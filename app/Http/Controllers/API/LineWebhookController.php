<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\RichMenuBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Clockin;
use App\Models\Users;

class LineWebhookController extends Controller
{

    protected $lineAccessToken;
    protected $lineChannelSecret;

    public function __construct()
    {
        $this->lineAccessToken = config('line.LINE_ACCESS_TOKEN');
        $this->lineChannelSecret = config('line.LINE_CHANNEL_SECRET');
        $this->liffUrl = config('line.LINE_REGISTER_LIFF_URL');
        
        $this->httpClient = new CurlHTTPClient ($this->lineAccessToken);
        $this->lineBot = new LINEBot($this->httpClient, ['channelSecret' => $this->lineChannelSecret]);
    }

    public function webhook (Request $request)
    {
        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
        if (!SignatureValidator::validateSignature($request->getContent(), $this->lineChannelSecret, $signature)) {
            return;
        }

        try {
            $events = $this->lineBot->parseEventRequest($request->getContent(), $signature);

            $type = json_decode($request->getContent())->events[0]->type;
            if ($type == 'message') {
                foreach ($events as $event) {
                    $replyToken = $event->getReplyToken();
                    $text = $event->getText();// 得到使用者輸入
                    $time = substr($event->getTimestamp()+28800000, 0, 10); // 伺服器時間晚8小時
                    $userId = $event->getUserId();
                    // $this->lineBot->replyText($replyToken, $text);// 回復使用者輸入
                    if (substr($text, 0, 1) == '$') {
                        $this->executeInstructions($replyToken, $text, $time, $userId);
                    }
                }
            }
        } catch (Exception $e) {
            return;
        }

        return;
    }

    public function createRichMenu (Request $request)
    {
        $imagePath = public_path() . '/img/register_menu.jpg';
        $contentType = 'image/jpeg';
        $size = new RichMenuSizeBuilder(1683, 2500);
        $register_boundsBuilder = new RichMenuAreaBoundsBuilder(1, 1, 2500, 1683);

        $register_actionBuilder = new UriTemplateActionBuilder('立即註冊', $this->liffUrl);
        $register_area = new  RichMenuAreaBuilder($register_boundsBuilder, $register_actionBuilder);
        $richMenuBuilder = new RichMenuBuilder($size, false, "Nice richmenu", "點擊註冊", [$register_area]);
        $response = $this->lineBot->createRichMenu($richMenuBuilder);
        $richmenu = json_decode($response->getRawBody(), true)["richMenuId"];
        $upload_image_url = "https://api-data.line.me/v2/bot/richmenu/{$richmenu}/content";
        $clinet = new Client();
        $res = $clinet->post($upload_image_url,
            [
                'headers' => [
                    'Authorization' => "Bearer {$this->lineAccessToken}",
                    'Content-Type' => 'image/png'
                ],
                'body' => file_get_contents($imagePath)
            ]);

        $link_menu_to_all_user_url = "https://api.line.me/v2/bot/user/all/richmenu/{$richmenu}";
        $res = $clinet->post($link_menu_to_all_user_url,
            [
                'headers' => [
                    'Authorization' => "Bearer {$this->lineAccessToken}",
                    'Content-Type' => 'application/json'
                ]
            ]);
            if($request->has('line_uid')){
                $this->createRichMenuForUser($richmenu,$request->line_uid);
            }

        return response()->json($res->getBody());
    }

    public function createClientRichMenu($line_user_id)
    {
        $imagePath = public_path() . '/img/book_menu.jpg';
        $size = new RichMenuSizeBuilder(1683, 2500);

        $reserve_boundsBuilder = new RichMenuAreaBoundsBuilder(0, 0, 2500, 1683);

        $reserve_actionBuilder = new UriTemplateActionBuilder('預約',config('line.liff_recv_url'). '/reserve?id=' . strval($line_user_id));

        $reserve_area = new  RichMenuAreaBuilder($reserve_boundsBuilder, $reserve_actionBuilder);

        $richMenuBuilder = new RichMenuBuilder($size, false, "Nice richmenu", "立即預約", [$reserve_area]);

        $response = $this->lineBot->createRichMenu($richMenuBuilder);
        
        $richmenu = json_decode($response->getRawBody(), true)["richMenuId"];

        $upload_image_url = "https://api-data.line.me/v2/bot/richmenu/{$richmenu}/content";
        $clinet = new Client();
        $res = $clinet->post($upload_image_url,
            [
                'headers' => [
                    'Authorization' => "Bearer {$this->lineAccessToken}",
                    'Content-Type' => 'image/png'
                ],
                'body' => file_get_contents($imagePath)
            ]);

        $link_menu_to_user_url = "https://api.line.me/v2/bot/user/{$line_user_id}/richmenu/{$richmenu}";
        $res = $clinet->post($link_menu_to_user_url,
            [
                'headers' => [
                    'Authorization' => "Bearer {$this->lineAccessToken}",
                    'Content-Type' => 'application/json'
                ]
            ]);

        return response()->json($res->getBody());
    }

    public function createRichMenuForUser($richmenu, $line_user_id)
    {
        $clinet = new Client();
        $link_menu_to_user_url = "https://api.line.me/v2/bot/user/{$line_user_id}/richmenu/{$richmenu}";
        $res = $clinet->post($link_menu_to_user_url,
            [
                'headers' =>[
                    'Authorization' => "Bearer {$this->lineAccessToken}",
                    'Content-Type' => 'application/json'
                ]
            ]);

        return $res;
    }

    function executeInstructions($replyToken, $text, $time, $userId)
    {
        $user = Users::where('line_uid', $userId)->first();
        if (!$user) {
            $this->lineBot->replyText($replyToken, '系統找不到該使用者。');
        }
        $date = date('Y-m-d', $time);
        $dateArray = strptime($date, '%Y-%m-%d');
        $datetimestamp = mktime(0, 0, 0, $dateArray['tm_mon']+1, $dateArray['tm_mday'], $dateArray['tm_year']+1900);
        $quarterPastTwelve = $datetimestamp + 44100;
        
        $isWork = Clockin::where('user_id', $user->id)->where('date', $date)->first();
        
        switch ($text) {
            case '$上工':
                if ($isWork) {
                    $this->lineBot->replyText($replyToken, $user->nick.' 重複打卡');
                    break;
                }
                if ($time > $quarterPastTwelve) {
                    $lateTime = $quarterPastTwelve - $time;
                    $lateHour = floor($lateTime / 3600);
                    if ($lateHour == 0) {
                        $lateHour = 1;
                    }
                    Clockin::create([
                        'date' => $date,
                        'type' => 'work',
                        'name' => $user->nick,
                        'user_id' => $user->id,
                        'start_time' => $time,
                        'late_time' => $lateHour,
                    ]);
                    $this->lineBot->replyText($replyToken, $user->nick.' 上班遲到：'.$lateHour.' 小時。');
                    break;
                }
                Clockin::create([
                    'date' => $date,
                    'type' => 'work',
                    'name' => $user->nick,
                    'user_id' => $user->id,
                    'start_time' => $time
                ]);
                $this->lineBot->replyText($replyToken, $user->nick.' 打卡成功');
                break;
            case '$收工':
                if (!$isWork) {
                    $yesterdayTimestamp = $datetimestamp - 86400;
                    $yesterday = date('Y-m-d', $yesterdayTimestamp);
                    $yesterdayWork = Clockin::where('user_id', $user->id)->where('date', $yesterday)->first();
                    if ($yesterdayWork) {
                        $yesterdayStartTime = $yesterday . ' ' . substr($yesterdayWork->start_time, 11, 8);
                        $YStimestamp = strtotime($yesterdayStartTime);
                        if (!$yesterdayWork->end_time) {
                            $yesterdayWork->end_time = $time;
                            $overTime = floor(($time - $YStimestamp)/3600);
                            $yesterdayWork->total = 8;
                            $yesterdayWork->over_time = $overTime;
                            $yesterdayWork->save();
                            $this->lineBot->replyText($replyToken, $user->nick.' 下班成功，有效時數為：8 小時。');
                            break;
                        }
                    }
                    $this->lineBot->replyText($replyToken, $user->nick.' 下班失敗');
                    break;
                }
                if (!$isWork->end_time) {
                    $startTime = $date . ' ' . substr($isWork->start_time, 11, 8);
                    $timestamp = strtotime($startTime);
                    $isWork->end_time = $time;
                    $total = floor(($time - $timestamp)/3600);
                    if ($total > 8) {
                        $overTime = $total - 8;
                        $total = 8;
                        $isWork->over_time = $overTime;
                    } else if ($total < 8) {
                        $earlyTime = $total - 8;
                        $isWork->leave_early_time = $earlyTime;
                    }
                    $isWork->total = $total;
                    $isWork->save();
                    $this->lineBot->replyText($replyToken, $user->nick.' 下班成功，有效時數為：'.$total.' 小時。');
                    break;
                }
                $this->lineBot->replyText($replyToken, $user->nick.' 重複下班');
                break;
            case '$請假':
                if ($isWork) {
                    if ($isWork->type == 'leave') {
                        $this->lineBot->replyText($replyToken, $user->nick.' 重複請假');
                        break;
                    }
                    $isWork->type = 'leave';
                    $startTime = $date . ' ' . substr($isWork->start_time, 11, 8);
                    $timestamp = strtotime($startTime);
                    $isWork->end_time = $time;
                    $total = floor(($time - $timestamp)/3600);
                    $earlyTime = $total - 8;
                    $isWork->leave_early_time = $earlyTime;
                    $isWork->total = $total;
                    $isWork->save();
                    $this->lineBot->replyText($replyToken, $user->nick.' 請假成功，上班時數為：'.$total.' 小時，請說明事由。');
                    break;
                }
                Clockin::create([
                    'date' => $date,
                    'type' => 'leave',
                    'name' => $user->nick,
                    'user_id' => $user->id,
                    'total' => 0
                ]);
                $this->lineBot->replyText($replyToken, $user->nick.' 請假成功，請說明事由。');
                break;
            case '$出師表':
                $this->lineBot->replyText($replyToken, "臣亮言：先帝創業未半，而中道崩殂。今天下三分，益州疲弊，此誠危急存亡之秋也。然侍衛之臣，不懈於內；忠志之士，忘身於外者，蓋追先帝之殊遇，欲報之於陛下也。誠宜開張聖聽，以光先帝遺德，恢宏志士之氣；不宜妄自菲薄，引喻失義，以塞忠諫之路也。");
                break;
        }

        if (strpos($text, '$事由') !== false) {
            $reason = Clockin::where('user_id', $user->id)->where('date', $date)->where('type', 'leave')->first();
            if ($reason) {
                $reason->note = $text;
                $this->lineBot->replyText($replyToken, $user->nick.'請假事由寫入成功。');
            } else {
                $this->lineBot->replyText($replyToken, $user->nick.'請假事由寫入失敗，請確認今日有無請假。');
            }
        }
    }

}

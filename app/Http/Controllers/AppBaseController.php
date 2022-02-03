<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Http\Request;
use App\User;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
    
    public function Get_Token_User(Request $request, $stoken)
    {

        $token = $stoken;

        $user_data = User::GetUserByToken($token);
        if($user_data==null){
            return $this->sendError( 'token failed :'.$token,401)
                ->header('Access-Control-Allow-Origin', "*")
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization')
            ->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS');
        }else{
            return response()->json($user_data);
            // return $next($request)
            // ->header('Access-Control-Allow-Origin', "*")
            // ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization')
            // ->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS');
        }

    }
    
}

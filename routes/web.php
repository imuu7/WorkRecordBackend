<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\LineWebhookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // \Auth::loginUsingId(1, TRUE);
    return view('welcome');
});

Route::get('/sample_deepblue_buttons', function () {
    return view('sample_deepblue.buttons');
});

Auth::routes(['verify' => true]);

Auth::routes();

// Route::get('/register', function () {
  
//     $lineController = app(LineWebhookController::class);
//     $line_udi = 'U9588773f3def9bbd395dda3e60524ffe';
//     $lineController->createClientRichMenu($line_udi);
//     return view('auth.closewin');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'TokenCheck'])->group(function () {
    Route::get('/home', 'HomeController@index')->middleware('verified');
    Route::resource('clockins', 'ClockinController');
});

Route::post('/tel_bot', 'Telegram_Controller@index');


Route::resource('users', 'UsersController');


// Route::get('/tel_bot', function () {
//     // return view('welcome');
// });





Route::resource('lineConfigs', 'LineConfigController');

Route::resource('telMsgLogs', 'tel_msg_logController');

Route::get('vue-migration', function () {
    return view('vue_migration');
});


Route::resource('configTables', 'config_tableController');

Route::get('/reserve', 'ReservationController@liff_create');

Route::get('/reserve/reserve', 'ReservationController@liff_create');
Route::resource('reservations', 'ReservationController');
Route::post('vue-migration', function(Request $request) {
    $cmds = json_decode($request->input(('data')), true);
    $tables = [];
    foreach($cmds as $cmd) {
        if (!isset($tables[$cmd['tableName']])) $tables[$cmd['tableName']] = [];

        $code = '$table->' . $cmd['rowType'] . '(\'' . $cmd['rowName'];
        if (intval($cmd['strLimit']) > 0) $code = $code . '\', ' . $cmd['strLimit'] . ')';
        else $code = $code . '\')';

        if ($cmd['nullable']) $code = $code . '->nullable()';
        if ($cmd['unique']) $code = $code . '->unique()';
        if (strlen($cmd['note']) > 0) $code . '->comment(' . $cmd['note'] . ')';

        $tables[$cmd['tableName']][] = $code . ';';
    }

    $upcode = '';
    $downcode = '';
    foreach (array_keys($tables) as $table) {
        $upcode = $upcode . '
            Schema::create(\'' . $table . '\', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                '
        . implode("\n                ", $tables[$table])
        . "\n            });\n";

        $downcode = $downcode . '            Schema::dropIfExists(\'' . $table . '\');' . "\n";
    }

    $migrationFileName = date('Y_m_d_Gis_') . 'create_' . implode('_', array_keys($tables)) . '_table' . (count($tables) > 1 ? 's' : '') . '.php';
    $migrationClassName = 'Create' . implode('', array_map(function($n) { return ucfirst($n); }, array_keys($tables))) . 'Table'. (count($tables) > 1 ? 's' : '');
    $migrationCode = "<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class $migrationClassName extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
$upcode
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
$downcode
        }
    }
    ";
    if (file_put_contents(base_path() . '/database/migrations/' . $migrationFileName, $migrationCode) === false) return response(500);
    return redirect('/vue-migration');
});

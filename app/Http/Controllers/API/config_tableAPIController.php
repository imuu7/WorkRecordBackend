<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createconfig_tableAPIRequest;
use App\Http\Requests\API\Updateconfig_tableAPIRequest;
use App\Models\config_table;
use App\Repositories\config_tableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\config_tableResource;
use Response;
use Artisan;
/**
 * Class config_tableController
 * @package App\Http\Controllers\API
 */

class config_tableAPIController extends AppBaseController
{
    /** @var  config_tableRepository */
    private $configTableRepository;

    public function __construct(config_tableRepository $configTableRepo)
    {
        $this->configTableRepository = $configTableRepo;
    }
    public function create_migration(Request $request){
        $table_name = $request->table_name;
        $columns_list = $request->columns;

        // dd($columns_list);
        $row_up_data = "   Schema::create('%s', function (Blueprint \$table) {
         %s
        });";
        $row_up_rows = [];
        $row_down_data = "Schema::dropIfExists('$table_name');";
        #產生列表
        $row_up_rows[] = '$table->id();';
        foreach ($columns_list as $key => $value) {
            if($value == null){
                continue;
            }
            $up_row = '$table->%s("%s")';
            try {
                $up_row = sprintf($up_row, $value['column_type'],$value['column_name']);
            } catch (\Throwable $th) {
            //    print_r($th);
                // dd($value);

            }
           
            if($value['allow_null']=='true'){
                $up_row = $up_row.'->nullable()';
            }
            if($value['unique']=='true'){
                $up_row = $up_row.'->unique()';
            }
            if($value['add_index']=='true'){
                $up_row = $up_row.'->index()';
            }
            

            $up_row = $up_row.';';
            // $row_up_data .= $up_row;
            $row_up_rows[] = $up_row;
        }
        $row_up_rows[] = '$table->timestamps();';
        $row_up_rows[] = '$table->softDeletes();';
        //補格式
        foreach ($row_up_rows as $key => $value) {
            $row_up_rows[$key] = '                  '.$value;
        }


        $row_up_data =  sprintf($row_up_data,$table_name, join("\n",$row_up_rows));


        $stream = fopen("php://output", "w");

        // Artisan::call("infyom:scaffold", ['name' => $request['name'], '--fieldsFile' => 'public/Product.json']);
        Artisan::call("make:migration", ["name"=>"ui_mode_".$table_name."_".time()]);
        $rs = Artisan::output();

        $rs_sp = explode(" ",$rs);
        $file_name = trim($rs_sp[2]);
        $file_name = $file_name.".php";
        $file_path = base_path()."/database/migrations/".$file_name;
        // print_r($rs_sp);
        // 
        $file_data = file_get_contents($file_path);
        preg_match_all('/class ([\w\W]+?) extends Migration/',$file_data,$class_name_arr);
        $class_name = $class_name_arr[1][0];
       
        $sample = "<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        
        class %s extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
        %s
            }
        
            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                %s
            }
        }
        ";

        
        $format = sprintf($sample, $class_name,$row_up_data,$row_down_data);
        // dd($format);
        file_put_contents($file_path,$format);
     
        Artisan::call("migrate", []);
    }
    /**
     * Display a listing of the config_table.
     * GET|HEAD /configTables
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $configTables = $this->configTableRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            config_tableResource::collection($configTables),
            __('messages.retrieved', ['model' => __('models/configTables.plural')])
        );
    }

    /**
     * Store a newly created config_table in storage.
     * POST /configTables
     *
     * @param Createconfig_tableAPIRequest $request
     *
     * @return Response
     */
    public function store(Createconfig_tableAPIRequest $request)
    {
        $input = $request->all();

        $configTable = $this->configTableRepository->create($input);

        return $this->sendResponse(
            new config_tableResource($configTable),
            __('messages.saved', ['model' => __('models/configTables.singular')])
        );
    }

    /**
     * Display the specified config_table.
     * GET|HEAD /configTables/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var config_table $configTable */
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/configTables.singular')])
            );
        }

        return $this->sendResponse(
            new config_tableResource($configTable),
            __('messages.retrieved', ['model' => __('models/configTables.singular')])
        );
    }

    /**
     * Update the specified config_table in storage.
     * PUT/PATCH /configTables/{id}
     *
     * @param int $id
     * @param Updateconfig_tableAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateconfig_tableAPIRequest $request)
    {
        $input = $request->all();

        /** @var config_table $configTable */
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/configTables.singular')])
            );
        }

        $configTable = $this->configTableRepository->update($input, $id);

        return $this->sendResponse(
            new config_tableResource($configTable),
            __('messages.updated', ['model' => __('models/configTables.singular')])
        );
    }

    /**
     * Remove the specified config_table from storage.
     * DELETE /configTables/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var config_table $configTable */
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/configTables.singular')])
            );
        }

        $configTable->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/configTables.singular')])
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\config_tableDataTable;
use App\Http\Requests;
use App\Http\Requests\Createconfig_tableRequest;
use App\Http\Requests\Updateconfig_tableRequest;
use App\Repositories\config_tableRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class config_tableController extends AppBaseController
{
    /** @var  config_tableRepository */
    private $configTableRepository;

    public function __construct(config_tableRepository $configTableRepo)
    {
        $this->configTableRepository = $configTableRepo;
    }

    /**
     * Display a listing of the config_table.
     *
     * @param config_tableDataTable $configTableDataTable
     * @return Response
     */
    public function index(config_tableDataTable $configTableDataTable)
    {
        return $configTableDataTable->render('config_tables.index');
    }

    /**
     * Show the form for creating a new config_table.
     *
     * @return Response
     */
    public function create()
    {
        return view('config_tables.create');
    }

    /**
     * Store a newly created config_table in storage.
     *
     * @param Createconfig_tableRequest $request
     *
     * @return Response
     */
    public function store(Createconfig_tableRequest $request)
    {
        $input = $request->all();

        $configTable = $this->configTableRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/configTables.singular')]));

        return redirect(route('configTables.index'));
    }

    /**
     * Display the specified config_table.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            Flash::error(__('messages.not_found', ['model' => __('models/configTables.singular')]));

            return redirect(route('configTables.index'));
        }

        return view('config_tables.show')->with('configTable', $configTable);
    }

    /**
     * Show the form for editing the specified config_table.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            Flash::error(__('messages.not_found', ['model' => __('models/configTables.singular')]));

            return redirect(route('configTables.index'));
        }

        return view('config_tables.edit')->with('configTable', $configTable);
    }

    /**
     * Update the specified config_table in storage.
     *
     * @param  int              $id
     * @param Updateconfig_tableRequest $request
     *
     * @return Response
     */
    public function update($id, Updateconfig_tableRequest $request)
    {
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            Flash::error(__('messages.not_found', ['model' => __('models/configTables.singular')]));

            return redirect(route('configTables.index'));
        }

        $configTable = $this->configTableRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/configTables.singular')]));

        return redirect(route('configTables.index'));
    }

    /**
     * Remove the specified config_table from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $configTable = $this->configTableRepository->find($id);

        if (empty($configTable)) {
            Flash::error(__('messages.not_found', ['model' => __('models/configTables.singular')]));

            return redirect(route('configTables.index'));
        }

        $this->configTableRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/configTables.singular')]));

        return redirect(route('configTables.index'));
    }

    public function file_upload($file)
    {
        return Storage::put(storage_path('config_table'), $file);

    }

}

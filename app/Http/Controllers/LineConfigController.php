<?php

namespace App\Http\Controllers;

use App\DataTables\LineConfigDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLineConfigRequest;
use App\Http\Requests\UpdateLineConfigRequest;
use App\Repositories\LineConfigRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LineConfigController extends AppBaseController
{
    /** @var  LineConfigRepository */
    private $lineConfigRepository;

    public function __construct(LineConfigRepository $lineConfigRepo)
    {
        $this->lineConfigRepository = $lineConfigRepo;
    }

    /**
     * Display a listing of the LineConfig.
     *
     * @param LineConfigDataTable $lineConfigDataTable
     * @return Response
     */
    public function index(LineConfigDataTable $lineConfigDataTable)
    {
        return $lineConfigDataTable->render('line_configs.index');
    }

    /**
     * Show the form for creating a new LineConfig.
     *
     * @return Response
     */
    public function create()
    {
        return view('line_configs.create');
    }

    /**
     * Store a newly created LineConfig in storage.
     *
     * @param CreateLineConfigRequest $request
     *
     * @return Response
     */
    public function store(CreateLineConfigRequest $request)
    {
        $input = $request->all();

        $lineConfig = $this->lineConfigRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/lineConfigs.singular')]));

        return redirect(route('lineConfigs.index'));
    }

    /**
     * Display the specified LineConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lineConfig = $this->lineConfigRepository->find($id);

        if (empty($lineConfig)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lineConfigs.singular')]));

            return redirect(route('lineConfigs.index'));
        }

        return view('line_configs.show')->with('lineConfig', $lineConfig);
    }

    /**
     * Show the form for editing the specified LineConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lineConfig = $this->lineConfigRepository->find($id);

        if (empty($lineConfig)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lineConfigs.singular')]));

            return redirect(route('lineConfigs.index'));
        }

        return view('line_configs.edit')->with('lineConfig', $lineConfig);
    }

    /**
     * Update the specified LineConfig in storage.
     *
     * @param  int              $id
     * @param UpdateLineConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLineConfigRequest $request)
    {
        $lineConfig = $this->lineConfigRepository->find($id);

        if (empty($lineConfig)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lineConfigs.singular')]));

            return redirect(route('lineConfigs.index'));
        }

        $lineConfig = $this->lineConfigRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/lineConfigs.singular')]));

        return redirect(route('lineConfigs.index'));
    }

    /**
     * Remove the specified LineConfig from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lineConfig = $this->lineConfigRepository->find($id);

        if (empty($lineConfig)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lineConfigs.singular')]));

            return redirect(route('lineConfigs.index'));
        }

        $this->lineConfigRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/lineConfigs.singular')]));

        return redirect(route('lineConfigs.index'));
    }

    public function file_upload($file)
    {
        return Storage::put(storage_path('LineConfig'), $file);

    }

}

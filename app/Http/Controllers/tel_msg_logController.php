<?php

namespace App\Http\Controllers;

use App\DataTables\tel_msg_logDataTable;
use App\Http\Requests;
use App\Http\Requests\Createtel_msg_logRequest;
use App\Http\Requests\Updatetel_msg_logRequest;
use App\Repositories\tel_msg_logRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class tel_msg_logController extends AppBaseController
{
    /** @var  tel_msg_logRepository */
    private $telMsgLogRepository;

    public function __construct(tel_msg_logRepository $telMsgLogRepo)
    {
        $this->telMsgLogRepository = $telMsgLogRepo;
    }

    /**
     * Display a listing of the tel_msg_log.
     *
     * @param tel_msg_logDataTable $telMsgLogDataTable
     * @return Response
     */
    public function index(tel_msg_logDataTable $telMsgLogDataTable)
    {
        return $telMsgLogDataTable->render('tel_msg_logs.index');
    }

    /**
     * Show the form for creating a new tel_msg_log.
     *
     * @return Response
     */
    public function create()
    {
        return view('tel_msg_logs.create');
    }

    /**
     * Store a newly created tel_msg_log in storage.
     *
     * @param Createtel_msg_logRequest $request
     *
     * @return Response
     */
    public function store(Createtel_msg_logRequest $request)
    {
        $input = $request->all();

        $telMsgLog = $this->telMsgLogRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/telMsgLogs.singular')]));

        return redirect(route('telMsgLogs.index'));
    }

    /**
     * Display the specified tel_msg_log.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $telMsgLog = $this->telMsgLogRepository->find($id);

        if (empty($telMsgLog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/telMsgLogs.singular')]));

            return redirect(route('telMsgLogs.index'));
        }

        return view('tel_msg_logs.show')->with('telMsgLog', $telMsgLog);
    }

    /**
     * Show the form for editing the specified tel_msg_log.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $telMsgLog = $this->telMsgLogRepository->find($id);

        if (empty($telMsgLog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/telMsgLogs.singular')]));

            return redirect(route('telMsgLogs.index'));
        }

        return view('tel_msg_logs.edit')->with('telMsgLog', $telMsgLog);
    }

    /**
     * Update the specified tel_msg_log in storage.
     *
     * @param  int              $id
     * @param Updatetel_msg_logRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetel_msg_logRequest $request)
    {
        $telMsgLog = $this->telMsgLogRepository->find($id);

        if (empty($telMsgLog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/telMsgLogs.singular')]));

            return redirect(route('telMsgLogs.index'));
        }

        $telMsgLog = $this->telMsgLogRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/telMsgLogs.singular')]));

        return redirect(route('telMsgLogs.index'));
    }

    /**
     * Remove the specified tel_msg_log from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $telMsgLog = $this->telMsgLogRepository->find($id);

        if (empty($telMsgLog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/telMsgLogs.singular')]));

            return redirect(route('telMsgLogs.index'));
        }

        $this->telMsgLogRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/telMsgLogs.singular')]));

        return redirect(route('telMsgLogs.index'));
    }

    public function file_upload($file)
    {
        return Storage::put(storage_path('tel_msg_log'), $file);

    }

}

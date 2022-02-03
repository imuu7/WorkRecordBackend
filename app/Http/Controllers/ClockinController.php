<?php

namespace App\Http\Controllers;

use App\DataTables\ClockinDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateClockinRequest;
use App\Http\Requests\UpdateClockinRequest;
use App\Repositories\ClockinRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ClockinController extends AppBaseController
{
    /** @var  ClockinRepository */
    private $clockinRepository;

    public function __construct(ClockinRepository $clockinRepo)
    {
        $this->clockinRepository = $clockinRepo;
    }

    /**
     * Display a listing of the Clockin.
     *
     * @param ClockinDataTable $clockinDataTable
     * @return Response
     */
    public function index(ClockinDataTable $clockinDataTable)
    {
        if (auth()->user()->role !== 'admin') {
            return $clockinDataTable->with(['id' => auth()->user()->id])->render('clockins.index', ['id' => auth()->user()->id]);
        }
        return $clockinDataTable->render('clockins.index');
    }

    /**
     * Show the form for creating a new Clockin.
     *
     * @return Response
     */
    public function create()
    {
        return view('clockins.create');
    }

    /**
     * Store a newly created Clockin in storage.
     *
     * @param CreateClockinRequest $request
     *
     * @return Response
     */
    public function store(CreateClockinRequest $request)
    {
        $input = $request->all();

        $clockin = $this->clockinRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/clockins.singular')]));

        return redirect(route('clockins.index'));
    }

    /**
     * Display the specified Clockin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clockins.singular')]));

            return redirect(route('clockins.index'));
        }

        return view('clockins.show')->with('clockin', $clockin);
    }

    /**
     * Show the form for editing the specified Clockin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clockins.singular')]));

            return redirect(route('clockins.index'));
        }

        return view('clockins.edit')->with('clockin', $clockin);
    }

    /**
     * Update the specified Clockin in storage.
     *
     * @param  int              $id
     * @param UpdateClockinRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClockinRequest $request)
    {
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clockins.singular')]));

            return redirect(route('clockins.index'));
        }

        $clockin = $this->clockinRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/clockins.singular')]));

        return redirect(route('clockins.index'));
    }

    /**
     * Remove the specified Clockin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clockins.singular')]));

            return redirect(route('clockins.index'));
        }

        $this->clockinRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/clockins.singular')]));

        return redirect(route('clockins.index'));
    }

    public function file_upload($file)
    {
        return Storage::put(storage_path('Clockin'), $file);

    }

}

<?php

namespace App\Http\Controllers;

use App\DataTables\ReservationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Repositories\ReservationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class ReservationController extends AppBaseController
{
    /** @var  ReservationRepository */
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->reservationRepository = $reservationRepo;
    }

    /**
     * Display a listing of the Reservation.
     *
     * @param ReservationDataTable $reservationDataTable
     * @return Response
     */
    public function index(ReservationDataTable $reservationDataTable)
    {
        return $reservationDataTable->render('reservations.index');
    }

    /**
     * Show the form for creating a new Reservation.
     *
     * @return Response
     */
    public function create(Request $request)
    { 
        if ($request->has('liff_state')) {
            $state = $request->liff_state;
            $uid = str_replace('/reserve?id=',"",$state);
            $user = \App\User::where('line_uid', $uid)->first();
           
            if ($user)
                return view('reservations.create', ['name' => $user->name]);
        }
        return redirect('/register');
    }
    public function liff_create(Request $request)
    { 
        // dd($request->all());
        if ($request->has('liff_state')) {
            $state = $request->liff_state;
            $uid = str_replace('/reserve?id=',"",$state);
            $user = \App\User::where('line_uid', $uid)->first();
           
            if ($user)
                return view('reservations.Liff_create', ['name' => $user->name]);
        }else{
           
            $uid = $request->id;
            $user = \App\User::where('line_uid', $uid)->first();
           
            if ($user)
                return view('reservations.Liff_create', ['name' => $user->name]);

        }
        // return redirect('/register');
    }

    /**
     * Store a newly created Reservation in storage.
     *
     * @param CreateReservationRequest $request
     *
     * @return Response
     */
    public function store(CreateReservationRequest $request)
    {
        $input = $request->all();

        $reservation = $this->reservationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/reservations.singular')]));

        return redirect(route('reservations.index'));
    }

    /**
     * Display the specified Reservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('reservations.index'));
        }

        return view('reservations.show')->with('reservation', $reservation);
    }

    /**
     * Show the form for editing the specified Reservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('reservations.index'));
        }

        return view('reservations.edit')->with('reservation', $reservation);
    }

    /**
     * Update the specified Reservation in storage.
     *
     * @param  int              $id
     * @param UpdateReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationRequest $request)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('reservations.index'));
        }

        $reservation = $this->reservationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/reservations.singular')]));

        return redirect(route('reservations.index'));
    }

    /**
     * Remove the specified Reservation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reservations.singular')]));

            return redirect(route('reservations.index'));
        }

        $this->reservationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/reservations.singular')]));

        return redirect(route('reservations.index'));
    }

    public function file_upload($file)
    {
        return Storage::put(storage_path('Reservation'), $file);

    }

}

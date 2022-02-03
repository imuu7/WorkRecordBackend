<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReservationAPIRequest;
use App\Http\Requests\API\UpdateReservationAPIRequest;
use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ReservationResource;
use Response;

/**
 * Class ReservationController
 * @package App\Http\Controllers\API
 */

class ReservationAPIController extends AppBaseController
{
    /** @var  ReservationRepository */
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->reservationRepository = $reservationRepo;
    }

    /**
     * Display a listing of the Reservation.
     * GET|HEAD /reservations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $reservations = $this->reservationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ReservationResource::collection($reservations),
            __('messages.retrieved', ['model' => __('models/reservations.plural')])
        );
    }

    /**
     * Store a newly created Reservation in storage.
     * POST /reservations
     *
     * @param CreateReservationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReservationAPIRequest $request)
    {
        $input = $request->all();

        $reservation = $this->reservationRepository->create($input);

        return $this->sendResponse(
            new ReservationResource($reservation),
            __('messages.saved', ['model' => __('models/reservations.singular')])
        );
    }

    /**
     * Display the specified Reservation.
     * GET|HEAD /reservations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Reservation $reservation */
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reservations.singular')])
            );
        }

        return $this->sendResponse(
            new ReservationResource($reservation),
            __('messages.retrieved', ['model' => __('models/reservations.singular')])
        );
    }

    /**
     * Update the specified Reservation in storage.
     * PUT/PATCH /reservations/{id}
     *
     * @param int $id
     * @param UpdateReservationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Reservation $reservation */
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reservations.singular')])
            );
        }

        $reservation = $this->reservationRepository->update($input, $id);

        return $this->sendResponse(
            new ReservationResource($reservation),
            __('messages.updated', ['model' => __('models/reservations.singular')])
        );
    }

    /**
     * Remove the specified Reservation from storage.
     * DELETE /reservations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Reservation $reservation */
        $reservation = $this->reservationRepository->find($id);

        if (empty($reservation)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reservations.singular')])
            );
        }

        $reservation->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/reservations.singular')])
        );
    }
}

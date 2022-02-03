<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClockinAPIRequest;
use App\Http\Requests\API\UpdateClockinAPIRequest;
use App\Models\Clockin;
use App\Repositories\ClockinRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ClockinResource;
use Response;

/**
 * Class ClockinController
 * @package App\Http\Controllers\API
 */

class ClockinAPIController extends AppBaseController
{
    /** @var  ClockinRepository */
    private $clockinRepository;

    public function __construct(ClockinRepository $clockinRepo)
    {
        $this->clockinRepository = $clockinRepo;
    }

    /**
     * Display a listing of the Clockin.
     * GET|HEAD /clockins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $clockins = $this->clockinRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ClockinResource::collection($clockins),
            __('messages.retrieved', ['model' => __('models/clockins.plural')])
        );
    }

    /**
     * Store a newly created Clockin in storage.
     * POST /clockins
     *
     * @param CreateClockinAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClockinAPIRequest $request)
    {
        $input = $request->all();

        $clockin = $this->clockinRepository->create($input);

        return $this->sendResponse(
            new ClockinResource($clockin),
            __('messages.saved', ['model' => __('models/clockins.singular')])
        );
    }

    /**
     * Display the specified Clockin.
     * GET|HEAD /clockins/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Clockin $clockin */
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clockins.singular')])
            );
        }

        return $this->sendResponse(
            new ClockinResource($clockin),
            __('messages.retrieved', ['model' => __('models/clockins.singular')])
        );
    }

    /**
     * Update the specified Clockin in storage.
     * PUT/PATCH /clockins/{id}
     *
     * @param int $id
     * @param UpdateClockinAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClockinAPIRequest $request)
    {
        $input = $request->all();

        /** @var Clockin $clockin */
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clockins.singular')])
            );
        }

        $clockin = $this->clockinRepository->update($input, $id);

        return $this->sendResponse(
            new ClockinResource($clockin),
            __('messages.updated', ['model' => __('models/clockins.singular')])
        );
    }

    /**
     * Remove the specified Clockin from storage.
     * DELETE /clockins/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Clockin $clockin */
        $clockin = $this->clockinRepository->find($id);

        if (empty($clockin)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clockins.singular')])
            );
        }

        $clockin->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/clockins.singular')])
        );
    }
}

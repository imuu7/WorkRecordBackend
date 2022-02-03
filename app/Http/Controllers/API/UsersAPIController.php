<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUsersAPIRequest;
use App\Http\Requests\API\UpdateUsersAPIRequest;
use App\Models\Users;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UsersResource;
use Response;

/**
 * Class UsersController
 * @package App\Http\Controllers\API
 */

class UsersAPIController extends AppBaseController
{
    /** @var  UsersRepository */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    /**
     * Display a listing of the Users.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->usersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            UsersResource::collection($users),
            __('messages.retrieved', ['model' => __('models/users.plural')])
        );
    }

    /**
     * Store a newly created Users in storage.
     * POST /users
     *
     * @param CreateUsersAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUsersAPIRequest $request)
    {
        $input = $request->all();

        $users = $this->usersRepository->create($input);

        return $this->sendResponse(
            new UsersResource($users),
            __('messages.saved', ['model' => __('models/users.singular')])
        );
    }

    /**
     * Display the specified Users.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Users $users */
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        return $this->sendResponse(
            new UsersResource($users),
            __('messages.retrieved', ['model' => __('models/users.singular')])
        );
    }

    /**
     * Update the specified Users in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUsersAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsersAPIRequest $request)
    {
        $input = $request->all();

        /** @var Users $users */
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        $users = $this->usersRepository->update($input, $id);

        return $this->sendResponse(
            new UsersResource($users),
            __('messages.updated', ['model' => __('models/users.singular')])
        );
    }

    /**
     * Remove the specified Users from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Users $users */
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        $users->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/users.singular')])
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UserController extends Controller
{
    /**
     * The service instance
     */
    private UserService $userService;

    /**
     * Constructor
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('list', User::class);

        return $this->userService->index($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse|Response
     *
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return $this->responseDataSuccess(['properties' => $this->properties()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $this->authorize('create', User::class);

        $input = $request->validated();
        $record = $this->userService->create($input);
        if (! is_null($record)) {
            return $this->responseStoreSuccess(['record' => $record]);
        } else {
            return $this->responseStoreFail();
        }
    }

    /**
     *  Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function show(User $user): JsonResponse
    {
        $this->authorize('view', User::class);

        $model = $this->userService->get($user);

        return $this->responseDataSuccess(['model' => $model, 'properties' => $this->properties()]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(User $user): JsonResponse
    {
        $this->authorize('edit', User::class);

        return $this->show($user);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('edit', User::class);

        $data = $request->validated();
        if ($this->userService->update($user, $data)) {
            return $this->responseUpdateSuccess(['record' => $user->fresh()]);
        } else {
            return $this->responseUpdateFail();
        }
    }

    /**
     * Update avatar in for specified user
     * @throws AuthorizationException
     */
    public function updateAvatar(UpdateAvatarRequest $request, User $user): JsonResponse
    {
        $this->authorize('edit-profile', User::class);

        $data = $request->validated();
        if ($this->userService->updateAvatar($user, $data)) {
            return $this->responseUpdateSuccess(['record' => $user->fresh()]);
        } else {
            return $this->responseUpdateFail();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(DestroyUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('delete', User::class);

        if ($this->userService->delete($user)) {
            return $this->responseDeleteSuccess(['record' => $user]);
        }

        return $this->responseDeleteFail();

    }

    /**
     * Render properties
     */
    public function properties(): array
    {
        return [];
    }
}

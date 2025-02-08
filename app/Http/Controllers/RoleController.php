<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Services\Role\RoleService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * The service instance
     */
    protected RoleService $roleService;

    /**
     * Constructor
     */
    public function __construct(RoleService $service)
    {
        $this->roleService = $service;
    }

    /**
     * Handle search data
     * @throws AuthorizationException
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $this->authorize('search', Role::class);

        return $this->roleService->index($request->all());
    }
}

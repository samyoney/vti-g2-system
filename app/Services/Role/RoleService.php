<?php

namespace App\Services\Role;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleService
{
    /**
     * Get resource index from the database
     *
     */
    public function index($data): AnonymousResourceCollection
    {
        $query = Role::query();
        $per_page = isset($data['per_page']) && is_numeric($data['per_page']) ? intval($data['per_page']) : 10;

        if (! empty($data['search'])) {
            $query = $query->search($data['search']);
        }
        if (! empty($data['sort_by']) && ! empty($data['sort'])) {
            $query = $query->orderBy($data['sort_by'], $data['sort']);
        }

        return RoleResource::collection($query->paginate($per_page));
    }
}

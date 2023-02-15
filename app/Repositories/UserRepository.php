<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    public function getQuery(): Builder
    {
        return (new User())->query();
    }

    public function index(): Collection
    {
        return $this->getQuery()
            ->when(!auth()->user()->admin, function ($query) {
                $query->where('id', auth()->user()->id);
            })
            ->orderBy('surname')
            ->get();
    }
}

<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function index(): Collection;
}

<?php

namespace Modules\User\Jobs;

use App\Models\User;

class DeleteUserJob
{
    private $id;

    public function __construct(
        int $id
    ) {
        $this->id = $id;
    }

    public function handle(): void
    {
        $this->deleteUser();
    }

    private function deleteUser(): void
    {
        User::destroy($this->id);
    }
}

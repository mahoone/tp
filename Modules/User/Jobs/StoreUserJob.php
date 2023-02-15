<?php

namespace Modules\User\Jobs;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StoreUserJob
{
    private $firstName;
    private $surname;
    private $email;
    private $admin;
    private $password;

    public function __construct(
        string $firstName,
        string $surname,
        string $email,
        ?string $admin,
        ?string $password
    ) {
        $this->firstName = $firstName;
        $this->surname = $surname;
        $this->email = $email;
        $this->admin = $admin;
        $this->password = $password;
    }

    public function handle(): void
    {
        $this->storeUser();
    }

    private function storeUser(): void
    {
        $user = new User;
        $user->first_name = $this->firstName;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->admin = $this->admin ? 1 : 0;
        $user->password = Hash::make($this->password);
        $user->save();
    }
}

<?php

namespace Modules\User\Jobs;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterUserJob
{
    private $name;
    private $surname;
    private $email;
    private $admin;
    private $password;

    public function __construct(
        string $name,
        string $surname,
        string $email,
        ?string $admin,
        string $password
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->admin = $admin;
        $this->password = $password;
    }

    public function handle(): void
    {
        $this->registerUser();
    }

    private function registerUser(): void
    {
        $user = User::create([
            'first_name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'admin' => $this->admin ? 1 : 0,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
    }
}

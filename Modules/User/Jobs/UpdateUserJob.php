<?php

namespace Modules\User\Jobs;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserJob
{
    private $id;
    private $firstName;
    private $surname;
    private $email;
    private $admin;
    private $password;

    public function __construct(
        int $id,
        string $firstName,
        string $surname,
        string $email,
        ?string $admin,
        ?string $password
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->surname = $surname;
        $this->email = $email;
        $this->admin = $admin;
        $this->password = $password;
    }

    public function handle(): void
    {
        $this->updateUser();
    }

    private function updateUser(): void
    {
        $data = [
            'first_name' => $this->firstName,
            'surname' => $this->surname,
            'email' => $this->email,
            'admin' => !is_null($this->admin) ? 1 : 0,
            'password' => $this->password ? Hash::make($this->password) : '',
        ];

        if (!isset($this->password)) {
            unset($data['password']);
        }

        User::where('id', $this->id)
            ->update($data);
    }
}

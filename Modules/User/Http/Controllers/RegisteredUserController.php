<?php

namespace Modules\User\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Modules\User\Http\Controllers\BaseController;
use Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Jobs\RegisterUserJob;

class RegisteredUserController extends BaseController
{
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  App\Http\Requests\Auth\RegisterUserRequest  $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(
        RegisterUserRequest $request
    ) {

        $this->dispatchNow(
            new RegisterUserJob(
                $request->input('name'),
                $request->input('surname'),
                $request->input('email'),
                $request->input('admin'),
                $request->input('password'),
            )
        );

        return redirect(RouteServiceProvider::HOME);
    }
}

<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Modules\User\Http\Requests\DefaultUsersRequest;
use Modules\User\Http\Requests\ShowUserRequest;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Jobs\DeleteUserJob;
use Modules\User\Jobs\StoreUserJob;
use Modules\User\Jobs\UpdateUserJob;

class UserController extends BaseController
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function index(
        DefaultUsersRequest $request
    ) {
        return view('dashboard')
            ->with('users', $this->userRepositoryInterface->index());
    }

    public function store(
        StoreUserRequest $request,
        User $user
    ) {
        $this->authorize('store', $user);

        $this->dispatchNow(
            new StoreUserJob(
                $request->input('first_name'),
                $request->input('surname'),
                $request->input('email'),
                $request->input('admin'),
                $request->input('password'),
            )
        );

        return redirect()->route('dashboard');
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $this->authorize('update', $user);

        $this->dispatchNow(
            new UpdateUserJob(
                $user->id,
                $request->input('first_name'),
                $request->input('surname'),
                $request->input('email'),
                $request->input('admin'),
                $request->input('password'),
            )
        );

        return redirect()->route('dashboard');
    }

    public function delete(
        DefaultUsersRequest $request,
        User $user
    ) {
        $this->authorize('delete', $user);

        $this->dispatchNow(
            new DeleteUserJob(
                $user->id
            )
        );

        return redirect()->route('dashboard');
    }

    public function show(
        ShowUserRequest $request,
        User $user
    ) {
        $this->authorize('show', $user);

        return view('user.update')->with('user', $user);
    }

    public function showStore(
        DefaultUsersRequest $request
    ) {

        $this->authorize('showStore', auth()->user());

        return view('user.store');
    }
}

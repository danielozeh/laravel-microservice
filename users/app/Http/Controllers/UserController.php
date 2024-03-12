<?php

namespace App\Http\Controllers;
use App\Http\Core\UserService;
use App\Jobs\SendUserCreatedNotification;
use App\Library\Master;
use App\Models\User;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserService $user) {
        $this->user = $user;
    }
    public function createUser(CreateUserRequest $request) {

        try {
            return $this->user->createUser($request);
        } catch (Throwable $ex) {
            if (Master::hasDebug()) {
                return Master::exceptionResponse($ex, 'UserController.createUser');
            }
        }
        return Master::failureResponse();
    }
}

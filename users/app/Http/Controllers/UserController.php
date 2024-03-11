<?php

namespace App\Http\Controllers;
use App\Jobs\SendUserCreatedNotification;
use App\Library\Master;
use App\Models\User;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function createUser(CreateUserRequest $request) {
        try {
            $user = User::create($request->validated());

            dispatch(new SendUserCreatedNotification($user));

            return Master::successResponse('User created successfully', $user, 201);
        } catch (Throwable $ex) {
            // error_log('Here');
            if (Master::hasDebug()) {
                return Master::exceptionResponse($ex, 'UserController.createUser');
            }
        }
        return Master::failureResponse();
    }
}

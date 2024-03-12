<?php

namespace App\Http\Controllers;
use App\Http\Core\UserService;
use App\Jobs\SendUserCreatedNotification;
use App\Library\Master;
use App\Models\User;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Storage;

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

    public function createUserForm(CreateUserRequest $request) {

        try {
            $usersPath = 'public/users.json';
            $existingUsers = [];

            if (Storage::exists($usersPath)) {
                $jsonData = Storage::get($usersPath);
                $existingUsers = json_decode($jsonData, true); // Convert to associative array
            }

            $newUser = [
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
            ];

            $exists = in_array($request->email, array_column($existingUsers, 'email'));
            if($exists) return back()->with('alert', 'Email already exist');

            $existingUsers[] = $newUser;

            $combinedUsers = json_encode($existingUsers, JSON_PRETTY_PRINT); // Optional formatting

            Storage::put($usersPath, $combinedUsers);

            $user  = $newUser;

            dispatch(new SendUserCreatedNotification($user));

            return back()->with('message', 'User created successfully');
            
        } catch (Throwable $ex) {
            // error_log($ex->getMessage());
            return back()->with('alert', 'An error occured');
        }
    }
}

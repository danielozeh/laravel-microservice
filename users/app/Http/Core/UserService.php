<?php

namespace App\Http\Core;
use App\Jobs\SendUserCreatedNotification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Library\Master;

use Illuminate\Support\Facades\Storage;

class UserService {

    public function createUser($request) : JsonResponse {

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
        if($exists) return Master::failureResponse('Email already exist');

        $existingUsers[] = $newUser;

        $combinedUsers = json_encode($existingUsers, JSON_PRETTY_PRINT); // Optional formatting

        Storage::put($usersPath, $combinedUsers);

        $user  = $newUser;

        dispatch(new SendUserCreatedNotification($user));
        
        return Master::successResponse('User created successfully', $newUser, 201);
    }
}
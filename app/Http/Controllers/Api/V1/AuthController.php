<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ApiErrorCodes;
use App\Enums\ApiErrorStatus;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Services\Utils\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use JWTAuth;
use Hash;

class AuthController extends Controller
{
    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $rules = [
            'username' => 'required|exists:users',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'status' => ApiErrorCodes::Credentials_Error, 'error'=> $validator->messages()], ApiErrorStatus::Bad_Request);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success'=> false, 'status' => ApiErrorCodes::Credentials_Error, 'error'=> 'We cant find an account with this credentials. Username or password is incorrect.'], ApiErrorStatus::Unauthorized);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'status' => ApiErrorCodes::Unknown, 'error' => 'Failed to login, please try again.'], ApiErrorStatus::Internal_Server_Error);
        }

        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);
    }

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function register(Request $request)
    {
        $credentials = $request->only('first_name', 'last_name', 'username', 'email', 'password', 'type');

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'type' => 'required|in:customer,seller'
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'status' => ApiErrorCodes::Invalid_Params, 'error'=> $validator->messages()], ApiErrorStatus::Bad_Request);
        }

        Transaction::run(function () use ($request) {

            $fistName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $username = $request->input('username');
            $password = $request->input('password');
            $email = $request->input('email');
            $type = $request->input('type');

            $user = new User();
            $user->first_name = $fistName;
            $user->last_name = $lastName;
            $user->username = $username;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();

            if ($type == 'customer') {
                $roleId = Role::whereName('customer')->first()->id;
            } elseif ($type == 'seller') {
                $roleId = Role::whereName('seller')->first()->id;
            } else {
                return response()->json(['success'=> false, 'status' => ApiErrorCodes::Invalid_Params, 'error'=> $validator->messages()], ApiErrorStatus::Bad_Request);
            }

            $roleUser = new RoleUser();
            $roleUser->user_id = $user->id;
            $roleUser->role_id = $roleId;
            $roleUser->save();

        });

        return response()->json(['success'=> true, 'message'=> 'Thanks for signing up!']);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to re-login to get a new token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
}

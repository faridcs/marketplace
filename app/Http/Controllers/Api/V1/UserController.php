<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ApiErrorCodes;
use App\Enums\ApiErrorStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserByUserName(Request $request) {

        $rules = [
            'username' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'status' => ApiErrorCodes::Invalid_Params, 'error'=> $validator->messages()], ApiErrorStatus::Bad_Request);
        }

        $user = User::whereUsername($request->input('username'))->first();

        return response()->json(['success'=> true, 'data'=> $user], ApiErrorStatus::OK);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserById($id) {

        $user = User::whereId($id)->first();

        return response()->json(['success'=> true, 'data'=> $user], ApiErrorStatus::OK);
    }
}

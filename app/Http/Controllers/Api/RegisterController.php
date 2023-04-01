<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{

    /**
     * Register Api
     * The function takes a request object, validates the request, creates a user, creates a token for
     * the user, and returns a response
     * 
     * @param Request request The request object.
     * 
     * @return \Illuminate\Http\Response token and the name of the user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }


    /**
     * Login Api
     * If the user is authenticated, then create a token and return the token and the user's name. If
     * the user is not authenticated, then return an error
     * 
     * @param Request request The request object.
     * 
     * @return \Illuminate\Http\Response token is being returned.
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }


    /**
     * It deletes all the tokens associated with the user
     * 
     * @param Request request The request object.
     */
    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            auth()->user()->tokens()->delete();
            return $this->sendSuccess([], 'User logout successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}

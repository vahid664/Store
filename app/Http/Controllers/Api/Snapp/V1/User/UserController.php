<?php

namespace App\Http\Controllers\Api\Snapp\V1\User;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group  User
 *
 * APIs for managing users
 */
class UserController extends Controller
{
    /**
     * Login a user
     * @bodyParam  email required The email of the user. Example: info@snapp.com
     * @bodyParam  password string The password of the user.
     * @response{
     * "response": {
     * "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9NmU3NzJmOTNjMDJiNWM5ZDc1MmMyMDk0MWY3MjZhY2E4MTI4YTQzMDEzMzQwZjQwOTI3M2QzYmM1NjhlMzFjNDc4MGRjNWM3ZDIxYWUiLCJpYXQiOjE2MTUzNjQzMzksIm5iZiI6MTYxNTM2NDMzOSwiZXhwIjoxNjQ2OTAwMzM5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.g7bhRqxl-WeVGacF226Hi3w1H-vD9xQewg-cRRjD4DxQ9JNebFY_uRUiPB4cfPjbKt8RpjGOMrA_ObQ1r9gtigRjRHUscKfNQKzBeTHLDoHQ7w0YrxJ4RZagfHnJsNdWGlvws6JZwbbJLrxU33M8Xztk1N5UIQhA0KIayGNmhXZKfqxLnlExAxYqbd5RZyUWmUrWH5SLEzFmIc9MBih6aj4d2QQ1aLEF2DCIN3V9ReMzGzsLEwV7rrEUojntX_gzhqaNIbXRV1N-Nf1OFI7yOFX4YujApGp1s3vdIoHxQUoHgZszDPg5Ub738MViX_QchakpUhaZnvtt4Vvc_0ySTQ12DKB5ZfUKbhL5fpVZjBVFi0LK0ypKJmuWTrfCgSUR33Uudv1Ld4gs3ERweYsP25unpXtm3YgMKEtMmF2PFTyisdA5_zJge8DG1C1kcyYSpbHVpPkpy67zZP8eQyWDzU8SnRcSBE_7u5IwOrvt2q8K61XzoQa_RDUKjgFKn3CPIstKoRhrMMsWKmIygywrVi3HXuExL36CnBwdYuw2wg0WeavN69RgNH2yCTZYSkfonxAyOGioIYdL_21Y0C9FrT8DSCyjBfRG4JauGdlqyU3fHAdBdxTCH-im-POCBBF0fqtUqHlEs3jgnaOHjHLewoZ809W3j7V5BTW4wg56gus",
     * "token_type": "Bearer",
     * "expires_at": "2022-03-10 11:48:59"
     * },
     * "message": "Success",
     * "code": 200
     * }
     */
    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if($validator->fails()) {
            return Helper::ApiValue(null,$validator->errors()->all(),400);
        }
        if(Auth::attempt(['email' => $request->email , 'password' => $request->password , 'status' => 1 , 'level' => 99]))
        {
            $user=Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYear(1);
            $token->save();
            $data=[
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()];
            return Helper::ApiValue($data);
        }
        return Helper::ApiValue(null,'Unauthorised',401);
    }

    /**
     * logout
     * @response {
     * "response": null,
     * "message": "logout",
     * "code": 200
     * }
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return Helper::ApiValue(null,'Logout');
    }
}

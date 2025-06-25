<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Models\Role;
use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if (!$finduser) {
                $finduser = User::where("email", $user->getEmail())->first();
            }
            $role = Role::where("name", "=", "student")->first();

            if ($finduser) {

                if ($finduser->google_id != null) {
                    return
                        $this->loginViaGoogle($finduser->google_id);
                }
                return response("عذرا لم تقم بانشاء حسابك بواسطة google");
            } else {
                $newUser = User::create([
                    'email' => $user->email,
                    'google_id' => $user->id,
                    "role_id" => $role->id,
                    'password' => Hash::make('isr.expert.2023@gmail.com')
                ]);


                $fullName = $user->getName();
                $first_name = strtok($fullName, " ");

                $last_name = substr($fullName, strpos($fullName, " ") + 1);
                $student = Student::create([
                    'user_id' => $newUser->id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                ]);


                Money::create([
                    "student_id" => $newUser->id,
                    "value" => 0
                ]);
            }
            return $this->loginViaGoogle($newUser->google_id);
        } catch (Exception $e) {
            return response("server error", 500);
        }
    }
    function loginViaGoogle($google_id)
    {

        $user = User::where("google_id", $google_id)->first();
        if (!$user) {
            return response("not found", 403);
        }
        $credentials = [
            "email" => $user->email,
            "password" => "isr.expert.2023@gmail.com"
        ];
        // $passowrd = ;

        $user = Auth::attempt($credentials);
        $user = Auth::user();
        $token = Auth::login($user);

        $user->money;
        $info =  $user->student;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "mony" => $user->money ?? null,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }
}

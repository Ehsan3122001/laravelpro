<?php

namespace App\Http\Controllers;

use App\Mail\MailForgotPassowrd;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    function forgetPassowrd(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $number = "";

        $user = User::where("email", '=', $request->email)->first();

        if (is_null($user)) {
            return response("not found", 403);
        }
        $forget = ForgotPassword::where("user_id", "=", $user->id)->first();

        if (!is_null($forget)) {
            $currentTime = now();
            $forgetUpdateTime = $forget->updated_at;

            $timeDifference = $currentTime->diff($forgetUpdateTime);

            $hours = $timeDifference->h;
            $minutes = $timeDifference->i;
            $seconds = $timeDifference->s;

            if (
                $hours > 0
            ) {
                $timeMessage = "$hours ساعة و $minutes دقيقة و $seconds ثانية";
            } elseif ($minutes > 0) {
                $timeMessage = "$minutes دقيقة و $seconds ثانية";
            } else {
                $timeMessage = "$seconds ثانية";
            }
            // return $timeDifference->i;
            if ($timeDifference->i <= 1) {

                return response("لقد مضى على اخر محاولة $timeMessage يجب الانتظار دقيقتين للمحاولة من جديد", 403);
            }
            // return "here";
            $forget->delete();
        }
        for ($i = 0; $i < 5; $i++) {
            $random = random_int(0, 9);
            $number  = $number . "$random";
        }
        ForgotPassword::create([
            "code" => $number,
            "user_id" => $user->id,
            "is_true" => 0
        ]);
        Mail::to($request->email)->send(new MailForgotPassowrd($request->email, $number));
        return response("يرجى ادخال الكود الذي ارسلناه عبر بريدك الالكتروني", 200);
    }
    function checkIfCodeIsTrue(Request $request)
    {
        $request->validate([
            "code" => "required|numeric",
            'email' => 'required|string|email'
        ]);
        $user = User::where("email", '=', $request->email)->first();
        if (is_null($user)) {
            return response("not found", 403);
        }
        $reset = ForgotPassword::where("user_id", "=", $user->id)->first();
        if (!$reset) {
            return response(["success" => "false"], 500);
        }
        if ($reset->code == $request->code) {
            $reset->is_true = 1;
            $reset->updated_at = now();
            $reset->save();
            return response(["success" => "true"], 200);
        }
        return response(["خطا الكود الذي ادخلته غير صحيح", $this->forgetPassowrd($request)], 403);

        return response(["success" => "false"], 500);
    }
    function changePassowrd(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            "new_password" => "required|string|min:8"
        ]);
        $user =  User::where("email", '=', $request->email)->first();
        if (is_null($user)) {
            return response("email not found", 403);
        }
        $forget = ForgotPassword::where("user_id", "=", $user->id)->first();
        if (is_null($forget)) {
            return response("no access", 403);
        }
        if ($forget->is_true != 1) {
            return response("no access", 403);
        }
        $user->password = Hash::make($request->new_password);
        $user->updated_at = now();
        $user->save();
        $forget->delete();
        return response("passowrd updated", 202);
    }
}

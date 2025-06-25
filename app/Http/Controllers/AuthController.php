<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Marketer;
use App\Models\Money;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        if ($user->role->name == "student") {
            $info =  $user->student;

            $user->money;
        }
        if ($user->role->name == "admin") {
            $info = $user->admin;
        }
        if ($user->role->name == "teacher") {
            $info = $user->teacher;
        }
        if ($user->role->name == "employee") {
            $info =  $user->employee;
        }
        if ($user->role->name == "marketer") {

            $info =  $user->marketer;
        }
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

    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            "first_name" => "required|string|min:2",
            "last_name" => "required|string|min:2",
            "biographical" => "string|min:2",
            "facebook" => "url|min:2",
            "twitter" => "url|min:2",
            "youtube" => "url|min:2",
            "linkedin" => "url|min:2",
            "gender" => "boolean",
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $role = Role::where("name", "=", "student")->first();
        if (!$role) {
            $role = Role::create(["name" => "student"]);
        }
        $email = strtolower($request->email);
        $user = User::create([
            'email' => $email,
            'password' => Hash::make($request->password),
            "role_id" => $role->id
        ]);
        $student = new Student();

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->biographical = $request->biographical ?? null;
        $student->facebook = $request->facebook ?? null;
        $student->twitter = $request->twitter ?? null;
        $student->youtube = $request->youtube ?? null;
        $student->linkedin = $request->linkedin ?? null;
        $student->gender = $request->gender ?? null;
        $student->user_id = $user->id;
        $student->created_at = now();
        $student->updated_at = now();
        $student->save();
        if (isset($request->image)) {
            $student->addMediaFromRequest("image")
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection();
        }
        Money::create([
            "student_id" => $user->id
        ]);
        $token = Auth::login($user);
        $info =  $user->student;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }

    function createAdmin(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $role = Role::where("name", "=", "admin")->first();
        if (!$role) {
            $role = Role::create(["name" => "admin"]);
        }
        $email = strtolower($request->email);

        $user = User::create([

            'email' => $email,
            'password' => Hash::make($request->password),
            "role_id" => $role->id
        ]);
        $admin = Admin::create(["user_id" => $user->id]);
        $token = Auth::login($user);
        $info = $user->admin;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }
    function createMarketer(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $role = Role::where("name", "=", "marketer")->first();
        if (!$role) {
            $role = Role::create(["name" => "marketer"]);
        }
        $email = strtolower($request->email);

        $user = User::create([

            'email' => $email,
            'password' => Hash::make($request->password),
            "role_id" => $role->id
        ]);
        $Marketer = Marketer::create(["user_id" => $user->id]);

        $token = Auth::login($user);
        $info = $user->marketer;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }
    function createTeacher(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $role = Role::where("name", "=", "teacher")->first();
        if (!$role) {
            $role = Role::create(["name" => "teacher"]);
        }
        $email = strtolower($request->email);

        $user = User::create([

            'email' => $email,
            'password' => Hash::make($request->password),
            "role_id" => $role->id
        ]);
        $Teacher = Teacher::create(["user_id" => $user->id]);
        $token = Auth::login($user);
        $info = $user->teacher;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }
    function createEmployee(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $role = Role::where("name", "=", "employee")->first();
        if (!$role) {
            $role = Role::create(["name" => "employee"]);
        }
        $email = strtolower($request->email);

        $user = User::create([
            'email' => $email,
            'password' => Hash::make($request->password),
            "role_id" => $role->id
        ]);
        $Employee = Employee::create(["user_id" => $user->id]);

        $token = Auth::login($user);
        $info = $user->employee;
        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            "info" => $info,
            "role" => $user->role->name,
            'authorisation' => [
                'token' => $token,

            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),

            ]
        ]);
    }
}

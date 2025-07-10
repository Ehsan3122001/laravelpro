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
        $role = $user->role->name ?? null;

        // Get role-specific info
        $info = null;
        switch ($role) {
            case 'student':
                $info = $user->student;
                break;
            case 'admin':
                $info = $user->admin;
                break;
            case 'teacher':
                $info = $user->teacher;
                break;
            case 'employee':
                $info = $user->employee;
                break;
            case 'marketer':
                $info = $user->marketer;
                break;
        }

        // تحديد المسار حسب الدور
        $redirectTo = match ($role) {
            'admin' => '/dashboard',
            'student', 'teacher' => '/',
            default => '/'
        };


        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            'info' => $info,
            'mony' => $user->money ?? null,
            'role' => $role,
            'redirect_to' => $redirectTo,
            'authorisation' => [
                'token' => $token,
            ]
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:student,teacher,admin,marketer,employee',
            'first_name' => 'nullable|string|min:2',
            'last_name' => 'nullable|string|min:2',
            'biographical' => 'nullable|string|min:2',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'gender' => 'nullable|boolean',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $roleName = $request->role;
        $role = Role::firstOrCreate(['name' => $roleName]);

        $user = User::create([
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role_id' => $role->id
        ]);

        $info = null;

        switch ($roleName) {
            case 'student':
                $student = Student::create([
                    'user_id' => $user->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'biographical' => $request->biographical,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'youtube' => $request->youtube,
                    'linkedin' => $request->linkedin,
                    'gender' => $request->gender
                ]);
                Money::create(['student_id' => $user->id]);
                $info = $student;

                if ($request->hasFile('image')) {
                    $student->addMediaFromRequest('image')
                            ->sanitizingFileName(fn($fileName) => strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName)))
                            ->toMediaCollection();
                }
                break;

            case 'teacher':
                $info = Teacher::create(['user_id' => $user->id]);
                break;

            case 'admin':
                $info = Admin::create(['user_id' => $user->id]);
                break;

            case 'marketer':
                $info = Marketer::create(['user_id' => $user->id]);
                break;

            case 'employee':
                $info = Employee::create(['user_id' => $user->id]);
                break;
        }

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'user' => $user->email,
            'info' => $info,
            'role' => $roleName,
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

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function students()
    {
        $users = User::where('type', 'student')
                    ->where('active', true)
                    ->get();

        return view('admin.users.students', compact('users'));
    }

    public function teachers()
    {
        $users = User::where('type', 'teacher')
                    ->where('active', true)
                    ->get();

        return view('admin.users.teachers', compact('users'));
    }


    public function admins()
    {
        $users = User::role('admin')->get();
        return view('admin.users.admins', compact('users'));
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->active = false;
        $user->save();

        return redirect()->back()->with('success', 'The account has been successfully suspended.');
    }


}

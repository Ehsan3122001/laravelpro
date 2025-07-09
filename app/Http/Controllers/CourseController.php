<?php

// namespace App\Http\Controllers;

// use App\Models\Course;
// use App\Models\User;
// use Illuminate\Http\Request;

// class CourseController extends Controller
// {
//     public function index()
//     {
//         $courses = Course::all();
//         return view('courses.index', compact('courses'));
//     }

//     public function create()
//     {
//         $users = User::where('type', 'teacher')->get();
//         return view('courses.create', compact('users'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'cost' => 'required|numeric',
//             'teacher_id' => 'required|exists:teachers,id',
//         ]);

//         Course::create($request->all());
//         return redirect()->route('courses.index')->with('success', 'Course created successfully.');
//     }

//     public function edit(Course $course)
//     {
//         $users = User::where('type', 'teacher')->get();
//         return view('courses.edit', compact('course', 'users'));
//     }


//     public function update(Request $request, Course $course)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'cost' => 'required|numeric',
//             'teacher_id' => 'required|exists:teachers,id',
//         ]);

//         $course->update($request->all());
//         return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
//     }

//     public function destroy(Course $course)
//     {
//         $course->delete();
//         return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $users = User::where('type', 'teacher')->get();
        return view('courses.create', compact('users', 'categories'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Course::create($request->only(['name', 'cost', 'teacher_id']));

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }


    public function edit(Course $course)
    {
        $categories = \App\Models\Category::all();
        $users = User::where('type', 'teacher')->get();
        return view('courses.edit', compact('course', 'users','categories'));
    }


    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course->update($request->only(['name', 'cost', 'teacher_id']));

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }


    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}


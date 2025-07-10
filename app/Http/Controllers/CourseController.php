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
use App\Models\Category;
use App\Models\Teacher;

use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category', 'teacher')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('type', 'teacher')->get();
        return view('courses.create', compact('categories', 'teachers'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'cost'       => 'required|numeric',
            'teacher_id'  => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $teachers = User::where('type', 'teacher')->get();
        return view('courses.edit', compact('course', 'categories', 'teachers'));
    }


    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'cost'       => 'required|numeric',
            'teacher_id'  => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }


    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}


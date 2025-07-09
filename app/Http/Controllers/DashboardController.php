<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Money;
use App\Models\Question;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $coursesCount = Course::count();
        $moneyTotal = Money::sum('value');
        $questionsCount = Question::count();
        $averageRating = Comment::avg('evaluation');

        return view('admin.dashboard', compact(
            'studentsCount',
            'teachersCount',
            'coursesCount',
            'moneyTotal',
            'questionsCount',
            'averageRating'
        ));
    }
}


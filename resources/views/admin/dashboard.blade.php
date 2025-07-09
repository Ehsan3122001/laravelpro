@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('components.card', [
                'title' => 'Students',
                'value' => $studentsCount,
                'color' => 'primary',
                'suffix' => 'Student'
            ])

            @include('components.card', [
                'title' => 'Teachers',
                'value' => $teachersCount,
                'color' => 'success',
                'suffix' => 'Teacher'
            ])

            @include('components.card', [
                'title' => 'Courses',
                'value' => $coursesCount,
                'color' => 'info'
            ])

            @include('components.card', [
                'title' => 'Revenue',
                'value' => $moneyTotal,
                'color' => 'warning',
                'suffix' => '$'
            ])

            @include('components.card', [
                'title' => 'Messages',
                'value' => $questionsCount,
                'color' => 'danger'
            ])

            @include('components.card', [
                'title' => 'Average Rate',
                'value' => number_format($averageRating, 1),
                'color' => 'dark',
                'suffix' => '/5'
            ])

        </div>
    </div>
@endsection

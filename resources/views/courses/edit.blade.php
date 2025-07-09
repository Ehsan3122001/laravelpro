@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Course</h2>

    <form method="POST" action="{{ route('courses.update', $course->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Course Name</label>
            <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="cost" value="{{ $course->cost }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Teacher ID</label>
            {{-- <input type="number" name="teacher_id" value="{{ $course->teacher_id }}" class="form-control" required> --}}
            <select name="teacher_id" class="form-control" id="" required>
                @foreach ($users as $user)
                    @if ($user->type === 'teacher')
                        <option value="{{ $user->id }}" {{ $course->teacher_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection

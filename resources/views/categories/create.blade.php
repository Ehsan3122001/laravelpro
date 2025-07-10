@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New category</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="form-group">
            <label>category Name </label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Save</button>
    </form>
</div>
@endsection

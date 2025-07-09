@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        @include('components.table', [
            'title' => 'Students',
            'headers' => ['ID', 'Name', 'Email'],
            'rows' => $users->map(fn($u) => [$u->id, $u->name, $u->email]),
            'actions' => [
                [
                    'route' => 'admin.users.deactivate',
                    'label' => 'Suspend',
                    'method' => 'POST',
                    'class' => 'warning',
                    'confirm' => 'Are you sure you want to suspend this account?'
                ]
            ]
        ])
    </div>
@endsection

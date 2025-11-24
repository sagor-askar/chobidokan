@extends('layouts.designer_panel')
@section('panel_content')
    <br>
    <h5>About Me</h5>
    <hr />
    <p>{!! $user->bio !!}</p>
    <table class="table">
        <tbody>
        <tr>
            <th>Full Name</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $user->phone }}</td>
        </tr>
        </tbody>
    </table>
@endsection

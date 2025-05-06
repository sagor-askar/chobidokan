@extends('includes.master')
@section('content')
    <main class="main">
        <div class="section infoContainer">
            <h2>{{ $privacy->title ?? '' }}</h2>
            {!! $privacy->description ?? '' !!}
        </div>
    </main>
@endsection

@extends('includes.master')
@section('content')
    <main class="main">
        <div class="section infoContainer">
            <h2>{{ $licencing->title ?? '' }}</h2>
            {!! $licencing->description ?? '' !!}
        </div>
    </main>
@endsection

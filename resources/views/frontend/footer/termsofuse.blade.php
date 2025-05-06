@extends('includes.master')
@section('content')
    <main class="main">

        <div class="section infoContainer">
            <h2>{{ $terms->title ?? '' }}</h2>
            {!! $terms->description ?? '' !!}
        </div>
    </main>
@endsection

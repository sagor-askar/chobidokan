@extends('includes.master')
@section('content')
    <main class="main">

        <div class="section infoContainer">
            <h2>{{ $searchTips->title ?? '' }}</h2>
            {!! $searchTips->description ?? '' !!}
        </div>
    </main>
@endsection

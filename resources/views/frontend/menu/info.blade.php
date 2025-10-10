@extends('includes.master')
@section('content')
<main class="main">

    <div class="section infoContainer">
        <h2>{{ $infoSetup?->title }}</h2>
        <p>{!! $infoSetup?->description !!}</p>
    </div>
</main>
@endsection

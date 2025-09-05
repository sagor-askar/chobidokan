@extends('includes.master')
@section('content')

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<div class="section">
    <div class="container" style="margin-top: 5rem;">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$project?->name}}</h5>
                        <hr>
                        <p class="card-text">{!! $project->project_description !!}</p>
                        <p class="card-text"><small class="text-muted">Posted On: {{\Carbon\Carbon::parse($project->publish_date)->format('d-m-Y')}}</small></p>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">

                        @foreach($project->uploads as $key=>$uploadData)
                            <div class="col-md-4">
                                <div class="card mb-3 h-100" style="min-height: 260px; max-height: 260px;">
                                    <div class="card-body p-2 d-flex justify-content-center align-items-center" style="height: 180px; overflow: hidden;">
                                        <!-- Fixed size Image -->
                                        <img src="{{ asset($uploadData->file_path) }}"
                                             alt="Request Image"
                                             class="img-fluid rounded"
                                             style="height: 100%; width: auto; object-fit: cover; max-height: 150px;">
                                    </div>

                                    <!-- Card footer with designer name and post date -->
                                    <div class="card-footer bg-white border-top text-center">
                                        <div>
                                            👤 <a href="{{ route('designer-profile',$uploadData->projectSubmit?->user?->id) }}">
                                                {{ $uploadData->projectSubmit?->user?->name }}
                                            </a>
                                        </div>
                                        <div>
                                            📅 {{ \Carbon\Carbon::parse($uploadData->projectSubmit?->submit_date)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>

            {{-- right nav --}}
            <div class="col-12 col-md-4">

                @php
                    $subscriptions = json_decode($project->subscription?->points);
                    $subscriptionDesigner = $project->subscription->designer;

                     $expireDate = \Carbon\Carbon::parse($project->expire_date)->startOfDay();
                     $today = \Carbon\Carbon::now()->startOfDay();
                     $daysLeft = $today->gt($expireDate)? 'Expired': $today->diffInDays($expireDate);


                    $expireSubmitDate = \Carbon\Carbon::parse($project->expire_date);
                    $currentDate = \Carbon\Carbon::now();
                @endphp
                @if($project->user->role_id == 3 && $currentDate->lte($expireSubmitDate) && $subscriptionDesigner > $project->total_designer)
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('job-submission',$project->id) }}" class="btn btn-sm btn-primary">Submit Your Design</a>
                    </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-body">
                    <button class="btn btn-sm btn-secondary" disabled style="cursor: not-allowed; opacity: 0.7;">
                        Submission Closed
                    </button>
                        </div>
                    </div>
                @endif
                <br />
                <div class="card">
                    <div class="card-body">
                        <h5>Statistics</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span>Budget: <b>{{$project->order?->amount}} Tk</b></span>

                            @if($daysLeft == 'Expired')
                                <span>Time: <strong class="text-danger"> Expired</strong> </span>
                            @else
                                <span>Time:  <strong>{{$daysLeft}}</strong>  days left</span>
                            @endif

                            <span>Total Designers:  <b>{{$project->total_designer ?? '0'}}</b></span>
                            <span>Total Designs: <b>{{$project->total_submitted_design ?? '0'}}</b></span>
                        </div>
                    </div>
                </div>
                <br />

                <div class="card">
                    <div class="card-body">
                        <h5>References</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span>Reference 1: ABCD</span>
                            <span>Reference 2: EFGH</span>
                            <span>Reference 3: IJKL</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

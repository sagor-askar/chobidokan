@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Software Settings
                </div>

                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- left side --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name" id="company_title" value="{{$settings->name ?? ''}}">
                                </div>

                                <div class="form-group">
                                    <label for="title">Phone </label>
                                    <input class="form-control" type="text" name="phone" id="phone" value="{{$settings->phone ?? ''}}">
                                </div>

                                <div class="form-group ">
                                    <label class="required" for="logo">Logo</label>
                                    <input type="file" class="form-control-file" id="photo-dropzone" value="{{$settings->logo ?? '' }}" name="logo">
                                    <img src="{{asset($settings->logo ?? ' ')}}" alt="" height="100" width="auto">
                                </div>
                            </div>

                            {{-- right side --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="{{$settings->email ?? ''}}">
                                </div>

                                <div class="form-group">
                                    <label for="title">Address</label>
                                    <input class="form-control" type="text" name="address" id="address" value="{{$settings->address ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Site Title</label>
                                    <input class="form-control" type="text" name="site_title" id="company_title" value="{{$settings->site_title ?? ''}}">
                                </div>

                                <!-- facebook -->

                                <div class="form-group">
                                    <span class="input-group-text">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{$settings->facebook ?? '' }}" placeholder="Facebook URL">
                                </div>

                                <!-- Twitter -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fab fa-twitter"></i>
                                        </span>
                                    </div>
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{$settings->twitter ?? '' }}" placeholder="Twitter URL">
                                </div>

                                <!-- Instagram -->
                                <div class="form-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-instagram"></i>
                                        </span>
                                    </div>
                                    <input type="url" class="form-control" id="instagram" name="instagram" value="{{$settings->instagram ?? '' }}" placeholder="Instagram URL">
                                </div>

                                <!-- LinkedIn -->
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-linkedin-in"></i>
                                        </span>
                                    </div>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="{{$settings->linkedin ?? '' }}" placeholder="LinkedIn URL">
                                </div>

                            </div>
                        </div>
                        <div class="form-group" style="float:left;">
                            <button class="button" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

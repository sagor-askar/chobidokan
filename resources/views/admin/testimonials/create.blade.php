@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Testimonial
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('speech') ? 'has-error' : '' }}">
                            <label class="required" for="speech">Speech</label>
                            <input class="form-control" type="text" name="speech" id="speech" value="{{ old('speech', '') }}" placeholder="Enter Speech" required>
                            @if($errors->has('speech'))
                            <span class="help-block" role="alert">{{ $errors->first('speech') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Name" required>
                            @if($errors->has('name'))
                            <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label class="required" for="designation">Designation</label>
                            <input class="form-control" type="text" name="designation" id="designation" value="{{ old('designation') }}" placeholder="Enter Designation" required>
                            @if($errors->has('designation'))
                            <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

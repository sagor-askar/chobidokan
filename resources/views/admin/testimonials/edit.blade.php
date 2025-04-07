@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Testimonial
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        {{-- Speech --}}
                        <div class="form-group {{ $errors->has('speech') ? 'has-error' : '' }}">
                            <label for="speech">Speech</label>
                            <textarea class="form-control" name="speech" id="speech" rows="4">{{ old('speech', $testimonial->speech) }}</textarea>
                            @if($errors->has('speech'))
                            <span class="help-block" role="alert">{{ $errors->first('speech') }}</span>
                            @endif
                        </div>

                        {{-- Name --}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}">
                            @if($errors->has('name'))
                            <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        {{-- Designation --}}
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label for="designation">Designation</label>
                            <input class="form-control" type="text" name="designation" id="designation" value="{{ old('designation', $testimonial->designation) }}">
                            @if($errors->has('designation'))
                            <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                        </div>

                        {{-- Submit --}}
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

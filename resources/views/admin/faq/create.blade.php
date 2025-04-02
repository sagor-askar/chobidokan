@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create FAQ
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.faqs.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label class="required" for="question">Question</label>
                            <input class="form-control" type="text" name="question" id="question" value="{{ old('question', '') }}" placeholder="Enter Question" required>
                            @if($errors->has('question'))
                            <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                            <label class="required" for="answer">Answer</label>
                            <input class="form-control" type="text" name="answer" id="answer" value="{{ old('answer') }}" placeholder="Enter Answer" required>
                            @if($errors->has('answer'))
                            <span class="help-block" role="alert">{{ $errors->first('answer') }}</span>
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

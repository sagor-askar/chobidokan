@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Category List
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.categories.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="required" for="name">Name</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                                <label>Logo</label>
                                <input class="form-control" type="file" name="logo">
                                @if($errors->has('logo'))
                                    <span class="help-block" role="alert">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Description</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="description" id="name_bn" value="{{ old('description', '') }}">
                                @if($errors->has('description'))
                                    <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="required">Status</label>
                                <select class="form-control " name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-3">
                            <div class="form-group">
                                <button class="button" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

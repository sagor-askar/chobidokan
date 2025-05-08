@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                                <label>Logo</label>
                                <input class="form-control" type="file" name="logo">
                                @isset($category)
                                    <img src="{{ asset($category->logo) }}" width="100">
                                @endisset

                                @if($errors->has('logo'))
                                    <span class="help-block" role="alert">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="name_bn">Description</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="description" id="name_bn" value="{{ old('description', $category->description) }}">
                                @if($errors->has('description'))
                                    <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="required">Status</label>
                                <select class="form-control " name="status" id="status">
                                    <option value="1" @if($category->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($category->status == 0) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
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

@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Technical Information
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.technical.info.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control" type="text" name="title"
                                            value="{{ $technicalInfo->title ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="descriptionstyle_one" cols="150" rows="50" required>
                                        {!! $technicalInfo->description ?? '' !!}
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block"
                                                role="alert">{{ $errors->first('description') }}</span>
                                        @endif
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descriptionstyle_one'))
            .catch(error => {
                console.log(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#descriptionstyle_one_bn'))
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection

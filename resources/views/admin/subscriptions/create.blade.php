@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Subscription Plan Create
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.subscriptions.store") }}" enctype="multipart/form-data">
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

                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label class="required" for="price">Price</label>
                                <input class="form-control" type="number" placeholder="Enter Price" name="price" id="price" value="{{ old('price', '') }}" required>
                                @if($errors->has('price'))
                                    <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_bn_helper') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="required">Status</label>
                                <select class="form-control " name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="items-container">
                                    <label class="required" >Points (English)</label>
                                        <div class="item-group d-flex align-items-center" style="margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" name="points[]" placeholder="Enter the point" class="form-control" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-primary add-item">+</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
                                <label for="price">Days</label>
                                <input class="form-control" type="number" placeholder="Enter Days" name="days" id="days" value="{{ old('days', '') }}">
                                @if($errors->has('days'))
                                    <span class="help-block" role="alert">{{ $errors->first('days') }}</span>
                                @endif
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


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#items-container').on('click', '.add-item', function () {
            $('#items-container').append(`
                <div class="item-group d-flex align-items-center" style="margin-top: 10px;">
                   <div class="row">
                   <div class="col-md-10">
                        <input type="text" name="points[]" placeholder="Enter the point" class="form-control" required>
                   </div>
                   <div class="col-md-2">
                      <button type="button" class="btn btn-danger remove-item">-</button>
                   </div>
              </div>
              </div>
            `);
        });

        $('#items-container').on('click', '.remove-item', function () {
            $(this).closest('.item-group').remove();
        });
    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#descriptionstyle'))
        .catch(error =>{
            console.log(error);
        });
</script>
@endsection

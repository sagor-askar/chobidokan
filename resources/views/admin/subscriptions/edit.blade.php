@extends('layouts.admin')
@section('content')

    <style>
        .show-image,
        .show-customDesign {
            display: none;
        }
    </style>
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.subscriptions.update", [$subscription->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name" id="name" value="{{ old('name', $subscription->name ?? '') }}" required>
                                @if($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>

                            <div class="form-group">
                                <label class="required">Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="1" {{ old('type', $subscription->type) == 1 ? 'selected' : '' }}>Image</option>
                                    <option value="2" {{ old('type', $subscription->type) == 2 ? 'selected' : '' }}>Custom Design</option>
                                </select>
                            </div>

                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label  class="required" for="price">Price</label>
                                <input class="form-control" type="number" placeholder="Enter Price" name="price" id="price" value="{{ old('price', $subscription->price ?? '') }}" required>
                                @if($errors->has('price'))
                                    <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
                                <label  for="price">Days</label>
                                <input class="form-control" type="number" placeholder="Enter Days" name="days" id="days" value="{{ old('days', $subscription->days ?? '') }}" >
                                @if($errors->has('days'))
                                    <span class="help-block" role="alert">{{ $errors->first('days') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="required">Status</label>
                                <select class="form-control " name="status" id="status">
                                    <option value="1" @if($subscription->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($subscription->status == 0) selected @endif>Inactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="show-image">
                                <div class="form-group">
                                    <label>No of Image</label>
                                    <input class="form-control" type="number" name="total_image" id="total_image"
                                           value="{{ old('total_image', $subscription->total_image) }}">
                                </div>
                            </div>

                            <!-- Custom Design Section -->
                            <div class="show-customDesign">
                                <div class="form-group">
                                    <label>Designer</label>
                                    <input class="form-control" type="number" name="designer" id="designer"
                                           value="{{ old('designer', $subscription->designer) }}">
                                </div>

                                <div class="form-group">
                                    <label>Design</label>
                                    <input class="form-control" type="number" name="design" id="design"
                                           value="{{ old('design', $subscription->design) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="items-container">
                                    <label >Points (English)</label>
                                    @if(isset($subscription) && is_array(json_decode($subscription->points)))
                                        <button type="button" class="btn btn-primary add-item">+</button>
                                        @foreach (json_decode($subscription->points) as $point)
                                            <div class="item-group d-flex align-items-center" style="margin-bottom: 10px;">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input type="text" name="points[]" value="{{ $point }}" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-danger remove-item">-</button>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
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
        $(document).ready(function () {

            function toggleFields() {
                let type = $('#type').val();

                if (type == 1) {
                    $('.show-image').show();
                    $('.show-customDesign').hide();

                    $('#total_image').attr('required', true);
                    $('#designer, #design').removeAttr('required');

                } else if (type == 2) {
                    $('.show-image').hide();
                    $('.show-customDesign').show();

                    $('#total_image').removeAttr('required');
                    $('#designer').attr('required', true);
                }
            }

            // page load
            toggleFields();

            // change
            $('#type').on('change', function () {
                toggleFields();
            });

        });
    </script>
@endsection

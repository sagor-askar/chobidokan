@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Edit Coupon
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.coupons.update", [$coupon->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                <label class="required" for="code">Coupon Code</label>
                                <input class="form-control" type="text" placeholder="Enter Coupon Code" name="code" id="code" value="{{ old('code', $coupon->code) }}" required>
                                @if($errors->has('code'))
                                    <span class="help-block" role="alert">{{ $errors->first('code') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label class="required">Discount Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="">Select Type</option>
                                    <option value="fixed" {{ (old('type') ? old('type') : $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                    <option value="percentage" {{ (old('type') ? old('type') : $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                </select>
                                @if($errors->has('type'))
                                    <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                                <label class="required" for="discount">Discount Amount</label>
                                <input class="form-control" type="number" step="0.01" placeholder="Enter Discount Amount" name="discount" id="discount" value="{{ old('discount', $coupon->discount) }}" required>
                                @if($errors->has('discount'))
                                    <span class="help-block" role="alert">{{ $errors->first('discount') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="required">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-3">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    {{ trans('global.update') }}
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

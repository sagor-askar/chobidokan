@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.show') }} Product
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.products.list') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th>
                                        Heading
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <td>
                                        {{ $product->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Category
                                    </th>
                                    <td>
                                        {{ $product->category?->name ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Type
                                    </th>
                                    @if($product->type == 1)
                                        <td>
                                            <span class="badge badge-warning" style="background-color: green">Image</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-danger" style="background-color: green">Video</span>
                                        </td>
                                    @endif
                                </tr>

                                <tr>
                                    <th>
                                        Tags
                                    </th>

                                    @php
                                        $tags = json_decode($product->tags);
                                    @endphp
                                    <td>
                                        @if($tags)
                                            @foreach($tags as $val)
                                                <li>{{ $val}}</li>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Description
                                    </th>
                                    <td>
                                        {!!    $product->description ?? ''  !!}
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Price
                                    </th>
                                    <td>
                                        {{ $product->price ?? '' }} Tk.
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Designer
                                    </th>

                                    <td>
                                        {{ $product->user->name ?? '' }}
                                    </td>

                                </tr>
                                <tr>

                                    <th> Publish Date </th>
                                    <td>
                                        {{ \Carbon\Carbon::parse( $product->created_at )->format('d/m/Y')?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Image
                                    </th>
                                    @php
                                        $extension = strtolower(pathinfo($product->file_path, PATHINFO_EXTENSION));
                                        $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                                    @endphp
                                    <td>
                                        @if ($isVideo)
                                            <div>
                                                <video width="30%" height="60%" style="object-fit: cover; border-radius: 3px;" muted>
                                                    <source src="{{ asset($product->file_path) }}"
                                                            type="video/{{ $extension }}">
                                                </video>
                                                @php $iconClass = 'bi-play-btn-fill'; @endphp
                                            </div>
                                        @else
                                            <div>
                                                <a target="_blank" href="{{ asset($product->file_path) }}" title="Click to download" download>
                                                    <img src="{{ asset($product->file_path) }}" alt="Image" width="170" style="height:auto; cursor:pointer;">
                                                </a>
                                                <div style="font-size:12px; color:#555;">Click image to download</div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>

                                    @if($product->status == 0)
                                        <td>
                                            <span class="badge badge-warning" style="background-color: #ff6b02">Inactive</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-danger" style="background-color: green">Active</span>
                                        </td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>

                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.products.list') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

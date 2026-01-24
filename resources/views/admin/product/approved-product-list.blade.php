@extends('layouts.admin')
@section('content')
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Approved Product Items
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-approved-products"
                                id="approved-products-dataTable">
                                <caption><i class="fa fa-list" aria-hidden="true"></i>  Approved Product Items</caption>
                                <thead>
                                    <tr>
                                        <th>

                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Designer
                                        </th>
                                        <th>
                                            Price(Tk.)
                                        </th>

                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvedProducts as $index => $product)
                                        @php
                                            $extension = strtolower(pathinfo($product->file_path, PATHINFO_EXTENSION));
                                            $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                                        @endphp
                                        <tr data-entry-id="{{ $product->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $product->title ?? '' }}
                                            </td>

                                            <td style="position: relative; width: 90px; height: 60px;">
                                                @if ($product->file_path)
                                                    {{-- Thumbnail --}}
                                                    @if ($isVideo)
                                                        <video width="100%" height="100%"
                                                            style="object-fit: cover; border-radius: 3px;" muted>
                                                            <source src="{{ asset($product->file_path) }}"
                                                                type="video/{{ $extension }}">
                                                        </video>
                                                        @php $iconClass = 'bi-play-btn-fill'; @endphp
                                                    @else
                                                        <img src="{{ asset($product->file_path) }}" alt="Image"
                                                            style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 3px;">
                                                        @php $iconClass = 'bi-arrows-fullscreen'; @endphp
                                                    @endif

                                                    {{-- Overlay Icon --}}
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#mediaModal{{ $index }}"
                                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                    color: #fff; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 4px;">
                                                        <i class="bi {{ $iconClass }}" style="font-size: 16px;"></i>
                                                    </a>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="mediaModal{{ $index }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ $product->title }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    @if ($isVideo)
                                                                        <video controls autoplay style="width: 100%">
                                                                            <source src="{{ asset($product->file_path) }}"
                                                                                type="video/{{ $extension }}">
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ asset($product->file_path) }}"
                                                                            alt="Image" class="img-fluid">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="badge bg-danger">No File!</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $product->category?->name ?? '' }}
                                            </td>

                                            <td>
                                                <p style="color:steelblue "><b>{{ $product->user?->name ?? '' }}</b></p>
                                                <p style="color:lightseagreen ">{{ $product->user?->email ?? '' }}</p>
                                            </td>

                                            <td>
                                                {{ $product->price ?? '' }}
                                            </td>

                                            @if ($product->status == 1)
                                                <td>
                                                    <span class="badge badge-info"
                                                        style="background-color: green">Active</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge badge-danger">Inactive</span>
                                                </td>
                                            @endif

                                            <td>

                                                @if ($product->status == 1)
                                                    <a class="btn btn-xs btn-danger"
                                                        href="{{ route('admin.product.statusChange', $product->id) }}"><i
                                                            class="fa fa-times-circle-o" aria-hidden="true"></i>
                                                        Inactive
                                                    </a>
                                                @else
                                                    <a class="btn btn-xs btn-success"
                                                        href="{{ route('admin.product.statusChange', $product->id) }}"><i
                                                            class="fa fa-check-circle-o"></i>
                                                        Active
                                                    </a>
                                                @endif

                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.product.show', $product->id) }}">
                                                    <i class="fa fa-eye"></i> View
                                                </a>

                                                <form action="{{ route('admin.product.delete', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger"
                                                        value="{{ __('global.delete') }}">
                                                </form>
                                                <a class="btn btn-xs btn-info"
                                                    href="{{ route('admin.project.details', $product->id) }}">
                                                    <i class="fa fa-list"></i> Details
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($approvedProducts->hasPages())
                                {{ $approvedProducts->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], defaultButtons);
            @can('category_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete ') }}'
            let deleteButton = {
                text: deleteButtonTrans
                , url: "{{ route('admin.categories.massDestroy') }}"
                , className: 'btn-danger'
                , action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).nodes(), function(entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                        return
                    }

                    if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                        $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                            .done(function() {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan
            initDataTable('#approved-products-dataTable', dtButtons);
        })

    </script>
@endsection

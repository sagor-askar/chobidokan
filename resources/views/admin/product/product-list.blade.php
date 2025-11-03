@extends('layouts.admin')
@section('content')
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Upload Product List
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-products" id="products-dataTable">
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
                                        Price
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
                                @foreach($products as $key => $product)
                                    <tr data-entry-id="{{ $product->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $product->title ?? '' }}
                                        </td>

                                        @if($product->file_path)
                                            <td><img src="{{ asset($product->file_path) }}" alt="Image" width="40"></td>
                                        @else
                                            <td><span class="badge badge-danger">No Image !</span></td>
                                        @endif

                                        <td>
                                            {{ $product->category?->name ?? '' }}
                                        </td>

                                        <td>
                                            <p style="color:steelblue "><b>{{ $product->user?->name ?? '' }}</b></p>
                                            <p style="color:lightseagreen " >{{ $product->user?->email ?? '' }}</p>
                                        </td>

                                        <td>
                                            {{ $product->price ?? '' }}
                                        </td>

                                        @if($product->status == 1)
                                            <td>
                                                <span class="badge badge-info" style="background-color: green">Active</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger">Inactive</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.project.details', $product->id) }}">
                                                <i class="fa fa-list"></i> Details
                                            </a>

                                            <form action="{{ route('admin.project.delete', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($products->hasPages())

                                {{ $products->links() }}
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
        $(document).ready(function() {

            // Optional: Mass delete button
            let dtButtons = $.extend(true, [], defaultButtons);

            @can('category_delete')
            let deleteButtonTrans = '{{ trans("global.datatables.delete") }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.categories.massDestroy') }}",
                className: 'btn-danger',
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function(entry) {
                        return $(entry).data('entry-id');
                    });

                    if (ids.length === 0) {
                        alert('{{ trans("global.datatables.zero_selected") }}');
                        return;
                    }

                    if (confirm('{{ trans("global.areYouSure") }}')) {
                        $.ajax({
                            headers: { 'x-csrf-token': _token },
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }
                        }).done(function() { location.reload(); });
                    }
                }
            }
            dtButtons.push(deleteButton);
            @endcan

            // Initialize DataTable for this page
            initDataTable('#products-dataTable', dtButtons);

        });
    </script>
@endsection


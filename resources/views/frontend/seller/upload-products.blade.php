@extends('layouts.designer_panel')
@section('panel_content')
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="card-header">
                          Upload Products
                        </div>
                        <div class="panel-body">
                            @if(count($products) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th> Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->category?->name ?? 'N/A' }}</td>
                                            <td style="position: relative; width: 90px; height: 60px;">
                                                @if($product->file_path)
                                                    <img src="{{ asset($product->file_path) }}" alt="Image"
                                                         style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 3px;">

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $index }}"
                                                       style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                  color: #fff; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 4px;">
                                                        <i class="bi bi-arrows-fullscreen" style="font-size: 14px;"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1"
                                                         aria-labelledby="imageModalLabel{{ $index }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel{{ $index }}">{{ $product->title }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset($product->file_path) }}" alt="Image" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="badge bg-danger">No Image!</span>
                                                @endif
                                            </td>


                                            <td>{{ $product->price  }}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                 @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="{{ route('designer.product.edit', $product->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            </td>
                                        </tr>

                                     @endforeach
                                    </tbody>


                                </table>

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $products->withQueryString()->links('pagination.custom') }}
                            </div>
                            @else
                                <div class="col-12 text-center py-4">
                                    <p class="mb-0 text-danger">No Product available yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>



@endsection

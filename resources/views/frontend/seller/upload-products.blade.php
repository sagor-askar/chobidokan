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
                                        <th>Image/Video</th>
                                        <th>Price</th>
                                        <th> Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $index => $product)
                                        @php
                                            $extension = strtolower(pathinfo($product->file_path, PATHINFO_EXTENSION));
                                            $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->category?->name ?? 'N/A' }}</td>

                                            <td style="position: relative; width: 90px; height: 60px;">
                                                @if($product->file_path)
                                                    @if($isVideo)
                                                        <video width="100%" height="100%" style="object-fit: cover; border-radius: 3px;" muted>
                                                            <source src="{{ asset($product->file_path) }}" type="video/{{ $extension }}">
                                                        </video>

                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $index }}"
                                                           style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                          color: #fff; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 4px;">
                                                            <i class="bi bi-play-btn-fill" style="font-size: 16px;"></i>
                                                        </a>
                                                    @else

                                                        <img src="{{ asset($product->file_path) }}" alt="Image"
                                                             style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 3px;">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $index }}"
                                                           style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                          color: #fff; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 4px;">
                                                            <i class="bi bi-arrows-fullscreen" style="font-size: 14px;"></i>
                                                        </a>
                                                    @endif

                                                    {{-- Modal for Image/Video --}}
                                                    <div class="modal fade" id="mediaModal{{ $index }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ $product->title }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    @if($isVideo)
                                                                        <video controls autoplay style="width: 100%">
                                                                            <source src="{{ asset($product->file_path) }}" type="video/{{ $extension }}">
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ asset($product->file_path) }}" alt="Image" class="img-fluid">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <span class="badge bg-danger">No File!</span>
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

                                                <form action="{{ route('designer.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
                                                </form>
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

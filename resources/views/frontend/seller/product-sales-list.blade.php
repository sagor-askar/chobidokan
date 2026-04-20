@extends('layouts.designer_panel')
@section('panel_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4>Product Payment List</h4>
                    </div>
                    <div class="panel-body">
                        @if(count($productSaleslist) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Image/Video</th>
                                        <th>Customer</th>
                                        <th>Product Price</th>
                                        <th> Earning Amount <br>
                                         <small>(Off Authority percentage)</small>
                                        </th>
                                        <th>Date </th>
                                        <th>Status </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productSaleslist as $index => $productSale)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route("product-details",$productSale->product->id) }}">{{ $productSale->product->title }}</a></td>
                                            <td class="text-center align-middle" style="width: 120px;">
                                                <div class="position-relative overflow-hidden rounded shadow-sm d-flex align-items-center justify-content-center"
                                                     style="width: 100px; height: 70px; margin: 0 auto; cursor: pointer; border: 1px solid #e0e0e0; background: #f8f9fa;"
                                                     data-bs-toggle="modal" data-bs-target="#mediaModal{{ $index }}">

                                                    @if($productSale->product->type == 1)
                                                        <img src="{{ route('product.file.view', $productSale->product->id) }}" alt="Image"
                                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 3px;">
                                                        <div class="position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center shadow"
                                                             style="width: 32px; height: 32px; background: rgba(0,0,0,0.6); border-radius: 50%; color: #fff;">
                                                            <i class="bi bi-arrows-fullscreen" style="font-size: 14px;"></i>
                                                        </div>
                                                    @else
                                                        <video style="width: 100%; height: 100%; object-fit: cover; border-radius: 3px;" muted onmouseover="this.play()" onmouseout="this.pause()">
                                                            <source src="{{ route('product.view.video', $productSale->product->id) }}" type="{{ $productSale->product->file_type }}">
                                                        </video>
                                                        <div class="position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center shadow"
                                                             style="width: 32px; height: 32px; background: rgba(0,0,0,0.6); border-radius: 50%; color: #fff;">
                                                            <i class="bi bi-play-fill" style="font-size: 18px; margin-left: 2px;"></i>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Modal for Image/Video --}}
                                                <div class="modal fade" id="mediaModal{{ $index }}" tabindex="-1" aria-hidden="true" style="z-index: 9999;">
                                                    <div class="modal-dialog modal-fullscreen m-0" style="max-width: 100vw; height: 100vh;">
                                                        <div class="modal-content border-0 rounded-0" style="background: rgba(0,0,0,0.85); display: flex; justify-content: center; align-items: center; min-height: 100vh;">
                                                            <div class="d-flex flex-column overflow-hidden shadow-lg m-auto position-relative" style="width: 90vw; height: 90vh; border-radius: 4px; background: #111;">

                                                                    <span class="position-absolute" data-bs-dismiss="modal" style="top: 15px; right: 25px; font-size: 28px; font-weight: lighter; color: #fff; cursor: pointer; transition: color 0.2s; z-index: 10000; text-shadow: 0 2px 4px rgba(0,0,0,0.5);" onmouseover="this.style.color='#ff3b3f'" onmouseout="this.style.color='#fff'">
                                                                        <i class="fa fa-times"></i>
                                                                    </span>

                                                                <div class="flex-grow-1 position-relative d-flex justify-content-center align-items-center overflow-hidden w-100 h-100" style="background: #111;">
                                                                    @if($productSale->product->type == 1)
                                                                        <img src="{{ route('product.file.view', $productSale->product->id) }}" alt="{{ $productSale->product->title }}" class="w-100 h-100 d-block" style="object-fit: contain;">
                                                                    @else
                                                                        <video controls class="w-100 h-100 d-block" style="object-fit: contain;" controlsList="nodownload">
                                                                            <source src="{{ route('product.view.video', $productSale->product->id) }}" type="{{ $productSale->product->file_type }}">
                                                                        </video>
                                                                    @endif
                                                                </div>

                                                                <div class="d-flex justify-content-between align-items-center" style="background: #2a2c31; padding: 12px 24px;">
                                                                    <div style="font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">chobidokan</div>
                                                                    <div class="text-end" style="font-size: 11px; font-weight: 600; color: #ffffff; line-height: 1.4;">
                                                                        IMAGE ID: {{ $productSale->product->asset_id ?? '' }}<br>
                                                                        <span style="color: #9ba0a9; font-weight: normal;">www.chobidokan.com</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td> {{ $productSale->user?->name ?? 'N/A' }}</td>
                                            <td> Tk. {{ number_format($productSale->amount ?? 0, 2)  }}</td>
                                            <td> Tk. {{ number_format($productSale->earning_amount ?? 0, 2)  }}</td>
                                            <td>{{ $productSale->created_at ?? 'N/A'  }}</td>
                                            <td>
                                                @if($productSale->designer_paid_status == 0)
                                                    <span class="badge bg-danger">Unpaid</span>
                                                @else
                                                    <span class="badge bg-success">Paid</span>
                                                @endif
                                            </td>

                                        </tr>

                                    @endforeach
                                    </tbody>


                                </table>

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $productSaleslist->withQueryString()->links('pagination.custom') }}
                            </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No Product Sale available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function (modal) {
                modal.addEventListener('shown.bs.modal', function () {
                    var video = this.querySelector('video');
                    if (video) {
                        video.play();
                    }
                });
                modal.addEventListener('hidden.bs.modal', function () {
                    var video = this.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            });
        });
    </script>



@endsection

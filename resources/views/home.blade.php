@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dashboard | Chobi Dokan
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- cards --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-counter primary">
                                    <i class="fa fa-code-fork"></i>
                                    <span class="count-numbers">12</span>
                                    <span class="count-name">Total Designers</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card-counter danger">
                                    <i class="fa fa-ticket"></i>
                                    <span class="count-numbers">599</span>
                                    <span class="count-name">Active Users</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card-counter success">
                                    <i class="fa fa-database"></i>
                                    <span class="count-numbers">6875</span>
                                    <span class="count-name">Today's Requests</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card-counter info">
                                    <i class="fa fa-users"></i>
                                    <span class="count-numbers">35</span>
                                    <span class="count-name">Today's Deliverys</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- lower tables --}}
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Update Request List</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Req. By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Logo Design</td>
                                            <td>Kamal Khan</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary">View Details</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h4>Update Delivery List</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Delivered By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Logo Design</td>
                                            <td>Mr. Designer</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary">View Details</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection

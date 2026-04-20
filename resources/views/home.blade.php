@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-heading-title"><i class="fa fa-tachometer-alt"></i> Admin Dashboard Overview</h3>
                    </div>
                    <div class="panel-body">

                        <!-- PLATFORM OVERVIEW -->
                        <div class="dashboard-section-title">
                            <i class="fa fa-globe"></i> Platform Overview
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-blue">
                                    <div class="widget-icon"><i class="fa fa-box"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Active Products</div>
                                        <div class="widget-value">{{ $totalActiveProduct }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-orange">
                                    <div class="widget-icon"><i class="fa fa-box-open"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Inactive Products</div>
                                        <div class="widget-value">{{ $totalInctiveProduct }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-indigo">
                                    <div class="widget-icon"><i class="fa fa-project-diagram"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Active Projects</div>
                                        <div class="widget-value">{{ $totalActiveProject }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-green">
                                    <div class="widget-icon"><i class="fa fa-check-circle"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Completed Projects</div>
                                        <div class="widget-value">{{ $totalCompletedProject }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-red">
                                    <div class="widget-icon"><i class="fa fa-times-circle"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Rejected Projects</div>
                                        <div class="widget-value">{{ $totalRejectedProject }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-purple">
                                    <div class="widget-icon"><i class="fa fa-user-tie"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Designers</div>
                                        <div class="widget-value">{{ $totalDesigner }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-teal">
                                    <div class="widget-icon"><i class="fa fa-users"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Customers</div>
                                        <div class="widget-value">{{ $totalCustomer }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SALES & REVENUE -->
                        <div class="dashboard-section-title">
                            <i class="fa fa-chart-line"></i> Sales & Revenue
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-teal">
                                    <div class="widget-icon"><i class="fa fa-coins"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Sales Amount</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($totalAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-blue">
                                    <div class="widget-icon"><i class="fa fa-shopping-cart"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Product Sales Amt</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($totalProductSalesAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-indigo">
                                    <div class="widget-icon"><i class="fa fa-briefcase"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Project Sales Amt</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($totalProjectOrderAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-purple">
                                    <div class="widget-icon"><i class="fa fa-shopping-bag"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Product Sales</div>
                                        <div class="widget-value">{{ $totalProductSale }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-primary" style="--widget-color: #0ea5e9; --widget-bg: #e0f2fe;">
                                    <div class="widget-icon"><i class="fa fa-tasks"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Project Sales</div>
                                        <div class="widget-value">{{ $totalProjectSale }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EARNINGS & PAYMENTS -->
                        <div class="dashboard-section-title">
                            <i class="fa fa-wallet"></i> Earnings & Payments
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="widget-card color-green">
                                    <div class="widget-icon"><i class="fa fa-hand-holding-usd"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Platform Earning</div>
                                        <div class="widget-value">৳ {{ number_format($totalEarningAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="widget-card color-blue">
                                    <div class="widget-icon"><i class="fa fa-money-check-alt"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Paid to Designers</div>
                                        <div class="widget-value">৳ {{ number_format($totalPaidAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DUES & REFUNDS -->
                        <div class="dashboard-section-title">
                            <i class="fa fa-exclamation-circle"></i> Dues & Refunds
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-red">
                                    <div class="widget-icon"><i class="fa fa-exclamation-triangle"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Total Due Amount</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($totalDuePayment ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-orange">
                                    <div class="widget-icon"><i class="fa fa-tags"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Product Due Amount</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($productDueamount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-orange">
                                    <div class="widget-icon"><i class="fa fa-hourglass-half"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Project Due Amount</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($orderDuePayment ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="widget-card color-pink">
                                    <div class="widget-icon"><i class="fa fa-undo-alt"></i></div>
                                    <div class="widget-content">
                                        <div class="widget-title">Refund Amount</div>
                                        <div class="widget-value" style="font-size: 20px;">৳ {{ number_format($refundPaymentsAmount ?? 0, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr style="border-top: 1px dashed #cbd5e1; margin: 35px 0 25px 0;">

                        {{-- lower tables --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="table-container">
                                    <h4><i class="fa fa-list-alt text-primary mr-2"></i> Update Request List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Req. By</th>
                                                    <th scope="col" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td class="font-weight-bold text-dark">Logo Design</td>
                                                    <td>Kamal Khan</td>
                                                    <td class="text-right">
                                                        <a href="#" class="btn btn-sm btn-primary btn-action">View Details</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="table-container">
                                    <h4><i class="fa fa-truck text-success mr-2"></i> Update Delivery List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Delivered By</th>
                                                    <th scope="col" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td class="font-weight-bold text-dark">Logo Design</td>
                                                    <td>Mr. Designer</td>
                                                    <td class="text-right">
                                                        <a href="#" class="btn btn-sm btn-success btn-action">View Details</a>
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
        </div>
    </div>

    <style>
        .dashboard-section-title {
            font-size: 15px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-top: 35px;
            display: flex;
            align-items: center;
        }
        .dashboard-section-title:first-child {
            margin-top: 0;
        }
        .dashboard-section-title i {
            margin-right: 10px;
            color: #94a3b8;
            font-size: 18px;
        }

        .widget-card {
            background: #fff;
            border-radius: 12px;
            padding: 22px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .widget-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            border-color: var(--widget-bg);
        }

        .widget-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 5px;
            background: var(--widget-color, #3b82f6);
            border-radius: 12px 0 0 12px;
        }

        .widget-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--widget-color, #3b82f6);
            background: var(--widget-bg, #eff6ff);
            margin-right: 18px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .widget-card:hover .widget-icon {
            background: var(--widget-color);
            color: #fff;
            transform: scale(1.05) rotate(5deg);
        }

        .widget-content {
            flex-grow: 1;
            overflow: hidden;
        }

        .widget-title {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .widget-value {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        /* Modern Colors */
        .color-blue { --widget-color: #3b82f6; --widget-bg: #eff6ff; }
        .color-green { --widget-color: #10b981; --widget-bg: #ecfdf5; }
        .color-red { --widget-color: #ef4444; --widget-bg: #fef2f2; }
        .color-orange { --widget-color: #f59e0b; --widget-bg: #fffbeb; }
        .color-purple { --widget-color: #8b5cf6; --widget-bg: #f5f3ff; }
        .color-teal { --widget-color: #14b8a6; --widget-bg: #f0fdfa; }
        .color-indigo { --widget-color: #6366f1; --widget-bg: #eef2ff; }
        .color-pink { --widget-color: #ec4899; --widget-bg: #fdf2f8; }

        /* Layout Adjustments */
        .panel-default {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .panel-default > .panel-heading {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 25px;
            border-radius: 12px 12px 0 0;
        }
        .panel-heading-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
        }
        .panel-heading-title i {
            color: #3b82f6;
            margin-right: 12px;
            font-size: 22px;
        }
        .panel-body {
            background: #f8fafc;
            padding: 30px;
            border-radius: 0 0 12px 12px;
        }
        .table-container {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #f1f5f9;
            height: 100%;
        }
        .table-container h4 {
            margin-top: 0;
            font-size: 16px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }
        .table th {
            font-weight: 600;
            color: #64748b;
            border-top: none !important;
            border-bottom: 2px solid #e2e8f0 !important;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .table td {
            vertical-align: middle !important;
            color: #334155;
            border-top: 1px solid #f1f5f9 !important;
            padding: 12px 8px !important;
        }
        .btn-action {
            border-radius: 6px;
            font-weight: 600;
            padding: 6px 14px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
@section('scripts')
    @parent
@endsection

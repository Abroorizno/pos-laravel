@extends('layouts.main')
{{-- @section('title', 'Data Categories') --}}

@section('content')
    <section class="section">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-12">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-start flex-column flex-sm-row mt-3">
                                        <h5 class="card-title text-primary">{{ $title ?? '' }}</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-orders">
                                            Add Orders
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Order Code</th>
                                                    <th>Order Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $no++ }}.</td>
                                                        <td>{{ $order->order_code}}</td>
                                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                        <td>{{ 'Rp. '. number_format($order->order_mount, 0,'.',',') }}</td>
                                                        <td>{{ $order->order_status ? 'Paid' : 'Unpaid'}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detail-orders-{{ $order->id }}">DETAILS</a>
                                                            {{-- <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-orders-{{ $order->id }}">DETAILS</a> --}}
                                                            {{-- <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this category?')">DELETE</button>
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- MODAL DETAIL --}}
                                @foreach ($orders as $order)
                                    <div class="modal fade" id="detail-orders-{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Order Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col mb-3">
                                                            <label class="form-label">Order Code</label>
                                                            <input type="text" class="form-control" value="{{ $order->order_code }}" readonly />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label">Order Date</label>
                                                            <input type="text" class="form-control" value="{{ $order->created_at->format('d/m/Y') }}" readonly />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label">Order Status</label>
                                                            <input type="text" class="form-control" value="{{ $order->order_status ? 'Paid' : 'Unpaid' }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm mb-3">
                                                            <table class="table custom-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Photo</th>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Price</th>
                                                                        <th>Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order->orderDetails as $detail)
                                                                        <tr>
                                                                            <td>
                                                                                <img src="{{ asset('storage/' . $detail->product->product_photo) }}" alt="Product Image" class="img-fluid" style="width: 150px; height: 150px;">
                                                                            </td>
                                                                            <td>{{ $detail->product->product_name }}</td>
                                                                            <td>{{ $detail->qty }}</td>
                                                                            <td>{{ 'Rp. '. number_format($detail->order_price, 0, ',', '.') }}</td>
                                                                            <td>{{ 'Rp. '. number_format($detail->qty * $detail->order_price, 0, ',', '.') }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('print', $order->id) }}" class="btn btn-primary" target="_blank"><i class="bx bx-printer"></i> Print</a>
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-orders" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">POS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pos.store') }}" method="post">
                                                <div class="row">
                                                {{-- KIRI --}}
                                                    <div class="col-sm-3">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameBasic" class="form-label">Product Category</label>
                                                                    <select name="product_category" id="product_category" class="form-control">
                                                                        <option value="#" disabled selected>Select Category</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameBasic" class="form-label">Product Name</label>
                                                                    <select name="product_subcategory" id="product_subcategory" class="form-control">
                                                                        <option value="#" disabled selected>--</option>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="">
                                                                    <button type="button" class="btn btn-primary add-row">Add To Chart</button>
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"></div>
                                                        </div>

                                                        {{-- KANAN --}}
                                                        <div class="card col-sm-9" style="border-radius: 10px; border: 2px solid #e9ecef;">
                                                            <table class="table mt-3 table-hover" id="modal-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Photo Products</th>
                                                                        <th>Product</th>
                                                                        <th>Qty</th>
                                                                        <th>Price</th>
                                                                        <th>Subtotals</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th colspan="2"> Grand Totals</th>
                                                                        <td colspan="3">
                                                                            <span id="grandTotal"></span>
                                                                            <input type="hidden" class="form-control" name="grandTotal" value="0" />
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <div class="mt-3 text-end">
                                                            <button type="submit" class="btn btn-primary">Add Order</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    </section>
@endsection

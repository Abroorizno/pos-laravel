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
                                    <h5 class="card-title text-primary">{{ $title ?? '' }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-3" id="table">
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
                                                        <td>{{ $order->order_mount}}</td>
                                                        <td>{{ $order->order_status ? 'Paid' : 'Unpaid'}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detail-orders-{{ $order->id }}">DETAILS</a>
                                                            <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-orders-{{ $order->id }}">DETAILS</a>
                                                            {{-- <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this category?')">DELETE</button>
                                                            </form> --}}
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-users-{{ $users->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Category</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('users.update', $users->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="editUsersName{{ $users->id }}" class="form-label">User Name</label>
                                                                            <input type="text" name="user_name" id="editUsersName{{ $users->id }}" class="form-control" value="{{ $users->name }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameBasic" class="form-label">Email</label>
                                                                            <input type="email" name="user_email" id="nameBasic" class="form-control" value="{{ $users->email }}"  />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameBasic" class="form-label">Password</label>
                                                                            <input type="password" name="password" id="nameBasic" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Save Change</button>
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-orders">
                                            Add Orders
                                        </button>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-orders" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">POS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                {{-- KIRI --}}
                                                <div class="col-sm-5">
                                                    <form action="{{ route('pos.store') }}" method="post">
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
                                                    </form>
                                                </div>

                                                {{-- KANAN --}}
                                                <div class="card col-sm-7" style="border-radius: 10px; border: 2px solid #e9ecef;">
                                                        <table class="table mt-3 table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Photo Products</th>
                                                                    <th>Product</th>
                                                                    <th>Qty</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="2"> Sub Totals </th>
                                                                    <td colspan="2">
                                                                        <input type="number" class="form-control" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="2"> Grand Totals</th>
                                                                    <td colspan="2">
                                                                        <input type="number" class="form-control" />
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    {{-- <form action="{{ route('pos.store') }}" method="post">
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
                                                                <select name="product_id" id="" class="form-control">
                                                                    <option value="#" disabled selected>Select Category</option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameBasic" class="form-label">Password</label>
                                                                <input type="password" name="password" id="nameBasic" class="form-control" required />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="">
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </form> --}}
                                                </div>
                                            </div>
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


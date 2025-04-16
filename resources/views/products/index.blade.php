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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-product">
                                            Add Orders
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-3" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Products Photo</th>
                                                    <th>Code of Product</th>
                                                    <th>Category of Product</th>
                                                    <th>Name of Products</th>
                                                    <th>Price of Products</th>
                                                    <th>Status</th>
                                                    <th>Products Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($products as $prods)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td><img src="{{ asset('storage/' . $prods->product_photo )}}" alt="" width="100px"></td>
                                                        <td>{{ $prods->product_code }}</td>
                                                        <td>{{ $prods->category->category_name }}</td>
                                                        <td>{{ $prods->product_name }}</td>
                                                        <td>Rp. {{ number_format($prods->product_price, 2) }}</td>
                                                        <td>{{ $prods->is_active ? 'Publish' : 'Draft' }}</td>
                                                        <td>{{ \Illuminate\Support\Str::limit($prods->product_description, 50, '...') }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-product-{{ $prods->id }}">EDIT</a>
                                                            <form action="{{ route('products.destroy', $prods->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this category?')">DELETE</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-product-{{ $prods->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Category</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('products.update', $prods->id )}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row mb-2">
                                                                        <div class="col mb-3">
                                                                            @if ($prods->product_photo)
                                                                                <div class="d-flex justify-content-center">
                                                                                    <img src="{{ asset('storage/' . $prods->product_photo) }}" alt="" width="100px" class="col-sm-5 mb-3">
                                                                                </div>
                                                                                <input type="file" name="photo_product" id="photo_product" class="form-control" />
                                                                            @else
                                                                                <label for="nameBasic" class="form-label">Photo Product</label>
                                                                                <input type="file" name="photo_product" id="photo_product" class="form-control" />
                                                                                {{-- <input type="hidden" name="old_photo" value="{{ $prods->product_photo }}"> --}}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-6 mb-3">
                                                                            <label for="nameBasic" class="form-label">Product Code</label>
                                                                            <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $prods->product_code }}"/>
                                                                        </div>
                                                                        <div class="col-sm-6 mb-3">
                                                                            <label for="nameBasic" class="form-label">Product Category</label>
                                                                            <select name="product_category" id="product_category" class="form-control">
                                                                                <option value="#" disabled selected>Select Category</option>
                                                                                @foreach ($categories as $category)
                                                                                    <option {{ $prods->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col mb-3">
                                                                            <label for="nameBasic" class="form-label">Product Price</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text">Rp. </span>
                                                                                <input type="number" name="price_product" id="price_product" class="form-control" value="{{ $prods->product_price }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col mb-3">
                                                                            <label for="nameBasic" class="form-label">Product Name</label>
                                                                            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $prods->product_name }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col mb-3">
                                                                            <label for="nameBasic" class="form-label">Product Description</label>
                                                                            <textarea name="desc_product" id="desc_product" class="form-control summernote">{{ $prods->product_description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col mb-5">
                                                                            <label for="nameBasic" class="form-label">Product Status</label>
                                                                            <br>
                                                                            <div class="col-sm-6 mb-2">
                                                                                <input type="radio" name="is_active" class="form-check-input" value="1" {{ $prods->is_active ? 'checked' : '' }} id="1">
                                                                                <label class="form-check-label" for="defaultCheck2"> Publish </label>
                                                                            </div>
                                                                            <div class="col-sm-6 mb-3">
                                                                                <input type="radio" name="is_active" class="form-check-input" id="0" value="0" {{ $prods->is_active ? '' : 'checked' }}>
                                                                                <label class="form-check-label" for="defaultCheck2"> Draft </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Save</button>
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
                                </div>

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-product" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Add New Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <div class="row mb-2">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Photo Product</label>
                                                    <input type="file" name="photo_product" id="photo_product" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="nameBasic" class="form-label">Product Code</label>
                                                    <input type="text" name="product_code" id="product_code" class="form-control" />
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label for="nameBasic" class="form-label">Product Category</label>
                                                    <select name="product_category" id="product_category" class="form-control">
                                                        <option value="#" disabled selected>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Product Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp. </span>
                                                        <input type="number" name="price_product" id="price_product" class="form-control" placeholder="Enter Price" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Product Name</label>
                                                    <input type="text" name="product_name" id="product_name" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Product Description</label>
                                                    <textarea name="desc_product" id="desc_product" class="form-control summernote"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col mb-5">
                                                    <label for="nameBasic" class="form-label">Product Status</label>
                                                    <br>
                                                    <div class="col-sm-6 mb-2">
                                                        <input type="radio" name="is_active" class="form-check-input" value="1" checked>
                                                        <label class="form-check-label" for="defaultCheck2"> Publish </label>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                        <input type="radio" name="is_active" class="form-check-input" value="0">
                                                        <label class="form-check-label" for="defaultCheck2"> Draft </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                                </button>
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

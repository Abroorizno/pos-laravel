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
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Created at</th>
                                                    <th>Updates at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($datas as $users)
                                                    <tr>
                                                        <td>{{ $no++ }}.</td>
                                                        <td>{{ $users->name}}</td>
                                                        <td>{{ $users->email}}</td>
                                                        <td>{{ $users->created_at->format('d/m/Y') }}</td>
                                                        <td>{{ $users->updated_at->format('d/m/Y') }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-users-{{ $users->id }}">EDIT</a>
                                                            <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this category?')">DELETE</button>
                                                            </form>
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-users">
                                            Add User
                                        </button>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-users" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Add New User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.store') }}" method="post">
                                                @csrf
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">User Name</label>
                                                    <input type="text" name="user_name" id="nameBasic" class="form-control" placeholder="Enter Name" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Email</label>
                                                    <input type="email" name="user_email" id="nameBasic" class="form-control" placeholder="Enter Name" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Password</label>
                                                    <input type="password" name="password" id="nameBasic" class="form-control" required/>
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


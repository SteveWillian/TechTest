@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@if ($message = session()->has('succes'))
<script>
    Swal.fire({
        type: 'success',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1000
    }).then(function() {
        window.location = "{{ route('users') }}";
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
    });
</script>
@enderror

@include('layouts.navbars.auth.topnav', ['title' => $title,'subtile' => $subtitle])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <form role="form" method="POST" action="{{route('users_update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0" style="border-radius:1rem 1rem 0 0 !important;">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6>Update User</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <input hidden type="text" name="id" value="{{$data['id']}}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Username</label>
                                    <input @error('username') class="form-control is-invalid" @enderror class="form-control" type="text" name="username" value="{{$data['username']}}">
                                    @error('username')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input @error('email') class="form-control is-invalid" @enderror class="form-control" type="text" name="email" value="{{$data['email']}}">
                                    @error('email')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input @error('password') class="form-control is-invalid" @enderror class="form-control" type="password" name="password">
                                    @error('password')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input @error('firstname') class="form-control is-invalid" @enderror class="form-control" type="text" name="firstname" value="{{$data['firstname']}}">
                                    @error('firstname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['lastname']}}">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Address</label>
                                    <input @error('address') class="form-control is-invalid" @enderror class="form-control" type="text" name="address" value="{{$data['address']}}">
                                    @error('address')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">City</label>
                                    <input @error('city') class="form-control is-invalid" @enderror class="form-control" type="text" name="city" value="{{$data['city']}}">
                                    @error('city')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Country</label>
                                    <input @error('country') class="form-control is-invalid" @enderror class="form-control" type="text" name="country" value="{{$data['country']}}">
                                    @error('country')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Postal code</label>
                                    <input @error('postal') class="form-control is-invalid" @enderror class="form-control" type="text" name="postal" value="{{$data['postal']}}">
                                    @error('postal')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">About me</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">About me</label>
                                    <input @error('about') class="form-control is-invalid" @enderror class="form-control" type="text" name="about" value="{{$data['about']}}">
                                    @error('about')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                            </div>
                            <div class="col-6 text-end">
                                <a type="button" href="{{ route('users') }}" class="btn text-secondary font-weight-bold text-xs">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
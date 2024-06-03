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
                <form role="form" method="POST" action="{{route('users_store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0" style="border-radius:1rem 1rem 0 0 !important;">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6>Create User</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input @error('email') class="form-control is-invalid" @enderror class="form-control" type="text" name="email" value="">
                                    @error('email')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input @error('password') class="form-control is-invalid" @enderror class="form-control" type="password" name="password" value="">
                                    @error('password')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tipo</label>
                                    <select @error('password') class="form-control is-invalid" @enderror class="form-control" name="type">
                                        <option value="admin">Admin</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                    @error('password')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input @error('name') class="form-control is-invalid" @enderror class="form-control" type="text" name="name" value="">
                                    @error('name')
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
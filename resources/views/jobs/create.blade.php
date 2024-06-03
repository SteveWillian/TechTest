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
        window.location = "{{ route('jobs') }}";
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
                <form role="form" method="POST" action="{{route('jobs_store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0" style="border-radius:1rem 1rem 0 0 !important;">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6>Create Jobs</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Job Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Job's Name</label>
                                    <input @error('firstname') class="form-control is-invalid" @enderror class="form-control" type="text" name="queue">
                                    @error('firstname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Salary</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="payload">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Task</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="detail[tareas]">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Cost per hour</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="detail[costo_hora]">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Position</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="detail[puesto]">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Currency</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="detail[moneda]">
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Country</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="detail[pais]">
                                    @error('lastname')
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
                                <a type="button" href="{{ route('jobs') }}" class="btn text-secondary font-weight-bold text-xs">Back</a>
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
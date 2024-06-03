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
        text: '{{ $errors->first() }}',
    });
</script>
@enderror

@include('layouts.navbars.auth.topnav', ['title' => $title,'subtile' => $subtitle])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <form role="form" method="POST" action="{{route('jobs_postulate')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0" style="border-radius:1rem 1rem 0 0 !important;">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6>Job Detail</h6>
                            </div>
                            <div class="col-6 text-end">
                                @if(Auth::user()->type != 'admin')
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Postular</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input hidden type="text" name="id" value="{{$data['job_id']}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Job's Name</label>
                                    <input @error('firstname') class="form-control is-invalid" @enderror class="form-control" type="text" name="firstname" value="{{$data['queue']}}" readonly>
                                    @error('firstname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Salary</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['payload']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Task</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['tareas']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Cost per hour</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['costo_hora']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Position</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['puesto']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Currency</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['moneda']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Country</label>
                                    <input @error('lastname') class="form-control is-invalid" @enderror class="form-control" type="text" name="lastname" value="{{$data['pais']}}" readonly>
                                    @error('lastname')
                                    <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">

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
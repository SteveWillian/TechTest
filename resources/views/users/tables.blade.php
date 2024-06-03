@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('scripts')
<script>
    let table = new DataTable("#user_table");
    
    $(".delete").click(function(e) {
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "once eliminated cannot be recovered",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#fd7e14"

        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.close();
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{route('users_delete')}}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    beforeSend: function() {
                        open = false;
                        Swal.fire({
                            title: 'Loading...',
                            text: '',
                            showCancelButton: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>

@endsection

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => $title])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6>List Users</h6>
                        </div>
                        <div class="col-6 text-end">
                            @if(Auth::user()->type == 'admin')
                            <a href="{{ route('users_create') }}" class="btn btn-outline-primary btn-sm mb-0">New</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="user_table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Correo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                    @if(Auth::user()->type == 'admin')
                                    <th class="text-secondary opacity-7"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$val['name']}} </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$val['email']}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($val['type'] == 'admin')
                                        <p class="text-xs font-weight-bold mb-0">Admin</p>
                                        @else
                                        <p class="text-xs font-weight-bold mb-0">Usuario</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ date("d/m/Y", strtotime($val['created_at'])) }}</span>
                                    </td>
                                    @if(Auth::user()->type == 'admin')
                                    <td class="align-middle text-center">
                                        <a class="btn text-secondary font-weight-bold text-xs mb-2 mt-2 delete" data-id="{{$val['id']}}">Delete</a>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
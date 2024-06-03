@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('scripts')
<script>
    var type = "{{ Auth::user()->type; }}";

    $("#filter").on('change', function() {
        $.ajax({
            type: "GET",
            url: "{{route('jobs_filter')}}",
            dataType: "JSON",
            data: {
                "filter": $(this).val(),
            },
            success: function(data) {
                let content = '';
                console.log(data);
                $("#job_table tbody tr").remove();

                data.forEach(element => {
                    content += '<tr>' +
                        '<td>' +
                        '<div class="d-flex flex-column justify-content-center">' +
                        '<h6 class="mb-0 text-sm">' + element.queue + '</h6>' +
                        '</div>' +
                        '</td>' +
                        '<td><p class="text-xs font-weight-bold mb-0">' + element.payload + '</p></td>' +
                        '<td class="align-middle text-center"><p class="text-xs font-weight-bold mb-0">' + element.count + '</p></td>' +
                        '<td class="align-middle text-center"><p class="text-xs font-weight-bold mb-0">' + element.reserved_at + '</p></td>' +
                        '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold">' + element.available_at + '</span></td>' +
                        '<td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold">' + element.created_at + '</span></td>' +
                        '<td class="align-middle text-center"><a href="{{ route("jobs_detail") }}/' + element.id + '" class="btn text-secondary font-weight-bold text-xs mb-2 mt-2">Detail</a>';
                    if (type == 'admin') {
                        content += '<a href="{{ route("jobs_applicants") }}/' + element.id + '" class="btn text-secondary font-weight-bold text-xs mb-2 mt-2">Postulantes</a>' +
                            '</td>' +
                            '</tr>'
                    }

                })

                $("#job_table").find('tbody')
                    .append(content);
            }
        })
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
                            <h6>List Jobs</h6>
                        </div>
                        @if(Auth::user()->type == 'admin')
                        <div class="col-4 text-end">
                            <input class="form-control" type="text" id="filter" placeholder="Find Job">
                        </div>
                        <div class="col-2 text-end">
                            <a href="{{ route('jobs_create') }}" class="btn btn-outline-primary btn-sm mb-0">New</a>
                        </div>
                        @else
                        <div class="col-6 text-end">
                            <input class="form-control" type="text" id="filter" placeholder="Find Job">
                        </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="job_table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pay</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Attempts</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reserved At</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available At</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($data))
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td class="align-middle text-center">
                                    </td>
                                    <td class="align-middle text-center">
                                    </td>
                                    <td class="align-middle text-center">
                                    </td>
                                    <td class="align-middle text-center">
                                    </td>
                                </tr>
                                @else
                                @foreach($data as $key => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$val['queue']}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$val['payload']}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$val['count']}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{date("d/m/Y", strtotime($val['reserved_at'])) }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ date("d/m/Y", strtotime($val['available_at'])) }}</span>

                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ date("d/m/Y", strtotime($val['created_at'])) }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('jobs_detail') }}/{{$val['id']}}" class="btn text-secondary font-weight-bold text-xs mb-2 mt-2">Detail</a>
                                        @if(Auth::user()->type == 'admin')
                                        <a href="{{ route('jobs_applicants') }}/{{$val['id']}}" class="btn text-secondary font-weight-bold text-xs mb-2 mt-2">Postulantes</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
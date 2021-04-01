@extends('layouts.main')
@section('title', 'Kas Keluar')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="black accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        List Kas Keluar
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <div class="tab-content my-3" id="pills-tabContent">
            <div class="mb-3">
                <a href="{{route('Data.kasKeluar.tambahKasKeluar')}}">
                <button type="button" class="btn btn-primary"><i class="icon icon-plus mr-2 text-center"></i>Tambah Kas Keluar</button>
                </a>
            </div>
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="30">No</th>
                                            <th>tanggal</th>
                                            <th>Keterangan</th>
                                            <th>nominal</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
 <script type="text/javascript">
    var table = $('#dataTable').dataTable({
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        ajax: {
            url: "{{ route('Data.kasKeluar.api') }}",
            method: 'POST'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'nominal', name: 'nominal'},
        ]
    });
</script>
@endsection


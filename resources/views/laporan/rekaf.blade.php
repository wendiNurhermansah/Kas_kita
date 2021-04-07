@extends('layouts.main')
@section('title', 'Laporan Rekafitulasi')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="black accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-list mr-2"></i>
                        Laporan Rekafitulasi
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid relative animatedParent animateOnce mt-3">
        <div class="tab-pane animated fadeInUpShort" id="tambah-data" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div id="alert"></div>
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" action="{{route('Laporan.cetakRekaf')}}" id="form" method="GET"  enctype="multipart/form-data" novalidate>

                                <input type="hidden" id="id" name="id"/>
                                <h4 id="formTitle">Laporan Rekafitulasi</h4><hr>
                                <div class="form-row form-inline">
                                    <div class="col-md-3">
                                        <div class="form-group mt-4">
                                            <label for="tahun">Tahun</label>
                                            <select class="custom-select" name="tahun">
                                                @for ($i = 2021; $i <= 2030; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-3 ml-2">
                                        <div class="form-group mt-4">
                                            <label for="bulan">Bulan</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="bulan">
                                                @foreach ($namaBulan as $k=> $item)
                                                <option value="{{$k+1}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </div>

                                </div>
                                <div class="mt-5" style="margin-left: 15%">
                                    <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-print mr-2"></i>Cetak PDF<span id="txtAction"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

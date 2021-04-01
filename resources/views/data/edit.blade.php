@extends('layouts.main')
@section('title', 'Edit Anggota')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="black accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        Edit Anggota
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
            <div class="tab-pane animated fadeInUpShort" id="tambah-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" action="{{ route('Data.anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{$anggota->id}}"/>
                                    <h4 id="formTitle">Edit Anggota</h4><hr>
                                    <div class="form-row form-inline">
                                        <div class="col-md-8">
                                            <div class="form-group m-10">
                                                <label for="nama" class="col-form-label s-12 col-md-2">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control r-0 light s-12 col-md-6" autocomplete="off" value="{{$anggota->nama}}" required/>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="alamat" class="col-form-label s-12 col-md-2">Alamat</label>
                                                <input type="text" name="alamat" id="alamat" class="form-control r-0 light s-12 col-md-6" autocomplete="off" value="{{$anggota->alamat}}" required/>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label class="col-form-label s-12 col-md-2">Jenis Kelamin</label>
                                                <div class="col-md-6 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                        <option value="Laki-Laki"   @if($anggota->jenis_kelamin == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                        <option value="Perempuan" @if($anggota->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="no_hp" class="col-form-label s-12 col-md-2">No Hp</label>
                                                <input type="text" name="no_hp" id="no_hp" class="form-control r-0 light s-12 col-md-6" autocomplete="off" value="{{$anggota->no_hp}}" required/>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="col-form-label s-12 col-md-2"></label>
                                                <img width="150" class="rounded img-fluid mt-2" id="preview" alt=""/>
                                            </div>
                                            <div class="mt-2" style="margin-left: 17%">
                                                <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Rubah Data<span id="txtAction"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

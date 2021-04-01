@extends('layouts.main')
@section('title', 'Tambah Kas Keluar')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="black accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-plus mr-2"></i>
                        Tambah Kas Keluar
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
                            <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                {{ method_field('POST') }}
                                <input type="hidden" id="id" name="id"/>
                                <h4 id="formTitle">Tambah Kas Keluar</h4><hr>
                                <div class="form-row form-inline">
                                    <div class="col-md-8">

                                        <div class="form-group mt-3">
                                            <label for="tanggal" class="col-form-label s-12 col-md-2">Tanggal</label>
                                            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="keterangan" class="col-form-label s-12 col-md-2">Keterangan</label>
                                            <input type="text" name="keterangan" id="keterangan" placeholder="Masukan keterangan" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="nominal" class="col-form-label s-12 col-md-2">Nominal</label>
                                            <input type="text" name="nominal" id="nominal" placeholder="Masukan Nominal" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="col-form-label s-12 col-md-2"></label>
                                            <img width="150" class="rounded img-fluid mt-2" id="preview" alt=""/>
                                        </div>
                                        <div class="mt-2" style="margin-left: 17%">
                                            <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></button>
                                            <a class="btn btn-sm" onclick="add()" id="reset">Reset</a>
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
@endsection
@section('script')
<script type="text/javascript">
function add(){
        save_method = "add";
        $('#form').trigger('reset');
        $('#formTitle').html('Tambah Kas Keluar');
        $('input[name=_method]').val('POST');
        $('#txtAction').html('');
        $('#reset').show();
        $('#preview').attr({ 'src': '-', 'alt': ''});
        $('#changeText').html('Browse Image')
        $('#username').focus();
    }

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            url = "{{ route('Data.kasKeluar.store') }}",
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log(data);
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                    table.api().ajax.reload();
                    add();
                },
                error : function(data){
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                }
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

</script>

@endsection



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Data PDF</title>
  </head>
  <body>
      @php
          setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
      @endphp
    <div class="container">
        <h4 style="text-align: center;">Laporan Rekafitulasi Kas Bulanan</h4>
        <h5 style="text-align: center;">Periode : Bulan {{$m}} , Tahun {{$y}}</h5>
        <hr>

        <table class="table mt-5">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kas Masuk</th>
                <th scope="col">Kas Keluar</th>

              </tr>



            </thead>
            <tbody>
            @php
                $a=1;
            @endphp
             @for ($i = 0; $i < count($serie); $i++)
              <tr>
               <th scope="row">{{$a++}}</th>
               <td>{{$serie[$i]['label']}}</td>
               <td>{{number_format($serie[$i]['kas_masuk'])}}</td>
               <td>{{number_format($serie[$i]['kas_keluar'])}}</td>
              </tr>
              @endfor







            </tbody>
            <tfoot class="thead-light">
                <th colspan="2" style="text-align: center;">Total</th>
                <th>{{number_format($subtotal_kasMasuk)}}</th>
                <th>{{number_format($subtotal_kasKeluar)}}</th>
            </tfoot>
          </table>

          <div class="mt-5" style="margin-left: 75%;">
              <h6>{{\Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')}}  </h6>
              <br><br><br><br>
              <h6 style="margin-left: 40px;">
                <strong>
                    <b>
                        <u>Bendahara</u>
                    </b>
                </strong>
            </h6>
          </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

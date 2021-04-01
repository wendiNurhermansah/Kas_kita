
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
        <h5 style="text-align: center;">Laporan Kas Keluar</h5>
        <h6 style="text-align: center;">Periode : {{\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')}} s/d {{\Carbon\Carbon::parse($tanggal2)->isoFormat('dddd, D MMMM Y')}}</h6>
        <hr>

        <table class="table mt-5">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nominal</th>
              </tr>
            </thead>
            <tbody>
                @php
                $a=1;
            @endphp
            @foreach ($data as $i)
              <tr>

                  <th scope="row">{{$a++}}</th>
                  <td>{{$i->tanggal}}</td>
                  <td>{{$i->keterangan}}</td>
                  <td>{{number_format($i->nominal)}}</td>


              </tr>
              @endforeach
            </tbody>
            <tfoot class="thead-light">
                <th colspan="3" style="text-align: center;">Total</th>
                <th><span>{{number_format($total)}}</span></th>
            </tfoot>
          </table>

          <div class="mt-5" style="margin-left: 65%;">
              <h6 style="font-size: 15px;">Garut, {{\Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')}}  </h6>
              <br><br><br><br>
              <p style="margin-left: 30px;">
                <strong style="margin-left: 50%;">
                    <b>

                        <p style="font-size: 10px;">WENDI NURHERMANSAH</p>
                        <hr style="black">
                    </b>
                </strong>
            </p>
          </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

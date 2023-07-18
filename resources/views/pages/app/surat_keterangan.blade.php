<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Dokumen</title>
  <style>
    body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }
    .margin-gambar{
      margin: 7px;
    }


    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 210mm;
      min-height: 297mm;
      padding: 15mm;
      margin: 10mm auto;
      border: 1px #D3D3D3 solid;
      border-radius: 5px;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .subpage {
      padding: 1cm;
      border: 5px red solid;
      height: 257mm;
      outline: 2cm #FFEAEA solid;
    }
    

    @page {
      size: A4;
      margin: 0;
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }

    table {
    border-collapse: collapse;
    width: 100%;
  }

  td:first-child {
    width: 30%;
  }

  td:nth-child(2) {
    width: 1%;
    white-space: nowrap;
  }

  td:last-child {
    text-align: left;
    line-height: 1;
  }
  @media print {
      .print-button {
        display: none;
      }
    }

    .page {
      position: relative;
    }

    .print-button {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 10px;
      background-color: #008ce9;
    }
  </style>
</head>
<body>
  <div class="page">
      <button class="print-button" onclick="window.print()">Cetak</button>
      <table width="700">
        <tr>
            <td>
                <img align="left" src="/img/logo.png" width="250" class="margin-top" alt="" srcset="">
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
      </table> <br><br>

      <table width="700">
        <center>
            <b><font size="4">BERITA ACARA PEMINJAMAN ASET KANTOR</font></b>
        </center><br><br>
      </table>

      <table>
        <tr>
            <td>Yang Bertanda Tangan Dibawah Ini :</td>
        </tr>
        <table width="707">
          <tr>
              <td>Nama</td>
              <td>:</td>
              <td>{{ Auth::user()->name }}</td>
          </tr>
          <tr>
              <td>NIP</td>
              <td>:</td>
              <td>{{ Auth::user()->nip }}</td>
          </tr>
          <tr>
              <td>Jabatan</td>
              <td>:</td>
              <td>{{ Auth::user()->jabatan }}</td>
          </tr>
          
      </table><br>
      </table>

      <table>
        <tr>
          <td>Menyatakan dengan sebenarnya bahwa :</td>
      </tr>
        <table width="778">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $peminjaman->name }}</td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $peminjaman->nip }}</td>
          </tr>
          <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $peminjaman->jabatan }}</td>
          </tr>
          <tr>
            <td>Jenis Aset</td>
            <td>:</td>
            <td>{{ $peminjaman->jenis_barang }}</td>
          </tr>
          <tr>
            <td>Nama Aset & Serial Number</td>
            <td>:</td>
            <td>{{ $peminjaman->nama_barang.' '.$peminjaman->nomor_model.' '.$peminjaman->serial_number }}</td>
          </tr>
          {{-- <tr>
            <td>Serial Number Aset</td>
            <td>:</td>
            <td>{{ $peminjaman->serial_number }}</td>
          </tr> --}}
          <tr>
            <td>Detail Aset</td>
            <td>:</td>
            <td>{{ strip_tags($peminjaman->detail) }}</td>
          </tr>
        </table>
    </table>
    <br>
    <p style="margin-top: 10px; line-height: 1.5; text-align:justify;">Telah melakukan peminjaman aset alat kantor berupa <b>{{ $peminjaman->jenis_barang }}. Pada hari {{ \Carbon\Carbon::parse($peminjaman->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</b>, lama waktu peminjaman yaitu <b>
      <td>
        @if($peminjaman->durasi_peminjaman >= 30)
        {{ $peminjaman->durasi_peminjaman/30 }} Bulan,
        @elseif($peminjaman->durasi_peminjaman >= 7)
        {{ $peminjaman->durasi_peminjaman/7 }} Minggu,
        @elseif($peminjaman->durasi_peminjaman >= 360)
        {{ $peminjaman->durasi_peminjaman/7 }} Tahun,
        @else
        {{ $peminjaman->durasi_peminjaman }} hari,
        @endif
    </td></b> harus mengembalikan aset alat kantor tersebut pada hari <b>{{ \Carbon\Carbon::parse($peminjaman->tgl_pengembalian)->locale('id')->isoFormat('dddd, D MMMM Y') }}</b></p>
  <p style="margin-top: 10px; line-height: 1.5; text-align:justify;">Demikian surat keterangan ini dibuat 2 (dua) rangkap untuk dapat dipergunakan dengan sebagai mana mestinya</p>
 {{-- <p style="margin-top: 20px; line-height: 1.;">Demikian berita acara ini dibuat 2 (dua) rangkap untuk dapat dipergunakan dengan sebagaimana mestinya.</p> --}}

      

      <div style="margin-top: 50px; float: left;">
        <div style="width: 250px">
          <p><b> Jakarta, {{ \Carbon\Carbon::parse($peminjaman->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</b></p>
          <p>Mengetahui</p><br><br><br><br>
          <span style="margin-top: 90px;">{{ Auth::user()->name }}<br> NIP. {{ Auth::user()->nip }}</span>
        </div>
      </div>
      <div style="margin-top: 85px; float: right;">
        <div style="width: 250px">
          <p>Pengguna</p><br><br><br><br>
          <span>{{ $peminjaman->name }}<br> NIP. {{ $peminjaman->nip }}</span>
          
        </div>
      </div>
      
      <td>
        <img align="left" src="/img/logo2.png" width="734" class="margin-top" alt="" srcset="">
    </td>
      <script>
        // Fungsi untuk mencetak halaman saat tombol ditekan
        function printPage() {
          window.print();
        }
        </script>
    </div>
    <button onclick="printPage()">Cetak</button>
</body>


</html>
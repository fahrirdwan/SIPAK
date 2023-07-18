@extends('layouts.default')

@section('title','Dashboard')

@push('styles')
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="card-body shadow">
          <img class="img-fluid pad" src="/img/kegiatan_juni.png" alt="Photo" width="100%" height="50%"> 
          <p class="mt-4">Royal Canin Bersama PERKIN hadir kembali dengan Dog Breeding Course Series <br> Sabtu 10 Juni 2023</p>
        </div>
        <!-- /.card -->
      </div>

      <div class="col-6" style="margin-top:250px ">
        <div class="card-body shadow">
          <img class="img-fluid pad" src="/img/kegiatan_2023.jpg" alt="Photo" width="100%" height="50%">

          <p class="mt-4">NORTH SULAWESI ALL BREED CHAMPIONS DOG SHOW 2023<br> 22-23 Juli 2023</p>
        </div>
        <!-- /.card -->
      </div>

      <div class="col-6" style="margin-top:-150px ">
        <div class="card-body shadow">
          <img class="img-fluid pad" src="/img/kegiatan_show.jpg" alt="Photo">

          <p class="mt-4">PERKIN JABAR  Dog Show 2023<br> 05-06 Agustus 2023</p>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection

@push('scripts')
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,  "bDestroy": true,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush
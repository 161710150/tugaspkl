@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Table Pengembalian</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="margin-bottom: 15px">
              <button type="button" name="add" id="Tambah" class="btn btn-success">Add Data</button>
            </div>
            <div class="panel panel-body">
               <table id="kbltabel" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                      <th>Nomor Pinjam</th>
                      <th>Nama Anggota</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Harus Kembali</th>
                      <th>Tanggal Kembali</th>
                      <th>Denda</th>
                     </tr>
                  </thead>
               </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')

@include('pinjamkmbl.modalkbl')

<script type="text/javascript">
   $(document).ready(function() {

    $('#kbltabel').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'jsonpinjam',
      columns:[
            { data: 'Nopjkb', name: 'Nopjkb' },
            { data: 'Anggota'},
            { data: 'Buku'},
            { data: 'Tglpjm', name: 'Tglpjm'},
            { data: 'Tglharuskbl', name: 'Tglharuskbl'},
            { data: 'Tglkbl', name: 'Tglkbl'},
            { data: 'Denda', name: 'Denda'},
        ],
      });
    $('#Tambah').click(function(){

      $('#kblModal').modal('show');
      $('.modal-title').text('Add Data');
      $('#aksi').val('Tambah');
      $('.select-dua').select2();
      state = "insert";

      });

    $('#kblModal').on('hidden.bs.modal',function(e){
      $(this).find('#kblForm')[0].reset();
      $('span.has-error').text('');
      $('.form-group.has-error').removeClass('has-error');
      });
    $(document).ready(function(){
      $('#Nopjkb').on('change', function(){
        var nomorID = $(this).val();
        console.log('bismillah');
          if(nomorID){
            $.ajax({
              url: 'myform/kbl/'+nomorID,
              type: "GET",
              dataType: "json",
              success: function (data){
                console.log(data.tanggalharuskbl);
                $('#id_agt').val(data.anggota);
                $('#id_buku').val(data.judulbuku);
                $('#Tglpjm').val(data.tanggalpjm);
                $('#Tglharuskbl').val(data.tanggalharuskbl);
              }
            });
          }
          else
          {
            $('#id_agt','#id_buku','#Tglpjm','#Tglharuskbl').empty();
          }
      });
    });
  });
</script>
@endpush      
@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Table Peminjaman</h1>
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
               <table id="pinjamtabel" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                      <th>Nomor Pinjam</th>
                      <th>Nama Anggota</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Harus Kembali</th>
                      <th>Action</th>
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

@include('pinjamkmbl.modal')

<script type="text/javascript">
   $(document).ready(function() {

    $('#pinjamtabel').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'jsonpinjam',
      columns:[
            { data: 'Nopjkb', name: 'Nopjkb' },
            { data: 'Anggota'},
            { data: 'Buku'},
            { data: 'Tglpjm', name: 'Tglpjm'},
            { data: 'Tglharuskbl', name: 'Tglharuskbl'},
            { data: 'action', orderable: false, searchable: false }
        ],
      });
    $('#Tambah').click(function(){

      $('#pinjamModal').modal('show');
      $('.modal-title').text('Add Data');
      $('#aksi').val('Tambah');
      $('.select-dua').select2();
      state = "insert";

      });

    $('#pinjamModal').on('hidden.bs.modal',function(e){
      $(this).find('#pinjamForm')[0].reset();
      $('span.has-error').text('');
      $('.form-group.has-error').removeClass('has-error');
      });

    $('#pinjamForm').submit(function(e){
      $.ajaxSetup({
        header: {
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
      });

      //menambah kan data
      e.preventDefault();

      if (state == 'insert'){

        $.ajax({
          type: "POST",
          url: "{{url ('/storepinjam')}}",
          data: new FormData(this),
          contentType: false,
          processData: false,
          dataType: 'json',

          success: function (data){
            console.log(data);
            swal({
                title:'Success Tambah!',
                text:'Data Berhasil Disimpan',
                type:'success',
                timer:'2000'
              });
            $('#pinjamModal').modal('hide');
            $('#pinjamtabel').DataTable().ajax.reload();
          },

          //menampilkan validasi error
          error: function (data){

            $('input').on('keydown keypress keyup click change', function(){
            $(this).parent().removeClass('has-error');
            $(this).next('.help-block').hide()
          });

            var coba = new Array();
            console.log(data.responseJSON.errors);
            $.each(data.responseJSON.errors,function(name, value){
              console.log(name);
              coba.push(name);

              $('input[name='+name+']').parent().addClass('has-error');
              $('input[name='+name+']').next('.help-block').show().text(value);
            });

            $('input[name='+coba[0]+']').focus();
          }
        });
      }
      else 
      {
         //mengupdate data yang telah diedit
        $.ajax({
          type: "POST",
          url: "{{url ('updatepinjam')}}"+ '/' + $('#id').val(),
          data: new FormData(this),
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (data){
            console.log(data);
            $('#pinjamModal').modal('hide');
            swal({
              title: 'Update Success',
              text: data.message,
              type: 'success',
              timer: '3500'
            })
            $('#pinjamtabel').DataTable().ajax.reload();
          },
          error: function (data){
            $('input').on('keydown keypress keyup click change', function(){
            $(this).parent().removeClass('has-error');
            $(this).next('.help-block').hide()
          });
            var coba = new Array();
            console.log(data.responseJSON.errors);
            $.each(data.responseJSON.errors,function(name, value){
              console.log(name);
              coba.push(name);
              $('input[name='+name+']').parent().addClass('has-error');
              $('input[name='+name+']').next('.help-block').show().text(value);
            });

            $('input[name='+coba[0]+']').focus();
          }
       });
      }
   });

    //mengambil data yang ingin diedit
    $(document).on('click', '.edit', function(){
      var bebas = $(this).data('id');
      $('#form_output').html('');
      $.ajax({
        url:"{{url('editpinjam')}}" + '/' + bebas,
        method:'get',
        data:{id:bebas},
        dataType:'json',
        success:function(data){
          console.log(data);
          state = "update";

          $('#id').val(data.id);
          $('#Nopjkb').val(data.Nopjkb);
          $('#id_jb').val(data.id_jb);
          $('#id_agt').val(data.id_agt);
          $('#id_buku').val(data.id_buku);
          $('#Tglpjm').val(data.Tglpjm);
          $('#Tglharuskbl').val(data.Tglharuskbl);
          $('.select-dua').select2();


            $('#pinjamModal').modal('show');
            $('#aksi').val('Save');
            $('.modal-title').text('Edit Data');
          }
        });
    });

    $(document).on('hide.bs.modal','#pinjamModal', function() {
      $('#pinjamtabel').DataTable().ajax.reload();
    });
  });
</script>
@endpush      
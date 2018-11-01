@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Table Buku</h1>
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
               <table id="bukutabel" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th>Jenis Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>International Standard Book Number (ISBN)</th>
                        <th>Tahun Terbit</th>
                        <th>Penerbit</th>
                        <th>Tersedia</th>
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

@include('buku.modal')

<script type="text/javascript">
   $(document).ready(function() {

    $('#bukutabel').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'jsonbuku',
      columns:[
            { data: 'jenisBuku' },
            { data: 'Judul', name: 'Judul'},
            { data: 'Pengarang', name: 'Pengarang'},
            { data: 'Isbn', name: 'Isbn'},
            { data: 'Thnterbit', name: 'Thnterbit'},
            { data: 'Penerbit', name: 'Penerbit'},
            { data: 'Tersedia', name: 'Tersedia'},
            { data: 'action', orderable: false, searchable: false }
        ],
      });
    $('#Tambah').click(function(){

      $('#bukuModal').modal('show');
      $('.modal-title').text('Add Data');
      $('#aksi').val('Tambah');
      $('.select-dua').select2();
      state = "insert";

      });

    $('#bukuModal').on('hidden.bs.modal',function(e){
      $(this).find('#bukuForm')[0].reset();
      $('span.has-error').text('');
      $('.form-group.has-error').removeClass('has-error');
      });

    $('#bukuForm').submit(function(e){
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
          url: "{{url ('/storebuku')}}",
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
            $('#bukuModal').modal('hide');
            $('#bukutabel').DataTable().ajax.reload();
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
          url: "{{url ('updatebuku')}}"+ '/' + $('#id').val(),
          data: new FormData(this),
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (data){
            console.log(data);
            $('#bukuModal').modal('hide');
            swal({
              title: 'Update Success',
              text: data.message,
              type: 'success',
              timer: '3500'
            })
            $('#bukutabel').DataTable().ajax.reload();
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
      $('#form_tampil').html('');
      $.ajax({
        url:"{{url('editbuku')}}" + '/' + bebas,
        method:'get',
        data:{id:bebas},
        dataType:'json',
        success:function(data){
          console.log(data);
          state = "update";

          $('#id').val(data.id);
          $('#id_jb').val(data.id_jb);
          $('#id_jb').val(data.id_jb);
          $('#Judul').val(data.Judul);
          $('#Pengarang').val(data.Pengarang);
          $('#Isbn').val(data.Isbn);
          $('#Thnterbit').val(data.Thnterbit);
          $('#Penerbit').val(data.Penerbit);
          $('#Tersedia').val(data.Tersedia);
          $('.select-dua').select2();


            $('#bukuModal').modal('show');
            $('#aksi').val('Simpan');
            $('.modal-title').text('Edit Data');
          }
        });
    });

    $(document).on('hide.bs.modal','#bukuModal', function() {
      $('#bukutabel').DataTable().ajax.reload();
    });

    //proses delete data
    $(document).on('click', '.delete', function(){
      var bebas = $(this).attr('id');
        if (confirm("Yakin Dihapus ?")) {

          $.ajax({
            url: "{{route('delete.buku')}}",
            method: "get",
            data:{id:bebas},
            success: function(data){
              swal({
                title:'Success Delete!',
                text:'Data Berhasil Dihapus',
                type:'success',
                timer:'1500'
              });
              $('#bukutabel').DataTable().ajax.reload();
            }
          })
        }
        else
        {
          swal({
            title:'Batal',
            text:'Data Tidak Jadi Dihapus',
            type:'error',
            });
          return false;
        }
      });
  });
</script>
@endpush      
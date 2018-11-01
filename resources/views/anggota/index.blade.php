@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Table Anggota</h1>
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
               <table id="tabelanggota" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th>Nomor Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
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

@include('anggota.modal')

<script type="text/javascript">
   $(document).ready(function() {

    $('#tabelanggota').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'jsonanggota',
      columns:[
            { data: 'Noagt', name: 'Noagt' },
            { data: 'Namaagt', name: 'Namaagt'},
            { data: 'Alamat', name: 'Alamat'},
            { data: 'Kota', name: 'Kota'},
            { data: 'Telp', name: 'Telp'},
            { data: 'action', orderable: false, searchable: false }
        ],
      });
    $('#Tambah').click(function(){

      $('#anggotaModal').modal('show');
      $('.modal-title').text('Add Data');
      $('#aksi').val('Tambah');
      $('.select-dua').select2();
      state = "insert";

      });

    $('#anggotaModal').on('hidden.bs.modal',function(e){
      $(this).find('#anggotaForm')[0].reset();
      $('span.has-error').text('');
      $('.form-group.has-error').removeClass('has-error');
      });

    $('#anggotaForm').submit(function(e){
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
          url: "{{url ('/storeanggota')}}",
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
            $('#anggotaModal').modal('hide');
            $('#tabelanggota').DataTable().ajax.reload();
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
          url: "{{url ('updateanggota')}}"+ '/' + $('#id').val(),
          data: new FormData(this),
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (data){
            console.log(data);
            $('#anggotaModal').modal('hide');
            swal({
              title: 'Update Success',
              text: data.message,
              type: 'success',
              timer: '3500'
            })
            $('#tabelanggota').DataTable().ajax.reload();
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
        url:"{{url('editanggota')}}" + '/' + bebas,
        method:'get',
        data:{id:bebas},
        dataType:'json',
        success:function(data){
          console.log(data);
          state = "update";

          $('#id').val(data.id);
          $('#Noagt').val(data.Noagt);
          $('#Namaagt').val(data.Namaagt);
          $('#Alamat').val(data.Alamat);
          $('#Kota').val(data.Kota);
          $('#Telp').val(data.Telp);
          $('.select-dua').select2();


            $('#anggotaModal').modal('show');
            $('#aksi').val('Simpan');
            $('.modal-title').text('Edit Data');
          }
        });
    });

    $(document).on('hide.bs.modal','#anggotaModal', function() {
      $('#tabelanggota').DataTable().ajax.reload();
    });

    //proses delete data
    $(document).on('click', '.delete', function(){
      var bebas = $(this).attr('id');
        if (confirm("Yakin Dihapus ?")) {

          $.ajax({
            url: "{{route('delete.anggota')}}",
            method: "get",
            data:{id:bebas},
            success: function(data){
              swal({
                title:'Success Delete!',
                text:'Data Berhasil Dihapus',
                type:'success',
                timer:'1500'
              });
              $('#tabelanggota').DataTable().ajax.reload();
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
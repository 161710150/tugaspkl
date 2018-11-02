<!DOCTYPE html>
<html>
<head>
	<title>Buku</title>
</head>
<body>
	<div id="kblModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="kblForm" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_output"></span>

                  <div class="form-group">
                     <input type="hidden" name="id" id="id">

                     <label>Nomor Pinjaman</label>
                     <select class="form-control select-dua" name="Nopjkb" id="Nopjkb" style="width: 468px">
                        <option disabled selected>Pilih Nomor Pinjam</option>
                        @foreach($kbl as $data)
                        <option value="{{$data->id}}">{{$data->Nopjkb}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('Nopjkb'))
                     <span class="help-block has-error id_buku_error">
                        <strong>{{$errors->first('Nopjkb')}}</strong>
                     </span>
                     @endif
                     <span class="help-block has-error Nopjkb_error"></span>
                  </div>
               
                  <div class="form-group">
                     <label>Nama Anggota</label>
                     <input class="form-control" type="text" name="id_agt" id="id_agt" placeholder="nama anggota" readonly>
                  </div>

                  <div class="form-group">
                     <label>Judul Buku</label>
                     <input class="form-control" type="text" name="id_buku" id="id_buku" placeholder="judul buku" readonly>
                  </div>

                  <div class="form-group">
                     <label>Tanggal Pinjam</label>
                     <input type="date" name="Tglpjm" id="Tglpjm" class="form-control" placeholder="masukan nama anda" readonly />
                     <span class="help-block has-error Tglpjm_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tanggal Harus Kembali</label><p>
                     <input type="date" name="Tglharuskbl" id="Tglharuskbl" class="form-control" placeholder="masukan harus kembali" readonly />
                     <span class="help-block has-error Tglharuskbl_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tanggal Kembali</label>
                     <input type="date" name="Tglkbl" id="Tglkbl" value="{{ carbon\carbon::today()->toDateString() }}" class="form-control" placeholder="masukan Tanggal Kembali" />
                     <span class="help-block has-error Tglkbl_error"></span>
                  </div>

                  <!-- <div class="form-group">
                     <label>Denda</label>
                     <input type="double" name="Denda" id="Denda" class="form-control" placeholder="Denda 2000" />
                     <span class="help-block has-error Denda_error"></span>
                  </div> -->

      				<div class="modal-footer">
      					<input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
      					<input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
      				</div>
               </form>
            </div>
         </div>
      </div>

</body>
</html>
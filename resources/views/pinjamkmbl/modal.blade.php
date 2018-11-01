<!DOCTYPE html>
<html>
<head>
	<title>Buku</title>
</head>
<body>
	<div id="pinjamModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="pinjamForm" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_output"></span>

                  <div class="form-group">
                     <label>Nomor Pinjaman</label>
                     <input type="text" name="Nopjkb" id="Nopjkb" class="form-control" placeholder="masukan nomor" />
                     <span class="help-block has-error Nopjkb_error"></span>
                  </div>
               
                  <div class="form-group {{ $errors->has('id_agt') ? 'has-error' : '' }}">
                     <input type="hidden" name="id" id="id">

                     <label>Nama Anggota</label>
                     <select class="form-control select-dua" name="id_agt" id="id_agt" style="width: 468px">
                        <option disabled selected>Pilih Nama Anggota</option>
                        @foreach($anggota as $data)
                        <option value="{{$data->id}}">{{$data->Namaagt}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_agt'))
                     <span class="help-block has-error id_agt_error">
                        <strong>{{$errors->first('id_agt')}}</strong>
                     </span>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('id_buku') ? 'has-error' : '' }}">
                     <input type="hidden" name="id" id="id">

                     <label>Judul Buku</label>
                     <select class="form-control select-dua" name="id_buku" id="id_buku" style="width: 468px">
                        <option disabled selected>Pilih Judul Buku</option>
                        @foreach($buku as $data)
                        <option value="{{$data->id}}">{{$data->Judul}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_buku'))
                     <span class="help-block has-error id_buku_error">
                        <strong>{{$errors->first('id_buku')}}</strong>
                     </span>
                     @endif
                  </div>

                  <div class="form-group">
                     <label>Tanggal Pinjam</label>
                     <input type="date" name="Tglpjm" id="Tglpjm" class="form-control" value="{{ carbon\carbon::today()->toDateString() }}" placeholder="masukan nama anda" readonly />
                     <span class="help-block has-error Tglpjm_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tanggal Harus Kembali</label><p>
                     <input type="date" name="Tglharuskbl" id="Tglharuskbl" class="form-control" value="{{ carbon\carbon::today()->addDays(2)->toDateString() }}" placeholder="masukan harus kembali" readonly />
                     <span class="help-block has-error Tglharuskbl_error"></span>
                  </div>

                  <!-- <div class="form-group">
                     <label>Tanggal Kembali</label>
                     <input type="text" name="Tglkbl" id="Tglkbl" class="form-control" placeholder="masukan Tanggal Kembali" />
                     <span class="help-block has-error Tglkbl_error"></span>
                  </div>

                  <div class="form-group">
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
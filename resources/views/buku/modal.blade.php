<!DOCTYPE html>
<html>
<head>
	<title>Buku</title>
</head>
<body>
	<div id="bukuModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="bukuForm" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_output"></span>

                  <div class="form-group {{ $errors->has('id_jb') ? 'has-error' : '' }}">
                     <input type="hidden" name="id" id="id">

                     <label>Jenis Buku</label>
                     <select class="form-control select-dua" name="id_jb" id="id_jb" style="width: 468px">
                        <option disabled selected>Pilih Jenis Buku</option>
                        @foreach($jenis as $data)
                        <option value="{{$data->id}}">{{$data->Jenis}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_jb'))
                     <span class="help-block has-error id_jb_error">
                        <strong>{{$errors->first('id_jb')}}</strong>
                     </span>
                     @endif
                  </div>

                  <div class="form-group">
                     <label>Judul</label>
                     <input type="text" name="Judul" id="Judul" class="form-control" placeholder="masukan nama anda" />
                     <span class="help-block has-error Judul_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Pengarang</label><p>
                     <textarea type="text" name="Pengarang" class="form-control" id="Pengarang" class="form-control" placeholder="masukan pengarang anda"></textarea>
                     <span class="help-block has-error Pengarang_error"></span>
                  </div>

                  <div class="form-group">
                     <label>International Standard Book Number</label>
                     <input type="text" name="Isbn" id="Isbn" class="form-control" placeholder="masukan isbn" />
                     <span class="help-block has-error Isbn_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tahun Terbit</label>
                     <input type="text" name="Thnterbit" id="Thnterbit" class="form-control" placeholder="masukan tahun terbit" />
                     <span class="help-block has-error Thnterbit_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Penerbit</label>
                     <input type="text" name="Penerbit" id="Penerbit" class="form-control" placeholder="masukan nama penerbit" />
                     <span class="help-block has-error Penerbit_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tersedia</label>
                     <input type="number" name="Tersedia" id="Tersedia" class="form-control" placeholder="masukan stok tersedia" />
                     <span class="help-block has-error Tersedia_error"></span>
                  </div>

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
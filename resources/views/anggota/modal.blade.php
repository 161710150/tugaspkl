<!DOCTYPE html>
<html>
<head>
	<title>Buku</title>
</head>
<body>
	<div id="anggotaModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="anggotaForm" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_output"></span>
               
                  <div class="form-group">
                     <input type="hidden" name="id" id="id">
               
                     <label>Nomor Anggota</label>
                     <input type="number" name="Noagt" id="Noagt" class="form-control" placeholder="masukan nomor anggota" />
                     <span class="help-block has-error Noagt_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Nama Anggota</label>
                     <input type="text" name="Namaagt" id="Namaagt" class="form-control" placeholder="masukan nama anda" />
                     <span class="help-block has-error Namaagt_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Alamat</label><p>
                     <textarea type="text" name="Alamat" class="form-control" id="Alamat" class="form-control" placeholder="masukan alamat anda"></textarea>
                     <span class="help-block has-error Alamat_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Nama Kota</label>
                     <input type="text" name="Kota" id="Kota" class="form-control" placeholder="masukan nama kota" />
                     <span class="help-block has-error Kota_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Telepon</label>
                     <input type="text" name="Telp" id="Telp" class="form-control" placeholder="masukan nomor telepon anda" />
                     <span class="help-block has-error Telp_error"></span>
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
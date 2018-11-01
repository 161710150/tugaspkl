<!DOCTYPE html>
<html>
<head>
	<title>Jenis Buku</title>
</head>
<body>
	<div id="jenisbukuModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="jenisbukuForm" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_tampil"></span>

                  <div class="form-group">
                     <input type="hidden" name="id" id="id">
                  	<label>Nama Jenis Buku</label>
                  	<input type="text" id="Jenis" name="Jenis" class="form-control" placeholder="masukan jenis">
                  	<span class="help-block has-error Jenis_error"></span>
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
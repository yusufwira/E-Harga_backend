<!DOCTYPE html>
		<html>
		<head>
			<style>
				
			</style>
		</head>
		<body>
		<form id="berita-create" method="post" enctype="multipart/form-data">
			{{ csrf_field()}}
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<div class="col-sm-6 col-md-12">
			    <div class="thumbnail">
				   <h3 style="text-align: center;">Masukkan Berita</h3>
				   		<div class="form-group">
						   <p>Judul Berita</p>
						   <input type="text" class="form-control" name="judulBerita" id="judulBerita"><br>
						   <p>Deskripsi</p>
						   <textarea class="form-control" name="deskripsiBerita" id="deskripsiBerita" rows="14"></textarea><br>
						  
						  	<div class="form-group">
					            <label>Upload File/Gambar</label>
					            <input type="file" name='file_uploads' id="file_uploads">					           
					        </div>

					         <div class="form-group row">
						   		<div class="col-sm-10">
						      		<input type="submit" value ="simpan" class="btn btn-primary" id="createBerita">
						    	</div>
						  	</div>
						  	

						</div>
				  
				</div>
				   
			</div>
		</form>
		</body>
		</html>
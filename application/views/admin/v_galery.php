<h3 style="border-bottom:dashed 1px #AAB2BD">Galery
<small>
<a href="<?=base_url().'galery/tambah_galery'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Foto Galery Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Foto Galeri Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
					<th>Judul Foto</th>
<th>Tempat Wisata</th>
				<th>Gambar</th>
			
					
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($join->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->judul ?></td>
					<td><?=$key->judulberita ?></td>

		
						<td>
								<?php 
					$img = array(  
						            'title' =>  'Klik Disini Untuk Melihat Gambar dari '.$key->judul,
						            'class' =>  'tip',
						            'data-placement' => 'top' 
						             
					 );
			 ?>


			 				<?php 
			 				echo	anchor('asset/upload/galery/gambarbesar/'.$key->gambar_besar_gal,
			 					'<i class="icon-eye-open"></i> View', $img);
			 				 ?>
						</td>
					
				


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'galery/edit_galery/'.$key->id_galery?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'galery/hapus/'.$key->id_galery?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->judul  ?> Dari data Galery..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






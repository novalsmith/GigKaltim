<h3 style="border-bottom:dashed 1px #AAB2BD">Kerajinan Khas Kaltim
<small>
<a href="<?=base_url().'kerajinan/tambah_kerajinan'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Tempat Kerajinan Khas Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Kerajinan Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kerajinan</th>
		    <th>Tempat Wisata</th>

			<th>Latitude (X)</th>
			<th>Longitude (Y)</th>
				<th>Gambar</th>
			
					
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($tampil->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->nama_kerajinan ?></td>
					<td><?=$key->judulberita ?></td>

					<td><?=$key->lat_kerajinan ?></td>
					<td><?=$key->long_kerajinan ?></td>
						<td>
						
			<?php 
					$img = array(  
						            'title' =>  'Klik Disini Untuk Melihat Gambar dari '.$key->nama_kerajinan,
						            'class' =>  'tip',
						            'data-placement' => 'top' 
						             
					 );
			 ?>


			 				<?php 
			 				echo	anchor('asset/upload/kerajinan/gambarbesar/'.$key->gambar_besar_k,
			 					'<i class="icon-eye-open"></i> View', $img);
			 				 ?>
							
						</td>
					


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'kerajinan/edit_kerajinan/'.$key->id_kerajinan?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'kerajinan/hapus/'.$key->id_kerajinan?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->nama_kerajinan  ?> Dari data Kerajinan Khas Kaltim..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






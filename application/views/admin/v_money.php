<h3 style="border-bottom:dashed 1px #AAB2BD">Money Changger
<small>
<a href="<?=base_url().'money/tambah_money'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Money CH Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Money CH Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Tempat Money Changger</th>
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

					<td><?=$key->nama_money ?></td>
					<td><?=$key->judulberita ?></td>

					<td><?=$key->lat_money ?></td>
					<td><?=$key->long_money ?></td>
						<td>
							<?php 
					$img = array(  
						            'title' =>  'Klik Disini Untuk Melihat Gambar dari '.$key->nama_money,
						            'class' =>  'tip',
						            'data-placement' => 'top' 
						             
					 );
			 ?>


			 				<?php 
			 				echo	anchor('asset/upload/money/gambarbesar/'.$key->gambar_besar_money,
			 					'<i class="icon-eye-open"></i> View', $img);
			 				 ?>
						</td>
					
				


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'money/edit_money/'.$key->id_money?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'money/hapus/'.$key->id_money?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->nama_money  ?> Dari data Money CH..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






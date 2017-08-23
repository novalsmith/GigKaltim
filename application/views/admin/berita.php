<h3 style="border-bottom:dashed 1px #AAB2BD">Artikel Wisata Kaltim
<small>
<a href="<?=base_url().'berita/tambah_berita'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon icon-plus icon-white"></i> Artikel Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kategori</th>
			<th>judulberita</th>
			<th>Waktu Posting</th>
			<th>Gambar</th>
			<th>Status</th>

			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($tampil->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->namakategori ?></td>

					<td><?=$key->judulberita ?></td>
					<td><?=$key->waktu ?></td>
					<td>
								<?php 
					$img = array(  
						            'title' =>  'Klik Disini Untuk Melihat Gambar dari '.$key->judulberita,
						            'class' =>  'tip',
						            'data-placement' => 'top' 
						             
					 );
			 ?>


			 				<?php 
			 				echo	anchor('asset/upload/berita/gambarbesar/'.$key->gambar_besar,
			 					'<i class="icon-eye-open"></i> View', $img);
			 				 ?>
						</td>
					
					<!--pengecekan status artikel berita-->
						<td>

						<?php if ($key->status == 'pending') {
						?>
					<span class="label label-warning">pending</span>
						<?php
						} else {
							?>
							<span class="label label-info">publish</span>
							<?php
						}
						?>

						</td>
					<!--Batas pengecekan status artikel berita-->


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'penduduk/detail_penduduk/'.$key->idberita?>" data-toggle="modal"><i class="icon icon-eye-open"></i> Lihat Detail Data</a></li>
						  <li><a href="<?=base_url().'berita/edit_berita/'.$key->idberita?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'berita/hapus/'.$key->idberita?>"

						  		onClick="return confirm('Anda Yakin Untuk Menghapus Artikel Berita..'+'\n'+
				'<?=  $key->judulberita  ?>..?')"

						  ><i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






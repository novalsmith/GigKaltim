<h3 style="border-bottom:dashed 1px #AAB2BD">Arsip Surat Ikmasor
<small>
<a href="<?=base_url().'arsip_surat/tambah_surat'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Surat Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Surat Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Judul Surat</th>
			<th>Keterangan</th>
			<th>Status Surat</th>
			
					
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($tampil->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->judul_surat ?></td>

					<td><?=$key->keterangan ?></td>
					
					<td>
						
						<?php 
				
				if ($key->status_surat == 'masuk') {
					?>

					<p class="label label-info">Aktif</p>

					<?php

					}else{
						 ?>

				<p class="label label-default">Tidak</p>


					<?php }  ?>


					</td>
					


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
					 <li><a href="<?=base_url().'anggota/detail_anggota/'.$key->id_arsip?>" data-toggle="modal"><i class="icon icon-eye-open"></i> Detail Anggota</a></li>

						  <li><a href="<?=base_url().'anggota/cetak_kartu_anggota/'.$key->id_arsip?>" data-toggle="modal"><i class="icon icon-download"></i> Download Kartu Anggota</a></li>
						  <li><a href="<?=base_url().'anggota/edit_anggota/'.$key->id_arsip?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'anggota/hapus/'.$key->id_arsip?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->nama_lengkap  ?> Dari Anggota IKMASOR..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






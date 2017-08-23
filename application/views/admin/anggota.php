<h3 style="border-bottom:dashed 1px #AAB2BD">Data Anggota Ikmasor
<small>
<a href="<?=base_url().'anggota/tambah_anggota'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Anggota Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Anggota Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>No Anggota</th>
			<th>Nama Lengkap</th>
			<th>Tlp</th>
			
			<th>Jurusan</th>
			<th>Kampus</th>
			<th>Angkatan</th>
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

					<td><?=$key->no_anggota ?></td>

					<td><?=$key->nama_lengkap ?></td>
					<td><?=$key->tlp ?></td>
					
					<td><?=$key->jurusan ?></td>
					<td><?=$key->kampus ?></td>
					<td><?=$key->angkatan ?></td>

					<td>
						
						<?php 
				
				if ($key->status == 'aktif') {
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
					 <li><a href="<?=base_url().'anggota/detail_anggota/'.$key->id_anggota?>" data-toggle="modal"><i class="icon icon-eye-open"></i> Detail Anggota</a></li>

						  <li><a href="<?=base_url().'anggota/cetak_kartu_anggota/'.$key->id_anggota?>" data-toggle="modal"><i class="icon icon-download"></i> Download Kartu Anggota</a></li>
						  <li><a href="<?=base_url().'anggota/edit_anggota/'.$key->id_anggota?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'anggota/hapus/'.$key->id_anggota?>"
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






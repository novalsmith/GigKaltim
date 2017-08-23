<h3 style="border-bottom:dashed 1px #AAB2BD">Master Data Penduduk
<small>
<a href="<?=base_url().'penduduk/tambah_penduduk'  ?>" title="" class="btn btn-info pull-right">
<i class="icon icon-plus icon-white"></i> Penduduk KK Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>No KK</th>
			<th>Nik</th>
			<th>Nama</th>
			<th>Jk</th>
			
			<th>Agama</th>
			<th>Status</th>
			<th>SHDRT</th>
		
			<th>Pekerjaan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($tampil->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->nomor_kk ?></td>

					<td><?=$key->nik ?></td>
					<td><?=$key->nama ?></td>
					<td><?=$key->jenis_kelamin ?></td>
					
					<td><?=$key->agama ?></td>
					<td><?=$key->status_pernikahan ?></td>
					<td><?=$key->status_hdrt ?></td>
					
					<td><?=$key->pekerjaan ?></td>


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'penduduk/detail_penduduk/'.$key->id_penduduk?>" data-toggle="modal"><i class="icon icon-eye-open"></i> Lihat Detail Data</a></li>
						  <li><a href="<?=base_url().'penduduk/edit_penduduk/'.$key->id_penduduk?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'penduduk/hapus/'.$key->id_penduduk?>"

						  		onClick="return confirm('Anda Yakin Untuk Menghapus Penduduk dengan NIK..'+'\n'+
				'<?=  $key->nik  ?>..?')"

						  ><i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






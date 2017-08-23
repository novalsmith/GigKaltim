<h3 style="border-bottom:dashed 1px #AAB2BD">Master Data Kelahiran Penduduk
<small>
<a href="<?=base_url().'kelahiran/tambah_kelahiran'  ?>" title="" class="btn btn-info pull-right">
<i class="icon icon-plus icon-white"></i> Penduduk Lahir Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>No Registrasi</th>
			<th>Tgl Laporan</th>
			<th>Nama Bayi</th>
			<th>Tempat Lahir</th>
			
			<th>Tanggal Lahir</th>
			<th>Ayah</th>
			<th>Ibu</th>
		
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($tampil->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->no_regis ?></td>

					<td><?=$key->tgl_laporan ?></td>
					<td><?=$key->nama_bayi ?></td>
					<td><?=$key->tempat_lhr ?></td>
					
					<td><?=$key->tgl_lahir ?></td>
					<td><?=$key->nama_ayah ?></td>
					<td><?=$key->nama_ibu ?></td>
					
		


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'kelahiran/detail_kelahiran/'.$key->id_kelahiran?>" data-toggle="modal"><i class="icon icon-eye-open"></i> Lihat Detail Data</a></li>
						  <li><a href="<?=base_url().'kelahiran/edit_kelahiran/'.$key->id_kelahiran?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'kelahiran/hapust/'.$key->id_kelahiran?>"

				onClick="return confirm('Anda Yakin Untuk Menghapus Data Kelahiran dengan Nama..'+'\n'+
				'<?=  $key->nama_bayi  ?>..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






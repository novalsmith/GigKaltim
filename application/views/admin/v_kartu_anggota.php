<h3 style="border-bottom:dashed 1px #AAB2BD">Kartu Anggota 
<small>
<a href="<?=base_url().'kartu_anggota/tambah_kartu'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon icon-plus icon-white"></i> Kartu Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Masa Berlaku</th>
				<th>Walpaper Kartu</th>	
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

					<td><?=$key->masa_berlaku ?></td>
					<td>
					<?php
					$img = array('src' => 'asset/upload/kartu_anggota/gambarbesar/'.$key->walpaper,
								  'class' => 'span2' );
					echo 
					anchor( 'asset/upload/kartu_anggota/gambarbesar/'.$key->walpaper,
					  img($img), 'attributes'); ?>
					</td>
					<td>


<?php if ($key->status == 'aktif'): ?>
	
	<p class="label label-info">Aktif</p>

	<?php else :?>
	<p class="label label-default">Tidak</p>

<?php endif ?>



					</td>

					<td>
					<a href="<?=base_url().'kartu_anggota/edit_kartu/'.$key->id_kartu ?>" title="" class="btn btn-default btn-medium "><i class="icon icon-pencil"></i></a>
					<a href="<?=base_url().'kartu_anggota/hapus/'.$key->id_kartu ?>" title=""

onClick="return confirm('Anda Yakin Untuk Menghapus data Masa Berlaku..'+'\n'+
				'<?=  $key->masa_berlaku  ?> Tahun...?')"
					 class="btn btn-defaunt btn-medium "><i class="icon icon-trash"></i></a>
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>














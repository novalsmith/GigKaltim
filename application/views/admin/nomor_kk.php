<h3 style="border-bottom:dashed 1px #AAB2BD">Nomor Kartu Keluarga 
<small>
<a href="<?=base_url().'nomor_kk/tambah_nomor_kk'  ?>" title="" class="btn btn-info pull-right">
<i class="icon icon-plus icon-white"></i> Nomor KK Baru</a>
</small>
</h3>







<table class="table table-hover table-responsive table-striped" id="tabel">

	<p><?=$keterangan?></p>

	<thead class="alert alert-info">
		<tr>
			<th>Nomor</th>
			<th>Nama Kategori</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>


    <?php echo $this->session->flashdata('message'); ?>


		<?php 

			if ($hslquery->num_rows()>0) {
			$no=1;
		?>

		<?php foreach ($hslquery->result() as $key){?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $key->namakategori ?></td>
			<td class="text-center"><a href="<?=base_url().'kategori/edit_data/'.$key->idkategori ?>"
				class="btn btn-sm btn-default">Edit</a>  

				<a href="<?=base_url().'kategori/hapus/'.$key->idkategori ?>"
				class="btn btn-sm btn-default" onClick="return confirm('Anda Yakin Untuk Menghapus Kategori..'+'\n'+
				'<?=  $key->namakategori  ?>..?')">
				Delete</a>

				</td>
		</tr>
		<?php
			$no++;
		 }
		 ?>
	 <?php

		} else
		{
	?>
		
		<p class="alert alert-danger">Maaf Data Kosong.</p>
			
	<?php
		}

		 ?>
	</tbody>

	</table>

</div>














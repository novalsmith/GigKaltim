<h3 style="border-bottom:dashed 1px #AAB2BD">Kategori Artikel 
<small>
<a href="<?=base_url().'category/tambah_category'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon icon-plus icon-white"></i> Kategori Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kategori Artikel</th>
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
					<td>
					<a href="<?=base_url().'category/edit_category/'.$key->idkategori ?>" title="" class="btn btn-default btn-medium "><i class="icon icon-pencil"></i></a>
					<a href="<?=base_url().'category/hapus/'.$key->idkategori ?>" title=""

onClick="return confirm('Anda Yakin Untuk Menghapus Nomor KK..'+'\n'+
				'<?=  $key->namakategori  ?>..?')"
					 class="btn btn-defaunt btn-medium "><i class="icon icon-trash"></i></a>
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>














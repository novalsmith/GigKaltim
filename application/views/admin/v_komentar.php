
<h3 style="border-bottom:dashed 1px #AAB2BD">Komentar Wisata 

</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Wisata Terkoment</th>
        	<th>Nama</th>

			<th>Email</th>
		
					
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($join->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td>
						<a href="<?=base_url().'tempatwisata/viewwisata/'.$key->idberita ?>" 
						title="<?=substr($key->isikomentar,0,250) ?>" data-placement="top" data-toggle="tooltip" class="tip">
						<?=$key->judulberita ?></a>
					</td>
					<td><?=$key->nama ?></td>

					<td><?=$key->email ?></td>
						
				


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">

						 <li><a href="<?=base_url().'komentar/balas_komentar/'.$key->idberita?>">
						 <i class="icon icon-edit"></i> Balas</a></li>

						 
						
						  <li><a href="<?=base_url().'komentar/hapus/'.$key->idkomentar_berita?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->judulberita  ?> Dari data Komentar..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






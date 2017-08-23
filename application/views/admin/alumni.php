<h3 style="border-bottom:dashed 1px #AAB2BD">Data Anggota Alumni Ikmasor
<small>
<a href="<?=base_url().'alumni/tambah_alumni'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Alumni Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Alumni Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>No Anggota</th>
			<th>Nama Lengkap</th>
			<th>Gelar</th>
			<th>Jurusan</th>
			<th>Alumni Kampus</th>
			<th>Lulus</th>
		<th>Cumlaude</th>

			
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

					<td><?=$key->nama_lengkap?></td>
					<td><?=$key->gelar ?></td>
					<td><?=$key->jurusan ?></td>
					
					<td><?=$key->kampus ?></td>
					<td><?=$key->tahun_lulus ?></td>
					<td>
						<?php if ($key->cumlaude == 'cumlaude'){ ?>
						
						<span class="label label-info">Cumlaude</span>	
						
						<?php }else{ ?>

					<span class="label label-default">Tidak</span>	


						<?php } ?>
					</td>

					


					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">

						  <li><a href="<?=base_url().'alumni/edit_alumni/'.$key->id_alumni?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'alumni/hapus/'.$key->id_alumni?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->nama_lengkap  ?> Dari Alumni IKMASOR..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






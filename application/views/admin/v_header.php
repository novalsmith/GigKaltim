<h3 style="border-bottom:dashed 1px #AAB2BD">Header Web
<small>
<a href="<?=base_url().'header/tambah_header'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Klik Untuk Menambah Foto Galery Baru" data-toggle="tooltip">
<i class="icon icon-plus icon-white"></i>Header Baru</a>
</small>
</h3>


<?=$this->session->flashdata('message');  ?>
	
<table class="table table-hover table-responsive table-striped" id="tabel">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori Header</th>
          
		    <th>Gambar</th>
		      <th>Status Header</th>
			
					
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php 
$no =1;
foreach ($join->result() as $key): ?>
		<tr>
					<td><?=$no++ ?></td>

					<td><?=$key->kategori ?></td>

		
						<td>
								<?php 
					$img = array(  
						            'title' =>  'Klik Disini Untuk Melihat Gambar dari '.$key->kategori,
						            'class' =>  'tip',
						            'data-placement' => 'top' 
						             
					 );
			 ?>


			 				<?php 
			 				echo	anchor('asset/upload/baner_web/'.$key->gambar,
			 					'<i class="icon-eye-open"></i> View', $img);
			 				 ?>
						</td>
					
									<td>
										<?php 

											if ($key->statusheader == 'aktif') {
												?>
										<span class="badge badge-success">Aktif</span>
												<?php
											}else{

												?>
										<span class="badge badge-default">Tidak</span>

												<?php
											}

										 ?>
									</td>



					<td>
					 <div class="btn-group">
						<button class="btn"><i class="icon icon-list"></i> Pilih</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="<?=base_url().'header/edit_header/'.$key->idheader?>"><i class="icon icon-edit"></i> Edit</a></li>
						  <li><a href="<?=base_url().'header/hapus/'.$key->idheader?>"
						  onClick="return confirm('Anda Yakin Untuk Menghapus '+'\n'+
				'<?=  $key->kategori  ?> Dari data Header..?')">
				<i class="icon icon-trash"></i> Hapus</a></li>
			
						</ul>
					  </div><!-- /btn-group -->
					</td>

		</tr>

<?php endforeach ?>
	
	</tbody>
	
</table>

</div>






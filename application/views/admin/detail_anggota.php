<h3 style="border-bottom:dashed 1px #AAB2BD">Detail Data Anggota
<small>
<a href="<?=base_url().'anggota'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<div class="span3">
	
</div>


<div class="span5 well" style="border:1px dashed #bbb;border-radius:10px;padding:10px;">
					<dl class="dl-horizontal">
						<dt>Nomor Anggota</dt>
						<dd><?=$detail->no_anggota  ?></dd>
						<dt>Nama Panggilan</dt>
						<dd><?=$detail->nama_panggilan  ?></dd>
						<dt>Nama Lengkap</dt>
						<dd><?=$detail->nama_lengkap  ?></dd>
						<dt>Kota Asal</dt>
						<dd><?=$detail->kota_asal  ?></dd>
						<dt>Alamat Kelurahan</dt>
						<dd><?=$detail->alamat_kelurahan  ?></dd>
						<dt>Email</dt>
						<dd><?=$detail->email  ?></dd>
						<dt>Telepon</dt>
						<dd><?=$detail->tlp  ?></dd>	
						<dt>Jurusan</dt>
						<dd><?=$detail->jurusan  ?></dd>
						<dt>Kampus</dt>
						<dd><?=$detail->kampus  ?></dd>
						<dt>Angkatan</dt>
						<dd><?=$detail->angkatan  ?></dd>
						<dt>Agama</dt>
						<dd><?=$detail->agama  ?></dd>
						<dt>Foto</dt>
						<dd><?=img('asset/upload/anggota/gambarkecil/'.$detail->gambar_kecil)  ?></dd>
						<dt>Status</dt>
						<dd><?php 
				
				if ($detail->status == 'aktif') {
					?>

					<p class="label label-info">Aktif</p>

					<?php

					}else{
						 ?>

				<p class="label label-default">Tidak</p>


					<?php }  ?>
						</dd>
						
					
					</dl>
        </div>
		
		<div class="span3">
	
</div>











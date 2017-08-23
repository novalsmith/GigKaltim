<?php 

if ($hasilpencarian->num_rows()>0) {
	?>

	 <strong class="pull-left" style="background-color:#f5f5f5; padding-left:5px; ">Ditemukan Hasil Pencarian..</strong>
<br>  


<?php 
foreach ($hasilpencarian->result() as $key) {
	?>

<h1><?=$key->judulberita ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->namakategori ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>





<?=img('asset/upload/berita/gambarbesar/'.$key->gambar_besar) ?>
<p><?=substr($key->isiberita, 0,300) ?>..<a href="<?=base_url().'tempatwisata/viewwisata/'.$key->idberita?>" class="btn btn-primary btn-small">
 Baca <i class="  icon-chevron-right icon-white"></i></a></p>



	<?php
}
 ?>


	<?php
}else
{
	echo '<h3>Maaf Data yang anda cari tidak ada silahkan cari dengan kata kunci lainnya.</h3>';
}
 ?>




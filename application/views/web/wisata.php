	 <strong class="" style="background-color:#f5f5f5; padding-left:5px; ">Tempat Wisata yang ada di Kaltim</strong>
<br>


<?php if ($wisata->num_rows() ==0) {
	?>
<h3>Maaf.. Untuk sementara Data ini belum ada isinya</h3>
	<?php
} ?>



<?php 
foreach ($wisata->result() as $key) {
	?>




<h1><?=$key->judulberita ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->namakategori ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>





<?=img('asset/upload/berita/gambarbesar/'.$key->gambar_besar) ?>
<p><?=substr($key->isiberita, 0,300) ?>..
<a href="<?=base_url().'tempatwisata/viewwisata/'.$key->idberita ?>"
 class="btn btn-primary btn-small">
 Baca <i class="  icon-chevron-right icon-white"></i></a></p>




	<?php
}
 ?>



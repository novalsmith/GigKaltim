	 <strong class="" style="background-color:#f5f5f5; padding-left:5px; ">Wisata yang ada di Kaltim</strong>
<br>





<?php 
foreach ($viewwisata->result() as $key) {
	?>




<h1><?=$key->judulberita ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->namakategori ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>





<?=img('asset/upload/berita/gambarbesar/'.$key->gambar_besar) ?>
<p><?=$key->isiberita?></p>




	<?php
}

?>

<?php $this->load->view('web/komentar'); ?>



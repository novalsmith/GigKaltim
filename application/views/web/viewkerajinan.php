	 <strong class="" style="background-color:#f5f5f5; padding-left:5px; ">Hotel yang ada di tempat wisata</strong>
<br>



<?php 
foreach ($detail_kerajinan->result() as $key) {
	?>


<h1><?=$key->nama_kerajinan ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->judulberita ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>



<?=img('asset/upload/kerajinan/gambarbesar/'.$key->gambar_besar_k) ?>
<p><?=$key->ket_kerajinan?></p>
<br><br>
<hr>



	<?php
}

?>




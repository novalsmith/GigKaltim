	 <strong class="" style="background-color:#f5f5f5; padding-left:5px; ">Hotel yang ada di tempat wisata</strong>
<br>



<?php 
foreach ($detail_hotel->result() as $key) {
	?>


<h1><?=$key->nama_hotel ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->judulberita ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>



<?=img('asset/upload/hotel/gambarbesar/'.$key->gambar_besar_hotel) ?>
<p><?=$key->keterangan_hotel?></p>
<br><br>
<hr>



	<?php
}

?>




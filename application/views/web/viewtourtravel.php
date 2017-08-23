	 <strong class="" style="background-color:#f5f5f5; padding-left:5px; ">Hotel yang ada di tempat wisata</strong>
<br>



<?php 
foreach ($detail_tourtravel->result() as $key) {
	?>


<h1><?=$key->nama_tour_travel ?></h1>


<ul class="nav nav-pills" >
	

<li><a href=""> <i class="icon-tag"></i> <?=$key->judulberita ?></a> </li>
<li><a href=""><i class="icon-time"></i> <?=$key->waktu ?></a> </li>

</ul>



<?=img('asset/upload/tour_travel/gambarbesar/'.$key->gambar_besar_tour) ?>
<p><?=$key->ket_tour_travel?></p>
<br><br>
<hr>



	<?php
}

?>




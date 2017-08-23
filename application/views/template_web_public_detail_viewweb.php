<?php $this->load->view('header_web_public'); ?>




<div class="container a">
	<div class="row">




<?php $this->load->view('menu_atas_web_public'); ?>


<br><br><br>

<div class="span12 well">

<div class="span2 ">
<?php
        $gambars = array( 'src' => 'asset/img/nauweb.gif',
                         'class' => 'img-rounded',
                         'width' => '140px;' );
        echo img($gambars);
 ?>
</div>

<div class="span10" style="margin:0px; padding:0px; color:#828282">


<?php 
    // header jika status tidak aktif dan aktif
    if ($header_view->statusheader == 'aktif') {
    	
    

$walp = array(		'src' => 'asset/upload/baner_web/'.$header_view->gambar,
					'class'	=>'' );
echo img($walp);
}else
{
	echo "<h2>Selamat Datang di Web SIG Kaltim</h2>";

}
	?>




</div>

<div class="span12" style="margin-left:0px; margin-top:5px; margin-bottom:0px; padding-bottom:0px">

<?php $this->load->view('bread_web_public'); ?>
</div>


<div>
<?=$map['js'] ?>

<?=$map['html'] ?>
	<div id="directionsDiv"></div>
</div>


<div class="span6" style="margin-left:0px;  margin-right:5px; margin-top:0px; padding-top:0px ">




<?php $this->load->view($content); ?>
</div>


<div class="span6" style="margin-left:0px">

<div class="span3" style="margin:0px; padding-left:15px">
	 <strong class="pull-right" style="background-color:#f5f5f5; padding-left:5px; ">Info Hotel</strong>
 <br> <br>

 <ul class="media-list">

<?php 

if ($hotel->num_rows()==0) {
echo '<div class="alert alert-info">Hotel Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($hotel->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/hotel/gambarbesar/'.$key->gambar_besar_hotel,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_hotel);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewhotel/'.$key->id_info_hotel?>"> 
									 <h4 class="media-heading"><?=$key->nama_hotel ?></h4> </a>
									 <p><?=substr($key->keterangan_hotel, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>



						</ul>
	<!--batas Hotel-->
 <strong class="pull-right" style="background-color:#f5f5f5; padding-left:5px; ">Info Transportasi</strong>
 <br> <br>

 <ul class="media-list">

<?php 

if ($transportasi->num_rows()==0) {
echo '<div class="alert alert-info">Transportasi Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($transportasi->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/transport/gambarbesar/'.$key->gambar_besar_t,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_transport);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewtransportasi/'.$key->id_transport?>"> 
									 <h4 class="media-heading"><?=$key->nama_transport ?></h4> </a>
									 <p><?=substr($key->ket_transport, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>



						</ul>
	<!--batas trasportasi-->

<strong class="pull-right" style="background-color:#f5f5f5; padding-left:5px; ">Info Tour Travel</strong>
 <br> <br>

 <ul class="media-list">

<?php 

if ($tour_travel->num_rows()==0) {
echo '<div class="alert alert-info">Tour Travel Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($tour_travel->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/tour_travel/gambarbesar/'.$key->gambar_besar_tour,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_tour_travel);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewtourtravel/'.$key->id_tour_travel?>"> 
									 <h4 class="media-heading"><?=$key->nama_tour_travel ?></h4> </a>
									 <p><?=substr($key->ket_tour_travel, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>



						</ul>
	<!--batas trasportasi-->

</div>
<div class="span3" style="margin:0px; padding-left:15px; ">
	<strong class="pull-right" style="background-color:#f5f5f5;  ">Info Rumah Sakit</strong>
<br><br>
 <ul class="media-list">

<?php 

if ($rumah_sakit->num_rows()==0) {
echo '<div class="alert alert-info">Rumah sakit Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($rumah_sakit->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/rumah_sakit/gambarbesar/'.$key->gambar_besar_rs,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_rs);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewrumahsakit/'.$key->id_rumah_sakit?>"> 
									 <h4 class="media-heading"><?=$key->nama_rs ?></h4> </a>
									 <p><?=substr($key->ket_rs, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>

	</ul>



	<strong class="pull-right" style="background-color:#f5f5f5;  ">Info Money Changger</strong>
<br><br>
 <ul class="media-list">

<?php 

if ($money_ch->num_rows()==0) {
echo '<div class="alert alert-info">Money Changger Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($money_ch->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/money/gambarbesar/'.$key->gambar_besar_money,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_money);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewmoney/'.$key->id_money?>"> 
									 <h4 class="media-heading"><?=$key->nama_money ?></h4> </a>
									 <p><?=substr($key->ket_money, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>




						</ul>


<strong class="pull-right" style="background-color:#f5f5f5;  ">Info Kerajinan Khas Kaltim</strong>
<br><br>
 <ul class="media-list">

<?php 

if ($info_kerajinan->num_rows()==0) {
echo '<div class="alert alert-info">Kerajinan Khas Kaltim Untuk Tempat wisata ini tidak ada</div>';
}else{

foreach ($info_kerajinan->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/kerajinan/gambarbesar/'.$key->gambar_besar_k,
													'class' => 'img-polaroid ',
													'width' => '100',
													'title' => $key->nama_kerajinan);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewkerajinan/'.$key->id_kerajinan?>"> 
									 <h4 class="media-heading"><?=$key->nama_kerajinan ?></h4> </a>
									 <p><?=substr($key->ket_kerajinan, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
}
 ?>




						</ul>






</div>


<!--batas untuk galery gambar bersangkutan-->
<div class="span6">
	<strong class="span6" style="background-color:#f5f5f5; margin:0px">Galery Foto</strong>
<br><br>
<ul class="media-list">
<?php 



if ($galery->num_rows()==0) {
echo '<div class="alert alert-info">Data galery foto sementara belum ada</div>';
}else{

foreach ($galery->result() as $key){ ?>
	<?php 
	$gambar = array('src' => 'asset/upload/galery/gambarbesar/'.$key->gambar_besar_gal,
					
					'class' => 'img-polaroid span2',
					'title'	=> $key->judul );


	 ?>


	<li class="galeri" style="margin-left:0px;"><?php 	echo img($gambar); ?></li>


<?php }
}
?>
</ul>

</div>
<!--batas untuk galery gambar bersangkutan-->









</div>


<!--Batas postingan berita wisata-->



</div>
<!--batas postingan berita wisata-->
<div class="span12">
	
<div class="span6" style="margin-left:0px">

<div class="span3" style="margin:0px; padding-left:15px">
	 <strong class="pull-right" style="background-color:#f5f5f5; padding-left:5px; ">Postingan Terdahulu</strong>
 <br> <br>

 <ul class="media-list">

<?php 
foreach ($terlama_7->result() as $key) {
?>


								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/berita/gambarbesar/'.$key->gambar_besar,
													'class' => 'img-polaroid ',
													'width' => '70',
													'title' => $key->judulberita);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewwisata/'.$key->idberita?>">  <h4 class="media-heading"><?=$key->judulberita ?></h4> </a>
									 <p><?=substr($key->isiberita, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
 ?>



						</ul>



</div>
<div class="span3" style="margin:0px; padding-left:15px; ">
	<strong class="pull-right" style="background-color:#f5f5f5;  ">Postingan Terpopular</strong>
<br><br>
 <ul class="media-list">

<?php 
foreach ($popular_7->result() as $key) {
?>



								  <li class="media galeri">
									<a class="pull-right" href="#">
									<?php 
									$gambar = array('src' => 'asset/upload/berita/gambarbesar/'.$key->gambar_besar,
													'class' => 'img-polaroid ',
													'width' => '70',
													'title' => $key->judulberita);
									 ?>
									 <?=img($gambar)  ?>
									</a>
									<div class="media-body">
									<a href="<?=base_url().'tempatwisata/viewwisata/'.$key->idberita?>">  <h4 class="media-heading"><?=$key->judulberita ?></h4> </a>
									 <p><?=substr($key->isiberita, 0,50) ?>..</p>
									  <!-- Nested media object -->
						</div>
						</li>

<?php
}
 ?>



						</ul>

</div>









</div>




<div class="span6">
	
<div class="span6" style="margin-left:10px">
	<?php 
    // header jika status tidak aktif dan aktif
    if ($iklan_view->statusheader == 'aktif') {
    	
    

$walp = array(		'src' => 'asset/upload/baner_web/'.$iklan_view->gambar,
					'class'	=>'' );
echo img($walp);
}else
{
	echo "<h2>Visit Wisata Kaltim</h2>";

}
	?>

</div>

<div class="span6 " style="margin-top:10px; margin-left:0px	">

<strong class="span6" style="background-color:#f5f5f5; margin:0px">Galery Foto</strong>
<br>
<ul class="media-list">
<?php foreach ($galeri->result() as $key){ ?>
	<?php 
	$gambar = array('src' => 'asset/upload/galery/gambarbesar/'.$key->gambar_besar_gal,
					
					'class' => 'img-polaroid span2',
					'title'	=> $key->judul );


	 ?>


	<li class="galeri" style="margin-left:0px;"><?php 	echo img($gambar); ?></li>


<?php }?>
</ul>

</div>


</div>


</div>

	</div>
</div>

<?php $this->load->view('footer_web_public'); ?>
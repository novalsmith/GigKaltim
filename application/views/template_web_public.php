<?php $this->load->view('header_web_public'); ?>




<div class="container  content">
	<div class="row">




<?php $this->load->view('menu_atas_web_public'); ?>


<br><br><br>

<div class="span12 well" >

<div class="span2 ">
<?php
        $gambars = array( 'src' => 'asset/img/nauweb.gif',
                         'class' => 'img-rounded',
                         'width' => '100px;' );
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

<div class="span12" style="margin-left:0px; margin-top:10px; margin-bottom:0px; padding-bottom:0px">

<?php $this->load->view('bread_web_public'); ?>
</div>

<div class="span6" style="margin-left:0px;  margin-right:5px; margin-top:0px; padding-top:0px ">


<?php $this->load->view($content); ?>
</div>


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
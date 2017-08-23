<?=$this->session->flashdata('pesan_login');  ?>


<div class="span4">
	                <div class="page-header">
						<h3>Informasi Wisata</h3>
				<small>Informasi Wisata ini menyakut semua fasilitas dan informasi tentang tempat wisata tersebut yang ada di Kaltim</small>

					</div>


<ul class="nav nav-tabs nav-stacked">
		 <li 
		 class="tip" 
		 title="Total Jumlah Keseluruhan Hotel yang ada di tempat wisata" 
		 data-placement="top"
		  data-toggle="tooltip">
		  <a href="#">Hotel Yang ada di Tempat Wisata 
		  <span class="badge badge-success pull-right">
		 <?=$hotel ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Transportasi yang ada di tempat wisata" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Transportasi  
		<span class="badge badge-success pull-right">
		<?=$trans ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Tour Travel secara keseluruhan" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Tour Travel  
		<span class="badge badge-success pull-right">
		<?=$tour ?></span></a></li>




	 <li 
		 class="tip" 
		 title="Total Jumlah data Money changger secara keseluruhan dari masing-masing tempat wisata" 
		 data-placement="top"
		  data-toggle="tooltip">
		  <a href="#">Money Changger
		  <span class="badge badge-success pull-right">
		 <?=$money ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Rumah Sakit Secara Keseluruhan yang ada di Masing-Masing Tempat Wisata" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Rumah Sakit  
		<span class="badge badge-success pull-right">
		<?=$rs ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Kerajinan Khas Kaltim secara keseluruhan yang ada di masing-masing tempat wisata" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Kerajinan Khas Kaltim  
		<span class="badge badge-success pull-right">
		<?=$kerajinan ?></span></a></li>



	</ul>
 

</div>
<div class="span3">
	<div class="page-header">
						<h3>Artikel Wisata </h3>
						<small>Artikel wisata ini mencatat tentang pengaturan tempat wisata yang ada di Kaltim</small>
					</div>


<ul class="nav nav-tabs nav-stacked">
		 <li 
		 class="tip" 
		 title="Total Jumlah Keseluruhan Tempat Wisata yang ada di Kaltim yang masuk pada Aplikasi SIG ini" 
		 data-placement="top"
		  data-toggle="tooltip">
		  <a href="#">Tempat Wisata 
		  <span class="badge badge-info pull-right">
		 <?=$tempatwisata ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Kategori Wisata yang Sementara Berada di Kaltim" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Kategori  
		<span class="badge badge-info pull-right">
		<?=$kategori ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Kategori Wisata yang Sementara Berada di Kaltim" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Komentar  
		<span class="badge badge-info pull-right">
		<?=$komentar ?></span></a></li>

	</ul>
 
<ul class="nav nav-tabs nav-stacked">
		 <li 
		 class="tip" 
		 title="Total Jumlah Artikel Tempat wisata yang di Publish atau di tampilkan Pada Website" 
		 data-placement="top"
		  data-toggle="tooltip">
		  <a href="#">Publish
		  <span class="badge badge-info pull-right">
		 <?=$publish ?></span></a></li>

		<li
class="tip" 
		 title="Total Jumlah Artikel Tempat Wisata Yang di pending untuk di tampilkan" 
		 data-placement="right"
		  data-toggle="tooltip">
		  <a href="#">Pending  
		<span class="badge badge-info pull-right">
		<?=$pending ?></span></a></li>


	</ul>



</div>

<div class="span4">
	<div class="page-header">
						<h3>Galery</h3>
	<small>Galery ini berfungsi untuk memberikan informasi tempat wisata dengan dukungan gambar atau foto-foto</small>

					</div>

	<ul class="nav nav-tabs nav-stacked">
			<li
class="tip" 
		 title="Total Jumlah data Galery yang ada di database" 
		 data-placement="top"
		  data-toggle="tooltip">
		  <a href="#">Galery
		<span class="badge badge-warning pull-right">
		<?=$galery ?></span></a></li>


</ul>				
</div>



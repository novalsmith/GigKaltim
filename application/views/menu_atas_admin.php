
				        <div class="span12">
					
					    <div class="navbar navbar-fixed-top">
					    <div class="navbar-inner">
						<div class="container">
						  <!-- Menampilkan tombol trigger -->
						  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						
						  </a>
						  <!-- Akhir dari tombol triger -->
						
						   <!-- Komponen navbar -->
						 
						  <a class="brand" href="<?=base_url().'home' ?>"><?=$brand ?></a>
						
						  <div class="nav-collapse collapse navbar-responsive-collapse">
						  <ul class="nav">
						  <li class="active"><a href="<?=base_url().'home' ?>">Home</a></li>

	  						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-map-marker"></i> Artikel Wisata<b class="caret"></b></a>
							<ul class="dropdown-menu">
								
 									  <li><?=anchor(base_url().'berita', 'Tempat Wisata'); ?></li>
							  <li><?=anchor(base_url().'category', 'Kategori Wisata'); ?></li>
							  <li><?=anchor(base_url().'komentar', 'Comment'); ?></li>						
							
							</ul>
							</li>

							  <li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-bullhorn"></i> Informasi<b class="caret"></b></a>
							  <ul class="dropdown-menu">
							  <li><?=anchor(base_url().'hotel', 'Hotel'); ?></li>
							  <li><?=anchor(base_url().'transportasi', 'Transportasi'); ?></li>
							  <li><?=anchor(base_url().'tour_travel', 'Tour Travel'); ?></li>
							  <li><?=anchor(base_url().'rumah_sakit', 'Rumah Sakit'); ?></li>
							  <li><?=anchor(base_url().'money', 'Money Changger'); ?></li>
							  <li><?=anchor(base_url().'kerajinan', 'Kerajinan Kaltim'); ?></li>
			
 									
				
							
							</ul>
							</li>

					        <li> 
                            <a href=<?=base_url()."galery";  ?> title="">
                            <i class="icon-picture"></i> Galery</a>
					      
                           </li>


					        <li> 
                            <a href=<?=base_url()."header";  ?> title="">
                            <i class="icon-th-large"></i> Header</a>
					      
                      	<?php 

			$edit = $this->db->get('profil');

		 ?>
<?php foreach ($edit->result() as $key): ?>

	<li><a href="<?=base_url().'profil/index/'.$key->idprofil ?>" title=""><i class="  icon-asterisk"></i> Profil</a></li>
	

<?php endforeach ?>

							 
							
							</ul>
							
							<ul class="nav pull-right">

							   <li><a href="#">  
<i class="icon icon-time"></i>
							     <?= 'Hari'.
              '&nbsp;'.
              namahari($nohari).
              ',&nbsp;'.
              $tgl.
              '&nbsp;'.
              namabulan($bln).
              '&nbsp;'.
              $thn; 
               ?></a></li>




							  <li class="divider-vertical"></li>
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-user"></i>
								<?=$this->session->userdata('nama_lengkap'); ?>
								 <b class="caret"></b></a>
								<ul class="dropdown-menu">
		<?php 

			$edit = $this->db->get('admin');

		 ?>
<?php foreach ($edit->result() as $key): ?>

	<li><a href="<?=base_url().'admin/index/'.$key->idadmin ?>" title=""><i class=" icon-user"></i> Edit Akun</a></li>
	

<?php endforeach ?>



								  <li><a href="<?=base_url(); ?>">Lihat WEB</a></li>
								  <li class="divider"></li>
								  <li><a href="<?=base_url().'login/logout'?>">
								  <i class="icon icon-off"></i> Logout</a></li>
								</ul>
							  </li>
							</ul>
						  </div><!-- /.nav-collapse -->
						</div>
					  </div><!-- /navbar-inner -->
					</div><!-- /navbar -->
					
						  
				</div>

				  	  
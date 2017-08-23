
				<div class="span12" >
					
					<div class="navbar navbar-fixed-top" >
					  <div class="navbar-inner">
						<div class="container">
						  <!-- Menampilkan tombol trigger -->
						  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </a><!-- Akhir dari tombol triger -->
						  <!-- Komponen navbar -->
						  <a class="brand" href="#"><?=$brand ?></a>
						  <div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">

						
							</ul>
						
							<ul class="nav pull-right">
							  <li class=""><a href="<?=base_url().'tempatwisata/index' ?>"> <p class="icon-home"></p>  Home</a></li>
							  <li><a href="<?=base_url().'tempatwisata/profil' ?>">Profil</a></li>
						
							  <li class="divider-vertical"></li>
							
							  		<form class="navbar-search pull-left" action="<?=base_url().'tempatwisata/hasilpencarian' ?>" method="post">
							  <input type="text" name="search" class="span3" required placeholder="Search" style="margin-bottom:0px; padding-bottom:0px; height:25px">
							 
							 <button type="submit" name="kirim" class="btn btn-small btn-inverse"
							  value="Search" style="margin-bottom:2px; height:25px"> <p class="icon-search icon-white"></p> Search</button>

							
							</form>
							</ul>

						  </div><!-- /.nav-collapse -->
						</div>
					  </div><!-- /navbar-inner -->
					</div><!-- /navbar -->
					
						  
				</div>

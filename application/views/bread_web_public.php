
		
<ul class="nav nav-pills" style="background-color:#f5f5f5; padding-left:5px; ">
			
<?php foreach ($posisi->result() as $key){ ?>
	

								  <li><a href="<?=base_url().'tempatwisata/wisata/'.$key->idkategori ?>"><?=$key->namakategori ?></a> </li>
					 
  <?php } ?>

					</ul>



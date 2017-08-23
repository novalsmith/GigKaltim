
			<ul class="breadcrumb" style="margin-bottom: 5px;>
			   <?php
          foreach ($posisi as $key=>$value) {
            if($value!=''){
          ?>
					<!-- membuat bread  memberikan warna pada class -->
					  <li >

					  <a href="<?=$value; ?>" style="color:green">

					   <?=$key; ?>

					   </a>

					    <span class="divider"><b>&raquo;</b></span>

					    </li>
					 

					  <?php }else{?>
              <li class="active"><?=$key; ?></li>

					          

					          <?php }
          }
          ?>   
					</ul>



<div class="container" style="height:35px; background-color:#1e2021;  border-radius:5px">
	<div class="row ">

 	<div class="copy">
							<h5 style="padding-left:50px; color:white">Skripsi SIG KALTIM<small> Copyright 	 &copy; <?=date('Y') ?></small><small class="pull-right" style="padding:5px">
							<?=anchor(base_url().'login', 'login', 'class="text text-success"'); ?></small></h5>
						</div>
						<div class="divider"></div>
</div>
</div>

 	  <script src="<?=base_url() ?>asset/js/jquery.js"></script>
 
      <!-- Bootstrap javascript -->
      <script src="<?=base_url() ?>asset/js/bootstrap.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.galeri img').click(function(){
				$('.zoom').remove();
				var src=$(this).attr('src');
				var title=$(this).attr('title');
				$('<div class="zoom tip"><img src='+src+'><p>'+title+'</p><span class="close" title="tutup">X</span></div>').appendTo('body').hide().fadeIn('slow');
				$('.close').click(function(){
					$('.zoom').fadeOut('slow');
				});
			});			
		});
	</script>

<script type="text/javascript">
			$(document).ready(function () {
				$(".tip").tooltip();
			});
		</script>
	 
</body>
</html>

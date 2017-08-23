<?php $this->load->view('header'); ?>



<style type="text/css" media="screen">
	body
	{
		
		background-image: url(<?=base_url().'asset/img/aa.jpg' ?>);
		background-repeat:no-repeat;
		background-attachment:fixed;
	}
	#user
	{
		height: 30px;
	}
	.a
	{
		background-color: white;
		border: 1px dashed #AAB2BD;
		box-shadow:2px 10px 5px #000;
	}
</style>

<div class="container well a">
	<div class="row">




<?php $this->load->view('menu_atas_admin'); ?>


<br><br>

<div class="span12">


<?php $this->load->view('bread'); ?>


<?php $this->load->view($content); ?>


</div>



	</div>
</div>

<?php $this->load->view('footer'); ?>
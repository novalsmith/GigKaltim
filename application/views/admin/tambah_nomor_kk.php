<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Nomor Kartu Keluarga 
<small>
<a href="<?=base_url().'nomor_kk'  ?>" title="" class="btn btn-info pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>




<div class="span4">
	
	<?=$this->session->flashdata('message');  ?>



<?php echo form_open(base_url().'nomor_kk/proses_tambah','method="post"'); ?>




<?php

$nomor = array(
			'name' 		=> 'nomor_kk',
			'class'		=> 'span4',
		
			'placeholder' => ' Masukan Nomor KK Penduduk',
			'required'  => 'masukan');

echo form_label('Nomor KK Penduduk');
echo form_input($nomor);
 echo form_error('nomor_kk', '<p class="text-error">', '</p>');
 ?>




<?php

echo form_submit('simpan','Simpan Data','class="btn btn-primary"');
 ?>
<?php echo form_close()?>


</div>













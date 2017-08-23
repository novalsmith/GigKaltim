<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Nomor Kartu Keluarga 
<small>
<a href="<?=base_url().'nomor_kk'  ?>" title="" class="btn btn-primary pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>




<div class="span4">
	
	<?=$this->session->flashdata('pesan_login');  ?>



<?php echo form_open(base_url().'nomor_kk/proses_edit_nomor_kk','method="post"'); ?>


  <?php if (! empty($pesan)) : ?>
        <p class="text text-error">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>


<?php

$nomor = array(
			'name' 		=> 'no',
			'class'		=> 'span4',
			'id'		=>	'user',
			'placeholder' => ' Masukan Nomor KK Penduduk',
			'required'  => 'masukan',
			'value'		=>	$tampil->nomor_kk);

echo form_label('Nomor KK Penduduk');
echo form_input($nomor);
echo form_hidden('id', $tampil->id_nomor_kk);
 echo form_error('nomor_kk', '<p class="text-error">', '</p>');
 ?>




<?php

echo form_submit('edit','Edit Data','class="btn btn-primary"');
 ?>
<?php echo form_close()?>


</div>













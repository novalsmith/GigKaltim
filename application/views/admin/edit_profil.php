<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Profil
<small>
<a href="<?=base_url().'category'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>




<div class="span12">
	<div class="span6">

	<?=$this->session->flashdata('message');  ?>
</div>


<?php echo form_open(base_url().'profil/proses_update_profil','method="post"'); ?>

<div class="span6 " style="font-weight: bold;">
	

<?php



echo form_label('Isi Profil Foto ');
echo form_textarea('isi_profil',$edit->isi_profil);
 echo form_error('isi_profil', '<p class="text-error">', '</p>');
 echo form_hidden('idprofil', $edit->idprofil);
 ?>


	<?php
echo br();
echo form_submit('edit','Edit Data','class="btn btn-primary"');
 ?>
</div>

<div class="span5">
	
                <div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <h4><i class='icon  icon-asterisk'></i> Data Profil</h4>

      <p>
    
      <?= $edit->isi_profil;    ?>
    
      </p>
    
    </div>
</div>


<?php echo form_close()?>


</div>













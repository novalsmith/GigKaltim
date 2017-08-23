<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Nomor Kartu Keluarga 
<small>
<a href="<?=base_url().'category'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>




<div class="span4">
	
	<?=$this->session->flashdata('message');  ?>



<?php echo form_open(base_url().'category/proses_edit_category','method="post"'); ?>


  <?php if (! empty($pesan)) : ?>
        <p class="text text-error">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>


<?php

$category = array(
			'name' 		=> 'category',
			'class'		=> 'span4',
			'id'		=>	'user',
			'placeholder' => ' Masukan Kategori Artikel',
			'required'  => 'masukan',
			'value'		=>	$tampil->namakategori);

echo form_label('Kategori Artikel Berita');
echo form_input($category);
echo form_hidden('id', $tampil->idkategori);
 echo form_error('category', '<p class="text-error">', '</p>');
 ?>




<?php

echo form_submit('edit','Edit Data','class="btn btn-primary"');
 ?>
<?php echo form_close()?>


</div>













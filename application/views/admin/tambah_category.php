<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Kategori Berita
<small>
<a href="<?=base_url().'category'  ?>" title="" class="btn btn-primary btn-small pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>




<div class="span4">
	
	<?=$this->session->flashdata('message');  ?>



<?php echo form_open(base_url().'category/proses_tambah','method="post"'); ?>




<?php

$nomor = array(
			'name' 		=> 'category',
			'class'		=> 'span4',
		
			'placeholder' => ' Masukan Kategori Artikel',
			'required'  => 'masukan');

echo form_label('Kategori Artikel Berita');
echo form_input($nomor);


 echo form_error('category', '<p class="text-error">', '</p>');
 ?>




<?php

echo form_submit('simpan','Simpan Data','class="btn btn-primary"');
 ?>
<?php echo form_close()?>


</div>













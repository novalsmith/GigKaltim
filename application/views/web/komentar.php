<?php 

$this->db->where('idberita', $this->uri->segment(3));
$jumlah =  $this->db->get('komentar_berita')->num_rows();  ?> 

<h4 style="border-bottom:1px dashed black">Beri Komentar 
<span class="badge badge-info pull-right tip" data-placement="top" data-toggle="tooltip" title="Jumlah Komentar yang ada di halaman ini " ><?=$jumlah ?></span></h4>



<div class="span6">
	
<?php if ($tampil_komentar->num_rows() ==0): ?>
	<blockquote>
		<p class="text text-info">Berita Ini Belum Terkomentari</p>
	</blockquote>

<?php else: ?>



<?php foreach ($tampil_komentar->result() as $value): ?>


                                  <p><?=$value->isikomentar  ?></p>

           <ul class="nav nav-pills " style="margin:0px; padding:0px">
					  <li><a href="#"><i class="icon-calendar"></i> <?=$value->waktu  ?></a></li>
                <li><a href="#"> <i class="icon-user"></i> <?=$value->nama  ?></a></li>
                <li><a href="#"> <i class="icon-envelope"></i> <?=$value->email  ?></a></li>
					</ul>		

<br>

            <?php  endforeach; ?>
       


 <?php endif ?>
</div>








<div class="span4" style="margin:0px">



	<?=$this->session->flashdata('message');  ?>



<?php echo form_open(base_url().'tempatwisata/simpan_komentar','method="post"'); ?>




<?php

$nama = array(
			'name' 		=> 'nama',
			'class'		=> 'span4 tip',
		'data-toggle'   => "tooltip", 
'data-placement'        =>"top",
'title'                 => 'silahkan memasukan nama anda', 
			'placeholder' => ' Masukan Nama Anda',
			'required'  => 'masukan');

echo form_label('Nama');
echo form_input($nama);

 echo form_error('nama', '<p class="text-error">', '</p>');
 ?>




<?php

$email = array(
			'name' 		=> 'email',
			'class'		=> 'span4 tip',
		'data-toggle'   => "tooltip", 
'data-placement'        =>"top",
'title'                 => 'silahkan memasukan email anda', 
			'placeholder' => ' Masukan Email Anda',
			'required'  => 'masukan');

echo form_label('Email');
echo form_input($email);

 echo form_error('email', '<p class="text-error">', '</p>');
 ?>



<?php

$komentar = array(
			'name' 		=> 'komentar',
			'class'		=> 'span4 tip',
		'data-toggle'   => "tooltip", 
'data-placement'        =>"top",
'title'                 => 'silahkan memasukan komentar anda', 
			'placeholder' => ' Masukan Komentar Anda',
			'required'  => 'masukan');

echo form_label('Komentar');
echo form_textarea($komentar);
echo form_hidden('idberita',$this->uri->segment(3));
 echo form_error('komentar', '<p class="text-error">', '</p>');
 ?>




<?php

echo form_submit('simpan','Kirim','class="btn btn-primary"');
 ?>
<?php echo form_close()?>


</div>













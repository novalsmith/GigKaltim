<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Transportasi 
<small>
<a href="<?=base_url().'transportasi'  ?>"  class="btn btn-primary btn-small pull-right tip"
data-placement="top" title="Kembali Untuk Melihat Daftar Hotel" data-toggle="tooltip">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>


	
   <?php 

	

            $data = array(
              'name'    =>  'tambah',
              'class'   =>  'form-signin',
              'method'  =>  'POST',
              'enctype' =>  'multipart/form-data'

              ); 

            echo   form_open('transportasi/proses_update_transportasi', $data);
            ?>





<?php echo $this->session->flashdata('message');   ?>



<div class="span4 " style="font-weight: bold;">



    <?=form_label('Tempat Wisata'); ?>
<select name="judulberita" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="top" 
title="Pilih Tempat Wisata yang memiliki informasi Hotel ini">

<option value="">--Pilih Tempat Wisata--</option>

  <?php 

            if (!empty($berita)) {
              ?>



                <?php 

                    foreach ($berita->result() as $key) {
                      ?>


                  <option 


                  <?php if ($key->idberita == $edit->idberita){ ?>
                    selected="selected"
                  <?php }?>


                  value="<?=$key->idberita  ?>"><?=$key->judulberita ?></option>
              
                      

                      <?php
                    }
                 ?>




<?php
    } 

    else
    {
      ?>
         <option value="">--Maaf Tempat Wisata Kosong--</option>
    <?php
    }
           echo form_error('idberita', '<p class="text-danger">', '</p>');

  ?>


</select>





<?php

$nama_transportasi = array(
			'name' 		=> 'nama_transportasi',
			'class'		=> 'span4 tip',
		
		      'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Nama transportasi yang ada di tempat wisata',
			'placeholder' => ' Masukan Nama Transportasi',
      'value'       =>  $edit->nama_transport,
			'required'  => 'masukan');

echo form_label('Nama Transportasi');
echo form_input($nama_transportasi);
 echo form_error('nama_transportasi', '<p class="text-error">', '</p>');
 ?>

<?php

$latitude = array(
            'name'    => 'latitude',
            'class'   => 'span4 tip',
    
       'data-toggle'  =>  'tooltip',
    'data-placement'  =>  'right',
      'title'         =>  'Silahkan Memasukan Latitude Kordinat - X Transportasi wisata',
        'placeholder' => ' Masukan Latitude',
        'value'       =>  $edit->lat_transport,
          'required'  => 'masukan');
          
echo form_label('Latitude -X');
echo form_input($latitude);
 echo form_error('latitude', '<p class="text-error">', '</p>');
 ?>
<?php

$longitude = array(
                'name'    => 'longitude',
                'class'   => 'span4 tip',
    
          'data-toggle'   =>  'tooltip',
        'data-placement'  =>  'right',
              'title'     =>  'Silahkan Memasukan Latitude Kordinat - Y Transportasi wisata',
            'placeholder' => ' Masukan Longitude',
            'value'       =>  $edit->long_transport,
              'required'  => 'masukan');

echo form_label('Longitude -Y');
echo form_input($longitude);
 echo form_error('longitude', '<p class="text-error">', '</p>');
 ?>



<?php 
         $gambar    = array(
              'name'          => 'imagefile',
              'class'         =>  'form-control span4 tip',
                 'type'       =>  'file',
              'data-toggle'   =>  'tooltip',
            'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memilih Sala-satu Gambar transportasi'
             );
            echo form_label('Masukan Gambar');
            echo form_input($gambar);

            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
    
                     echo form_hidden('id_transportasi',$edit->id_transport);
            echo img('asset/upload/transport/gambarkecil/'.$edit->gambar_kecil_t);
              echo form_hidden('g_besar', $edit->gambar_besar_t);
              echo form_hidden('g_kecil', $edit->gambar_kecil_t);
            echo form_error('imagefile', '<p class="text-error">', '</p>');
echo br().br();
          ?>



           <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>




<div class="span6 " style="font-weight: bold;">
	

<?php



echo form_label('Keterangan Transportasi ');
echo form_textarea('ket_transportasi',$edit->ket_transport);
 echo form_error('ket_transportasi', '<p class="text-error">', '</p>');
 ?>



</div>







<?=form_close() ?>











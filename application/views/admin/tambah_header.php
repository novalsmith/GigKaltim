<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Foto Galery Baru
<small>
<a href="<?=base_url().'galery'  ?>"  class="btn btn-primary btn-small pull-right tip"
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

            echo   form_open('header/proses_tambah_header', $data);
            ?>





<?php echo $this->session->flashdata('message');   ?>



<div class="span4" style="font-weight: bold;">



    <?=form_label('Kategori Header'); ?>
<select name="kategori" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="top" 
title="Pilih  Kategori Header">

<option value="">--Pilih Kategori Header--</option>
 <option value="iklan">Iklan</option>
 <option value="header">Header</option>

</select>


    <?=form_label('Status Header'); ?>
<select name="statusheader" class="form-control span4 tip"
required
data-toggle="tooltip" 
data-placement="top" 
title="Pilih  Status Header">

<option value="">--Pilih Status Header--</option>
 <option value="aktif">Aktif</option>
 <option value="tidak">Tidak</option>

</select>




<?php 
         $gambar    = array(
              'name'          => 'imagefile',
              'class'         =>  'form-control span4 tip',
               'type'       =>  'file',
              'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memilih Sala-satu Gambar',
              'required'      =>  'Masukan'
             );
            echo form_label('Masukan Gambar');
            echo form_input($gambar);

            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
            echo form_hidden('idheader');

            echo form_error('imagefile', '<p class="text-error">', '</p>');
echo br().br();
          ?>



           <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>





<?=form_close() ?>











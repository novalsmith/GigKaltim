<h3 style="border-bottom:dashed 1px #AAB2BD">Tambah Kartu Anggota
<small>
<a href="<?=base_url().'kartu_anggota'  ?>" title="" class="btn btn-primary btn-small btn pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<div class="span4">
  
    <?php 

 echo $this->session->flashdata('message');  

            $data = array(
              'name'    =>  'tambah',
              'class'   =>  'form-signin',
              'method'  =>  'POST',
              'enctype' =>  'multipart/form-data'

              ); 

            echo   form_open('kartu_anggota/proses_edit', $data);
            ?>

   


    <!-- pesan start -->
    <?php if (! empty($pesan)) : ?>
        <p class="text-danger">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>
    <!-- pesan end -->




         <?php 
         $masa_berlaku    = array(
              'name'          => 'masa_berlaku' ,
              'class'         =>  'form-control span3 tip',
              'type'          =>  'text',
              'data-toggle'   =>  'tooltip',
              'value'         =>  $edit->masa_berlaku,
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Menentukan Tahun Masa Berlaku Kartu Anggota dengan memasukan bilangan bulat saja: * angka 1',
             'placeholder'    => 'Contoh : 1',
              'required'      =>  'Masukan'
             );
         	
          echo form_label('Masukan Masa Berlaku Kartu Anggota');
          echo form_input($masa_berlaku);

           echo form_label('<p class="text-error">'.' * 1 Thn : Masukan Angka 1, Begitupun seterusnya '.'</p>');

          echo form_hidden('waktu_upload', namahari($nohari).',&nbsp;'.$tgl.'&nbsp;'.namabulan($bln).'&nbsp;'.$thn);


           echo form_error('judulberita', '<p class="text-error">', '</p>');

          ?>

<?php 
         $gambar    = array(
              'name'          => 'imagefile',
              'class'         =>  'form-control span3 tip',
               'type'       =>  'file',
             
              'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memilih Sala-satu Gambar Untuk Walpaper Kartu Anggota'
             );
            echo form_label('Masukan Gambar Walpaper Kartu');

            echo form_input($gambar);
?>
<?php

          $img = array('src' => 'asset/upload/kartu_anggota/gambarbesar/'.$edit->walpaper,
                  'class' => 'span2' );

          echo  img($img);

            echo form_hidden('walpaper_db',$edit->walpaper);
            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
            echo form_hidden('id_kartu',$edit->id_kartu);
            echo form_error('imagefile', '<p class="text-error">', '</p>');

          ?>
      <br><br><br><br><br><br><br>      
 <?=form_label('<p class="text-error">Status Kartu Anggota</p>'); ?>
<select name="status" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Status Kartu Anggota">

  <option value="">--Pilih Status Kartu Anggota--</option>

<?php if ($edit->status=='aktif'): ?>
  <option value="aktif" selected="selected">aktif</option>
    <option value="tidak">tidak</option>
<?php else: ?>
  <option value="tidak" selected="selected">tidak</option>
    <option value="aktif">aktif</option>
<?php endif ?>




</select>
<?=             form_label('<p class="text-error">'.'Jika Status aktif, Maka Kartu Anggota tersebut yang di Gunakan'.'</p>');  ?>
              <?php 
         
echo br();

         $submit   = array(
              'name'    => 'login' ,
              'class'   =>  'btn btn-md btn-primary',
              'value'   =>  'Simpan',
              'type'    =>  'submit'         
               );
            echo form_submit($submit);
         

          ?>
        




      </div>
      <div class="span6">
        
 
     

     </div>
     

         <?=form_close(); ?>
        
     
  
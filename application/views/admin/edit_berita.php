<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Artikel Berita


<small>
<a href="<?=base_url().'berita'  ?>" title="" class="btn btn-primary btn-small btn pull-right">
<i class="icon  icon-arrow-left icon-white"></i> Kembali</a>
</small>
</h3>

<div class="span4">
  

    <?php 

            $data = array(
              'name'    =>  'tambah',
              'class'   =>  'form-signin',
              'method'  =>  'POST',
              'enctype' =>  'multipart/form-data'

              ); 

            echo   form_open('berita/proses_edit', $data);
            ?>

   


    <!-- pesan start -->
    <?php if (! empty($pesan)) : ?>
        <p class="text-danger">
            <?php echo $pesan; ?>
        </p>
    <?php endif ?>
    <!-- pesan end -->



    <?=form_label('Kategori Artikel Berita'); ?>
<select name="idkategori" class="form-control span4 tip"

              data-toggle   ="tooltip"
              data-placement  =  "right"
              title         = "Silahkan Memilih Sala-satu Kategori Untuk Postingan Artikel Berita"
>
  <option value="">--Pilih Kategori Berita--</option>
  <?php 

            if (!empty($tampil_category)) {
              ?>



                <?php 

                    foreach ($tampil_category->result() as $key) {
                      ?>


                  <option
    <?php if ($edit->idkategori == $key->idkategori){ ?>
      selected="selected" 
    <?php } ?>

     value="<?=$key->idkategori ?>"><?=$key->namakategori ?></option>
              
                      

                      <?php
                   }
                    
                 ?>




<?php
    } 

    else
    {
        echo 'Maaf Data Kategori Kosong';
    }

  ?>


</select>




         <?php 
         $judul    = array(
              'name'          => 'judul' ,
              'class'         =>  'form-control span4 tip',
                 'type'       =>  'text',

              'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Judul Untuk Postingan Artikel Berita',
             'placeholder'    => 'Masukan Judul Berita',
              'required'      =>  'Masukan',
              'value'         =>  $edit->judulberita
             );
         	
          echo form_label('Judul Berita');
          echo form_input($judul);
          echo form_hidden('waktu_upload', namahari($nohari).',&nbsp;'.$tgl.'&nbsp;'.namabulan($bln).'&nbsp;'.$thn);


           echo form_error('judul', '<p class="text-danger">', '</p>');

          ?>








<?php

$latitude = array(
      'name'    => 'latitude',
      'class'   => 'span4 tip',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Latitude Kordinat - X tempat wisata',
      'placeholder' => ' Masukan Latitude',
      'value'     =>$edit->lat_wisata,
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
              'title'         =>  'Silahkan Memasukan Latitude Kordinat - Y tempat wisata',
      'placeholder' => ' Masukan Longitude',
      'value'     =>$edit->long_wisata,
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
              'title'         =>  'Silahkan Memilih Sala-satu Gambar Untuk Postingan Artikel Berita',
             'placeholder'    => 'Masukan Gambar'
             );
            echo form_label('Masukan Gambar');
            echo form_input($gambar);

            echo '<small class="text-error" id="error">Jika Gambar tidak di Ubah, <strong>Silahkan Kosongkan Saja</strong></small>';
            echo form_hidden('waktu',namahari($nohari).' '.$tgl.' '.namabulan($bln).' '.$thn);
            echo form_hidden('idberita',$edit->idberita);
              echo form_hidden('g_besar',$edit->gambar_besar);
              echo form_hidden('g_kecil',$edit->gambar_kecil);
            
            echo form_error('gambar', '<p class="text-danger">', '</p>');

          ?>
         
       
<?php
 echo br().br();

$img = array(
                'src'   => 'asset/upload/berita/gambarkecil/'.$edit->gambar_kecil,
                'class' => 'img-polaroid' );

echo img($img);




 ?>


 <?=form_label('<strong class="text-error">Status Artikel Berita</strong>'); ?>
<select name="status" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Status Artikel Berita">

  <option value="">--Pilih Status Artikel--</option>


<?php if ($edit->status =='publish') {
?>
       <option selected="selected" value="publish">Publish</option>
         <option value="pending">Pending</option>

<?php
} else {
?>
  <option selected="selected" value="pending">Pending</option>
         <option value="publish">Publish</option>


<?php
}
 ?>
      

              
                      

</select>





<?=form_label('<strong class="text-error">Status Artikel Berita</strong>'); ?>
<select name="popular" class="form-control span3 tip"
required
data-toggle="tooltip" 
data-placement="right" 
title="Pilih Salah satu Untuk Menentukan Status Artikel Berita">

  <option value="">--Pilih Status Artikel--</option>


<?php if ($edit->status_popular =='popular') {
?>
       <option selected="selected" value="popular">Popular</option>
         <option value="tidak">Tidak</option>

<?php
} else {
?>
  <option selected="selected" value="tidak">Tidak</option>
         <option value="popular">Popular</option>


<?php
}
 ?>
      

              
                      

</select>



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
        
 
     




                <!--batas inputan judul-->
           <?php 



      
          echo form_label('<strong>Isi Artikel Berita</<strong>');
            echo form_textarea('isi',$edit->isiberita);

            echo form_error('isi', '<p class="text-danger">', '</p>');

          ?>
     </div>
     

         <?=form_close(); ?>
        
     
  
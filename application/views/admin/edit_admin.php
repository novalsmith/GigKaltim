<h3 style="border-bottom:dashed 1px #AAB2BD">Edit Data Admin
<small>
</h3>


	
   <?php 

	

            $data = array(
              'name'    =>  'tambah',
              'class'   =>  'form-signin',
              'method'  =>  'POST',
              'enctype' =>  'multipart/form-data'

              ); 

            echo   form_open('admin/proses_update_admin', $data);
            ?>





<?php echo $this->session->flashdata('message');   ?>



<div class="span3 ">




<?php

$username = array(
			'name' 		=> 'username',
			'class'		=> 'span3 tip',
		
		      'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Username Anda Untuk Admin',
			'placeholder' => ' Masukan Username',
      'value'       => $edit->username,
			'required'  => 'masukan');

echo form_label('Username');
echo form_input($username);
 echo form_error('username', '<p class="text-error">', '</p>');
 ?>

<?php

$nama_lengkap = array(
      'name'    => 'nama_lengkap',
      'class'   => 'span3 tip',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Nama Lengkap Anda',
      'placeholder' => ' Masukan Nama Lengkap',
       'value'       => $edit->nama_lengkap,
      'required'  => 'masukan');

echo form_label('Nama Lengkap');
echo form_input($nama_lengkap);
 echo form_error('nama_lengkap', '<p class="text-error">', '</p>');
 ?>
<?php

$email = array(
      'name'    => 'email',
      'class'   => 'span3 tip',
    'type'      =>  'email',
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Email Anda yang aktif',
      'placeholder' => ' Masukan Email',
       'value'       => $edit->email,
      'required'  => 'masukan');

echo form_label('Masukan Email');
echo form_input($email);
 echo form_error('email', '<p class="text-error">', '</p>');
 ?>


<?php

$tlp = array(
      'name'    => 'tlp',
      'class'   => 'span3 tip',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Nomor Telepon Anda Yang aktif',
      'placeholder' => ' Masukan Nomor Telepon',
       'value'       => $edit->tlp,
      'required'  => 'masukan');

echo form_label('Masukan Nomor Telepon');
echo form_input($tlp);
 echo form_error('tlp', '<p class="text-error">', '</p>');
 ?>


<?php

$password = array(
      'name'    => 'password',
      'class'   => 'span3 tip',
      'type'    => 'password',
    
          'data-toggle'   =>  'tooltip',
              'data-placement'  =>  'right',
              'title'         =>  'Silahkan Memasukan Password anda, * Ingat Untuk memudahkan anda pada saat login',
      'placeholder' => ' Masukan Password Anda',
      'required'  => 'ketikulang'
      
      );
echo form_hidden('idadmin',$edit->idadmin);

echo "<p class='text text-error'>Jika Password tidak di Ganti,..Silahkan Ketik Ulang Password Anda *</p>";

echo form_label('Password');
echo form_input($password);
echo "<p class='text text-info'>Jika Ingin Mengubah Password,..Silahkan Masukan Massword Baru *</p>";
 echo form_error('password', '<p class="text-error">', '</p>');
 ?>

           <button type="submit" class="btn btn-primary btn-medium"><i class="icon icon-white icon-hdd"></i> Simpan</button>
<button type="reset" class="btn btn-default btn-medium"><i class="icon icon-refresh"></i> Bersihkan Form</button>

</div>



<div class="span5 " style="font-weight: bold;">

</div>
<div class="span3 " style="font-weight: bold;">
<div class='alert alert-info alert-dismissible fade in' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
   

   <?php 
$data = $this->db->get('admin')->result();
    foreach ($data as $key ) {
      ?>

                <p>
 <i class="icon-user"></i>
                <?=$key->nama_lengkap ?>
                </p>

                <p>
<i class="icon-barcode"></i>
                <?=$key->username ?>
            </p>
                <p>
<i class="icon- icon-envelope"></i>
                <?=$key->email ?>
                </p>
                <p>
<i class="icon-headphones"></i>
                <?=$key->tlp ?>
                </p>
         
              
            
      <?php
    }
    ?>
    </div>
</div>






<?=form_close() ?>











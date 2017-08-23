
<style>
body{
background-color:white;
}
</style>
<style>
body{
margin:0px;
}
#idc{
margin-left:-10px;
width:100%;

padding-right:20px;
padding-top:8px;

}
body{
margin-left:25px;
}
.nama{
position:absolute;
margin-top:-200px;


font-size:20px;
}

.nuptk{
position:absolute;
margin-top:-96px;
margin-left:-345px;
font-weight:bold;
}
#poto{
margin-top:430px;
margin-left:524px;

width:22%;
height:30%;
position:absolute;

}
.atribut
{
	margin-right: 10px;
	float:left;
}
.data
{
	margin-left: 0px;
	float:left;
}
#bars{
margin-left:520px;
margin-top:58px;
position:absolute;
font-size:53pt;
}
@font-face{
    font-family:'barcode';
    src: url(<?=base_url().'asset/fonts/BarcodeFont.ttf'?>);
    }
	
#footer-bottom-inner {
   position: fixed; left: 0; bottom: 0; right: 0; height: 30px; text-align: center;
    
}
.berlaku{
	font-size:15px;
}
</style>

<?php         $kartu_aktif = $this->m_kartu->kartu_aktif()->row(); ?>

<div style="max-width:690px;margin-left:13px">

<?php

$data_img = array(
					 'src' => 'asset/upload/kartu_anggota/gambarbesar/'.$kartu_aktif->walpaper,
					'id'	=> 'idc' );


echo img($data_img);
?>

<span class="nama">
<br>
<div class="atribut">
	<font face="arial">Nama * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>	<font face="arial" class=" pull-left"> <?=$cetak_kartu->nama_lengkap ?></font>
<br>
		<font  face="arial">Nomor Anggota * </font>	<font  face="arial"><?=$cetak_kartu->no_anggota ?></font>
<br>
<font  face="arial">Angkatan *  &nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>	<font  face="arial"><?=$cetak_kartu->angkatan ?></font>
<br>
	<font  face="arial">Kampus *  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;</font> 	<font  face="arial"><?=$cetak_kartu->kampus ?></font>
	<br><br><br><br><br>
	<p class="berlaku">Berlaku Hingga <?=date('d M')?> &nbsp;<?=date('Y')+$kartu_aktif->masa_berlaku ?></p>

	</div>

<?php

$data_img1 = array(
					'src'	=> 'asset/upload/anggota/gambarkecil/'.$cetak_kartu->gambar_kecil,
					'id'	=> 'poto',
					'class' => '' );


echo img($data_img1);
?>

</span>


</div>










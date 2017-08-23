<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	   <meta name="viewport" content="width=device-width, initial-scale=1.0">   
	<title><?=$title ?></title>
	 	
	 	<link href="<?=base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url() ?>asset/css/bootstrap-responsive.css" rel="stylesheet">
<style type="text/css" media="screen">

	#error{
		padding: 10px;
		box-shadow: 2px 2px 3px; black;
		margin-top: 1px;
	}
	.galeri{
			list-style: none;
		}
		.galeri img{
			background: #fff;
	
			border: 1px solid #ccc;
			cursor: pointer;
			width: 100px;
			height: 80px;
		
		}
		.zoom{
			position: fixed;
			top: 50%;
			left: 50%;
			width: 500px;
			height: 400px;
			z-index: 5;
			margin-left: -250px;
			margin-top: -200px;
			padding: 10px 10px 50px 10px;
			border: 1px solid #aaa;
			box-shadow: 0 0 5px #ccc;
			background: #fff;
			color:black;
		}
		.zoom img{
			width: 500px;
			height: 400px;
		}
		.zoom p{
			font-size: 18px;
			font-weight: bold;
			margin-top: 10px;
		}
		.zoom .close{
			position: ab

			bottom: 10px;
			cursor: pointer;
		}

		body

	
			{

		background-image: url(<?=base_url().'asset/img/aab.jpg' ?>);
		background-repeat:no-repeat;
		background-attachment:fixed;

		
			
			}
		
</style>
</head>
<body>

	

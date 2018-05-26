<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<html>
	<head>
		<title>Dnevnik</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Elektronski Dnevnik</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav"></ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url(); ?>login">Login</a></li>
				</ul>
			</div>
		</div>
		</nav>
  
		<div class="container">
		
		
<?php if($this->session->flashdata('user_registered')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
<?php endif; ?>
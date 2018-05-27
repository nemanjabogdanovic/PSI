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
		<!-- navigacioni bar -->
		<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Elektronski Dnevnik</a>
			</div>
			<div id="navbar">
				<!-- leva strana -->
				<ul class="nav navbar-nav">
					<?php if($this->session->userdata('logged_in')) : ?>
						<li><a><?php echo $this->session->userdata('username'); ?></a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_level') === 'administrator') : ?>
						<li><a>Administrator</a></li>
					<?php endif; ?>
				</ul>
				<!-- desna strana -->
				<ul class="nav navbar-nav navbar-right">
					<?php if(!$this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
					<?php endif; ?>
						
					<li><a href="<?php echo base_url(); ?>users/register">Registracija_temp</a></li>
						
					<?php if($this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		</nav>
  
		<div class="container">
		
<!-- funkcije za flash poruke -->
<?php if($this->session->flashdata('user_registered')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('login_failed')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('user_loggedin')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('user_loggedout')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
<?php endif; ?>
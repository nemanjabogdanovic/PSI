<!--
	autor: Nemanja Bogdanovic, 2012/0533
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
					<?php if($this->session->userdata('user_level') === 'administrator') : ?>
						<li><a href="<?php echo base_url(); ?>administrator">Administrator</a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_level') === 'koordinator') : ?>
						<li><a href="<?php echo base_url(); ?>koordinator">Koordinator</a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_level') === 'nastavnik') : ?>
						<li><a href="<?php echo base_url(); ?>nastavnik">Nastavnik</a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_level') === 'ucenik') : ?>
						<li><a href="<?php echo base_url(); ?>ucenik">Učenik</a></li>
					<?php endif; ?>
				</ul>
				<!-- desna strana -->
				<ul class="nav navbar-nav navbar-right">
					<?php if(!$this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
					<?php endif; ?>
						
					
					<?php if($this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>users/reset">Promena lozinke</a></li>
					<?php endif; ?>
					
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

<?php if($this->session->flashdata('reset_failed')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('reset_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('reset_success')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('reset_success').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('forgotten_success')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('forgotten_success').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('forgotten_fail')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('forgotten_fail').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('vest_uspesno_dodata')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('vest_uspesno_dodata').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('vesti_izbrisane')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('vesti_izbrisane').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('skola_uspesno_dodata')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('skola_uspesno_dodata').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('skola_uspesno_izmenjena')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('skola_uspesno_izmenjena').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('koordinator_uspesno_izmenjen')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('koordinator_uspesno_izmenjen').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('poruka_poslata')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('poruka_poslata').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('izmenjen_predmet')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('izmenjen_predmet').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('unet_cas')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('unet_cas').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('izbrisan_predmet')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('izbrisan_predmet').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('izbrisan_nastavnik')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('izbrisan_nastavnik').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('izbrisan_ucenik')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('izbrisan_ucenik').'</p>'; ?>
<?php endif; ?>
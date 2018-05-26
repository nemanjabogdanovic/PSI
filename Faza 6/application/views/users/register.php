<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="form-group">
		<label>Ime</label>
		<input type="text" class="form-control" name="name" placeholder="Ime">
	</div>
	<div class="form-group">
		<label>Prezime</label>
		<input type="text" class="form-control" name="surname" placeholder="Prezime">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email" placeholder="Email">
	</div>
	<div class="form-group">
		<label>Korisnicko Ime</label>
		<input type="text" class="form-control" name="username" placeholder="Korisnicko Ime">
	</div>
	<div class="form-group">
		<label>Sifra</label>
		<input type="text" class="form-control" name="password" placeholder="Sifra">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>

<?php echo form_close(); ?>

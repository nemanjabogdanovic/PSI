<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="row">
		<div class="col-md-4">
			<h1 class="text-center"><?= $title.' obican korisnik privremeno'; ?></h2>
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
				<label>Lozinka</label>
				<input type="text" class="form-control" name="password" placeholder="Lozinka">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>

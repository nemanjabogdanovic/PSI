<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php echo form_open('users/login'); ?>
	
<div class="row">
	<div class="col-md-4">
		<h1 class="text-center"><?php echo $title; ?></h1>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Korisnicko Ime" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Lozinka" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Login</button>
		<br>
		<a href="<?php echo base_url(); ?>users/forgotten">Zaboravljena lozinka?</a>
	</div>
</div>
	
<?php echo form_close(); ?>
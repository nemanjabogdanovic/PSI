<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php echo form_open('users/reset'); ?>
	
<div class="row">
	<div class="col-md-4">
		<h1 class="text-center"><?php echo $title; ?></h1>
		<div class="form-group">
			<input type="password" name="old_password" class="form-control" placeholder="Stara lozinka" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="new_password" class="form-control" placeholder="Nova lozinka" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Promeni šifru</button>
		<br>
	</div>
</div>
	
<?php echo form_close(); ?>
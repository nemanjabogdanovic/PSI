<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="row">
		<div class="col-md-4">
			<h1 class="text-center"><?= $title.' '; ?></h2>
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
			
			<div class="radio">
				<label><input type="radio" name="optradio">Ucenik</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="optradio">Nastavnik</label>
			</div>
			
			
			<button type="submit" class="btn btn-primary btn-block">Unesi</button>
		</div>
	</div>
<?php echo form_close(); ?>

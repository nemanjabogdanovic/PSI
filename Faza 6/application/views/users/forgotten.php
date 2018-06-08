<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php echo form_open('users/forgotten'); ?>
	
<div class="row">
	<div class="col-md-4">
		<h1 class="text-center"><?php echo $title; ?></h1>
		<br><br>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Promeni šifru</button>
		<br>
	</div>
</div>

<?php echo form_close(); ?>
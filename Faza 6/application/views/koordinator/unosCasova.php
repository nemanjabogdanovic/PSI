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
				<select class="selectpicker">
					  <option>Predmet 1</option>
					  <option>Predmet 2</option>
					  <option>Predmet 3</option>
				</select>

			</div>
			<h3 class="text">Datum </h3>
			<input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="date" value="09-01-2013">
				<script>
					$(function(){
						$('#date').combodate();    
					});
				</script>
			<h3 class="text">termin </h3>
			
			dropdown
			
			
			<button type="submit" class="btn btn-primary btn-block">Dodaj</button>
			<!--
				Bilo bi dobro da se prikaze raspored za taj dan
			-->
			
		</div>
	</div>
<?php echo form_close(); ?>

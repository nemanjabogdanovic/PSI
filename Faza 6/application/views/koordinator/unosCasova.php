<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo validation_errors(); ?>

<?php echo form_open('koordinator/unosCasova'); ?>
	<div class="row">
		<div class="col-md-4">
			<h1 class="text-center"><?= $title.' '; ?></h2>
			
			<div class="form-group">
					<label>Odeljenje</label>
					<input type="text" class="form-control" name="odeljenje" placeholder="Odeljenje">
				</div>
				<div class="form-group">
					<label>Dan</label>
					<input type="text" class="form-control" name="dan" placeholder="Dan">
				</div>
				<div class="form-group">
					<label>Broj časa</label>
					<br>
					<input type="number" name="brojCasa" min="1" max="20" placeholder="Čas" >
				</div>
				<div class="form-group">
					<label>Nastavnik</label>
					<br>
					<input type="number" name="nastavnik" min="1" max="20" placeholder="ID" >
				</div>
				
				<div class="form-group">
					<label>Kabinet</label>
					<input type="text" class="form-control" name="kabinet" placeholder="Kabinet">
				</div>
				
				<div class="form-group">
					<label>Predmet</label>
					<input type="number" name="predmet" min="1" max="20" placeholder="Čas" placeholder="predmet" >
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			<!--
				Bilo bi dobro da se prikaze raspored za taj dan
			-->
			
		</div>
	</div>
<?php echo form_close(); ?>

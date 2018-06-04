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
					<label>Odeljenja:</label>
					<?php
					echo "<select name='odeljenje'>";
					foreach($odeljenja->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->oznaka; ?></option>"; 
					<?php
					}
					echo "</select>";
					?>
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
					<label>Nastavnik:</label>
					<?php
						echo "<select name='nastavnik'>";
						foreach($nastavnici->result() as $row) {
							foreach($users->result() as $rowU)
							{
								if($row->id === $rowU->id){
								?>
								echo "<option value="<?php echo $rowU->id; ?>"><?php echo $rowU->username; ?> </option>"; 
								<?php
								}
							}
						}
						echo "</select>";
					?>
				</div>
				
				<div class="form-group">
					<label>Kabinet</label>
					<input type="text" class="form-control" name="kabinet" placeholder="Kabinet">
				</div>
				
			<div class="form-group">
					<label>Predmeti:</label>
					<?php
					echo "<select name='predmet'>";
					foreach($predmeti->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ime; ?></option>"; 
					<?php
					}
					echo "</select>";
					?>
			</div>
				
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			<!--
				Bilo bi dobro da se prikaze raspored za taj dan
			-->
			
		</div>
	</div>
<?php echo form_close(); ?>

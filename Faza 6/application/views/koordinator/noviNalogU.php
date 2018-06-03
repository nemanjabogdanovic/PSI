<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->

<?php  echo validation_errors(); ?>

<?php echo form_open('koordinator/noviNalogU'); ?>
		<div class="row">
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
				<div class="form-group">
					<label>Škola</label>
					<?php
					echo "<select name='skola'>";
					foreach($skole->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ime; ?></option>"; 
					<?php
					}
					echo "</select>";
					?>
				</div>
			<div class="form-group">
					<label>Odeljenje:</label>
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
				
				<button type="submit" class="btn btn-primary btn-block">Unesi</button>
		</div>
<?php echo form_close(); ?>

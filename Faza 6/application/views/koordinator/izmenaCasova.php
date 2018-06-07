<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="row">
		<div class="col-md-4">
			<h1 class="text-center"><?= $title.' '; ?></h2>
			
			<table class="table table-hover">
				<thead>
				  <tr>
					<th></th>
					<th>Ponedeljak</th>
					<th>Utorak</th>
					<th>Sreda</th>
					<th>Četvrtak</th>
					<th>Petak</th>
					
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>8h</td>
					<td>mata</td>
					<td>eng</td>
					<td>12</td>
				  </tr>
				  <tr>
					<td>9h</td>
					<td>eng</td>
					<td>fra</td>
					<td>12,14</td>
				  </tr>
				  <tr>
					<td>10h</td>
					<td>fra</td>
					<td>oet</td>
					<td>12,13,15</td>
				  </tr>
				</tbody>
			  </table>
			<h3 class="text">Dan:</h3>
			
			<div class="form-group">
				<select class="selectpicker">
					  <option>Ponedeljak</option>
					  <option>Utorak</option>
					  <option>Sreda</option>
					  <option>Četvrtak</option>
					  <option>Petak</option>
				</select>

			</div>
			
			<h3 class="text">Termin: </h3>
			
			
			<div class="form-group">
				<select class="selectpicker">
					  <option>8</option>
					  <option>9</option>
					  <option>10</option>
					  <option>11</option>
					  <option>12</option>
				</select>

			</div>
			
			<h3 class="text">Predmet: </h3>
			<div class="form-group">
				<select class="selectpicker">
					  <option>Predmet 1</option>
					  <option>Predmet 2</option>
					  <option>Predmet 3</option>
				</select>

			</div>
			
			<h3 class="text">Promeni u:</h3>
			
			<div class="form-group">
				<select class="selectpicker">
					  <option>Predmet 1</option>
					  <option>Predmet 2</option>
					  <option>Predmet 3</option>
				</select>

			</div>
			
			<button type="submit" class="btn btn-primary btn-block">Izmeni</button>
			
			<!--
				Bilo bi dobro da se prikaze raspored za taj dan
			-->
			
		</div>
	</div>
<?php echo form_close(); ?>

<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->

<?php  echo validation_errors(); ?>

<?php echo form_open('koordinator/noviNalogU'); ?>

<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/home">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/ra	spored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">
		
		<div class="row">
				<div class="col-md-6">
		<h1 class="text-center"><?php echo $title; ?></h1>
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
		</div>
<?php echo form_close(); ?>

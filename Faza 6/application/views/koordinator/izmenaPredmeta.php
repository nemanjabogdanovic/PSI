<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo form_open('koordinator/izmenaPredmeta'); ?>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/statistika">Statistika</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">
		
		
<div class="row">
	<div class="col-md-6">
		<h1 class="text-center"><?php echo $title; ?></h1>

		<br>
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
			
			<div class="form-group">
					<label>Nastavnik:</label>
					<?php
					echo "<select name='nastavnik'>";
					foreach($nastavnici->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>"; 
					<?php
					}
					echo "</select>";
					?>
			</div>
				
			<div class="form-group">
				<label>Ime</label>
				<input type="text" class="form-control" name="ime" placeholder="Ime">
			</div>
			
			<div class="form-group">
				<label>Školska godina</label>
				<input type="text" class="form-control" name="skolskaGodina" placeholder="Skolska godina">
			</div>
			<div class="form-group">
				<label>Kabineti</label>
				<input type="text" class="form-control" name="kabineti" placeholder="Kabinet">
			</div>				
			
			
			
		<button type="submit" class="btn btn-primary btn-block">Izmeni predmet</button>
		
	
		
			
	</div>		
	
	
		
		
	</div>	
</div>
</div>
<?php echo form_close(); ?>
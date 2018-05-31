<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo form_open('koordinator/unosPredmeta'); ?>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/home">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/ra	spored">Raspored časova</a></li>
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
		
		<div class="form-group">
				<label>Ime predmeta</label>
				<input type="text" class="form-control" name="ime" placeholder="Ime">
			</div>
			<div class="form-group">
				<label>Nastavnik</label>
				<input type="text" class="form-control" name="nastavnik" placeholder="Nastavnik">
			</div>
			<div class="form-group">
				<label>Skolska godina</label>
				<input type="text" class="form-control" name="skolskaGodina" placeholder="Skolska godina">
			</div>
			<div class="form-group">
				<label>Kabinet</label>
				<input type="text" class="form-control" name="kabineti" placeholder="Kabinet">
			</div>
			
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		
		
		
		
		
		
		<!--<div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="Ime">
		</div>
		
		<br>
		
		
		 <h3 class="text">Izbor školske godine: </h3>
		<div class="checkbox">
			<label><input type="checkbox" value="">Prva godina</label>
		</div>
		<div class="checkbox">
			 <label><input type="checkbox" value="">Druga godina</label>
		</div>
		<div class="checkbox">
			 <label><input type="checkbox" value="">Treća godina</label>
		</div>
		<div class="checkbox">
			 <label><input type="checkbox" value="">Četvrta godina</label>
		</div>
		
		
		<h3 class="text">Izbor nastavnika:</h3>
		
		
			<select class="selectpicker" multiple data-width="auto">
				<option>Profa 11 asdasdasdasdasd</option>
				<option>Profa 2</option>
				<option>Profa 3</option>
			</select>
		
		<br>
		<br>
		<br>
		
		
		<button type="submit" class="btn btn-primary btn-block">unesi</button>
		-->
			
</div>		
		
		
	</div>	
</div>

<?php echo form_close(); ?>
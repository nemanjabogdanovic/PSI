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
		<div class="form-group">
			<input type="text" name="ime" class="form-control" placeholder="ime predmeta" required autofocus>
		</div>
		
		<br>
		
		
		<h1 class="text-center">Izbor školske godine </h1>
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
		
		
		<h1 class="text-center">Izbor nastavnika </h1>
		
		
			<select class="selectpicker" multiple data-width="auto">
				<option>Profa 11 asdasdasdasdasd</option>
				<option>Profa 2</option>
				<option>Profa 3</option>
			</select>
		
		<br>
		<br>
		<br>
		
		
		<button type="submit" class="btn btn-primary btn-block">unesi</button>
		
			
</div>		
		
		
	</div>	
</div>

<?php echo form_close(); ?>
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
			<select class="selectpicker">
			  <option>Predmet 1</option>
			  <option>Predmet 2</option>
			  <option>Predmet 3</option>
			</select>

		</div>
		<h3 class="text">Dodaj profesora </h3>
			<select class="selectpicker" multiple data-width="auto">
				<option>Profa 11 asdasdasdasdasd</option>
				<option>Profa 2</option>
				<option>Profa 3</option>
			</select>
		<button type="submit" class="btn btn-primary btn-block">Dodaj</button> <!-- poruka da je profa dodat -->	

		
		<br>
		
	
		
		<button type="submit" class="btn btn-primary btn-block">Izmeni</button>
		
			
	</div>		
		
		
	</div>	
</div>

<?php echo form_close(); ?>
<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php echo form_open('koordinator/novaVest'); ?>

<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/statistika">Statistika</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">		
		<h1><?php echo $title; ?></h1>
		<br><br>
		<div class="form-group">
			<input type="text" name="naslov" class="form-control" placeholder="Naslov vesti" required autofocus>
			<br><textarea type="text" name="text" class="form-control" rows="5" placeholder="Tekst vesti" required autofocus></textarea>
			
		</div>
		<button type="submit" class="btn btn-primary">Dodaj vest</button>
		<br>
	</div>	
</div>


	
<?php echo form_close(); ?>
<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
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
<div class="col col-lg-10 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		<div class="col-lg-8 col-md-5 col-sm-4 col-xs-12">
			<h1 class="text-center"><?php echo $title; ?></h1>
			
			<h3 class="text">Raspored za odeljenje: </h3>
			<select class="selectpicker">
				<option>I/1</option>
				<option>I/2</option>
				<option>I/3</option>
			</select>
			
			<br>
			KALENDAR
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/unosCasova">Unos časova</a></button>
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/izmenaCasova">Izmena časova</a></button>			
			
			
			
			 
			

			
		</div>
	</div>	
</div>
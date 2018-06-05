<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo form_open('koordinator/raspored'); ?>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-10 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		<div class="col-lg-8 col-md-5 col-sm-4 col-xs-12">
			<h1> Rad sa rasporedima</h1>

			
			<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;" href="<?php echo base_url(); ?>koordinator/prikazRasporedaO">Raspored</a></button>
			<br><br>
	
			<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;" href="<?php echo base_url(); ?>koordinator/unosCasova">Unesi čas</a></button>
<br><br>
			<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;" href="<?php echo base_url(); ?>koordinator/brisanjeCasova">Brisanje časova</a></button>
			
		<br><br>
			
			
			
			 
			

			
		</div>
	</div>	
</div>
<?php echo form_close(); ?>
<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php echo form_open('administrator/izmenaSkole'); ?>

<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>administrator">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>administrator/skole">Škole i programi</a></li>
			<li><a href="<?php echo base_url(); ?>administrator/uredjivanje">Uređivanje naloga</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">		
		<h1><?php echo $title; ?></h1>
		<br><br>
		<div class="form-group">
			<label>Ime škole</label><input type="text" name="ime" class="form-control" placeholder="Ime" value="<?php echo $skola['ime']; ?>" required autofocus>
			<br><label>Adresa</label><input type="text" name="adresa" class="form-control" placeholder="Adresa" value="<?php echo $skola['adresa']; ?>"required autofocus>
			<br><label>Grad</label><input type="text" name="grad" class="form-control" placeholder="Grad" value="<?php echo $skola['grad']; ?>"required autofocus>
		</div>
		<button type="submit" class="btn btn-primary">Sačuvaj</button>
		<br>
	</div>	
</div>
<?php echo form_close(); ?>
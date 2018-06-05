<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php echo form_open('administrator/izmenaKoordinatora'); ?>

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
		<div class="row">
				<div class="form-group">
					<label>Ime</label>
					<input type="text" class="form-control" name="name" value="<?php echo $koordinator['name']; ?>" placeholder="Ime">
				</div>
				<div class="form-group">
					<label>Prezime</label>
					<input type="text" class="form-control" name="surname" value="<?php echo $koordinator['surname']; ?>" placeholder="Prezime">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="<?php echo $koordinator['email']; ?>" placeholder="Email">
				</div>
				<div class="form-group">
					<label>Korisnicko Ime</label>
					<input type="text" class="form-control" name="username" value="<?php echo $koordinator['username']; ?>" placeholder="Korisnicko Ime">
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Unesi</button>
		</div>
	</div>	
</div>
<?php echo form_close(); ?>
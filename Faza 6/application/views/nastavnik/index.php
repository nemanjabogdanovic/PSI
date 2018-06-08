<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>nastavnik/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/kalendar">Kalendar</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ucenici">Učenici</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/upis">Upis časa</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/izostanci">Izostanci</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ocene">Ocene</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">
		<h1><?php echo $title; ?></h1>
		
		<br>
		<?php foreach($vesti as $vest): ?>
			<h3><?php echo $vest['naslov']; ?></h3>
			<small>Datum: <?php echo $vest['timestamp']; ?>, od strane: <?php echo ucfirst($vest['userLevel']); ?></small><br><br>
			<?php echo $vest['text']; ?>
			<br><br>
		<?php endforeach; ?>
		
		<?php foreach($vestiSkola as $vest): ?>
			<h3><?php echo $vest['naslov']; ?></h3>
			<small>Datum: <?php echo $vest['timestamp']; ?>, od strane: <?php echo ucfirst($vest['userLevel']); ?></small><br><br>
			<?php echo $vest['text']; ?>
			<br><br>
		<?php endforeach; ?>
		<br>
	</div>	
</div>

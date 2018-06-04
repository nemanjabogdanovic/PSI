<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>ucenik">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>ucenik/ocene">Ocene</a></li>
			<li><a href="<?php echo base_url(); ?>ucenik/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>ucenik/kontakt">Kontaktiraj nastavnika</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">		
		<h1><?php echo $title; ?></h1>
		<br><br>
		<table class = "table table-bordered">
			<tr colspan = "5">
				<td><strong>Predmet</strong></td>
				<td><strong>Ocene</strong></td>
			</tr>
			<?php
			foreach($ocene as $row){
				if($row->predmetId != '0'){
					?>
					<tr>
						<td> <?php echo $row->predmetId; ?> </td>
						<td> <?php echo $row->ocena; ?> </td>
					</tr>
					<?php
				}
			}
			?>
		</table>
	</div>	
</div>
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
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		
			
		<div class="col-md-4">
			<h1 class="text-center"><?php echo $title; ?></h1>
			
			
			<div class="container">
			        
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Ime</th>
					<th>Nastavnici</th>
					<th>Školska godina</th>
					<th>Kabineti</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>Mata</td>
					<td>Profa 1</td>
					<td>1</td>
					<td>12</td>
				  </tr>
				  <tr>
					<td>Francuski</td>
					<td>Profa 2,Profa 1</td>
					<td>1</td>
					<td>12,14</td>
				  </tr>
				  <tr>
					<td>Fizika</td>
					<td>Profa 3</td>
					<td>1</td>
					<td>12,13,15</td>
				  </tr>
				</tbody>
			  </table>
			</div>
			
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/unosPredmeta">Unesi Predmet</a></button>
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/izmenaPredmeta">Izmeni Predmet</a></button>
			
		</div>
		
		
		
		
		
		
	</div>	
</div>
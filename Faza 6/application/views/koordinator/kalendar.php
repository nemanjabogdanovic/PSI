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
			
			
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th></th>
					<th>Ponedeljak</th>
					<th>Utorak</th>
					<th>Sreda</th>
					<th>Četvrtak</th>
					<th>Petak</th>
					
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>8h</td>
					<td>mata</td>
					<td>eng</td>
					<td>12</td>
				  </tr>
				  <tr>
					<td>9h</td>
					<td>eng</td>
					<td>fra</td>
					<td>12,14</td>
				  </tr>
				  <tr>
					<td>10h</td>
					<td>fra</td>
					<td>oet</td>
					<td>12,13,15</td>
				  </tr>
				</tbody>
			  </table>
			
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/unosCasova">Unos časova</a></button>
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/izmenaCasova">Izmena časova</a></button>	
			
		</div>
		
		
		
		
		
		
	</div>	
</div>
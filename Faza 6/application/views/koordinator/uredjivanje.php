<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/statistika">Statistika</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		<h1 class="css-header">Uređivanje naloga</h1>	
		<br>
		<h2 class="css-header">Nastavnici:</h2>	
		<table class = "table table-bordered">
			<tr colspan = "5">
				<td><strong>Ime</strong></td>
				<td><strong>Prezime</strong></td>
				<td><strong>Škola</strong></td>
				<td><strong>Email</strong></td>
			</tr>
			<?php
			foreach($nastavnici->result() as $row)
			{
				foreach($users->result() as $rowU)
				{
					foreach($skole->result() as $rowS)
					{	
						if($row->id === $rowU->id && $row->skolaId === $rowS->id){
							?>
							<tr>
								<td> <?php echo $rowU->name; ?> </td>
								<td> <?php echo $rowU->surname; ?> </td>
								<td> <?php echo $rowS->ime; ?> </td>
								<td> <?php echo $rowS->grad; ?> </td>
							</tr>
							<?php
						}
					}
				}
			}
			?>
		</table>
		<button type="submit"><a href="<?php echo base_url(); ?>koordinator/noviNalog">Novi nalog</a></button>
		
		
	</div>	
</div>
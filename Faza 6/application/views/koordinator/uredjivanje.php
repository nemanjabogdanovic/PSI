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
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		<h1 class="css-header">Uređivanje naloga</h1>	
		<br>
		<h2 class="css-header">Nastavnici:</h2>	
		<table class = "table table-bordered">
			<tr colspan = "5" style = "border: 1px solid black;background-color:#337ab7;">
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
								<td style = "background-color:lightblue;"> <?php echo $rowU->name; ?> </td>
								<td style = "background-color:lightblue;"> <?php echo $rowU->surname; ?> </td>
								<td style = "background-color:lightblue;"> <?php echo $rowS->ime; ?> </td>
								<td style = "background-color:lightblue;"> <?php echo $rowU->email; ?> </td>
							</tr>
							<?php
						}
					}
				}
			}
			?>
		</table> 
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/noviNalog">Novi nalog</a></button>
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/izmenaNaloga">Izmena naloga</a></button>
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/brisanjeNaloga">Brisanje naloga</a></button>
		<br>
		<h2 class="css-header">Učenici:</h2>	
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/noviNalogU">Novi nalog</a></button>
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/izmenaNalogaU">Izmena naloga</a></button>
		<button type="submit" class="btn btn-primary"><a style="color: #FFFFFF;"  href="<?php echo base_url(); ?>koordinator/brisanjeNalogaU">Brisanje naloga</a></button>
		
	</div>	
</div>
<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.1
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
<div class="col col-lg-10 col-md-7 col-sm-7 col-xs-12 right-container">		
	<div class="tm-right-inner-container">
		
			
		<div class="col-lg-8 col-md-5 col-sm-4 col-xs-12">
			<!--<h1 class="text-center"><?php echo $title; ?></h1>-->
						
<table class = "table table-bordered">
	<tr colspan = "5">
		<td><strong>Ime predmeta</strong></td>
		<td><strong>Nastavnik</strong></td>
		<td><strong>Školska godina</strong></td>
		<td><strong>Kabineti</strong></td>
		<td><strong>Škola</strong></td>
     </tr>
		<?php
			if ($fetch_data->num_rows() > 0){
		
				foreach($fetch_data->result() as $row){
			?>
			
			<tr>
			<td> <?php echo $row->ime; ?> </td>   
		   
			<?php
			foreach($nastavnici->result() as $rowN){
				if($row->nastavnik === $rowN->id){
					?>
					 <td>  <?php echo $rowN->name; ?> <?php echo $rowN->surname; ?>  </td>
					<?php
				}
				
			}
			?>
		
		   
		   <td> <?php echo $row->skolskaGodina; ?> </td>
		   
		   <td> <?php echo $row->kabineti; ?> </td>
		   
			<?php
			foreach($skole->result() as $rowS){
				if($row->skolaId === $rowS->id){
					?>
					 <td> <?php echo $rowS->ime; ?>  </td>
					<?php
				}
				
			}
			?>
			
			</tr>
			<?php
			}
		}
		else {
			?>
			<tr colspan = "5">
			Nema !
			</tr>
			<?php

		}
		?>
  </table>
  

			
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/unosPredmeta">Unesi Predmet</a></button>
			
			
			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/brisanjePredmeta">Izbriši Predmet</a></button>
			

			
			<button type="submit"><a href="<?php echo base_url(); ?>koordinator/izmenaPredmeta">Izmeni Predmet</a></button>
		
			
		</div>
		
		
		
		
		
		
	</div>	
</div>
<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo form_open('koordinator/prikazRasporedaO'); ?>
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
		
		
<div class="row">
	<div class="col-md-6">
		<h1 class="text-center"><?php echo $title; ?></h1>
		<h1>OPA</h1>
<table class = "table table-bordered">
	<tr colspan = "5">
		<td><strong>Ponedeljak</strong></td>
		<td><strong>Utorak</strong></td>
		<td><strong>Sreda</strong></td>
		<td><strong>Četvrtak</strong></td>
		<td><strong>Petak</strong></td>
     </tr>
			<?php
			if ($fetch_data_o->num_rows() > 0){
		
				foreach($fetch_data_o->result() as $row){
			?>
			
			<tr>
			
			<?php
			foreach($rasporedi->result() as $rowN){
				if('ponedeljak' === $rowN->dan){
					?>
					 <td>  <?php echo $rowN->predmetId; ?>   </td>
					<?php
				}
				
			}
			?>
			

			
			
			
			</tr>
			<?php
			}
		}	 
	 
?>
  </table>
  
		
			

		
	
		
			
	</div>		
	
	
		
		
	</div>	
</div>
</div>
<?php echo form_close(); ?>
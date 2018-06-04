<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->

<?php echo form_open('koordinator/brisanjeNaloga'); ?>

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
		<h2>Brisanje naloga</h2>
				<div class="form-group">
					<label>Nastavnik:</label>
					<?php
						echo "<select name='nastavnik'>";
						foreach($nastavnici->result() as $row) {
							foreach($users->result() as $rowU)
							{
								if($row->id === $rowU->id){
								?>
								echo "<option value="<?php echo $rowU->id; ?>"><?php echo $rowU->username; ?> </option>"; 
								<?php
								}
							}
						}
						echo "</select>";
					?>
			<button type="submit" class="btn btn-primary ">Izbriši</button> <!-- poruka da je godina izbacena -->	
		
				</div>

		
	</div>	
</div>
<?php echo form_close(); ?>
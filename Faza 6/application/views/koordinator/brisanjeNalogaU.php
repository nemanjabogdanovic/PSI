<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->

<?php echo form_open('koordinator/brisanjeNalogaU'); ?>

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
					<div class="col-md-6">

		<h1 class="text-center"><?php echo $title; ?></h1>

				<div class="form-group">
					<label>Učenik:</label>
					<?php
						echo "<select name='ucenik'>";
						foreach($ucenici->result() as $row) {
							foreach($users->result() as $rowU)
							{
								if($row->id === $rowU->id){
								?>
								echo "<option value="<?php echo $rowU->id; ?>"><?php echo $rowU->name; ?> <?php echo $rowU->surname; ?></option>"; 
								<?php
								}
							}
						}
						echo "</select>";
					?>
			
				</div>
		<button type="submit" class="btn btn-primary btn-block">Izbriši</button>

		</div>
	</div>	
</div>
<?php echo form_close(); ?>
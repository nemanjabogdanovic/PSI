<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>administrator">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>administrator/skole">Škole i programi</a></li>
			<li><a href="<?php echo base_url(); ?>administrator/uredjivanje">Uređivanje naloga</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">		
		<h1><?php echo $title; ?></h1>
		<br><br>
		<table class = "table table-bordered">
			<tr colspan = "5">
				<td><strong>Ime</strong></td>
				<td><strong>Prezime</strong></td>
				<td><strong>Ime škole</strong></td>
				<td><strong>Grad</strong></td>
			</tr>
			<?php
			foreach($koordinatori->result() as $row)
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
		<form action="<?php echo base_url(); ?>administrator/noviKoordinator">
			<button type="submit" class="btn btn-primary" />Novi koordinator</button>
		</form>
		<?php echo form_open('administrator/uredjivanje'); ?>
			<form action="<?php echo base_url(); ?>administrator/izmenaKoordinatora">
				<?php
					echo "<select name='koord_lista'>";
					foreach($koordinatori->result() as $row) {
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
				<button type="submit" class="btn btn-primary" />Izmeni</button>
			</form>
		<?php echo form_close(); ?>
	</div>	
</div>
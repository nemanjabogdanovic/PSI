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
				<td><strong>Adresa</strong></td>
				<td><strong>Grad</strong></td>
			</tr>
			<?php
			foreach($skole->result() as $row)
			{
				?>
				<tr>
					<td> <?php echo $row->ime; ?> </td>
					<td> <?php echo $row->adresa; ?> </td>
					<td> <?php echo $row->grad; ?> </td>
				</tr>
				<?php
			}
			?>
		</table>
		<form action="<?php echo base_url(); ?>administrator/unosSkole">
			<button type="submit" class="btn btn-primary" />Unos škole</button>
		</form>
		<?php echo form_open('administrator/skole'); ?>
			<form action="<?php echo base_url(); ?>administrator/izmenaSkole">
				<?php
					echo "<select name='skola'>";
					foreach($skole->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ime; ?></option>"; 
					<?php
					}
					echo "</select>";
				?>
				<button type="submit" class="btn btn-primary" />Izmeni</button>
			</form>
		<?php echo form_close(); ?>
	</div>	
</div>
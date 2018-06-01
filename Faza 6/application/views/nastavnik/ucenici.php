<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->

<?php echo form_open('nastavnik/ucenici'); ?>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>nastavnik/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/kalendar">Kalendar</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ucenici">Učenici</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/upis">Upis časa</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/izostanci">Izostanci</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ocene">Ocene</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">
	<div class="tm-right-inner-container">
		<h1 class="css-header">Učenici</h1>


		<table class = "table table-bordered">
			<tr colspan = "3">
		    <h3> Lista ucenika: </h3>
	    </tr>
				<?php
				if ($fetch_data->num_rows() > 0)
				{
					foreach($fetch_data->result() as $row)
					{
				?>

				   <tr>

							<td> <?php echo $row->name; ?> </td>
							<td> <?php echo $row->surname; ?> </td>
							<td> <?php echo $row->email; ?> </td>

						</tr>
					<?php
					}
				}
				else {
					?>
					<tr colspan = "3">
						Nema ucenika!
					</tr>
				<?php

				}
				?>
			</table>


		<?php echo form_close(); ?>

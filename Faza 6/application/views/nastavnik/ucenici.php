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



<style type="text/css">
    select {
        width:200px;
    }
</style>



<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">
	<div style="width: 850px; overflow: hidden;">


		<h1 class="css-header">Učenici</h1>

    <div style="width: 570px; float: left;">
		<h4> Lista ucenika: </h4>
		<table class = "table table-bordered" id= "tabela">



				<?php
				if ($fetch_data->num_rows() > 0)
				{

				?>
				<tr style = "border: 1px solid black;background-color:#337ab7;">
					 <td style = "border: 1px solid black;" > <strong> Ime</strong> </td>
					 <td style = "border: 1px solid black;"><strong> Prezime</strong> </td>
					 <td style = "border: 1px solid black;"><strong> E-mail</strong> </td>
					 <td style = "border: 1px solid black;"><strong> Odeljenje</strong> </td>

			 <tr >

				<?php
					foreach($fetch_data->result() as $row)
					{
				?>


							<td style = "background-color:#ebf6f9; border:1px solid black;"> <?php echo $row->name; ?> </td>
							<td style = "background-color:#ebf6f9; border:1px solid black;"> <?php echo $row->surname; ?> </td>
							<td style = "background-color:#ebf6f9; border:1px solid black;"> <?php echo $row->email; ?> </td>
							<td style = "background-color:#ebf6f9; border:1px solid black;"> <?php echo $row->oznaka; ?> </td>

						</tr>
					<?php
					}
				}
				else {
					?>
					<tr colspan = "4">

					 <strong style = "font-size:20px">	Nema ucenika! </strong>

					</tr>

				<?php

				}
				?>
			</table>
		</div>

		<div style="margin-left: 620px;">
			<br>
			<br>
			<br>
		<p style = " font-size: 20px; font-style: bold">Filteri:</p>



		<form name = "search_form" method= "POST" action = "ucenici.php">


			<br>
    <label> Odeljenje: </label>
		<br>
		<select name = 'odeljenje'>
				<option value="" disabled selected> Odeljenje </option>
			<?php
			if ($odeljenja->num_rows() > 0)
			{
				foreach($odeljenja->result() as $row)
				{
			?>
								<option option value="<?php echo $row->id; ?>"  > <?php echo $row->oznaka; ?> </option>

				<?php
				}
			}
			else {
				?>
			 <option> Nema odeljenja </option>
			<?php

			}
			?>
		</select>
		<br>
		<br>
		<label>Ime: </label>
		<input type="text" class="form-control" name="name" placeholder="Ime" id ="ime">
		<br>
		<label>Prezime: </label>
		<input type="text" class="form-control" name="surname" placeholder="Prezime" id = "prezime">
  <br>
    	<input type="submit" name = "search" value = "Pretrazi" class="btn btn-primary btn-block" ">


		</form>
	</div>


</div>

</div>





		<?php echo form_close(); ?>

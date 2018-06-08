<!--
	autor:  Dragana Svrkota, 2015/0485
	@version: 1.0
-->
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
		<h1 class="css-header">Upis časa</h1>


			<div style="width: 850px; overflow: hidden;">


 			<form name = "search_form" method= "POST" action = "upis">

				<label>Izaberite za koji predmet želite da upišete čas: <font color = "red"> *** </font></label>
				<br>
				<select name = 'predmet'>

						<option value="" disabled selected> Predmet </option>
					<?php
					if ($predmeti->num_rows() > 0)
					{
						foreach($predmeti->result() as $row)
						{
					?>
										<option option value="<?php echo $row->id; ?>"  > <?php echo $row->ime; ?> </option>

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
				<label> Tema časa: </label>
				<input type="text" class="form-control" name="temaCasa" placeholder="Unesite temu casa">
				<br>
				<label> Redni broj časa: </label>  <input type="text" class="form-control" name="redniBroj" placeholder = "Unesite redni broj casa">
				<br>

				<label> Komentari: </label>
				<br>

				<textarea rows="10" cols="115" name = "komentar">
				</textarea>
				<br>

					<input type="submit" name = "upisiCas" value = "Upiši cas">
			</form>
				<p> <font color = "red"> *** obavezno  </font></p>
		  </div>




	</div>
</div>

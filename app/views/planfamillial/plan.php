<h1>Plan famillial</h1>

<p>Inscrivez ici vos informations</p>

<form class="form-horizontal">
<h2>Membres de votre famille</h2>
<?php for($i=1; $i<5; $i++): ?>
	<div class="row">
		<div class="col-md-12">
			<fieldset>
				<legend>Membre <?php echo $i;?></legend>
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="champNom<?php echo $i;?>" class="col-md-3 control-label">Nom :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="Nom<?php echo $i;?>" id="champNom<?php echo $i;?>" placeholder="Nom">
						</div>
					</div>
					<div class="col-md-6 form-group">
						<label for="champDate<?php echo $i;?>" class="col-md-5 control-label">Date de naissance :</label>
						<div class="col-md-7">
							<input type="email" class="form-control" name="Date<?php echo $i;?>" id="champDate<?php echo $i;?>" placeholder="Date de naissance">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="champTelephone<?php echo $i;?>" class="col-md-3 control-label">Téléphone :</label>
						<div class="col-md-9">
							<input type="email" class="form-control" name="Telephone<?php echo $i;?>" id="champTelephone<?php echo $i;?>" placeholder="Téléphone">
						</div>
					</div>
					<div class="col-md-6 form-group">
						<label for="champCellulaire<?php echo $i;?>" class="col-md-5 control-label">Cellulaire :</label>
						<div class="col-md-7">
							<input type="email" class="form-control" name="Cellulaire<?php echo $i;?>" id="champCellulaire<?php echo $i;?>" placeholder="Cellulaire">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="champAdresse<?php echo $i;?>" class="col-md-3 control-label">Adresse :</label>
						<div class="col-md-9">
							<textarea class="form-control" name="Adresse<?php echo $i;?>" id="champAdresse<?php echo $i;?>" placeholder="Adresse"></textarea>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<label for="champCourriel<?php echo $i;?>" class="col-md-5 control-label">Courriel :</label>
						<div class="col-md-7">
							<input type="email" class="form-control" name="Courriel<?php echo $i;?>" id="champCourriel<?php echo $i;?>" placeholder="Courriel">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label for="champLieuFrequente<?php echo $i;?>" class="col-md-4 control-label">Lieu fréquenté :</label>
						<div class="col-md-8">
							<textarea class="form-control" name="LieuFrequente<?php echo $i;?>" id="champLieuFrequente<?php echo $i;?>" placeholder="Lieu fréquenté"></textarea>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<label for="champInformationMedicale<?php echo $i;?>" class="col-md-5 control-label">Information médicale :</label>
						<div class="col-md-7">
							<textarea class="form-control" name="InformationMedicale<?php echo $i;?>" id="champInformationMedicale<?php echo $i;?>" placeholder="Information médicale"></textarea>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
<?php endfor;?>
<h2>Personnes ressources</h2>
<?php for($i=1; $i<=2; $i++): ?>
<div class="row">
	<div class="col-md-6 form-group">
		<label for="champRessourceNom<?php echo $i;?>" class="col-md-3 control-label">Nom :</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="Nom<?php echo $i;?>" id="champRessourceNom<?php echo $i;?>" placeholder="Nom">
		</div>
	</div>
	<div class="col-md-6 form-group">
		<label for="champRessourceCourriel<?php echo $i;?>" class="col-md-5 control-label">Courriel :</label>
		<div class="col-md-7">
			<input type="email" class="form-control" name="Date<?php echo $i;?>" id="champRessourceCourriel<?php echo $i;?>" placeholder="Courriel">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 form-group">
		<label for="champRessourceTelephone<?php echo $i;?>" class="col-md-3 control-label">Téléphone :</label>
		<div class="col-md-9">
			<input type="tel" class="form-control" name="Nom<?php echo $i;?>" id="champRessourceTelephone<?php echo $i;?>" placeholder="Téléphone">
		</div>
	</div>
	<div class="col-md-6 form-group">
		<label for="champRessourceCellulaire<?php echo $i;?>" class="col-md-5 control-label">Cellulaire :</label>
		<div class="col-md-7">
			<input type="tel" class="form-control" name="Date<?php echo $i;?>" id="champRessourceCellulaire<?php echo $i;?>" placeholder="Cellulaire">
		</div>
	</div>
</div>
<?php endfor;?>
</form>
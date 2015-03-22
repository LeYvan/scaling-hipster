<h1 class="hidden-print">Plan famillial</h1>

<form class="form-horizontal">
	<div role="tabpanel">
		<!-- Nav tabs -->
		<nav class="hidden-print">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#resume" aria-controls="resume" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="hidden-xs"> Résumé</span></a></li>
				<li role="presentation"><a href="#famille" aria-controls="famille" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="hidden-xs"> Famille</span></a></li>
				<li role="presentation"><a href="#ressources" aria-controls="ressources" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span><span class="hidden-xs"> Ressources</span><!-- Personnes ressources --></a></li>
				<li role="presentation"><a href="#maison" aria-controls="maison" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span class="hidden-xs"> Maison</span></a></li>
				<li role="presentation"><a href="#numeros" aria-controls="numeros" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><span class="hidden-xs"> Téléphones</span><!-- Numéros importants --></a></li>
				<li role="presentation"><a href="#rassemblement" aria-controls="rassemblement" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span><span class="hidden-xs"> Rassemblement</span></a></li>
			</ul>
		</nav>

		<!-- Tab panes -->
		<div class="tab-content">

		<!-- VOTRE FAMILLE -->

			<div role="tabpanel" class="tab-pane active" id="resume">
				<!-- <h2>Votre plan famillial</h2> -->
				<div id="resume-contenu"></div>
			</div>
			<div role="tabpanel" class="tab-pane" id="famille">
				<div class="tab-header">
					<h2 class="text-center">Membres de votre famille</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php for($i=1; $i<5; $i++): ?>
							<div class="col-md-12">
								<fieldset>
									<legend>Membre <?php echo $i;?></legend>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champNom<?php echo $i;?>" class="col-md-4 control-label">Nom :</label>
											<div class="col-md-8">
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
											<label for="champTelephone<?php echo $i;?>" class="col-md-4 control-label">Téléphone :</label>
											<div class="col-md-8">
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
											<label for="champAdresse<?php echo $i;?>" class="col-md-4 control-label">Adresse :</label>
											<div class="col-md-8">
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
						<?php endfor;?>
					</div>
				</div>
			</div>

			<!-- PERSONNES RESSOURCES -->

			<div role="tabpanel" class="tab-pane" id="ressources">
				<div class="tab-header">
					<h2>Personnes ressources</h2>
					<p>Personnes à prévenir dans une situation d'urgence (au moins une personne résidant dans votre quartier).</p>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php for($i=1; $i<=2; $i++): ?>
							<div class="col-md-12">
								<fieldset>
									<legend>Personne ressource <?php echo $i;?></legend>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champRessourceNom<?php echo $i;?>" class="col-md-4 control-label">Nom :</label>
											<div class="col-md-8">
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
											<label for="champRessourceTelephone<?php echo $i;?>" class="col-md-4 control-label">Téléphone :</label>
											<div class="col-md-8">
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
								</fieldset>
							</div>
						<?php endfor;?>
					</div>
				</div>
			</div>

			<!-- VOTRE MAISON -->

			<div role="tabpanel" class="tab-pane" id="maison">
				<div class="tab-header">
					<h2>Votre maison</h2>
					<p>Notez l'emplacement des appareils suivants et expliquez leur fonctionnement aux membres de votre famille.</p>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
						$champs = array(
							array("label" => "Extincteur", "id" => "extincteur", "placeholder" => "Ex: À la droite du foyer, au rez de chaussée"),
							array("label" => "Robinet d'entrée d'eau", "id" => "robinet-eau", "placeholder" => "Ex: Au sous-sol, à la gauche de l'établi"),
							array("label" => "Boîte de disjoncteurs", "id" => "disjoncteurs", "placeholder" => "Ex: En dessous de l'escalier du sous-sol"),
							array("label" => "Robinet de gaz", "id" => "robinet-gaz", "placeholder" => "Ex: Derrière la cuisinière"),
							array("label" => "Drain de sol", "id" => "drain", "placeholder" => "Ex: Au pied de l'escalier du sous-sol")
						);
						foreach ($champs as $champ):?>
							<div class="col-md-12 form-group">
								<label for="<?php echo $champ['id'];?>" class="col-md-3 control-label"><?php echo $champ['label'];?> :</label>
								<div class="col-md-9">
									<textarea class="form-control" name="<?php echo $champ['id'];?>" id="<?php echo $champ['id'];?>" placeholder="<?php echo $champ['placeholder'];?>"></textarea>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>

			<!-- NUMÉROS IMPORTANTS -->

			<div role="tabpanel" class="tab-pane" id="numeros">
				<div class="tab-header">
					<h2>Personnes ressources</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
						$champs = array(
							array("label" => "Urgence", "tel" => "9-1-1"),
							array("label" => "Info-Santé", "tel" => "811"),
							array("label" => "Centre antipoison du Québec", "tel" => "1 800 463-5060"),
							array("label" => "Hydro-Québec", "tel" => "1 800 790-2424"),
							array("label" => "Gaz métro", "tel" => "1 800 361-8003")
						);
						foreach ($champs as $champ):?>
							<div class="col-md-6 form-group">
								<label class="col-md-7 control-label"><?php echo $champ['label'];?> :</label>
								<div class="col-md-5">
									<p class="form-control-static"><?php echo $champ['tel'];?></p>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>

			<!-- LIEUX DE RASSEMBLEMENT -->

			<div role="tabpanel" class="tab-pane" id="rassemblement">
				<div class="tab-header">
					<h2>Lieux de rassemblement</h2>
				</div>
			</div>
		</div>
	</div>
</form>
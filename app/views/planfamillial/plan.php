<h1 class="hidden-print">Plan famillial</h1>
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     !!!  À FAIRE: mettre l'attribut « method » et mettre l'attribut « action »  !!!
     !!!                 s'ils sont nécessaires S.V.P. Merci :-)                 !!!
     !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
<form class="form-horizontal" name="PlanFamillial" id="frmPlanFamillial">
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
				<button class="btn btn-primary btn-block hidden-print" type="button" id="btnImprimer"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer</button>
				<h2>Votre plan famillial</h2>
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
											<label for="champNom<?php echo $i;?>" class="col-md-4 col-xs-5 col-sm-3 control-label">Nom :</label>
											<div class="col-md-8 col-xs-7 col-sm-9">
												<input type="text" class="form-control" name="Nom<?php echo $i;?>" id="champNom<?php echo $i;?>" placeholder="Nom">
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champNaissance<?php echo $i;?>" class="col-xs-5 col-sm-3 col-md-5 control-label">Date de naissance :</label>
											<div class="col-xs-7 col-sm-9 col-md-7">
												<input type="date" class="form-control" name="Naissance<?php echo $i;?>" id="champNaissance<?php echo $i;?>" placeholder="Date de naissance">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champTelephone<?php echo $i;?>" class="col-md-4 col-xs-5 col-sm-3 control-label">Téléphone :</label>
											<div class="col-md-8 col-xs-7 col-sm-9">
												<input type="tel" class="form-control" name="Telephone<?php echo $i;?>" id="champTelephone<?php echo $i;?>" placeholder="Téléphone">
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champCellulaire<?php echo $i;?>" class="col-xs-5 col-sm-3 col-md-5 control-label">Cellulaire :</label>
											<div class="col-xs-7 col-sm-9 col-md-7">
												<input type="tel" class="form-control" name="Cellulaire<?php echo $i;?>" id="champCellulaire<?php echo $i;?>" placeholder="Cellulaire">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champAdresse<?php echo $i;?>" class="col-md-4 col-xs-5 col-sm-3 control-label">Adresse :</label>
											<div class="col-md-8 col-xs-7 col-sm-9">
												<textarea class="form-control" name="Adresse<?php echo $i;?>" id="champAdresse<?php echo $i;?>" placeholder="Adresse"></textarea>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champCourriel<?php echo $i;?>" class="col-xs-5 col-sm-3 col-md-5 control-label">Courriel :</label>
											<div class="col-xs-7 col-sm-9 col-md-7">
												<input type="email" class="form-control" name="Courriel<?php echo $i;?>" id="champCourriel<?php echo $i;?>" placeholder="Courriel">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champLieuFrequente<?php echo $i;?>" class="col-md-4 col-xs-5 col-sm-3 control-label">Lieu fréquenté :</label>
											<div class="col-md-8 col-xs-7 col-sm-9">
												<textarea class="form-control" name="LieuFrequente<?php echo $i;?>" id="champLieuFrequente<?php echo $i;?>" placeholder="Lieu fréquenté"></textarea>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champInformationMedicale<?php echo $i;?>" class="col-xs-5 col-sm-3 col-md-5 control-label">Information médicale :</label>
											<div class="col-xs-7 col-sm-9 col-md-7">
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
											<label for="champRessourceNom<?php echo $i;?>" class="col-md-4 col-sm-2 col-xs-3 control-label">Nom :</label>
											<div class="col-md-8 col-xs-9 col-sm-10">
												<input type="text" class="form-control" name="Nom<?php echo $i;?>" id="champRessourceNom<?php echo $i;?>" placeholder="Nom">
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champRessourceCourriel<?php echo $i;?>" class="col-md-5 col-sm-2 col-xs-3 control-label">Courriel :</label>
											<div class="col-xs-9 col-md-7 col-sm-10">
												<input type="date" class="form-control" name="Date<?php echo $i;?>" id="champRessourceCourriel<?php echo $i;?>" placeholder="Courriel">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="champRessourceTelephone<?php echo $i;?>" class="col-md-4 col-sm-2 col-xs-3 control-label">Téléphone :</label>
											<div class="col-md-8 col-xs-9 col-sm-10">
												<input type="text" class="form-control" name="Nom<?php echo $i;?>" id="champRessourceTelephone<?php echo $i;?>" placeholder="Téléphone">
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label for="champRessourceCellulaire<?php echo $i;?>" class="col-md-5 col-sm-2 col-xs-3 control-label">Cellulaire :</label>
											<div class="col-xs-9 col-md-7 col-sm-10">
												<input type="date" class="form-control" name="Date<?php echo $i;?>" id="champRessourceCellulaire<?php echo $i;?>" placeholder="Cellulaire">
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
							array("label" => "Extincteur", "id" => "Dxtincteur", "placeholder" => "Ex: À la droite du foyer, au rez de chaussée"),
							array("label" => "Robinet d'entrée d'eau", "id" => "Eau", "placeholder" => "Ex: Au sous-sol, à la gauche de l'établi"),
							array("label" => "Boîte de disjoncteurs", "id" => "Disjoncteurs", "placeholder" => "Ex: En dessous de l'escalier du sous-sol"),
							array("label" => "Robinet de gaz", "id" => "Gaz", "placeholder" => "Ex: Derrière la cuisinière"),
							array("label" => "Drain de sol", "id" => "Disjoncteursrain", "placeholder" => "Ex: Au pied de l'escalier du sous-sol")
						);
						foreach ($champs as $champ):?>
							<div class="col-md-12 form-group">
								<label for="champ<?php echo $champ['id'];?>" class="col-md-3 control-label"><?php echo $champ['label'];?> :</label>
								<div class="col-md-9">
									<textarea class="form-control" name="<?php echo $champ['id'];?>" id="champ<?php echo $champ['id'];?>" placeholder="<?php echo $champ['placeholder'];?>"></textarea>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>

			<!-- NUMÉROS IMPORTANTS -->

			<div role="tabpanel" class="tab-pane" id="numeros">
				<div class="tab-header">
					<h2>Téléphones importants</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
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
									<div class="col-sm-6 form-group">
										<label class="col-xs-6 control-label"><?php echo $champ['label'];?> :</label>
										<div class="col-xs-6">
											<p class="form-control-static"><?php echo $champ['tel'];?></p>
										</div>
									</div>
								<?php endforeach;?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group">
									<label for="champArrondissement" class="col-sm-3 col-md-6 col-xs-6 control-label">Arrondissement :</label>
									<div class="col-xs-6 col-sm-9 col-md-6">
										<textarea class="form-control" name="Arrondissement" id="champArrondissement" placeholder=""></textarea>
									</div>
								</div>

								<div class="col-md-6 form-group">
									<label for="champClinique" class="col-sm-3 col-md-6 col-xs-6 control-label">Clinique médicale :</label>
									<div class="col-xs-6 col-sm-9 col-md-6">
										<input type="tel" class="form-control" name="Clinique" id="champClinique" placeholder="Téléphone" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group">
									<label for="champPharmacie" class="col-sm-3 col-md-6 col-xs-6 control-label">Pharmacie :</label>
									<div class="col-xs-6 col-sm-9 col-md-6">
										<input type="tel" class="form-control" name="Pharmacie" id="champPharmacie" placeholder="Téléphone" />
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label for="champVétérinaire" class="col-sm-3 col-md-6 col-xs-6 control-label">Vétérinaire :</label>
									<div class="col-xs-6 col-sm-9 col-md-6">
										<input type="tel" class="form-control" name="Veterinaire" id="champVétérinaire" placeholder="Téléphone" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
								$champs = array(
									array("label" => "habitation", "short" => "Habitation"),
									array("label" => "automobile", "short" => "Automobile")
								);
								foreach ($champs as $champ):?>
									<fieldset>
										<legend>Assurance <?php echo $champ['label'];?></legend>
										<div class="row">
											<div class="col-md-12">								
												<div class="col-md-12 form-group">
													<label for="champAss<?php echo $champ['short'];?>" class="col-xs-6 col-sm-4 col-md-4 control-label">Nom de la compagnie :</label>
													<div class="col-xs-6 col-sm-8 col-md-8">
														<input type="text" class="form-control" name="NomAss<?php echo $champ['short'];?>" id="champNomAss<?php echo $champ['short'];?>" placeholder="Nom de la compagnie" />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">								
												<div class="col-md-7 form-group">
													<label for="champAss<?php echo $champ['short'];?>" class="col-xs-6 col-sm-4 col-md-7 control-label">Numéro de police :</label>
													<div class="col-xs-6 col-sm-8 col-md-5">
														<input type="number" class="form-control" name="PoliceAss<?php echo $champ['short'];?>" id="champNomAss<?php echo $champ['short'];?>" placeholder="Nom de la compagnie" />
													</div>
												</div>
												<div class="col-md-5 form-group">
													<label for="champAss<?php echo $champ['short'];?>" class="col-xs-6 col-sm-4 col-md-4 control-label">Téléphone :</label>
													<div class="col-xs-6 col-sm-8 col-md-8">
														<input type="text" class="form-control" name="TelAss<?php echo $champ['short'];?>" id="champTelAss<?php echo $champ['short'];?>" placeholder="Nom de la compagnie" />
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- LIEUX DE RASSEMBLEMENT -->

			<div role="tabpanel" class="tab-pane" id="rassemblement">
				<div class="tab-header">
					<h2>Lieux de rassemblement</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
						$champs = array(
							array("legend" => "Dans le quartier", "short" => "Quartier"),
							array("legend" => "Hors de votre quartier", "short" => "HorsQuartier")
						);
						foreach ($champs as $champ):?>
							<div class="col-md-12">
								<fieldset>
									<legend><?php echo $champ["legend"];?></legend>
									<div class="col-md-6 form-group">
										<label class="col-md-4 col-xs-5 control-label">Adresse :</label>
										<div class="col-md-8 col-xs-7">
											<textarea class="form-control" name="Adresse<?php echo $champ['short'];?>" id="champAdresse<?php echo $champ['short'];?>" placeholder="Adresse"></textarea>
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label class="col-md-4 col-xs-5 control-label">Téléphone :</label>
										<div class="col-md-8 col-xs-7">
											<input type="tel" class="form-control" name="Telephone<?php echo $champ['short'];?>" id="champTelephone<?php echo $champ['short'];?>" placeholder="Téléphone" />
										</div>
									</div>
								</fieldset>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="text-right">
		<button type="submit" class="btn btn-primary">Sauvegarder</button>
	</div>
</form>
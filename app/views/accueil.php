		<div id="accueil">
			<div class="row">
				<div class="col-md-12">
					<h2 class="sr-only">Récemment</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-faireface">
								<div class="panel-heading">
									<h3 class="panel-title">Alertes</h3>
									<p class="tout-lire pull-right"><a href="/alertes">Tout lire</a></p>
								</div>
								<div class="panel-body">
									<div class="list-group fill">
										<?php foreach($alertes as $alerte):?>
											<li class="list-group-item">
												<h4 class="list-group-item-heading"><?php echo $alerte->utilisateur()->nom;?></h4>
												<p class="list-group-item-text"><?php echo Str::words($alerte->contenu,10);?> <a href="#">Lire la suite</a></p>
											</li>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-faireface">
								<div class="panel-heading">
									<h3 class="panel-title">Nouvelles</h3>
									<p class="tout-lire pull-right"><a href="/nouvelles">Tout lire</a></p>
								</div>
								<div class="panel-body">
									<div class="list-group fill">
										<?php foreach($nouvelles as $nouvelle):?>
											<li class="list-group-item">
												<h4 class="list-group-item-heading"><?php echo Str::words($nouvelle->titre,5);?></h4>
												<p class="list-group-item-text"><?php echo Str::words($nouvelle->contenu,10);?> <a href="#">Lire la suite</a></p>
											</li>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-faireface">
								<div class="panel-heading">
									<h3 class="panel-title">Capsules</h3>
									<p class="tout-lire pull-right"><a href="/capsules">Tout lire</a></p>
								</div>
								<div class="panel-body">
									<div class="list-group fill">
										<?php foreach($capsules as $capsule):?>
											<li class="list-group-item">
												<h4 class="list-group-item-heading"><?php echo Str::words($capsule->titre,4);?></h4>
												<p class="list-group-item-text"><?php echo Str::words($capsule->contenu,6);?></p>
												<p><a href="#">Lire la suite</a> <!-- <span class="label label-info"><?php echo $capsule->categorie()->etiquette;?></span> --></p>
											</li>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-faireface">
								<div class="panel-heading">
									<h3 class="panel-title">Sinistres</h3>
									<p class="tout-lire pull-right"><a href="/sinistres">Tout lire</a></p>
								</div>
								<div class="panel-body">
									<div class="list-group fill">
										<?php foreach($sinistres as $sinistre):?>
											<li class="list-group-item">
												<h4 class="list-group-item-heading"><?php echo Str::words($sinistre->titre,5);?></h4>
												<p class="list-group-item-text"><?php echo Str::words($sinistre->rapport,10);?> <a href="#">Lire la suite</a></p>
											</li>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

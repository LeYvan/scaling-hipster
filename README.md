<div id="contenu">
    <header>
        <h1>Faireface</h1>
        <p>Ce fichier décrit la procédure de déploiement de l'application faireface.ca.</p>
        <nav>
            <ol>
                <li><a href="#info">Informations</a></li>
                <li><a href="#prereq">Prérequis</a></li>
                <li><a href="#install">Installation</a></li>
                <li><a href="#init">Initialisation</a></li>
            </ol>
        </nav>
    </header>
    <article>
        <section>
            <h2 id="info">Informations</h2>
            <p>Faireface fut développé en PHP à l'aide du framework Laravel.</p>
            <p>Laravel utilise le gestionnaire de dépendance composer.</p>
            <section>
                <h3>Configuration (LEMP)</h3>
                <ul>
                    <li>OS: Linux/Debian</li>
                    <li>Serveur HTTP: nginx</li>
                    <li>Serveur DB: MySQL</li>
                </ul>
            </section>
            <h3>Liens</h3>
            <ul>
                <li><a href="http://laravel.com/">Laravel</a></li>
                <li><a href="https://getcomposer.org/">Composer</a></li>
                <li><a href="http://en.wikipedia.org/wiki/LAMP_(software_bundle)">LEMP</a></li>
            </ul>
        </section>
        <section>
            <h2 id="prereq">Prérequis</h2>
            <p>Avant de procéder à l'installation de l'application, l'environement doit être correctement configuré.</p>
            <ol>
                <li>La librairie mcrypt doit être installée.</li>
                <li>L'extention php-mcrypt doit être installée.</li>
                <li>Le serveur doit pouvoir interpréter les fichiers php.</li>
                <li>Le serveur doit DB être fonctionnel.</li>
            </ol>
            <p>Le reste du document prends pour acquis:</p>
            <ul>
                <li>Que le serveur est fonctionnel et que les informations de connexions au serveur de BD sont disponibles.</li>
                <li>Que la machine n'héberge qu'un seul site.</li>
            </ul>
        </section>
        <section>
            <h2 id="install">Installation</h2>
            <h3>Récupération du code</h3>
            <p><span>Dans un environement Debian, par défaut, le dossier racine des fichiers publiques de nginx sont situés dans </span><code>/usr/share/nginx/</code><span>.</span></p>
            <p>
                <span>Il faut </span>
                <attr title="Il s&#39;agit de récupérer les fichiers du contrôle de source dans un emplacement local.">cloner </attr>
                <span>le dépot de faireface à partir de github à cet emplacement à l'aide de la commande </span><code>git clone https://github.com/LeYvan/scaling-hipster.git faireface</code><span> .</span>
            </p>
            <p><span>À la suite de l'execution de cette commande, le dépot devrait être disponible dans le dossier </span><code>/usr/share/nginx/faireface/</code><span> .</span></p>
            <h3>Installation de composer</h3>
            <p><span>Le projet nescessite le gestionaire de dépendances </span><code>composer </code><span>.</span></p>
            <p>Il faut l'installer de le dossier de faireface, car nous avons choisi d'exclure ses fichiers du dépot pour dimminuer la complexité d'utilisation de git.</p>
            <p>
                <span>Rendez-vous dans le dossier </span><code>/usr/share/nginx/faireface/</code><span>et lancez la commande </span><code>php -r "readfile('https://getcomposer.org/installer');" | php </code>
                <pour>pour y télécharger les fichiers de composer.</pour>
            </p>
            <p>asd
                span Une fois composer téléchargé, le fichier composer.phar est créé.
            </p>
            <h3>Sécurité / Fichier critique</h3>
            <p>Pour executer la dernière étape d'installation, un fichier critique doit être créé manuellement.</p>
            <p>Ce fichier contient les informations d'authentification pour le service de messagerie SMS Twillio.</p>
            <p><span>Dans le dossier </span><code>./faireface/app/commands/</code><span>il faut créé le fichier </span><code>.secure.php</code><span> et y insérer le code suivant:</span><code>&lt;?php $GLOBALS['account_sid'] = 'xxx'; $GLOBALS['auth_token'] = 'yyy';?&gt;</code><span>.</span></p>
            <p>Il faut remplacer xxx et yyy par vos informations confidentielles. </p>
            <p>Si ce fichier n'existe pas lors de l'execution de la prochaine commande, le processus échouera.</p>
        </section>
        <section>
            <h3>Dépendances</h3>
            <p><span>À la racine du dossier faireface, executer: </span><code>php composer.phar install</code></p>
            <p>Ceci lancera le téléchargement de Laravel et de ses dépendances.</p>
            <p>La base de code du projet est maintenant techniquement fonctionnelle, il faut la rendre executable.</p>
        </section>
        <section>
            <h3>Nginx</h3>
            <p>La combinaison Laravel+Nginx nescéssite une configuration particulière.</p>
            <p>Il faut modifier le fichier du site par défaut dans la configuration de nginx.</p>
            <p><span>Pour ce faire éditer le fichier</span><code>/etc/nginx/site-availables/default</code><span> .</span></p>
            <p><span>Remplacer tout le contenu par:</span>
            <pre>
    #faireface
    server {
            listen 80 default_server;
            #listen [::]:80 default_server ipv6only=on;
     
            root /usr/share/nginx/faireface/public;
            index index.php;
     
            server_name faireface.ca;
     
            client_max_body_size 10m;

            # Envoiver scripts php vers php5-fpm
            location ~ \.php$ {
                    fastcgi_split_path_info ^(.+\.php)(/.+)$;
                    fastcgi_pass unix:/var/run/php5-fpm.sock;
                    fastcgi_index index.php;
                    include fastcgi_params;
            }
     
            # Sauf si on demande un fichier, on redirige vers index.php de laravel
            if (!-e $request_filename)
            {
                rewrite ^/(.*)$ /index.php?/$1 last;
                break;
            }
    }
            </pre>.
            </p>
            <p>Vous devez modifier les chemins pour pointer vers l'emplacement de l'application sur votre machine.</p>
        </section>
        <section>
            <h3>MySQL</h3>
            <h4>Laravel</h4>
            <p><span>Au lignes 59 et 60 dans le fichier </span><code>app/config/database.php</code><span> modifier les informations d'authentification pour MySQL.</span></p>
            <h4>MySQL</h4>
            <p><span>De plus, vous devez créer une base de données nommée faireface qui sera remplie à la phase d'initialisation. Executer: </span><code> mysql -uroot -proot -e "CREATE DATABASE faireface;"</code><span> où root/root sont remplacés par vos information d'authentification.</span></p>
        </section>
        <section>
            <h3>Permissions</h3>
            <p>Laravel nescéssite des permissions précises sur certains dossiers.</p>
            <p><span>Le fichier </span><code>./faireface/set-permission.sh</code><span> doit être executé avec les droits </span><code>root</code><span> .</span></p>
            <p>L'application est prête à fonctionner. Il faur remplir la base de données.</p>
        </section>
        <section>
            <h2 id="init">Initilisation</h2>
            <section>
                <h3>Schéma de donnée</h3>
                <p><span>À la racine du dossier, executer: </span><code>php artisan migrate</code></p>
                <h3>Génération de données de développement</h3>
                <p><span>Toujours à la racine du dossier faireface, executer: </span><code>php artisan db:seed</code><span> .</span></p>
                <p>Ceci rendra l'application foncionelle, testable et navigable. Félicitations.</p>
            </section>
        </section>
        <section>
            <h2 id="trouble">Troubleshooting</h2>
            <div>
                <h3>Erreur: mcrypt_encrypt(): Key of size 12 not supported by this algorithm. Only keys of sizes 16, 24 or 32 supported</h3>
                <p><span>Pour régler ce problème, à la racine du dossier faireface, executer la commande: </span><code>php artisan key:generate</code><span>.</span></p>
            </div>
            <div>
                <h3>Erreur: could not find driver</h3>
                <p><span>Vérifier vos informations de connexion de base de données dans le fichier </span><code>./faireface/app/config/database.php</code><span> .</span></p>
                <p>De plus, vérifier si l'extention php5-mysql est correctement installée.</p>
            </div>
            <div>
                <h3>Erreur: SQLSTATE[42000] [1049] Unknown database 'faireface'</h3>
                <p><span>Créer une base de données nommée "faireface" dans MySQL.</span></p>
            </div>
        </section>
    </article>
</div>

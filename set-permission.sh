#1. le dossier faireface doit appartenir à l'utilisateur www-data
#2. pour pouvoir modifier les fichiers par l'utilisateur actuelelement loggé,
#   on l'ajoute au groupe www-data
#3. pour que les fichiers et dossiers créés par l'utilisateur courant
#   appartiennent à www-data plutôt qu'à lui-même, on set l'héritance
#   d'appartenance pour les nouveaux fichiers.
chown -R www-data:www-data ../faireface
usermod -a -G www-data $USER
chmod g+s ../faireface
 
#Droit d'écriture de groupe sur le dossier .git
sudo chmod -R g+ws .git
#dire à git d'utiliser les permissions de groupe de l'utilisateur courant
git config core.sharedRepository true
#sudo chgrp -R www-data .git
echo "\033[0;31mVous devez vous relogger avant que les permissions (de groupes) soient prises en compte."

Mod�le de Module pour le site Intranet

Ce r�pertoire template contient la structure par d�faut qu'il faut utiliser pour cr�er ou mettre � jour un module Intranet

Pour cr�er un nouveau module, recopier template en lui donnant le nom du module
Exemple depuis la ligne de commande du syst�me:
cp -R /home/www/intranet.dev/template /home/www/intranet.dev/nouveau_module

Ensuite d�clarez ce nouveau module au niveau de MySQL dans la table intranet_modules:
Pour un module du site intranet utilisez la base agis
Pour un module du site intranet.dev utilisez la base agis_dev
Enregistrez les informations du module dans la table intranet_module

Explication du contenu du r�pertoire:
archives/      Contient les vieux fichiers que vous souhaitez tout de m�me garder
cli/           Contient les fichiers d�di�s � �tre ex�cut� en ligne de commande
data/          Donn�es du module sous forme de fichiers (ex: .pdf, .txt, .cvs...)
doc/           Contient la documentation utilisateur du module
images/        banque d'images limit�e au module

Explication des fichiers:
index.php           Page de d�marrage du module
functions.php       Libraire de fonctions PHP propres au module
functions.js        Libraire de fonctions JavaScript propres au module. Le JavaScript doit �tre utiliser quand extr�me recours
action.php          Page ex�cut� apr�s chaque page PHP. Il ex�cute les actions demand�es puis redirige
menu_principal.inc  Menu de liens apparaisant sur les pages PHP du module
php.map             Cartographie des relations entres les pages php du module
sql.map             Cartographie des relations entres les tables MySQL du module
readme.txt          Ce fichier !!!
release-x.x.txt     Description des modifications r�alis�es et restant � r�aliser
online-x.x.txt      Historique des modifications techniques � r�aliser lors de la migration vers le site d'exploitation
template.php        Doit �tre utilis� comme mod�le pour cr�er d'autres pages PHP


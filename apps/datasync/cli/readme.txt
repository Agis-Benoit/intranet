Contient des scripts PHP autonome qui s'execute directement depuis le syst�me en ligne de commande
CLI signifie Command Line Interface

Ce r�pertoire n'est pas accessible depuis le service HTTP (cf .htaccess)

[datasync.sh]

le fichier datasync.sh lance le fichier "../index.php" pour actualiser le script de recopie intersite "netcopy.sh"
puis ex�cute ce script "netcopy.sh"

il est lanc� par le programmateur cron via le fichier /etc/crontab

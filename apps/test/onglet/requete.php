<?php
include('./connection/connection.php');//inclu les param�tres de connection � la base de donn�e
    if (!$connect)//si pas connecter a la base de donn�e d�clenche une �rreur SQL
       die("Erreur de connection � MySQL: ".mysql_error());	   
if (!mysql_select_db($database_connect, $connect))//si base non trouv�e d�clenche une erreur SQL
       die("Erreur base de donn�e non trouv�e: ".mysql_error());   
if($HTTP_GET_VARS['page'])//pour soucis de compatibilit� de test en local ou sur site distant verifie la pr�sence de la variable dans l'url
{
	$contenu=$HTTP_GET_VARS['page'];//r�cup�re la variable de la m�thode GET
}else{
	$contenu=$_GET['page'];//idem pour la r�cup�ration en local
}
$select= "SELECT * FROM multionglet";//s�lectionne la table pour la gestion du contenu
$Requete_Contenu=mysql_query($select,$connect) or die("Erreur table non trouv�e:".mysql_error());//d�clenche une erreur si la table n'est pas trouv�
while ($row = mysql_fetch_object($Requete_Contenu)){//boucle pour parcourir la table multionglet
	if ($row->onglet==$contenu)//verifie si la variable est identique a celle touver dans la base de donn�e
		{
				echo "<br/>".mb_convert_encoding($row->contenu, "UTF-8", "ISO-8859-1")."<br/><br/>";//affichage du contenu qui sera retourner par la requete AJAX
		}
}
mysql_close($connect);//fermeture de la connection SQL
?>

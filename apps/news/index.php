<?php

/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/
   //$module = substr(strrchr(`pwd`, '/'), 1);

/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

//   $module='';

/*********
Inclusions
*********/
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/functions.php");         //Timeout de déconnexion

//Redirection vers la page par défaut du module
header ("Location: rapide.php");



/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $action = '';                       //Action proposée à la page action.php
   $method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/


/***********
Fin Code PHP
***********/


/**************
Début Code HTML
**************/
/*
echo "
     <form $method action=action.php>
     <input type=hidden name=action value=$action>

     <$html_table>
     <tr class=titre_principal><td>

         Module Modèle à partir du quel vous pouvez créer de nouveaux modules<br>
         Il constitue la '' SPECIFICATION'' à respecter.<br>

     </td></tr>
     <tr><td>

         &nbsp&nbsp&nbsp&nbsp
         Voici le Module permettant de créer d'autres modules.<br>
         <br>
         Comment installer un nouveau module ?<br>
         - Copier /template<br>
         - Déclarer le module dans la table MYSQL `intranet_modules`<br>
         - Configurer les droits d'accès<br>
         - Effectuer la migration de intranet.dev.agis.fr vers intranet.agis.fr<br>
         <br>
         Pensez à optimiser, centraliser et commenter votre code au maximum !<br>
         Boris - 2003.08.12<br>
         <br>
         <br>
         <a href='readme.txt'>Télécharger le ficher readme.txt</a>

     </td></tr>
     <tr><td>

         <center>
         <input type=submit value='Ok'>
         </center>

     </td></tr>
     </table>

     </form>
     ";
*/

/************
Fin Code HTML
************/

/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");
?>


<?php

//Redirection vers la page par défaut du module
//header ("Location: indexft.php");

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr('pwd', '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);



/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "width=100% "
        . "class=titre "
;
//$html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
//$html_color_modif = "bgcolor=#B0FFFE";
$version_modif = 1;                        //Activer la visualisation des modifications effectuées depuis la version précédente
$show_help = 1;                              //Activer l'aide en ligne Pop-up
$bloc = "";

/**
 * @todo  règle de nommage du lancement 
 * Attention dans la version 2 de la BDD certains champs possèdent des accents
 * -fta.Unité_Facturation
 * -fta.Coût_Denrée
 * -fta.Coût_Emballage
 * -fta.Coût_Autre
 * -fta.Coût_PF
 * Lors du transfère retier les clé étrangère entre les tables
 */
/**
 * Création de la base de données
 */
{
    DatabaseOperation::execute(
            "DROP DATABASE intranet_v3_0_dev;"
    );

    DatabaseOperation::execute(
            "CREATE DATABASE intranet_v3_0_dev CHARACTER SET utf8 COLLATE utf8_general_ci;"
    );
}

/* * *
 * Recuperations des données de la V2 avec la structure de la V3
 */ {

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article LIKE intranet_v3_0_cod.classification_arborescence_article ;"
            . " INSERT INTO intranet_v3_0_dev.classification_arborescence_article SELECT * FROM intranet_v2_0_prod.classification_arborescence_article;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie LIKE intranet_v3_0_cod.classification_arborescence_article_categorie ;"
            . " INSERT INTO intranet_v3_0_dev.classification_arborescence_article_categorie SELECT * FROM intranet_v2_0_prod.classification_arborescence_article_categorie;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie_contenu LIKE intranet_v3_0_cod.classification_arborescence_article_categorie_contenu ;"
            . " INSERT INTO intranet_v3_0_dev.classification_arborescence_article_categorie_contenu SELECT * FROM intranet_v2_0_prod.classification_arborescence_article_categorie_contenu;"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fte_fournisseur LIKE intranet_v3_0_cod.fte_fournisseur;"
            . " INSERT INTO intranet_v3_0_dev.fte_fournisseur SELECT * FROM intranet_v2_0_prod.fte_fournisseur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.geo LIKE intranet_v3_0_cod.geo;"
            . " INSERT INTO intranet_v3_0_dev.geo SELECT * FROM intranet_v2_0_prod.geo"
    );



    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.geo_codesoft LIKE intranet_v3_0_cod.geo_codesoft;"
            . " INSERT INTO intranet_v3_0_dev.geo_codesoft SELECT * FROM intranet_v2_0_prod.geo_codesoft"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.groupes LIKE intranet_v3_0_cod.groupes;"
            . " INSERT INTO intranet_v3_0_dev.groupes SELECT * FROM intranet_v2_0_prod.groupes"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.planning_presence_semaine_visible LIKE intranet_v3_0_cod.planning_presence_semaine_visible;"
            . " INSERT INTO intranet_v3_0_dev.planning_presence_semaine_visible SELECT * FROM intranet_v2_0_prod.planning_presence_semaine_visible"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_agrologic_article_codification LIKE intranet_v3_0_cod.annexe_agrologic_article_codification;"
            . " INSERT INTO intranet_v3_0_dev.annexe_agrologic_article_codification SELECT * FROM intranet_v2_0_prod.annexe_agrologic_article_codification"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_allergene LIKE intranet_v3_0_cod.annexe_allergene;"
            . " INSERT INTO intranet_v3_0_dev.annexe_allergene SELECT * FROM intranet_v2_0_prod.annexe_allergene"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_additif LIKE intranet_v3_0_cod.annexe_additif;"
            . " INSERT INTO intranet_v3_0_dev.annexe_additif SELECT * FROM intranet_v2_0_prod.annexe_additif"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_service LIKE intranet_v3_0_cod.access_materiel_service;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_service SELECT * FROM intranet_v2_0_prod.access_materiel_service"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_additif_groupe LIKE intranet_v3_0_cod.annexe_additif_groupe;"
            . " INSERT INTO intranet_v3_0_dev.annexe_additif_groupe SELECT * FROM intranet_v2_0_prod.annexe_additif_groupe"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_allergene_famille LIKE intranet_v3_0_cod.annexe_allergene_famille;"
            . " INSERT INTO intranet_v3_0_dev.annexe_allergene_famille SELECT * FROM intranet_v2_0_prod.annexe_allergene_famille"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_allergene_origine LIKE intranet_v3_0_cod.annexe_allergene_origine;"
            . " INSERT INTO intranet_v3_0_dev.annexe_allergene_origine SELECT * FROM intranet_v2_0_prod.annexe_allergene_origine"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_arome_categorie LIKE intranet_v3_0_cod.annexe_arome_categorie;"
            . " INSERT INTO intranet_v3_0_dev.annexe_arome_categorie SELECT * FROM intranet_v2_0_prod.annexe_arome_categorie"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique LIKE intranet_v3_0_cod.annexe_caracteristique_scientifique;"
            . " INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique SELECT * FROM intranet_v2_0_prod.annexe_caracteristique_scientifique"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe LIKE intranet_v3_0_cod.annexe_caracteristique_scientifique_groupe;"
            . " INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe SELECT * FROM intranet_v2_0_prod.annexe_caracteristique_scientifique_groupe"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation LIKE intranet_v3_0_cod.annexe_environnement_conservation;"
            . " INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation SELECT * FROM intranet_v2_0_prod.annexe_environnement_conservation"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation_groupe LIKE intranet_v3_0_cod.annexe_environnement_conservation_groupe;"
            . " INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation_groupe SELECT * FROM intranet_v2_0_prod.annexe_environnement_conservation_groupe"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_pays LIKE intranet_v3_0_cod.annexe_pays;"
            . " INSERT INTO intranet_v3_0_dev.annexe_pays SELECT * FROM intranet_v2_0_prod.annexe_pays"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_unite LIKE intranet_v3_0_cod.annexe_unite;"
            . " INSERT INTO intranet_v3_0_dev.annexe_unite SELECT * FROM intranet_v2_0_prod.annexe_unite"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.archcomment LIKE intranet_v3_0_cod.archcomment;"
            . " INSERT INTO intranet_v3_0_dev.archcomment SELECT * FROM intranet_v2_0_prod.archcomment"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.archlu LIKE intranet_v3_0_cod.archlu;"
            . " INSERT INTO intranet_v3_0_dev.archlu SELECT * FROM intranet_v2_0_prod.archlu"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.articlece LIKE intranet_v3_0_cod.articlece;"
            . " INSERT INTO intranet_v3_0_dev.articlece SELECT * FROM intranet_v2_0_prod.articlece"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.articles LIKE intranet_v3_0_cod.articles;"
            . " INSERT INTO intranet_v3_0_dev.articles SELECT * FROM intranet_v2_0_prod.articles"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.artstat LIKE intranet_v3_0_cod.artstat;"
            . " INSERT INTO intranet_v3_0_dev.artstat SELECT * FROM intranet_v2_0_prod.artstat"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.catsopro LIKE intranet_v3_0_cod.catsopro;"
            . " INSERT INTO intranet_v3_0_dev.catsopro SELECT * FROM intranet_v2_0_prod.catsopro"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client LIKE intranet_v3_0_cod.classification_arborescence_client;"
            . " INSERT INTO intranet_v3_0_dev.classification_arborescence_client SELECT * FROM intranet_v2_0_prod.classification_arborescence_client"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client_groupe LIKE intranet_v3_0_cod.classification_arborescence_client_groupe;"
            . " INSERT INTO intranet_v3_0_dev.classification_arborescence_client_groupe SELECT * FROM intranet_v2_0_prod.classification_arborescence_client_groupe"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_article LIKE intranet_v3_0_cod.classification_article;"
            . " INSERT INTO intranet_v3_0_dev.classification_article SELECT * FROM intranet_v2_0_prod.classification_article"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.classification_article_rayon LIKE intranet_v3_0_cod.classification_article_rayon;"
            . " INSERT INTO intranet_v3_0_dev.classification_article_rayon SELECT * FROM intranet_v2_0_prod.classification_article_rayon"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes LIKE intranet_v3_0_cod.codesoft_etiquettes;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_etiquettes SELECT * FROM intranet_v2_0_prod.codesoft_etiquettes"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes_logo LIKE intranet_v3_0_cod.codesoft_etiquettes_logo;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_etiquettes_logo SELECT * FROM intranet_v2_0_prod.codesoft_etiquettes_logo"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_historique_satel LIKE intranet_v3_0_cod.codesoft_historique_satel;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_historique_satel SELECT * FROM intranet_v2_0_prod.codesoft_historique_satel"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_imprimante LIKE intranet_v3_0_cod.codesoft_imprimante;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_imprimante SELECT * FROM intranet_v2_0_prod.codesoft_imprimante"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_style_paragraphe LIKE intranet_v3_0_cod.codesoft_style_paragraphe;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_style_paragraphe SELECT * FROM intranet_v2_0_prod.codesoft_style_paragraphe"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.droitft LIKE intranet_v3_0_cod.droitft;"
            . " INSERT INTO intranet_v3_0_dev.droitft SELECT * FROM intranet_v2_0_prod.droitft"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.erp_datasync LIKE intranet_v3_0_cod.erp_datasync;"
            . " INSERT INTO intranet_v3_0_dev.erp_datasync SELECT * FROM intranet_v2_0_prod.erp_datasync"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche LIKE intranet_v3_0_cod.fiches_mp_achats_moteur_de_recherche;"
            . " INSERT INTO intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche SELECT * FROM intranet_v2_0_prod.fiches_mp_achats_moteur_de_recherche"
    );


    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_derogation_duree_vie LIKE intranet_v3_0_cod.fta_derogation_duree_vie;"
            . " INSERT INTO intranet_v3_0_dev.fta_derogation_duree_vie SELECT * FROM intranet_v2_0_prod.fta_derogation_duree_vie"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_duree_vie LIKE intranet_v3_0_cod.fta_duree_vie;"
            . " INSERT INTO intranet_v3_0_dev.fta_duree_vie SELECT * FROM intranet_v2_0_prod.fta_duree_vie"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_migration_import_articles_actifs LIKE intranet_v3_0_cod.fta_migration_import_articles_actifs;"
            . " INSERT INTO intranet_v3_0_dev.fta_migration_import_articles_actifs SELECT * FROM intranet_v2_0_prod.fta_migration_import_articles_actifs"
    );


    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_processus_delai LIKE intranet_v3_0_cod.fta_processus_delai;"
            . " INSERT INTO intranet_v3_0_dev.fta_processus_delai SELECT * FROM intranet_v2_0_prod.fta_processus_delai"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_processus_etat LIKE intranet_v3_0_cod.fta_processus_etat;"
            . " INSERT INTO intranet_v3_0_dev.fta_processus_etat SELECT * FROM intranet_v2_0_prod.fta_processus_etat"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_processus_multisite LIKE intranet_v3_0_cod.fta_processus_multisite;"
            . " INSERT INTO intranet_v3_0_dev.fta_processus_multisite SELECT * FROM intranet_v2_0_prod.fta_processus_multisite"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_tarif LIKE intranet_v3_0_cod.fta_tarif;"
            . " INSERT INTO intranet_v3_0_dev.fta_tarif SELECT * FROM intranet_v2_0_prod.fta_tarif"
    );
}




/**
 * Création de tables de la V2 vers V3
 */ {
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_base_degust_mois LIKE  intranet_v2_0_prod.access_base_degust_mois;"
            . " INSERT INTO intranet_v3_0_dev.access_base_degust_mois SELECT * FROM intranet_v2_0_prod.access_base_degust_mois;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_base_degust_motifs LIKE  intranet_v2_0_prod.access_base_degust_motifs;"
            . " INSERT INTO intranet_v3_0_dev.access_base_degust_motifs SELECT * FROM intranet_v2_0_prod.access_base_degust_motifs;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_base_degust_produits LIKE  intranet_v2_0_prod.access_base_degust_produits;"
            . " INSERT INTO intranet_v3_0_dev.access_base_degust_produits SELECT * FROM intranet_v2_0_prod.access_base_degust_produits;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_base_degust_resultat LIKE  intranet_v2_0_prod.access_base_degust_resultat;"
            . " INSERT INTO intranet_v3_0_dev.access_base_degust_resultat SELECT * FROM intranet_v2_0_prod.access_base_degust_resultat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_accomptes LIKE  intranet_v2_0_prod.access_budget_marketing_accomptes;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_accomptes SELECT * FROM intranet_v2_0_prod.access_budget_marketing_accomptes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_budget LIKE  intranet_v2_0_prod.access_budget_marketing_budget;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_budget SELECT * FROM intranet_v2_0_prod.access_budget_marketing_budget;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_fournisseur LIKE  intranet_v2_0_prod.access_budget_marketing_fournisseur;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_fournisseur SELECT * FROM intranet_v2_0_prod.access_budget_marketing_fournisseur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_datasharing_data_sharing LIKE  intranet_v2_0_prod.access_datasharing_data_sharing;"
            . " INSERT INTO intranet_v3_0_dev.access_datasharing_data_sharing SELECT * FROM intranet_v2_0_prod.access_datasharing_data_sharing;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_accomptes LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_accomptes;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_accomptes SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_accomptes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_budget LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_budget;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_budget SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_budget;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_fournisseur;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_fournisseur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_hierarchie_compta_analytique;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_hierarchie_compta_analytique;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_intitule_base;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_intitule_base;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique LIKE  intranet_v2_0_prod.access_budget_marketing_hierarchie_compta_analytique;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique SELECT * FROM intranet_v2_0_prod.access_budget_marketing_hierarchie_compta_analytique;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_intitule_base LIKE  intranet_v2_0_prod.access_budget_marketing_intitule_base;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_intitule_base SELECT * FROM intranet_v2_0_prod.access_budget_marketing_intitule_base;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_prestation LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_prestation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_prestation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_prestation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_provisions LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_provisions;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_provisions SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_provisions;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_reglement LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_reglement;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_reglement SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_reglement;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_rubrique_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_rubrique_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_section LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_section;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_section;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_sous_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_sous_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_section LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_sous_section;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_sous_section;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee LIKE  intranet_v2_0_prod.access_budget_marketing_mdd_temp_facture_provionnee;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_temp_facture_provionnee;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_prestation LIKE  intranet_v2_0_prod.access_budget_marketing_prestation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_prestation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_prestation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_provisions LIKE  intranet_v2_0_prod.access_budget_marketing_provisions;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_provisions SELECT * FROM intranet_v2_0_prod.access_budget_marketing_provisions;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_reglement LIKE  intranet_v2_0_prod.access_budget_marketing_reglement;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_reglement SELECT * FROM intranet_v2_0_prod.access_budget_marketing_reglement;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_rubrique_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_rubrique_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_rubrique_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_rubrique_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_section LIKE  intranet_v2_0_prod.access_budget_marketing_section;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_section;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_facturation LIKE  intranet_v2_0_prod.access_budget_marketing_sous_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_sous_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_section LIKE  intranet_v2_0_prod.access_budget_marketing_sous_section;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_sous_section;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE  intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee LIKE  intranet_v2_0_prod.access_budget_marketing_temp_facture_provionnee;"
            . " INSERT INTO  intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee SELECT * FROM intranet_v2_0_prod. access_budget_marketing_temp_facture_provionnee;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE  intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 LIKE  intranet_v2_0_prod.access_budget_ventes_14mois_Importation_Real_N_1;"
            . " INSERT INTO  intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_14mois_Importation_Real_N_1;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE  intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 LIKE  intranet_v2_0_prod.access_budget_ventes_14mois_Importation_des_Realisations_N_1;"
            . " INSERT INTO  intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_14mois_Importation_des_Realisations_N_1;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 LIKE  intranet_v2_0_prod.access_budget_ventes_Importation_des_Realisations_N_1;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_Importation_des_Realisations_N_1;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_arti2_dev LIKE  intranet_v2_0_prod.access_budget_ventes_arti2_dev;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_ventes_arti2_dev SELECT * FROM intranet_v2_0_prod.access_budget_ventes_arti2_dev;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_reseau_commercial LIKE  intranet_v2_0_prod.access_budget_ventes_reseau_commercial;"
            . " INSERT INTO intranet_v3_0_dev.access_budget_ventes_reseau_commercial SELECT * FROM intranet_v2_0_prod.access_budget_ventes_reseau_commercial;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation LIKE  intranet_v2_0_prod.access_bugdet_ventes_14mois_table_animation;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_animation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget LIKE  intranet_v2_0_prod.access_bugdet_ventes_14mois_table_budget;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_budget;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises LIKE  intranet_v2_0_prod.access_bugdet_ventes_14mois_table_realises;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_realises;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_cout LIKE  intranet_v2_0_prod.access_bugdet_ventes_articles_cout;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_cout SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_articles_cout;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_totalite LIKE  intranet_v2_0_prod.access_bugdet_ventes_articles_totalite;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_totalite SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_articles_totalite;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg LIKE  intranet_v2_0_prod.access_bugdet_ventes_correspondance_famcli_fammktg;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_correspondance_famcli_fammktg;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_animation LIKE  intranet_v2_0_prod.access_bugdet_ventes_table_animation;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_animation SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_animation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_budget LIKE  intranet_v2_0_prod.access_bugdet_ventes_table_budget;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_budget SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_budget;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire LIKE  intranet_v2_0_prod.access_bugdet_ventes_table_bugdet_commentaire;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_bugdet_commentaire;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_realises LIKE  intranet_v2_0_prod.access_bugdet_ventes_table_realises;"
            . " INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_realises SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_realises;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_clients LIKE  intranet_v2_0_prod.access_clients;"
            . " INSERT INTO intranet_v3_0_dev.access_clients SELECT * FROM intranet_v2_0_prod.access_clients;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_clients_rayon LIKE  intranet_v2_0_prod.access_clients_rayon;"
            . " INSERT INTO intranet_v3_0_dev.access_clients_rayon SELECT * FROM intranet_v2_0_prod.access_clients_rayon;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_commerciaux LIKE  intranet_v2_0_prod.access_commerciaux;"
            . " INSERT INTO intranet_v3_0_dev.access_commerciaux SELECT * FROM intranet_v2_0_prod.access_commerciaux;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot LIKE  intranet_v2_0_prod.access_datasharing_Nb_magasin_entrepot;"
            . " INSERT INTO intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot SELECT * FROM intranet_v2_0_prod.access_datasharing_Nb_magasin_entrepot;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_datasharing_Table_des_magasins LIKE  intranet_v2_0_prod.access_datasharing_Table_des_magasins;"
            . " INSERT INTO intranet_v3_0_dev.access_datasharing_Table_des_magasins SELECT * FROM intranet_v2_0_prod.access_datasharing_Table_des_magasins;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_etat LIKE  intranet_v2_0_prod.access_etat;"
            . " INSERT INTO intranet_v3_0_dev.access_etat SELECT * FROM intranet_v2_0_prod.access_etat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_familles_articles LIKE  intranet_v2_0_prod.access_familles_articles;"
            . " INSERT INTO intranet_v3_0_dev.access_familles_articles SELECT * FROM intranet_v2_0_prod.access_familles_articles;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_familles_clients LIKE  intranet_v2_0_prod.access_familles_clients;"
            . " INSERT INTO intranet_v3_0_dev.access_familles_clients SELECT * FROM intranet_v2_0_prod.access_familles_clients;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_familles_gammes LIKE  intranet_v2_0_prod.access_familles_gammes;"
            . " INSERT INTO intranet_v3_0_dev.access_familles_gammes SELECT * FROM intranet_v2_0_prod.access_familles_gammes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_familles_marketing LIKE  intranet_v2_0_prod.access_familles_marketing;"
            . " INSERT INTO intranet_v3_0_dev.access_familles_marketing SELECT * FROM intranet_v2_0_prod.access_familles_marketing;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_categories_socio_professionnelles LIKE  intranet_v2_0_prod.access_formation_categories_socio_professionnelles;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_categories_socio_professionnelles SELECT * FROM intranet_v2_0_prod.access_formation_categories_socio_professionnelles;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_departements LIKE  intranet_v2_0_prod.access_formation_departements;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_departements SELECT * FROM intranet_v2_0_prod.access_formation_departements;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_fonctions LIKE  intranet_v2_0_prod.access_formation_fonctions;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_fonctions SELECT * FROM intranet_v2_0_prod.access_formation_fonctions;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_formation LIKE  intranet_v2_0_prod.access_formation_formation;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_formation SELECT * FROM intranet_v2_0_prod.access_formation_formation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_regroupement_age LIKE  intranet_v2_0_prod.access_formation_regroupement_age;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_regroupement_age SELECT * FROM intranet_v2_0_prod.access_formation_regroupement_age;"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_salarie LIKE  intranet_v2_0_prod.access_formation_salarie;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_salarie SELECT * FROM intranet_v2_0_prod.access_formation_salarie;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_services LIKE  intranet_v2_0_prod.access_formation_services;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_services SELECT * FROM intranet_v2_0_prod.access_formation_services;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_stage_informations LIKE  intranet_v2_0_prod.access_formation_stage_informations;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_stage_informations SELECT * FROM intranet_v2_0_prod.access_formation_stage_informations;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_stage_intitule_formation LIKE  intranet_v2_0_prod.access_formation_stage_intitule_formation;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_stage_intitule_formation SELECT * FROM intranet_v2_0_prod.access_formation_stage_intitule_formation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_domaines LIKE  intranet_v2_0_prod.access_formation_stage_table_des_domaines;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_domaines SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_domaines;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_intitules LIKE  intranet_v2_0_prod.access_formation_stage_table_des_intitules;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_intitules SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_intitules;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_organismes LIKE  intranet_v2_0_prod.access_formation_stage_table_des_organismes;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_organismes SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_organismes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_Tx LIKE  intranet_v2_0_prod.access_formation_table_des_Tx;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_table_des_Tx SELECT * FROM intranet_v2_0_prod.access_formation_table_des_Tx;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_donnees LIKE  intranet_v2_0_prod.access_formation_table_des_donnees;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_table_des_donnees SELECT * FROM intranet_v2_0_prod.access_formation_table_des_donnees;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_postes_de_depenses LIKE  intranet_v2_0_prod.access_formation_table_des_postes_de_depenses;"
            . " INSERT INTO intranet_v3_0_dev.access_formation_table_des_postes_de_depenses SELECT * FROM intranet_v2_0_prod.access_formation_table_des_postes_de_depenses;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_gammes LIKE  intranet_v2_0_prod.access_gammes;"
            . " INSERT INTO intranet_v3_0_dev.access_gammes SELECT * FROM intranet_v2_0_prod.access_gammes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_production LIKE  intranet_v2_0_prod.access_indicateur_productivite_expedition_production;"
            . " INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_production SELECT * FROM intranet_v2_0_prod.access_indicateur_productivite_expedition_production;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail LIKE  intranet_v2_0_prod.access_indicateur_productivite_expedition_temps_travail;"
            . " INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail SELECT * FROM intranet_v2_0_prod.access_indicateur_productivite_expedition_temps_travail;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_carte_reseau LIKE  intranet_v2_0_prod.access_materiel_carte_reseau;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_carte_reseau SELECT * FROM intranet_v2_0_prod.access_materiel_carte_reseau;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_categorie_logiciel LIKE  intranet_v2_0_prod.access_materiel_categorie_logiciel;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_categorie_logiciel SELECT * FROM intranet_v2_0_prod.access_materiel_categorie_logiciel;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_connectique LIKE  intranet_v2_0_prod.access_materiel_connectique;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_connectique SELECT * FROM intranet_v2_0_prod.access_materiel_connectique;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_contrat LIKE  intranet_v2_0_prod.access_materiel_contrat;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_contrat SELECT * FROM intranet_v2_0_prod.access_materiel_contrat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_ecran LIKE  intranet_v2_0_prod.access_materiel_ecran;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_ecran SELECT * FROM intranet_v2_0_prod.access_materiel_ecran;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_incident LIKE  intranet_v2_0_prod.access_materiel_etat_incident;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_etat_incident SELECT * FROM intranet_v2_0_prod.access_materiel_etat_incident;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_materiel_detail LIKE  intranet_v2_0_prod.access_materiel_etat_materiel_detail;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_etat_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_etat_materiel_detail;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_fonction_prestataire LIKE  intranet_v2_0_prod.access_materiel_fonction_prestataire;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_fonction_prestataire SELECT * FROM intranet_v2_0_prod.access_materiel_fonction_prestataire;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident LIKE  intranet_v2_0_prod.access_materiel_gestion_incident;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident SELECT * FROM intranet_v2_0_prod.access_materiel_gestion_incident;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident_groupe LIKE  intranet_v2_0_prod.access_materiel_gestion_incident_groupe;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident_groupe SELECT * FROM intranet_v2_0_prod.access_materiel_gestion_incident_groupe;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_horloge_processeur LIKE  intranet_v2_0_prod.access_materiel_horloge_processeur;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_horloge_processeur SELECT * FROM intranet_v2_0_prod.access_materiel_horloge_processeur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_imprimante LIKE  intranet_v2_0_prod.access_materiel_imprimante;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_imprimante SELECT * FROM intranet_v2_0_prod.access_materiel_imprimante;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_incident LIKE  intranet_v2_0_prod.access_materiel_incident;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_incident SELECT * FROM intranet_v2_0_prod.access_materiel_incident;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_licence LIKE  intranet_v2_0_prod.access_materiel_licence;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_licence SELECT * FROM intranet_v2_0_prod.access_materiel_licence;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_log LIKE  intranet_v2_0_prod.access_materiel_log;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_log SELECT * FROM intranet_v2_0_prod.access_materiel_log;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_logiciel LIKE  intranet_v2_0_prod.access_materiel_logiciel;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_logiciel SELECT * FROM intranet_v2_0_prod.access_materiel_logiciel;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_marque_materiel LIKE  intranet_v2_0_prod.access_materiel_marque_materiel;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_marque_materiel SELECT * FROM intranet_v2_0_prod.access_materiel_marque_materiel;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_detail LIKE  intranet_v2_0_prod.access_materiel_materiel_detail;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_materiel_detail;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_general LIKE  intranet_v2_0_prod.access_materiel_materiel_general;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_materiel_general SELECT * FROM intranet_v2_0_prod.access_materiel_materiel_general;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_modem LIKE  intranet_v2_0_prod.access_materiel_modem;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_modem SELECT * FROM intranet_v2_0_prod.access_materiel_modem;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_module LIKE  intranet_v2_0_prod.access_materiel_module;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_module SELECT * FROM intranet_v2_0_prod.access_materiel_module;"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_action LIKE  intranet_v2_0_prod.access_materiel_nature_action;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_nature_action SELECT * FROM intranet_v2_0_prod.access_materiel_nature_action;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_incident LIKE  intranet_v2_0_prod.access_materiel_nature_incident;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_nature_incident SELECT * FROM intranet_v2_0_prod.access_materiel_nature_incident;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_poste LIKE  intranet_v2_0_prod.access_materiel_poste;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_poste SELECT * FROM intranet_v2_0_prod.access_materiel_poste;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_prestataire LIKE  intranet_v2_0_prod.access_materiel_prestataire;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_prestataire SELECT * FROM intranet_v2_0_prod.access_materiel_prestataire;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_processeur LIKE  intranet_v2_0_prod.access_materiel_processeur;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_processeur SELECT * FROM intranet_v2_0_prod.access_materiel_processeur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux LIKE  intranet_v2_0_prod.access_materiel_reseaux;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_reseaux SELECT * FROM intranet_v2_0_prod.access_materiel_reseaux;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux_detail LIKE  intranet_v2_0_prod.access_materiel_reseaux_detail;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_reseaux_detail SELECT * FROM intranet_v2_0_prod.access_materiel_reseaux_detail;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_section_analytique LIKE  intranet_v2_0_prod.access_materiel_section_analytique;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_section_analytique SELECT * FROM intranet_v2_0_prod.access_materiel_section_analytique;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur LIKE  intranet_v2_0_prod.access_materiel_serveur;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_serveur SELECT * FROM intranet_v2_0_prod.access_materiel_serveur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur_applicatif LIKE  intranet_v2_0_prod.access_materiel_serveur_applicatif;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_serveur_applicatif SELECT * FROM intranet_v2_0_prod.access_materiel_serveur_applicatif;"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_technologie_materiel LIKE  intranet_v2_0_prod.access_materiel_technologie_materiel;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_technologie_materiel SELECT * FROM intranet_v2_0_prod.access_materiel_technologie_materiel;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_type_materiel_detail LIKE  intranet_v2_0_prod.access_materiel_type_materiel_detail;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_type_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_type_materiel_detail;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_materiel_unite_centrale LIKE  intranet_v2_0_prod.access_materiel_unite_centrale;"
            . " INSERT INTO intranet_v3_0_dev.access_materiel_unite_centrale SELECT * FROM intranet_v2_0_prod.access_materiel_unite_centrale;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE  intranet_v3_0_dev.access_materiel_wintegrate LIKE  intranet_v2_0_prod.access_materiel_wintegrate;"
            . " INSERT INTO  intranet_v3_0_dev.access_materiel_wintegrate SELECT * FROM intranet_v2_0_prod. access_materiel_wintegrate;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_action LIKE  intranet_v2_0_prod.access_plan_qualite_action;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_action SELECT * FROM intranet_v2_0_prod.access_plan_qualite_action;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_genre LIKE  intranet_v2_0_prod.access_plan_qualite_genre;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_genre SELECT * FROM intranet_v2_0_prod.access_plan_qualite_genre;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_nature LIKE  intranet_v2_0_prod.access_plan_qualite_nature;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_nature SELECT * FROM intranet_v2_0_prod.access_plan_qualite_nature;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_origine LIKE  intranet_v2_0_prod.access_plan_qualite_origine;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_origine SELECT * FROM intranet_v2_0_prod.access_plan_qualite_origine;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_plan LIKE  intranet_v2_0_prod.access_plan_qualite_plan;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_plan SELECT * FROM intranet_v2_0_prod.access_plan_qualite_plan;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_processus LIKE  intranet_v2_0_prod.access_plan_qualite_processus;"
            . " INSERT INTO intranet_v3_0_dev.access_plan_qualite_processus SELECT * FROM intranet_v2_0_prod.access_plan_qualite_processus;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_frequences LIKE  intranet_v2_0_prod.access_prise_coeur_frequences;"
            . " INSERT INTO intranet_v3_0_dev.access_prise_coeur_frequences SELECT * FROM intranet_v2_0_prod.access_prise_coeur_frequences;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_produits LIKE  intranet_v2_0_prod.access_prise_coeur_produits;"
            . " INSERT INTO intranet_v3_0_dev.access_prise_coeur_produits SELECT * FROM intranet_v2_0_prod.access_prise_coeur_produits;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_qualite_processus LIKE  intranet_v2_0_prod.access_qualite_processus;"
            . " INSERT INTO intranet_v3_0_dev.access_qualite_processus SELECT * FROM intranet_v2_0_prod.access_qualite_processus;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice LIKE  intranet_v2_0_prod.access_rcp_Correspondance_mois_exercice;"
            . " INSERT INTO intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice SELECT * FROM intranet_v2_0_prod.access_rcp_Correspondance_mois_exercice;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers LIKE  intranet_v2_0_prod.access_rcp_Couts_a_ventiler_Articles_Saisonniers;"
            . " INSERT INTO intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers SELECT * FROM intranet_v2_0_prod.access_rcp_Couts_a_ventiler_Articles_Saisonniers;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES LIKE  intranet_v2_0_prod.access_rcp_Donnees_CLIENTS_ARTICLES;"
            . " INSERT INTO intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES SELECT * FROM intranet_v2_0_prod.access_rcp_Donnees_CLIENTS_ARTICLES;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_rcp_Liste_Diffusion LIKE  intranet_v2_0_prod.access_rcp_Liste_Diffusion;"
            . " INSERT INTO intranet_v3_0_dev.access_rcp_Liste_Diffusion SELECT * FROM intranet_v2_0_prod.access_rcp_Liste_Diffusion;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_rcp_Mois LIKE  intranet_v2_0_prod.access_rcp_Mois;"
            . " INSERT INTO intranet_v3_0_dev.access_rcp_Mois SELECT * FROM intranet_v2_0_prod.access_rcp_Mois;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_composition LIKE  intranet_v2_0_prod.access_recettes_multi_composition;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_composition SELECT * FROM intranet_v2_0_prod.access_recettes_multi_composition;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_cout_fab LIKE  intranet_v2_0_prod.access_recettes_multi_cout_fab;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_cout_fab SELECT * FROM intranet_v2_0_prod.access_recettes_multi_cout_fab;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_frais_de_transport LIKE  intranet_v2_0_prod.access_recettes_multi_frais_de_transport;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_frais_de_transport SELECT * FROM intranet_v2_0_prod.access_recettes_multi_frais_de_transport;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_gammes LIKE  intranet_v2_0_prod.access_recettes_multi_gammes;"
            . " INSERT INTO access_recettes_multi_gammes SELECT * FROM intranet_v2_0_prod.access_recettes_multi_gammes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_matiere LIKE  intranet_v2_0_prod.access_recettes_multi_importation_matiere;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_matiere SELECT * FROM intranet_v2_0_prod.access_recettes_multi_importation_matiere;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_tarif LIKE  intranet_v2_0_prod.access_recettes_multi_importation_tarif;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_tarif SELECT * FROM intranet_v2_0_prod.access_recettes_multi_importation_tarif;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs LIKE  intranet_v2_0_prod.access_recettes_multi_infologic_fournisseurs;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs SELECT * FROM intranet_v2_0_prod.access_recettes_multi_infologic_fournisseurs;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_unite LIKE  intranet_v2_0_prod.access_recettes_multi_infologic_unite;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_unite SELECT * FROM intranet_v2_0_prod.access_recettes_multi_infologic_unite;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_ingredients LIKE  intranet_v2_0_prod.access_recettes_multi_ingredients;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_ingredients SELECT * FROM intranet_v2_0_prod.access_recettes_multi_ingredients;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_recette LIKE  intranet_v2_0_prod.access_recettes_multi_recette;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_recette SELECT * FROM intranet_v2_0_prod.access_recettes_multi_recette;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_stades LIKE  intranet_v2_0_prod.access_recettes_multi_stades;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_stades SELECT * FROM intranet_v2_0_prod.access_recettes_multi_stades;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_unites LIKE  intranet_v2_0_prod.access_recettes_multi_unites;"
            . " INSERT INTO intranet_v3_0_dev.access_recettes_multi_unites SELECT * FROM intranet_v2_0_prod.access_recettes_multi_unites;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_regroupements LIKE  intranet_v2_0_prod.access_regroupements;"
            . " INSERT INTO intranet_v3_0_dev.access_regroupements SELECT * FROM intranet_v2_0_prod.access_regroupements;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_SITES LIKE  intranet_v2_0_prod.access_risq_pro_intranet_SITES;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_SITES SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_SITES;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier LIKE  intranet_v2_0_prod.access_risq_pro_intranet_etat_dossier;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_etat_dossier;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque LIKE  intranet_v2_0_prod.access_risq_pro_intranet_evaluation_risque;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_evaluation_risque;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_gravites LIKE  intranet_v2_0_prod.access_risq_pro_intranet_gravites;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_gravites SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_gravites;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque LIKE  intranet_v2_0_prod.access_risq_pro_intranet_identification_codes_risque;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_identification_codes_risque;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque LIKE  intranet_v2_0_prod.access_risq_pro_intranet_matrice_risque;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_matrice_risque;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_nature_risque LIKE  intranet_v2_0_prod.access_risq_pro_intranet_nature_risque;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_nature_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_nature_risque;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_probabilites LIKE  intranet_v2_0_prod.access_risq_pro_intranet_probabilites;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_probabilites SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_probabilites;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_risques LIKE  intranet_v2_0_prod.access_risq_pro_intranet_risques;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_risques SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_risques;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_secteurs LIKE  intranet_v2_0_prod.access_risq_pro_intranet_secteurs;"
            . " INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_secteurs SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_secteurs;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes LIKE  intranet_v2_0_prod.access_ruptures_commandes;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_commandes SELECT * FROM intranet_v2_0_prod.access_ruptures_commandes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES LIKE  intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES SELECT * FROM intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes_details LIKE  intranet_v2_0_prod.access_ruptures_commandes_details;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_commandes_details SELECT * FROM intranet_v2_0_prod.access_ruptures_commandes_details;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif LIKE  intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif SELECT * FROM intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_code_langue LIKE  intranet_v2_0_prod.access_ruptures_export_code_langue;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_export_code_langue SELECT * FROM intranet_v2_0_prod.access_ruptures_export_code_langue;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_libelles_etrangers LIKE  intranet_v2_0_prod.access_ruptures_export_libelles_etrangers;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_export_libelles_etrangers SELECT * FROM intranet_v2_0_prod.access_ruptures_export_libelles_etrangers;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_suivi LIKE  intranet_v2_0_prod.access_ruptures_suivi;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_suivi SELECT * FROM intranet_v2_0_prod.access_ruptures_suivi;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_ruptures_type_manquant LIKE  intranet_v2_0_prod.access_ruptures_type_manquant;"
            . " INSERT INTO intranet_v3_0_dev.access_ruptures_type_manquant SELECT * FROM intranet_v2_0_prod.access_ruptures_type_manquant;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_ciliviltes LIKE  intranet_v2_0_prod.access_service_consommateur_ciliviltes;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_ciliviltes SELECT * FROM intranet_v2_0_prod.access_service_consommateur_ciliviltes;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_consommateur LIKE  intranet_v2_0_prod.access_service_consommateur_consommateur;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_consommateur SELECT * FROM intranet_v2_0_prod.access_service_consommateur_consommateur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_lettres_types LIKE  intranet_v2_0_prod.access_service_consommateur_lettres_types;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_lettres_types SELECT * FROM intranet_v2_0_prod.access_service_consommateur_lettres_types;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_liste_diffusion LIKE  intranet_v2_0_prod.access_service_consommateur_liste_diffusion;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_liste_diffusion SELECT * FROM intranet_v2_0_prod.access_service_consommateur_liste_diffusion;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_mesure_corrective LIKE  intranet_v2_0_prod.access_service_consommateur_mesure_corrective;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_mesure_corrective SELECT * FROM intranet_v2_0_prod.access_service_consommateur_mesure_corrective;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_niveau_gravite LIKE  intranet_v2_0_prod.access_service_consommateur_niveau_gravite;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_niveau_gravite SELECT * FROM intranet_v2_0_prod.access_service_consommateur_niveau_gravite;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_reclamations LIKE  intranet_v2_0_prod.access_service_consommateur_reclamations;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_reclamations SELECT * FROM intranet_v2_0_prod.access_service_consommateur_reclamations;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_statistiques_articles LIKE  intranet_v2_0_prod.access_service_consommateur_statistiques_articles;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_statistiques_articles SELECT * FROM intranet_v2_0_prod.access_service_consommateur_statistiques_articles;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_typologies LIKE  intranet_v2_0_prod.access_service_consommateur_typologies;"
            . " INSERT INTO intranet_v3_0_dev.access_service_consommateur_typologies SELECT * FROM intranet_v2_0_prod.access_service_consommateur_typologies;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.access_type_de_facturation LIKE  intranet_v2_0_prod.access_type_de_facturation;"
            . " INSERT INTO intranet_v3_0_dev.access_type_de_facturation SELECT * FROM intranet_v2_0_prod.access_type_de_facturation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actiavaris LIKE  intranet_v2_0_prod.actiavaris;"
            . " INSERT INTO intranet_v3_0_dev.actiavaris SELECT * FROM intranet_v2_0_prod.actiavaris;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actijour LIKE  intranet_v2_0_prod.actijour;"
            . " INSERT INTO intranet_v3_0_dev.actijour SELECT * FROM intranet_v2_0_prod.actijour;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actijour_arch LIKE  intranet_v2_0_prod.actijour_arch;"
            . " INSERT INTO intranet_v3_0_dev.actijour_arch SELECT * FROM intranet_v2_0_prod.actijour_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actijour_site LIKE  intranet_v2_0_prod.actijour_site;"
            . " INSERT INTO intranet_v3_0_dev.actijour_site SELECT * FROM intranet_v2_0_prod.actijour_site;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actijour_site_arch LIKE  intranet_v2_0_prod.actijour_site_arch;"
            . " INSERT INTO intranet_v3_0_dev.actijour_site_arch SELECT * FROM intranet_v2_0_prod.actijour_site_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actisem LIKE  intranet_v2_0_prod.actisem;"
            . " INSERT INTO intranet_v3_0_dev.actisem SELECT * FROM intranet_v2_0_prod.actisem;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actisem_site LIKE  intranet_v2_0_prod.actisem_site;"
            . " INSERT INTO actisem_site SELECT * FROM intranet_v2_0_prod.actisem_site;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.actitempo LIKE  intranet_v2_0_prod.actitempo;"
            . " INSERT INTO intranet_v3_0_dev.actitempo SELECT * FROM intranet_v2_0_prod.actitempo;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.activite LIKE  intranet_v2_0_prod.activite;"
            . " INSERT INTO intranet_v3_0_dev.activite SELECT * FROM intranet_v2_0_prod.activite;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_internet LIKE  intranet_v2_0_prod.analyse_log_internet;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_internet SELECT * FROM intranet_v2_0_prod.analyse_log_internet;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_arch LIKE  intranet_v2_0_prod.analyse_log_internet_arch;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_internet_arch SELECT * FROM intranet_v2_0_prod.analyse_log_internet_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree LIKE  intranet_v2_0_prod.analyse_log_internet_duree;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree SELECT * FROM intranet_v2_0_prod.analyse_log_internet_duree;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree_arch LIKE  intranet_v2_0_prod.analyse_log_internet_duree_arch;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree_arch SELECT * FROM intranet_v2_0_prod.analyse_log_internet_duree_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie LIKE  intranet_v2_0_prod.analyse_log_messagerie;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_messagerie SELECT * FROM intranet_v2_0_prod.analyse_log_messagerie;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie_arch LIKE  intranet_v2_0_prod.analyse_log_messagerie_arch;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_messagerie_arch SELECT * FROM intranet_v2_0_prod.analyse_log_messagerie_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_num_tel LIKE  intranet_v2_0_prod.analyse_log_num_tel;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_num_tel SELECT * FROM intranet_v2_0_prod.analyse_log_num_tel;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie LIKE  intranet_v2_0_prod.analyse_log_telephonie;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_telephonie SELECT * FROM intranet_v2_0_prod.analyse_log_telephonie;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie_arch LIKE  intranet_v2_0_prod.analyse_log_telephonie_arch;"
            . " INSERT INTO intranet_v3_0_dev.analyse_log_telephonie_arch SELECT * FROM intranet_v2_0_prod.analyse_log_telephonie_arch;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.client LIKE  intranet_v2_0_prod.client;"
            . " INSERT INTO intranet_v3_0_dev.client SELECT * FROM intranet_v2_0_prod.client;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.codesoft_superviseur LIKE  intranet_v2_0_prod.codesoft_superviseur;"
            . " INSERT INTO intranet_v3_0_dev.codesoft_superviseur SELECT * FROM intranet_v2_0_prod.codesoft_superviseur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.comment LIKE  intranet_v2_0_prod.comment;"
            . " INSERT INTO intranet_v3_0_dev.comment SELECT * FROM intranet_v2_0_prod.comment;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.compos LIKE  intranet_v2_0_prod.compos;"
            . " INSERT INTO intranet_v3_0_dev.compos SELECT * FROM intranet_v2_0_prod.compos;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.composa LIKE  intranet_v2_0_prod.composa;"
            . " INSERT INTO intranet_v3_0_dev.composa SELECT * FROM intranet_v2_0_prod.composa;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.composv LIKE  intranet_v2_0_prod.composv;"
            . " INSERT INTO intranet_v3_0_dev.composv SELECT * FROM intranet_v2_0_prod.composv;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.conserv LIKE  intranet_v2_0_prod.conserv;"
            . " INSERT INTO intranet_v3_0_dev.conserv SELECT * FROM intranet_v2_0_prod.conserv;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.conserva LIKE  intranet_v2_0_prod.conserva;"
            . " INSERT INTO intranet_v3_0_dev.conserva SELECT * FROM intranet_v2_0_prod.conserva;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.conservv LIKE  intranet_v2_0_prod.conservv;"
            . " INSERT INTO intranet_v3_0_dev.conservv SELECT * FROM intranet_v2_0_prod.conservv;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.datasync_serveur LIKE  intranet_v2_0_prod.datasync_serveur;"
            . " INSERT INTO intranet_v3_0_dev.datasync_serveur SELECT * FROM intranet_v2_0_prod.datasync_serveur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.datasync_transfert LIKE  intranet_v2_0_prod.datasync_transfert;"
            . " INSERT INTO intranet_v3_0_dev.datasync_transfert SELECT * FROM intranet_v2_0_prod.datasync_transfert;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.diffusion LIKE  intranet_v2_0_prod.diffusion;"
            . " INSERT INTO intranet_v3_0_dev.diffusion SELECT * FROM intranet_v2_0_prod.diffusion;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.divers LIKE  intranet_v2_0_prod.divers;"
            . " INSERT INTO intranet_v3_0_dev.divers SELECT * FROM intranet_v2_0_prod.divers;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.diversa LIKE  intranet_v2_0_prod.diversa;"
            . " INSERT INTO intranet_v3_0_dev.diversa SELECT * FROM intranet_v2_0_prod.diversa;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.diversv LIKE  intranet_v2_0_prod.diversv;"
            . " INSERT INTO intranet_v3_0_dev.diversv SELECT * FROM intranet_v2_0_prod.diversv;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.enseigne LIKE  intranet_v2_0_prod.enseigne;"
            . " INSERT INTO intranet_v3_0_dev.enseigne SELECT * FROM intranet_v2_0_prod.enseigne;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.famille LIKE  intranet_v2_0_prod.famille;"
            . " INSERT INTO intranet_v3_0_dev.famille SELECT * FROM intranet_v2_0_prod.famille;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_palettisation LIKE  intranet_v2_0_prod.fta_palettisation;"
            . " INSERT INTO intranet_v3_0_dev.fta_palettisation SELECT * FROM intranet_v2_0_prod.fta_palettisation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.gamme LIKE  intranet_v2_0_prod.gamme;"
            . " INSERT INTO intranet_v3_0_dev.gamme SELECT * FROM intranet_v2_0_prod.gamme;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.gamstat LIKE  intranet_v2_0_prod.gamstat;"
            . " INSERT INTO intranet_v3_0_dev.gamstat SELECT * FROM intranet_v2_0_prod.gamstat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.indicateur_productivite_unite_temps LIKE  intranet_v2_0_prod.indicateur_productivite_unite_temps;"
            . " INSERT INTO intranet_v3_0_dev.indicateur_productivite_unite_temps SELECT * FROM intranet_v2_0_prod.indicateur_productivite_unite_temps;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.infog LIKE  intranet_v2_0_prod.infog;"
            . " INSERT INTO intranet_v3_0_dev.infog SELECT * FROM intranet_v2_0_prod.infog;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.infoga LIKE  intranet_v2_0_prod.infoga;"
            . " INSERT INTO intranet_v3_0_dev.infoga SELECT * FROM intranet_v2_0_prod.infoga;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.infogv LIKE  intranet_v2_0_prod.infogv;"
            . " INSERT INTO intranet_v3_0_dev.infogv SELECT * FROM intranet_v2_0_prod.infogv;"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.intranet_niveau_acces LIKE  intranet_v2_0_prod.intranet_niveau_acces;"
            . " INSERT INTO intranet_v3_0_dev.intranet_niveau_acces SELECT * FROM intranet_v2_0_prod.intranet_niveau_acces;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.intranet_password LIKE  intranet_v2_0_prod.intranet_password;"
            . " INSERT INTO intranet_v3_0_dev.intranet_password SELECT * FROM intranet_v2_0_prod.intranet_password;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.logft LIKE  intranet_v2_0_prod.logft;"
            . " INSERT INTO intranet_v3_0_dev.logft SELECT * FROM intranet_v2_0_prod.logft;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.lustat LIKE  intranet_v2_0_prod.lustat;"
            . " INSERT INTO intranet_v3_0_dev.lustat SELECT * FROM intranet_v2_0_prod.lustat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere LIKE  intranet_v2_0_prod.matiere_premiere;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere SELECT * FROM intranet_v2_0_prod.matiere_premiere;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique LIKE  intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique SELECT * FROM intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere LIKE  intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique_filiere;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere SELECT * FROM intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique_filiere;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client LIKE  intranet_v2_0_prod.matiere_premiere_client;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_client SELECT * FROM intranet_v2_0_prod.matiere_premiere_client;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client_regroupement LIKE  intranet_v2_0_prod.matiere_premiere_client_regroupement;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_client_regroupement SELECT * FROM intranet_v2_0_prod.matiere_premiere_client_regroupement;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant LIKE  intranet_v2_0_prod.matiere_premiere_composant;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_allergene LIKE  intranet_v2_0_prod.matiere_premiere_composant_allergene;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_allergene SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_allergene;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_arome_categorie LIKE  intranet_v2_0_prod.matiere_premiere_composant_arome_categorie;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_arome_categorie SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_arome_categorie;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_groupe LIKE  intranet_v2_0_prod.matiere_premiere_composant_groupe;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_groupe SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_groupe;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_nature LIKE  intranet_v2_0_prod.matiere_premiere_composant_nature;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_nature SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_nature;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_origine LIKE  intranet_v2_0_prod.matiere_premiere_composant_origine;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_origine SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_origine;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium LIKE  intranet_v2_0_prod.matiere_premiere_composant_regroupement_advitium;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_regroupement_advitium;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_template LIKE  intranet_v2_0_prod.matiere_premiere_composant_template;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_template SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_template;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_conditionnement LIKE  intranet_v2_0_prod.matiere_premiere_conditionnement;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_conditionnement SELECT * FROM intranet_v2_0_prod.matiere_premiere_conditionnement;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant LIKE  intranet_v2_0_prod.matiere_premiere_contaminant;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant SELECT * FROM intranet_v2_0_prod.matiere_premiere_contaminant;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant_association LIKE  intranet_v2_0_prod.matiere_premiere_contaminant_association;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant_association SELECT * FROM intranet_v2_0_prod.matiere_premiere_contaminant_association;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contamination_croisee LIKE  intranet_v2_0_prod.matiere_premiere_contamination_croisee;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_contamination_croisee SELECT * FROM intranet_v2_0_prod.matiere_premiere_contamination_croisee;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_etat LIKE  intranet_v2_0_prod.matiere_premiere_etat;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_etat SELECT * FROM intranet_v2_0_prod.matiere_premiere_etat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_ethique_client LIKE  intranet_v2_0_prod.matiere_premiere_ethique_client;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_ethique_client SELECT * FROM intranet_v2_0_prod.matiere_premiere_ethique_client;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_filiere LIKE  intranet_v2_0_prod.matiere_premiere_filiere;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_filiere SELECT * FROM intranet_v2_0_prod.matiere_premiere_filiere;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_fournisseur LIKE  intranet_v2_0_prod.matiere_premiere_fournisseur;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_fournisseur SELECT * FROM intranet_v2_0_prod.matiere_premiere_fournisseur;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_nature LIKE  intranet_v2_0_prod.matiere_premiere_nature;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_nature SELECT * FROM intranet_v2_0_prod.matiere_premiere_nature;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine LIKE  intranet_v2_0_prod.matiere_premiere_origine;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_origine SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_cycle LIKE  intranet_v2_0_prod.matiere_premiere_origine_cycle;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_cycle SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_cycle;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_peche LIKE  intranet_v2_0_prod.matiere_premiere_origine_peche;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_peche SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_peche;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_speciale LIKE  intranet_v2_0_prod.matiere_premiere_origine_speciale;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_speciale SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_speciale;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_surgelation LIKE  intranet_v2_0_prod.matiere_premiere_surgelation;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_surgelation SELECT * FROM intranet_v2_0_prod.matiere_premiere_surgelation;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_transition LIKE  intranet_v2_0_prod.matiere_premiere_transition;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_transition SELECT * FROM intranet_v2_0_prod.matiere_premiere_transition;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.matiere_premiere_zone_fao LIKE  intranet_v2_0_prod.matiere_premiere_zone_fao;"
            . " INSERT INTO intranet_v3_0_dev.matiere_premiere_zone_fao SELECT * FROM intranet_v2_0_prod.matiere_premiere_zone_fao;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.navservavaris LIKE  intranet_v2_0_prod.navservavaris;"
            . " INSERT INTO intranet_v3_0_dev.navservavaris SELECT * FROM intranet_v2_0_prod.navservavaris;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.navstat LIKE  intranet_v2_0_prod.navstat;"
            . " INSERT INTO intranet_v3_0_dev.navstat SELECT * FROM intranet_v2_0_prod.navstat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.navstatavaris LIKE  intranet_v2_0_prod.navstatavaris;"
            . " INSERT INTO intranet_v3_0_dev.navstatavaris SELECT * FROM intranet_v2_0_prod.navstatavaris;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.netlog_log LIKE  intranet_v2_0_prod.netlog_log;"
            . " INSERT INTO intranet_v3_0_dev.netlog_log SELECT * FROM intranet_v2_0_prod.netlog_log;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.newsdefil LIKE  intranet_v2_0_prod.newsdefil;"
            . " INSERT INTO intranet_v3_0_dev.newsdefil SELECT * FROM intranet_v2_0_prod.newsdefil;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.palet LIKE  intranet_v2_0_prod.palet;"
            . " INSERT INTO intranet_v3_0_dev.palet SELECT * FROM intranet_v2_0_prod.palet;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.paleta LIKE  intranet_v2_0_prod.paleta;"
            . " INSERT INTO intranet_v3_0_dev.paleta SELECT * FROM intranet_v2_0_prod.paleta;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.paletv LIKE  intranet_v2_0_prod.paletv;"
            . " INSERT INTO intranet_v3_0_dev.paletv SELECT * FROM intranet_v2_0_prod.paletv;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.perso LIKE  intranet_v2_0_prod.perso;"
            . " INSERT INTO intranet_v3_0_dev.perso SELECT * FROM intranet_v2_0_prod.perso;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.publicateur LIKE  intranet_v2_0_prod.publicateur;"
            . " INSERT INTO intranet_v3_0_dev.publicateur SELECT * FROM intranet_v2_0_prod.publicateur;"
    );


    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.save_client LIKE  intranet_v2_0_prod.save_client;"
            . " INSERT INTO intranet_v3_0_dev.save_client SELECT * FROM intranet_v2_0_prod.save_client;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.segment LIKE  intranet_v2_0_prod.segment;"
            . " INSERT INTO intranet_v3_0_dev.segment SELECT * FROM intranet_v2_0_prod.segment;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.segstat LIKE  intranet_v2_0_prod.segstat;"
            . " INSERT INTO intranet_v3_0_dev.segstat SELECT * FROM intranet_v2_0_prod.segstat;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.servicece LIKE  intranet_v2_0_prod.servicece;"
            . " INSERT INTO intranet_v3_0_dev.servicece SELECT * FROM intranet_v2_0_prod.servicece;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.services LIKE  intranet_v2_0_prod.services;"
            . " INSERT INTO intranet_v3_0_dev.services SELECT * FROM intranet_v2_0_prod.services;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.societe LIKE  intranet_v2_0_prod.societe;"
            . " INSERT INTO intranet_v3_0_dev.societe SELECT * FROM intranet_v2_0_prod.societe;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.stat_segment_site LIKE  intranet_v2_0_prod.stat_segment_site;"
            . " INSERT INTO intranet_v3_0_dev.stat_segment_site SELECT * FROM intranet_v2_0_prod.stat_segment_site;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.types LIKE  intranet_v2_0_prod.types;"
            . " INSERT INTO intranet_v3_0_dev.types SELECT * FROM intranet_v2_0_prod.types;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.valft LIKE  intranet_v2_0_prod.valft;"
            . " INSERT INTO intranet_v3_0_dev.valft SELECT * FROM intranet_v2_0_prod.valft;"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.words LIKE  intranet_v2_0_prod.words;"
            . " INSERT INTO intranet_v3_0_dev.words SELECT * FROM intranet_v2_0_prod.words;"
    );
}

/**
 * Création de tables de la V3
 */ {
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_saisie_obligatoire LIKE intranet_v3_0_cod.fta_saisie_obligatoire;"
            . " INSERT INTO intranet_v3_0_dev.fta_saisie_obligatoire SELECT * FROM intranet_v3_0_cod.fta_saisie_obligatoire"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.intranet_actions LIKE intranet_v3_0_cod.intranet_actions;"
            . " INSERT INTO intranet_v3_0_dev.intranet_actions SELECT * FROM intranet_v3_0_cod.intranet_actions"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.intranet_modules LIKE intranet_v3_0_cod.intranet_modules;"
            . " INSERT INTO intranet_v3_0_dev.intranet_modules SELECT * FROM intranet_v3_0_cod.intranet_modules"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ LIKE intranet_v3_0_cod.intranet_moteur_de_recherche_type_de_champ;"
            . " INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ SELECT * FROM intranet_v3_0_cod.intranet_moteur_de_recherche_type_de_champ"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_chapitre LIKE intranet_v3_0_cod.fta_chapitre;"
            . " INSERT INTO intranet_v3_0_dev.fta_chapitre SELECT * FROM intranet_v3_0_cod.fta_chapitre"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_etat LIKE intranet_v3_0_cod.fta_etat;"
            . " INSERT INTO intranet_v3_0_dev.fta_etat SELECT * FROM intranet_v3_0_cod.fta_etat"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_processus_cycle LIKE intranet_v3_0_cod.fta_processus_cycle;"
            . " INSERT INTO intranet_v3_0_dev.fta_processus_cycle SELECT * FROM intranet_v3_0_cod.fta_processus_cycle"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_processus LIKE intranet_v3_0_cod.fta_processus;"
            . " INSERT INTO intranet_v3_0_dev.fta_processus SELECT * FROM intranet_v3_0_cod.fta_processus"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_transition LIKE intranet_v3_0_cod.fta_transition;"
            . " INSERT INTO intranet_v3_0_dev.fta_transition SELECT * FROM intranet_v3_0_cod.fta_transition"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.extranets_table_des_liens LIKE intranet_v3_0_cod.extranets_table_des_liens;"
            . " INSERT INTO intranet_v3_0_dev.extranets_table_des_liens SELECT * FROM intranet_v3_0_cod.extranets_table_des_liens"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_migration_nomenclature LIKE intranet_v3_0_cod.fta_migration_nomenclature;"
            . " INSERT INTO intranet_v3_0_dev.fta_migration_nomenclature SELECT * FROM intranet_v3_0_cod.fta_migration_nomenclature"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_migration_produit LIKE intranet_v3_0_cod.fta_migration_produit;"
            . " INSERT INTO intranet_v3_0_dev.fta_migration_produit SELECT * FROM intranet_v3_0_cod.fta_migration_produit"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_moteur_de_recherche LIKE intranet_v3_0_cod.fta_moteur_de_recherche;"
            . " INSERT INTO intranet_v3_0_dev.fta_moteur_de_recherche SELECT * FROM intranet_v3_0_cod.fta_moteur_de_recherche"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_service_consommateur LIKE intranet_v3_0_cod.annexe_service_consommateur;"
            . " INSERT INTO intranet_v3_0_dev.annexe_service_consommateur SELECT * FROM intranet_v3_0_cod.annexe_service_consommateur"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.annexe_unite_facturation LIKE intranet_v3_0_cod.annexe_unite_facturation;"
            . " INSERT INTO intranet_v3_0_dev.annexe_unite_facturation SELECT * FROM intranet_v3_0_cod.annexe_unite_facturation"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_atelier LIKE intranet_v3_0_cod.arcadia_atelier;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_atelier SELECT * FROM intranet_v3_0_cod.arcadia_atelier"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_client_circuit LIKE intranet_v3_0_cod.arcadia_client_circuit;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_client_circuit SELECT * FROM intranet_v3_0_cod.arcadia_client_circuit"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau LIKE intranet_v3_0_cod.arcadia_client_reseau;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_client_reseau SELECT * FROM intranet_v3_0_cod.arcadia_client_reseau"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau_segment_association LIKE intranet_v3_0_cod.arcadia_client_reseau_segment_association;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_client_reseau_segment_association SELECT * FROM intranet_v3_0_cod.arcadia_client_reseau_segment_association"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_client_segment LIKE intranet_v3_0_cod.arcadia_client_segment;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_client_segment SELECT * FROM intranet_v3_0_cod.arcadia_client_segment"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_emballage_type LIKE intranet_v3_0_cod.arcadia_emballage_type;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_emballage_type SELECT * FROM intranet_v3_0_cod.arcadia_emballage_type"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_maquette_etiquette LIKE intranet_v3_0_cod.arcadia_maquette_etiquette;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_maquette_etiquette SELECT * FROM intranet_v3_0_cod.arcadia_maquette_etiquette"
    );

    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_poste LIKE intranet_v3_0_cod.arcadia_poste;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_poste SELECT * FROM intranet_v3_0_cod.arcadia_poste"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_site_groupe_production LIKE intranet_v3_0_cod.arcadia_site_groupe_production;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_site_groupe_production SELECT * FROM intranet_v3_0_cod.arcadia_site_groupe_production"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_type_calibre LIKE intranet_v3_0_cod.arcadia_type_calibre;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_type_calibre SELECT * FROM intranet_v3_0_cod.arcadia_type_calibre"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.arcadia_type_conservation LIKE intranet_v3_0_cod.arcadia_type_conservation;"
            . " INSERT INTO intranet_v3_0_dev.arcadia_type_conservation SELECT * FROM intranet_v3_0_cod.arcadia_type_conservation"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_action_role LIKE intranet_v3_0_cod.fta_action_role;"
            . " INSERT INTO intranet_v3_0_dev.fta_action_role SELECT * FROM intranet_v3_0_cod.fta_action_role"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_action_site LIKE intranet_v3_0_cod.fta_action_site;"
            . " INSERT INTO intranet_v3_0_dev.fta_action_site SELECT * FROM intranet_v3_0_cod.fta_action_site"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_role LIKE intranet_v3_0_cod.fta_role;"
            . " INSERT INTO intranet_v3_0_dev.fta_role SELECT * FROM intranet_v3_0_cod.fta_role"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_workflow LIKE intranet_v3_0_cod.fta_workflow;"
            . " INSERT INTO intranet_v3_0_dev.fta_workflow SELECT * FROM intranet_v3_0_cod.fta_workflow"
    );
    DatabaseOperation::execute(
            "CREATE TABLE intranet_v3_0_dev.fta_workflow_structure LIKE intranet_v3_0_cod.fta_workflow_structure;"
            . " INSERT INTO intranet_v3_0_dev.fta_workflow_structure SELECT * FROM intranet_v3_0_cod.fta_workflow_structure"
    );
}
/**
 * Nouvelles données du jours de la prod
 */
/**
 * Création des tables dépendant de id_user
 */
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.salaries LIKE intranet_v3_0_cod.salaries;"
        . " INSERT INTO intranet_v3_0_dev.salaries SELECT * FROM intranet_v2_0_prod.salaries"
);
DatabaseOperation::execute(
        "UPDATE intranet_v3_0_dev." . UserModel::TABLENAME
        . " SET " . UserModel::FIELDNAME_PRENOM . "='Non définie'," . UserModel::FIELDNAME_LOGIN . "='non_definie'"
        . " WHERE " . UserModel::KEYNAME . "=-1;"
        . "INSERT INTO `intranet_v3_0_dev`.`salaries` "
        . "(`id_user`, `ascendant_id_salaries`, `nom`, `prenom`, `date_creation_salaries`,"
        . " `id_catsopro`, `id_service`, `id_type`, `actif`, `libre2`, `libre3`, `libre4`,"
        . " `libre5`, `libre6`, `login`, `pass`, `mail`, `ecriture`, `membre_ce`, `lieu_geo`,"
        . " `newsdefil`, `blocage`, `portail_wiki_salaries`) "
        . "VALUES ('-2', '0', 'SYSTEM', 'Utilisateur supprimé', '" . date("Y-m-d") . "', '0',"
        . " '0', '0', 'oui', NULL, NULL, NULL, NULL, NULL, 'utilisateur_supprime',"
        . " NULL, NULL, 'oui', 'non', '', 'non', 'non', NULL); "
);
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.log LIKE intranet_v3_0_cod.log;"
        . " INSERT INTO intranet_v3_0_dev.log SELECT intranet_v2_0_prod.log . * 
             FROM intranet_v2_0_prod.log, intranet_v3_0_dev.salaries
             WHERE intranet_v2_0_prod.log.id_user = intranet_v3_0_dev.salaries.id_user"
);
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.lu LIKE intranet_v3_0_cod.lu;"
        . " INSERT INTO intranet_v3_0_dev.lu SELECT intranet_v2_0_prod.lu . * 
            FROM intranet_v2_0_prod.lu, intranet_v3_0_dev.salaries
            WHERE intranet_v2_0_prod.lu.id_user = intranet_v3_0_dev.salaries.id_user"
);
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.modes LIKE intranet_v3_0_cod.modes;"
        . " INSERT INTO intranet_v3_0_dev.modes SELECT intranet_v2_0_prod.modes.* 
            FROM intranet_v2_0_prod.modes, intranet_v3_0_dev.salaries
            WHERE intranet_v2_0_prod.modes.id_user = intranet_v3_0_dev.salaries.id_user"
);
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.planning_presence_detail LIKE intranet_v3_0_cod.planning_presence_detail;"
        . " INSERT INTO intranet_v3_0_dev.planning_presence_detail SELECT intranet_v2_0_prod.planning_presence_detail . * 
            FROM intranet_v2_0_prod.planning_presence_detail, intranet_v3_0_dev.salaries
            WHERE intranet_v2_0_prod.planning_presence_detail.id_salaries = intranet_v3_0_dev.salaries.id_user"
);

DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.intranet_droits_acces LIKE intranet_v3_0_cod.intranet_droits_acces;"
        . " INSERT INTO intranet_v3_0_dev.intranet_droits_acces SELECT intranet_v2_0_prod.intranet_droits_acces.*
                FROM intranet_v2_0_prod.intranet_droits_acces,intranet_v3_0_dev.salaries,intranet_v3_0_dev.intranet_modules,intranet_v3_0_dev.intranet_actions 
                WHERE intranet_v2_0_prod.intranet_droits_acces.id_user=intranet_v3_0_dev.salaries.id_user 
                AND intranet_v2_0_prod.intranet_droits_acces.id_intranet_modules=intranet_v3_0_dev.intranet_modules.id_intranet_modules 
                AND intranet_v2_0_prod.intranet_droits_acces.id_intranet_actions=intranet_v3_0_dev.intranet_actions.id_intranet_actions"
);


/**
 * Création des tables dépendant de id_fta
 */
$arrayTableFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT * FROM intranet_v2_0_prod.fta f JOIN intranet_v2_0_prod.access_arti2 a  ON a.id_access_arti2 = f.id_access_arti2  AND a.id_fta = f.id_fta");


DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.fta LIKE  intranet_v3_0_cod.fta;"
);



$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 


$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect) or die("connexion impossible");

foreach ($arrayTableFta as $value) {
    /**
     * Nouveau champs : 
     * commentaire
     * duree_vie_technique_fta est devenue DEPRECATED_duree_vie_technique_fta
     */
    $idFta = $value[FtaModel::KEYNAME];
    $idAccessArti2 = $value['id_access_arti2'];
    /**
     * Categorie devient workflow
     */
    $idFtaWorkflow = $value['id_fta_categorie'];


    $idDossierFta = $value[FtaModel::FIELDNAME_DOSSIER_FTA];
    $idVersionDossierFta = $value[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
    $idFtaEtat = $value[FtaModel::FIELDNAME_ID_FTA_ETAT];
    $cretateurFta = $value[FtaModel::FIELDNAME_CREATEUR];
    if ($cretateurFta == 0) {
        $cretateurFta = -1;
    }
    $dateDerniereMajFta = $value[FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA];
    $commentaireMajFtatmp = $value[FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA];
    $commentaireMajFtatmp2 = str_replace('"', '', $commentaireMajFtatmp);
    $commentaireMajFta = stripslashes($commentaireMajFtatmp2);
    $dateEcheanceFta = $value[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
    $codeDouneFta = $value[FtaModel::FIELDNAME_CODE_DOUANE_FTA];
    $poidsEmballageUVC = $value[FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC];
    $poidsBrutUVC = $value[FtaModel::FIELDNAME_POIDS_BRUT_UVC];
    $suffixeAgrologicFta = $value[FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA];
    $origineTransformationFta = $value[FtaModel::FIELDNAME_PRODUIT_TRANSFORME];
    $remarqueFtatmp = $value[FtaModel::FIELDNAME_REMARQUE];
    $remarqueFtatmp2 = str_replace('"', '', $remarqueFtatmp);
    $remarqueFta = stripslashes($remarqueFtatmp2);
    $apresOuvertureFtatmp = $value[FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE];
    $apresOuvertureFtatmp2 = str_replace('"', '', $apresOuvertureFtatmp);
    $apresOuvertureFta = stripslashes($apresOuvertureFtatmp2);
    $conseilRechauffageValideFtatmp = $value[FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE];
    $conseilRechauffageValideFtatmp2 = str_replace('"', '', $conseilRechauffageValideFtatmp);
    $conseilRechauffageValideFta = stripslashes($conseilRechauffageValideFtatmp2);
    $conseilReferenceExterneFtatmp = $value[FtaModel::FIELDNAME_REFERENCE_EXTERNES];
    $conseilReferenceExterneFtatmp2 = str_replace('"', '', $conseilReferenceExterneFtatmp);
    $conseilReferenceExterneFta = stripslashes($conseilReferenceExterneFtatmp2);
    $designationCommercialeFtatmp = $value[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
    $designationCommercialeFtatmp2 = str_replace('"', '', $designationCommercialeFtatmp);
    $designationCommercialeFta = stripslashes($designationCommercialeFtatmp2);
    $siteExpeditionFta = $value[FtaModel::FIELDNAME_SITE_EXPEDITION_FTA];
    $conseilRechauffageExperimentaleFtatmp = $value[FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE_DEVELOPPEMENT];
    $conseilRechauffageExperimentaleFtatmp2 = str_replace('"', '', $conseilRechauffageExperimentaleFtatmp);
    $conseilRechauffageExperimentaleFta = stripslashes($conseilRechauffageExperimentaleFtatmp2);
    $origineMatiereFtatmp = $value[FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE];
    $origineMatiereFtatmp2 = str_replace('"', '', $origineMatiereFtatmp);
    $origineMatiereFta = stripslashes($origineMatiereFtatmp2);
    $idArticleAgrocologic = $value[FtaModel::FIELDNAME_ARTICLE_AGROLOGIC];
    $allergenesMatiereFtatmp = $value[FtaModel::FIELDNAME_LISTE_ALLERGENE];
    $allergenesMatiereFtatmp2 = str_replace('"', '', $allergenesMatiereFtatmp);
    $allergenesMatiereFta = stripslashes($allergenesMatiereFtatmp2);
    $descriptionEmballagetmp = $value[FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE];
    $descriptionEmballagetmp2 = str_replace('"', '', $descriptionEmballagetmp);
    $descriptionEmballage = stripslashes($descriptionEmballagetmp2);
    $listeChapitreMajFta = $value[FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA];
    $verrouillageLibelleEtiquetteFta = $value[FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE];
    $nombrePortionFta = $value[FtaModel::FIELDNAME_NOMBRE_PORTION_FTA];
    $imageEcoEmballage = $value[FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE];
    $idServiceConsommateur = $value[FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR];
    $dateCreation = $value[FtaModel::FIELDNAME_DATE_CREATION];
    $CODE_ARTICLE = $value[FtaModel::FIELDNAME_CODE_ARTICLE];
    $codeArticleClient = $value[FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT];
    $libelleCodeArticleClient = $value[FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT];
    $codeArticleLdc = $value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
    $LIBELLEtmp = $value[FtaModel::FIELDNAME_LIBELLE];
    $LIBELLEtmp2 = str_replace('"', '', $LIBELLEtmp);
    $LIBELLE = stripslashes($LIBELLEtmp2);
    $LIBELLE_CLIENTtmp = $value[FtaModel::FIELDNAME_LIBELLE_CLIENT];
    $LIBELLE_CLIENTtmp2 = str_replace('"', '', $LIBELLE_CLIENTtmp);
    $LIBELLE_CLIENT = stripslashes($LIBELLE_CLIENTtmp2);
    $NB_UNIT_ELEM = $value[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];
    $Poids_ELEM = $value[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE];
    $atmosphereProtectrice = $value[FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE];

    /**
     * Unité_Facturation devient id_annexe_unite_facturation
     */
    $Unité_Facturation = $value[FtaModel::FIELDNAME_UNITE_FACTURATION];
    $actif = $value[FtaModel::FIELDNAME_ACTIF];
    $Site_de_production = $value[FtaModel::FIELDNAME_SITE_ASSEMBLAGE];
    $DureeDeVie = $value[FtaModel::FIELDNAME_DUREE_DE_VIE];
    $DureeDeVieTechnique = $value[FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION];
    $Composition = $value[FtaModel::FIELDNAME_COMPOSITION1];
    $Composition1 = $value[FtaModel::FIELDNAME_COMPOSITION2];
    $libelleMultilangue = $value[FtaModel::FIELDNAME_LIBELLE_MULTILANGUE];
    $K_etat = $value[FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION];
    $EAN_UVC = $value[FtaModel::FIELDNAME_EAN_UVC];
    $EAN_COLIS = $value[FtaModel::FIELDNAME_EAN_COLIS];
    $EAN_PALETTE = $value[FtaModel::FIELDNAME_EAN_PALETTE];
    $activation_codesoft_arti2 = $value[FtaModel::FIELDNAME_ACTIVATION_CODESOFT];
    $id_etiquette_codesoft_arti2 = $value[FtaModel::FIELDNAME_ETIQUETTE_CODESOFT];


    /**
     * Conditions de transfères
     */
    switch ($cretateurFta) {
        //identifiant de l'utilisateur 
        case 486:
            $idFtaWorkflow = 4;
            break;
    }






    /**
     * Champ non utlisé (renommer en intranet_v3_0_dev.nom_du_champ)
     */
    $numft = $value['numft'];
    $TRASH_id_fta_palettisation = $value['TRASH_id_fta_palettisation'];
    $champ_maj_fta = $value['champ_maj_fta'];
    $duree_apres_dernier_processus_fta = $value['duree_apres_dernier_processus_fta'];
    $periodeCommercialisationFta = $value[FtaModel::FIELDNAME_PERIODE_DE_COMMERCIALISATION];
    $code_douane_libelle_fta = $value['code_douane_libelle_fta'];
    $synoptique_valide_ftatmp = $value['synoptique_valide_fta'];
    $synoptique_valide_ftatmp2 = str_replace('"', '', $synoptique_valide_ftatmp);
    $synoptique_valide_fta = stripslashes($synoptique_valide_ftatmp2);
    $presentationFtatmp = $value[FtaModel::FIELDNAME_CONSEIL_DE_PRESENTATION];
    $presentationFtatmp2 = str_replace('"', '', $presentationFtatmp);
    $presentationFta = stripslashes($presentationFtatmp2);
    $nom_abrege_ftatmp = $value[FtaModel::FIELDNAME_NOM_ABREGE];
    $nom_abrege_ftatmp2 = str_replace('"', '', $nom_abrege_ftatmp);
    $nom_abrege_fta = stripslashes($nom_abrege_ftatmp2);
    $synoptique_experimental_ftatmp = $value['synoptique_experimental_fta'];
    $synoptique_experimental_ftatmp2 = str_replace('"', '', $synoptique_experimental_ftatmp);
    $synoptique_experimental_fta = stripslashes($synoptique_experimental_ftatmp2);
    $unite_affichage_fta = $value[FtaModel::FIELDNAME_UNITE_AFFICHAGE];
    $signature_validation_fta = $value['signature_validation_fta'];
    $old_gamdesc = $value['old_gamdesc'];
    $old_segdesc = $value['old_segdesc'];
    $old_condition = $value['old_condition'];
    $old_conservation = $value['old_conservation'];
    $id_annexe_environnement_conservation = $value['id_annexe_environnement_conservation'];
    $date_transfert_industriel = $value['date_transfert_industriel'];
    $NB_UV_PAR_US1 = $value['NB_UV_PAR_US1'];
    $REGROUPEMENT = $value['REGROUPEMENT'];
    $UL2 = $value['UL2'];
    $RGR2 = $value['RGR2'];
    $Rayon = $value['Rayon'];
    $code_barre_specifique = $value['code_barre_specifique'];
    $transfert_PF = $value['transfert_PF'];
    $Zone_picking = $value['Zone_picking'];
    $fiche_palette_specifique = $value['fiche_palette_specifique'];
    $TARIF = $value['TARIF'];
    $pvc_article = $value['pvc_article'];
    $pvc_article_kg = $value['pvc_article_kg'];
    $FAMILLE_BUDGET = $value['FAMILLE_BUDGET'];
    $FAMILLE_ARTICLE = $value['FAMILLE_ARTICLE'];
    $id_access_familles_gammes = $value['id_access_familles_gammes'];
    $Coût_Denrée = $value['Coût_Denrée'];
    $Coût_Emballage = $value['Coût_Emballage'];
    $Coût_Autre = $value['Coût_Autre'];
    $Coût_PF = $value['Coût_PF'];
    $FAMILLE_MKTG = $value['FAMILLE_MKTG'];
    $nouvel_article = $value['nouvel_article'];
    $k_gestion_lot = $value['k_gestion_lot'];






    $sql_inter = "INSERT INTO intranet_v3_0_dev.fta (
id_fta, id_access_arti2, OLD_numft, id_fta_workflow,
 commentaire, OLD_id_fta_palettisation, id_dossier_fta, id_version_dossier_fta,
 OLD_champ_maj_fta, id_fta_etat, createur_fta, date_derniere_maj_fta,
 commentaire_maj_fta, date_echeance_fta, OLD_duree_apres_dernier_processus_fta, OLD_periode_commercialisation_fta,
 code_douane_fta, OLD_code_douane_libelle_fta, poids_emballages_uvc_fta, poids_brut_uvc_fta,
 poids_net_uvc_fta, suffixe_agrologic_fta, OLD_synoptique_valide_fta, origine_transformation_fta,
 remarque_fta, OLD_presentation_fta, apres_ouverture_fta, conseil_rechauffage_valide_fta,
 reference_externe_fta, OLD_duree_vie_technique_fta, designation_commerciale_fta, OLD_nom_abrege_fta,
 site_expedition_fta, conseil_rechauffage_experimentale_fta, OLD_synoptique_experimental_fta, OLD_unite_affichage_fta,
 OLD_signature_validation_fta, OLD_old_gamdesc, OLD_old_segdesc, OLD_old_condition,
 OLD_old_conservation, id_article_agrologic, OLD_id_annexe_environnement_conservation, origine_matiere_fta,
 allergenes_matiere_fta, description_emballage, OLD_date_transfert_industriel, liste_chapitre_maj_fta,
 verrouillage_libelle_etiquette_fta, nombre_portion_fta, OLD_last_id_fta, OLD_id_arcadia_type_calibre,
 OLD_nom_client_demandeur, OLD_besoin_fiche_technique, OLD_echeance_demandeur, OLD_besoin_compostage_fta,
 OLD_calibre_defaut, OLD_id_arcadia_emballage_type, OLD_id_arcadia_client_segment, OLD_quantite_hebdomadaire_estime_commande,
 OLD_nom_machine_fta, OLD_frequence_hebdomadaire_estime_commande, OLD_tare_fta, OLD_perte_matiere_fta,
 OLD_besoin_fiche_rendement, OLD_nom_demandeur_fta, OLD_id_arcadia_atelier, OLD_id_arcadia_client_circuit,
 OLD_id_annexe_environnement_conservation_groupe, OLD_societe_demandeur_fta, OLD_type_marinade_fta, OLD_besoin_fiche_productivite_fta,
 OLD_id_arcadia_poste, OLD_date_demandeur_fta, id_annexe_unite_facturation, OLD_type_minerai,
 OLD_id_arcadia_client_reseau, OLD_id_arcadia_maquette_etiquette, OLD_etude_prix_fta, OLD_bon_fabrication_atelier,
 date_creation, CODE_ARTICLE, code_article_client, code_article_ldc,
 LIBELLE, LIBELLE_CLIENT, NB_UNIT_ELEM, OLD_NB_UV_PAR_US1,
 Poids_ELEM, OLD_REGROUPEMENT, OLD_UL2, OLD_RGR2,
 OLD_Unite_Facturation, Rayon, actif, Site_de_production,
 Duree_de_vie, Duree_de_vie_technique, OLD_code_barre_specifique, OLD_transfert_PF,
 OLD_Zone_picking, OLD_fiche_palette_specifique, OLD_TARIF, pvc_article,
 OLD_pvc_article_kg, OLD_FAMILLE_BUDGET, OLD_FAMILLE_ARTICLE, OLD_id_access_familles_gammes,
 OLD_Cout_Denree, OLD_Cout_Emballage, OLD_Cout_Autre, OLD_Cout_PF,
 OLD_FAMILLE_MKTG, Composition, composition1, libelle_multilangue,
 K_etat, EAN_UVC, EAN_COLIS, EAN_PALETTE,
 OLD_nouvel_article, OLD_k_gestion_lot, activation_codesoft_arti2, id_etiquette_codesoft_arti2,
 atmosphere_protectrice, image_eco_emballage, libelle_code_article_client, id_service_consommateur,
 nom_societe, id_fta_classification2)
VALUES ( \"$idFta\", \"$idAccessArti2\", \"$numft\", \"$idFtaWorkflow\" "
            . ", \"\", \"$TRASH_id_fta_palettisation\", \"$idDossierFta\", \"$idVersionDossierFta\" "
            . ", \"$champ_maj_fta\", \"$idFtaEtat\", \"$cretateurFta\", \"$dateDerniereMajFta\" "
            . ", \"$commentaireMajFta\", \"$dateEcheanceFta\", \"$duree_apres_dernier_processus_fta\", \"$periodeCommercialisationFta\" "
            . ", \"$codeDouneFta\", \"$code_douane_libelle_fta\", \"$poidsEmballageUVC\", \"$poidsBrutUVC\" "
            . ", \"\", \"$suffixeAgrologicFta\", \"$synoptique_valide_fta\", \"$origineTransformationFta\" "
            . ", \"$remarqueFta\", \"$presentationFta\", \"$apresOuvertureFta\", \"$conseilRechauffageValideFta\" "
            . ", \"\", \"$DureeDeVieTechnique\", \"$designationCommercialeFta\", \"$nom_abrege_fta\" "
            . ", \"$siteExpeditionFta\", \"$conseilRechauffageExperimentaleFta\", \"$synoptique_experimental_fta\", \"$unite_affichage_fta\" "
            . ", \"$signature_validation_fta\", \"$old_gamdesc\", \"$old_segdesc\", \"$old_condition\" "
            . ", \"$old_conservation\", \"$idArticleAgrocologic\", \"$id_annexe_environnement_conservation\", \"$origineMatiereFta\" "
            . ", \"$allergenesMatiereFta\", \"$descriptionEmballage\", \"$date_transfert_industriel\", \"$listeChapitreMajFta\" "
            . ", \"$verrouillageLibelleEtiquetteFta\", \"$nombrePortionFta\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"$Unité_Facturation\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"$dateCreation\", \"$CODE_ARTICLE\", \"$codeArticleClient\", \"$codeArticleLdc\" "
            . ", \"$LIBELLE\", \"$LIBELLE_CLIENT\", \"$NB_UNIT_ELEM\", \"$NB_UV_PAR_US1\" "
            . ", \"$Poids_ELEM\", \"$REGROUPEMENT\", \"$UL2\", \"$RGR2\" "
            . ", \"\", \"$Rayon\", \"$actif\", \"$Site_de_production\" "
            . ", \"$DureeDeVie\", \"$DureeDeVieTechnique\", \"$code_barre_specifique\", \"$transfert_PF\" "
            . ", \"$Zone_picking\", \"$fiche_palette_specifique\", \"$TARIF\", \"$pvc_article\" "
            . ", \"$pvc_article_kg\", \"$FAMILLE_BUDGET\", \"$FAMILLE_ARTICLE\", \"$id_access_familles_gammes\" "
            . ", \"$Coût_Denrée\", \"$Coût_Emballage\", \"$Coût_Autre\", \"$Coût_PF\" "
            . ", \"$FAMILLE_MKTG\", \"$Composition\", \"$Composition1\", \"$libelleMultilangue\" "
            . ", \"$K_etat\", \"$EAN_UVC\", \"$EAN_COLIS\", \"$EAN_PALETTE\" "
            . ", \"$nouvel_article\", \"$k_gestion_lot\", \"$activation_codesoft_arti2\", \"$id_etiquette_codesoft_arti2\" "
            . ", \"$atmosphereProtectrice\", \"$imageEcoEmballage\", \"$libelleCodeArticleClient\", \"$idServiceConsommateur\" "
            . ", \"\", NULL)";

    mysql_query("SET NAMES 'utf8'");
    $resultquery = mysql_query($sql_inter) or mysql_error();
    if (!$resultquery) {
        $sqlFalse = $sql_inter;
    }
}

/**
 * Affiliation d'un id_user au createur supprimer
 */
$arrayIdUserExistFromFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT fta.id_fta
                FROM  intranet_v3_0_dev.fta , intranet_v3_0_dev.salaries
                WHERE createur_fta = id_user"
);

$arrayChangeIdSiteProduction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT fta.id_fta
                FROM intranet_v3_0_dev.fta
                WHERE Site_de_production=0 "
);
if ($arrayChangeIdSiteProduction) {
    foreach ($arrayChangeIdSiteProduction as $rowsChangeIdSiteProduction) {
        $idFta = $rowsChangeIdSiteProduction[FtaModel::KEYNAME];
        $sql_inter = "UPDATE intranet_v3_0_dev." . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . "=1"
                . " WHERE " . FtaModel::KEYNAME . "=" . $idFta;
        $resultquery = DatabaseOperation::execute($sql_inter);
        if (!$resultquery) {
            $resultFalse = $sql_inter;
        }
    }
} 
$arrayChangeIdUser = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT fta.id_fta
                FROM intranet_v3_0_dev.fta, intranet_v3_0_dev.salaries
                WHERE createur_fta NOT 
                IN (
                SELECT DISTINCT fta.createur_fta
                FROM intranet_v3_0_dev.fta, intranet_v3_0_dev.salaries
                WHERE createur_fta = id_user
                )"
);
if ($arrayChangeIdUser) {
    foreach ($arrayChangeIdUser as $rowsChangeIdUser) {
        $idFta = $rowsChangeIdUser[FtaModel::KEYNAME];
        $sql_inter = "UPDATE intranet_v3_0_dev." . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_CREATEUR . "=-2"
                . " WHERE " . FtaModel::KEYNAME . "=" . $idFta;
        $resultquery = DatabaseOperation::execute($sql_inter);
        if (!$resultquery) {
            $resultFalse = $sql_inter;
        }
    }
} else {
    echo "Erreur dans le changement d'id de crétauir dans la table fta";
}

/**
 * Extraction Fta suivi de projet
 */
$arrayTableFtaSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT intranet_v2_0_prod.fta_suivi_projet.* FROM intranet_v2_0_prod.fta_suivi_projet,intranet_v3_0_dev.fta WHERE intranet_v2_0_prod.fta_suivi_projet.id_fta=intranet_v3_0_dev.fta.id_fta "
);

DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.fta_suivi_projet LIKE  intranet_v3_0_cod.fta_suivi_projet;"
);

foreach ($arrayTableFtaSuiviProjet as $rowsTableFtaSuiviProjet) {
    $idFtaSuiviProjet = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::KEYNAME];
    $idFta = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_ID_FTA];
    $idFtaChapitreTMP = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE];
    $commentaire_suivi_projettmp = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET];
    $commentaire_suivi_projettmp2 = str_replace('"', '', $commentaire_suivi_projettmp);
    $commentaire_suivi_projet = stripslashes($commentaire_suivi_projettmp2);
    $date_validation_suivi_projet = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET];
    $signature_validation_suivi_projet = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET];
    $date_demarrage_chapitre_fta_suivi_projet = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET];
    $notification_fta_suivi_projet = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET];
    $correction_fta_suivi_projettmp = $rowsTableFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET];
    $correction_fta_suivi_projettmp2 = str_replace('"', '', $correction_fta_suivi_projettmp);
    $correction_fta_suivi_projet = stripslashes($correction_fta_suivi_projettmp2);

    $arrayIdFtaWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT DISTINCT " . FtaModel::FIELDNAME_WORKFLOW
                    . " FROM intranet_v3_0_dev.fta "
                    . " WHERE id_fta = " . $idFta
    );

    foreach ($arrayIdFtaWorkflow as $rowIdFtaWorkflow) {
        $idFtaWorkflow = $rowIdFtaWorkflow[FtaModel::FIELDNAME_WORKFLOW];
    }
    $idFtaChapitre = FtaSuiviProjetModel::checkChapitreV2toV3($idFtaChapitreTMP, $idFtaWorkflow);

    $selectInsert = " INSERT INTO intranet_v3_0_dev." . FtaSuiviProjetModel::TABLENAME
            . " (" . FtaSuiviProjetModel::KEYNAME
            . ", " . FtaSuiviProjetModel::FIELDNAME_ID_FTA
            . ", " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
            . ", " . FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
            . ", " . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET
            . ", " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
            . ", " . FtaSuiviProjetModel::FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET
            . ", " . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
            . ", " . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET . ")"
            . "VALUES ("
            . " \"" . $idFtaSuiviProjet . "\","
            . " \"" . $idFta . "\","
            . " \"" . $idFtaChapitre . "\","
            . " \"" . $commentaire_suivi_projet . "\","
            . " \"" . $date_validation_suivi_projet . "\","
            . " \"" . $signature_validation_suivi_projet . "\","
            . " \"" . $date_demarrage_chapitre_fta_suivi_projet . "\","
            . " \"" . $notification_fta_suivi_projet . "\","
            . " \"" . $correction_fta_suivi_projet . "\")"
    ;

    mysql_query("SET NAMES 'utf8'");
    $resultquery = mysql_query($selectInsert) or mysql_error();
    if (!$resultquery) {
        $sqlFalse = $selectInsert;
    }
}

/**
 * Second traitment fta suivie de projet
 */
$arrayIdFtaSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT id_fta FROM intranet_v3_0_dev.fta_suivi_projet "
);
foreach ($arrayIdFtaSuiviProjet as $rowsIdFtaSuiviProjet) {
    $idFta = $rowsIdFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_ID_FTA];

    FtaSuiviProjetModel::initFtaSuiviProjetV2VersV3($idFta);
}

/**
 * Composition
 */
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.fta_composant LIKE intranet_v3_0_cod.fta_composant;"
        . " INSERT INTO intranet_v3_0_dev.fta_composant SELECT intranet_v2_0_prod.fta_composant.* FROM intranet_v2_0_prod.fta_composant,intranet_v3_0_dev.fta "
        . " WHERE intranet_v2_0_prod.fta_composant.id_fta=intranet_v3_0_dev.fta.id_fta"
);

$arrayFtaCompositionParagraphe = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT id_fta_composant
FROM  intranet_v3_0_dev.fta_composant
WHERE  k_style_paragraphe_ingredient_fta_composition =0 "
);
if ($arrayFtaCompositionParagraphe) {
    foreach ($arrayFtaCompositionParagraphe as $rowsFtaCompositionParagraphe) {
        $idFtaComposant = $rowsFtaCompositionParagraphe[FtaComposantModel::KEYNAME];


        $sql_inter = "UPDATE intranet_v3_0_dev." . FtaComposantModel::TABLENAME
                . " SET " . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION . "=4"
                . " WHERE " . FtaComposantModel::KEYNAME . "=" . $idFtaComposant;
        $resultquery = DatabaseOperation::execute($sql_inter);
        if (!$resultquery) {
            $resultFalse = $resultquery;
        }
    }
}
$arrayFtaCompositionEtiquette = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT id_fta_composant, k_etiquette_fta_composition
FROM intranet_v3_0_dev.fta_composant
WHERE k_etiquette_fta_composition NOT 
IN (

SELECT k_etiquette
FROM intranet_v2_0_prod.codesoft_etiquettes
)"
);
if ($arrayFtaCompositionEtiquette) {
    foreach ($arrayFtaCompositionEtiquette as $rowsFtaCompositionEtiquette) {
        $idFtaComposant = $rowsFtaCompositionEtiquette[FtaComposantModel::KEYNAME];


        $sql_inter = "UPDATE intranet_v3_0_dev." . FtaComposantModel::TABLENAME
                . " SET " . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION . "=-1"
                . " WHERE " . FtaComposantModel::KEYNAME . "=" . $idFtaComposant;
        $resultquery = DatabaseOperation::execute($sql_inter);
        if (!$resultquery) {
            $resultFalse = $resultquery;
        }
    }
}

/**
 * Seconde partie composition
 */
$arrayFtaCompositionIdGeo = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT id_fta_composant, Site_de_production
FROM intranet_v3_0_dev.fta_composant, intranet_v3_0_dev.fta
WHERE id_fta_composant NOT 
IN (

SELECT id_fta_composant
FROM  `fta_composant` , geo
WHERE fta_composant.id_geo = geo.id_geo
)
AND fta.id_fta = fta_composant.id_fta
AND Site_de_production IS NOT NULL "
);
if ($arrayFtaCompositionIdGeo) {
    foreach ($arrayFtaCompositionIdGeo as $rowsFtaCompositionIdGeo) {
        $idFtaComposant = $rowsFtaCompositionIdGeo[FtaComposantModel::KEYNAME];
        $idGeo = $rowsFtaCompositionIdGeo[FtaModel::FIELDNAME_SITE_ASSEMBLAGE];


        $sql_inter = "UPDATE intranet_v3_0_dev." . FtaComposantModel::TABLENAME
                . " SET " . FtaComposantModel::FIELDNAME_ID_GEO . "=" . $idGeo
                . " WHERE " . FtaComposantModel::KEYNAME . "=" . $idFtaComposant;
        $resultquery = DatabaseOperation::execute($sql_inter);
        if (!$resultquery) {
            $resultFalse = $resultquery;
        }
    }
}




/**
 * Extraction  annexe emballage
 */
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe_type LIKE intranet_v3_0_cod.annexe_emballage_groupe_type ;"
        . " INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe_type SELECT * FROM intranet_v2_0_prod.annexe_emballage_groupe_type;"
);
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe LIKE intranet_v3_0_cod.annexe_emballage_groupe ;"
        . " INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe SELECT * FROM intranet_v2_0_prod.annexe_emballage_groupe;"
);

DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.annexe_emballage LIKE intranet_v3_0_cod.annexe_emballage ;"
        . " INSERT INTO intranet_v3_0_dev.annexe_emballage SELECT intranet_v2_0_prod.annexe_emballage.* FROM intranet_v2_0_prod.annexe_emballage,intranet_v3_0_dev.fte_fournisseur,intranet_v3_0_dev.annexe_emballage_groupe"
        . " WHERE intranet_v2_0_prod.annexe_emballage.id_fte_fournisseur=intranet_v3_0_dev.fte_fournisseur.id_fte_fournisseur"
        . " AND intranet_v2_0_prod.annexe_emballage.id_annexe_emballage_groupe=intranet_v3_0_dev.annexe_emballage_groupe.id_annexe_emballage_groupe;"
);


/**
 * Extrationc fta_conditionnement 
 */
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.fta_conditionnement LIKE intranet_v3_0_cod.fta_conditionnement ;"
        . " INSERT INTO intranet_v3_0_dev.fta_conditionnement SELECT intranet_v2_0_prod.fta_conditionnement.* FROM intranet_v2_0_prod.fta_conditionnement,intranet_v3_0_dev.fta,intranet_v3_0_dev.annexe_emballage"
        . " WHERE intranet_v2_0_prod.fta_conditionnement.id_fta=intranet_v3_0_dev.fta.id_fta"
        . " AND intranet_v2_0_prod.fta_conditionnement.id_annexe_emballage=intranet_v3_0_dev.annexe_emballage.id_annexe_emballage;"
);



/**
 * Insertion  de la nouvelle classification
 */
DatabaseOperation::execute(
        "CREATE TABLE intranet_v3_0_dev.classification_fta LIKE intranet_v3_0_cod.classification_fta ;"
        . " INSERT INTO intranet_v3_0_dev.classification_fta SELECT intranet_v2_0_prod.classification_fta . * 
            FROM intranet_v2_0_prod.classification_fta, intranet_v3_0_dev.fta
            WHERE intranet_v2_0_prod.classification_fta.id_fta = intranet_v3_0_dev.fta.id_fta;"
);

require_once '../fta/extraction_classification.php';

$arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT fta.id_fta FROM intranet_v3_0_dev.fta,intranet_v3_0_dev.classification_fta WHERE classification_fta.id_fta =fta.id_fta "
);

foreach ($arrayFta as $rowsFta) {
    $arrayIdFtaClassfication = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT DISTINCT id_fta_classification2 "
                    . " FROM intranet_v3_0_dev.classification_fta, intranet_v3_0_dev.classification_fta2"
                    . " WHERE intranet_v3_0_dev.classification_fta.id_classification_arborescence_article = intranet_v3_0_dev.classification_fta2.id_arborescence"
                    . " AND intranet_v3_0_dev.classification_fta.id_fta = " . $rowsFta[FtaModel::KEYNAME]
    );
    if ($arrayIdFtaClassfication) {
        foreach ($arrayIdFtaClassfication as $value) {
            $sql_inter = "UPDATE intranet_v3_0_dev." . FtaModel::TABLENAME
                    . " SET " . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . "=" . $value[ClassificationFta2Model::KEYNAME]
                    . " WHERE " . FtaModel::KEYNAME . "=" . $rowsFta[FtaModel::KEYNAME];
            $resultquery = DatabaseOperation::execute($sql_inter);

            if (!$resultquery) {
                $sqlFalse = $sql_inter;
            }
        }
    }
}

DatabaseOperation::execute(
        "ALTER TABLE classification_fta2
        DROP id_arborescence");
/**
 * Ajout des clé étrangère
 */ {

// Fta workflow structure    
    $resultquery28 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery28) {
        $resultFalse = $resultquery28;
    }
    $resultquery29 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_role(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery29) {
        $resultFalse = $resultquery29;
    }
    $resultquery30 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery30) {
        $resultFalse = $resultquery30;
    }
    $resultquery31 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES intranet_v3_0_dev.fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery31) {
        $resultFalse = $resultquery31;
    }

//annexe emballage
    $resultquery = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.annexe_emballage
       ADD CONSTRAINT FOREIGN KEY (id_fte_fournisseur) REFERENCES intranet_v3_0_dev.fte_fournisseur(id_fte_fournisseur)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery) {
        $resultFalse = $resultquery;
    }

    $resultquery2 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.annexe_emballage
        ADD CONSTRAINT FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery2) {
        $resultFalse = $resultquery2;
    }
//Fta
    $resultquery3 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta
       ADD CONSTRAINT FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );

    if (!$resultquery3) {
        $resultFalse = $resultquery3;
    }
    $resultquery4 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_etat) REFERENCES intranet_v3_0_dev.fta_etat(id_fta_etat)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery4) {
        $resultFalse = $resultquery4;
    }

    $resultquery51 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (createur_fta) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery51) {
        $resultFalse = $resultquery51;
    }
    $resultquery52 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (Site_de_production) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery52) {
        $resultFalse = $resultquery52;
    }
    $resultquer6 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_classification2) REFERENCES intranet_v3_0_dev.classification_fta2(id_fta_classification2)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquer6) {
        $resultFalse = $resultquer6;
    }
//Fta action role

    $resultquery7 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery7) {
        $resultFalse = $resultquery7;
    }
    $resultquery8 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery8) {
        $resultFalse = $resultquery8;
    }
    $resultquery9 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery9) {
        $resultFalse = $resultquery9;
    }
//Fta action site

    $resultquery10 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_site
        ADD CONSTRAINT FOREIGN KEY (id_site) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery10) {
        $resultFalse = $resultquery10;
    }

    $resultquery11 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_site
       ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery11) {
        $resultFalse = $resultquery11;
    }

    $resultquery12 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_action_site
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery12) {
        $resultFalse = $resultquery12;
    }

//Fta composant
    $resultquery13 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery13) {
        $resultFalse = $resultquery13;
    }
    $resultquery14 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_composant
       ADD CONSTRAINT  FOREIGN KEY (id_geo) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery14) {
        $resultFalse = $resultquery14;
    }
    $resultquery15 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_style_paragraphe_ingredient_fta_composition) REFERENCES intranet_v3_0_dev.codesoft_style_paragraphe(k_codesoft_style_paragraphe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery15) {
        $resultFalse = $resultquery15;
    }
    $resultquery16 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_etiquette_fta_composition) REFERENCES intranet_v3_0_dev.codesoft_etiquettes(k_etiquette)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery16) {
        $resultFalse = $resultquery16;
    }


//Fta conditionnement
    $resultquery18 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery18) {
        $resultFalse = $resultquery18;
    }
    $resultquery19 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery19) {
        $resultFalse = $resultquery19;
    }
    $resultquery20 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe_type) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe_type(id_annexe_emballage_groupe_type)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery20) {
        $resultFalse = $resultquery20;
    }
    $resultquery21 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage) REFERENCES intranet_v3_0_dev.annexe_emballage(id_annexe_emballage)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery21) {
        $resultFalse = $resultquery21;
    }


//Fta processus
    $resultquery22 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_processus
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery22) {
        $resultFalse = $resultquery22;
    }

// Fta processus cycle
    $resultquery23 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
       ADD CONSTRAINT  FOREIGN KEY (id_init_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery23) {
        $resultFalse = $resultquery23;
    }
    $resultquery24 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_next_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery24) {
        $resultFalse = $resultquery24;
    }
    $resultquery25 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery25) {
        $resultFalse = $resultquery25;
    }

// Fta suivie projet
    $resultquery26 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery26) {
        $resultFalse = $resultquery26;
    }
    $resultquery27 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES intranet_v3_0_dev.fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery27) {
        $resultFalse = $resultquery27;
    }


// Intranet actions     
    $resultquery32 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.intranet_actions
        ADD CONSTRAINT  FOREIGN KEY (parent_intranet_actions) REFERENCES intranet_v3_0_dev.fta_workflow(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery32) {
        $resultFalse = $resultquery32;
    }
// Intranet droits acces
    $resultquery33 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_modules) REFERENCES intranet_v3_0_dev.intranet_modules(id_intranet_modules)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery33) {
        $resultFalse = $resultquery33;
    }
    $resultquery34 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
       ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery34) {
        $resultFalse = $resultquery34;
    }
    $resultquery35 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery35) {
        $resultFalse = $resultquery35;
    }

// log
    $resultquery36 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.log
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery36) {
        $resultFalse = $resultquery36;
    }
// modes
    $resultquery37 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.modes
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery37) {
        $resultFalse = $resultquery37;
    }
//  Planning presence detail
    $resultquery38 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.planning_presence_detail
        ADD CONSTRAINT  FOREIGN KEY (id_salaries) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery38) {
        $resultFalse = $resultquery38;
    }

// Lu
    $resultquery39 = DatabaseOperation::execute(
                    "ALTER TABLE intranet_v3_0_dev.lu
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    );
    if (!$resultquery39) {
        $resultFalse = $resultquery39;
    }
}
mysql_close();

$bloc .="Vous avez bien envoyer les données dans la table";

/**
 * Rendu HTML
 */
echo "
$navigue
<form $method action = \"$page_action\" name=\"form_action\" method=\"post\">
     <input type=hidden name=action value=$action>
     <input type=hidden name=id_fta value=$id_fta>
     <input type=hidden name=abreviation_fta_etat value=$abreviationFtaEtat>
     <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
     <input type=hidden name=id_fta_chapitre value=$id_fta_chapitre>
     <input type=hidden name=id_fta_suivi_projet value=$id_fta_suivi_projet>
     <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />
     <input type=\"hidden\" name=\"nom_fta_chapitre_encours\" value=\"$nom_fta_chapitre_encours\" />
     <input type=\"hidden\" name=\"comeback\" value=\"$comeback\" />

     $javascript
     <$html_table>
     <tr><td>

              $bloc

     </td></tr>
     </table>
     </form>

     ";

//$recordSetFta = new FtaModel($id_fta);
//$test = $recordSetFta->getFieldNomDemandeur();
//
//echo "<pre>";
//print_r ($_SESSION);
////print_r($recordSetFta);
//echo "</pre>";

/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");

//SELECT DISTINCT *
//                FROM intranet_v2_0_prod.access_arti2,intranet_v2_0_prod.fta
//            WHERE Site_de_production=0 AND fta.id_fta=access_arti2.id_fta AND access_arti2.id_access_arti2=fta.id_access_arti2   
//      18541  
//SELECT fta_composant . * 
//FROM  `fta_composant` 
//WHERE fta_composant.id_geo NOT 
//IN (
//
//SELECT geo.id_geo
//FROM geo
//)
//AND fta_composant.id_geo IS NOT NULL
//   27 532     
//        SELECT id_fta_composant, Site_de_production
//FROM fta_composant, fta
//WHERE id_fta_composant NOT 
//IN (
//
//SELECT id_fta_composant
//FROM  `fta_composant` , geo
//WHERE fta_composant.id_geo = geo.id_geo
//)
//AND fta.id_fta = fta_composant.id_fta
//AND Site_de_production IS NOT NULL 
//        
//        il manque les 375 
//        
//        
//        SELECT id_fta_composant, Site_de_production
//FROM fta_composant, fta
//WHERE id_fta_composant NOT 
//IN (
//
//SELECT id_fta_composant
//FROM  `fta_composant` , geo
//WHERE fta_composant.id_geo = geo.id_geo
//)
//AND fta.id_fta = fta_composant.id_fta
        
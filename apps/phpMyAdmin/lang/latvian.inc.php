<?php
/* $Id: latvian.inc.php,v 1.6 2002/04/21 11:16:44 loic1 Exp $ */

/**
 * Latvian language file by Sandis Jçrics <sandisj at parks.lv>
 */

$charset = 'windows-1257';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('baiti', 'KB', 'MB', 'GB');

$day_of_week = array('Sv', 'Pr', 'Ot', 'Tr', 'Ce', 'Pt', 'Se');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jûn', 'Jûl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d%m.%Y %H:%M';


$strAccessDenied = 'Pieeja aizliegta';
$strAction = 'Darbîba';
$strAddDeleteColumn = 'Pievienot/Dzçst laukus (kolonnas)';
$strAddDeleteRow = 'Pievienot/Dzçst ierakstu';
$strAddNewField = 'Pievienot jaunu lauku';
$strAddPriv = 'Pievienot jaunu privilçìiju';
$strAddPrivMessage = 'Jûs pievienojât jaunu privilçìiju.';
$strAddSearchConditions = 'Pievienot meklçðanas nosacîjumus ("where" izteiksmes íermenis):';
$strAddToIndex = 'Pievienot indeksam &nbsp;%s&nbsp;kolonn(u/as)';
$strAddUser = 'Pievienot jaunu lietotâju';
$strAddUserMessage = 'Jûs pievienojât jaunu lietotâju.';
$strAffectedRows = 'Ietekmçto rindu skaits:';
$strAfter = 'Pçc %s';
$strAfterInsertBack = 'Atgriezties iepriekðçjâ lapâ atpakaï';
$strAfterInsertNewInsert = 'Ievietot vçl vienu rindu';
$strAll = 'Visi';
$strAlterOrderBy = 'Mainît datu kârtoðanas laukus';
$strAnalyzeTable = 'Analizçt tabulu';
$strAnd = 'Un';
$strAnIndex = 'Indekss tieka pievienots uz %s';
$strAny = 'Jebkurð';
$strAnyColumn = 'Jebkura kolonna';
$strAnyDatabase = 'Jebkura datubâze';
$strAnyHost = 'Jebkurð hosts';
$strAnyTable = 'Jebkura tabula';
$strAnyUser = 'Jebkurð lietotâjs';
$strAPrimaryKey = 'Primârâ atslçga pievienota uz lauka %s';
$strAscending = 'Augoðâ secîbâ';
$strAtBeginningOfTable = 'Tabulas sâkumâ';
$strAtEndOfTable = 'Tabulas beigâs';
$strAttr = 'Atribûti';

$strBack = 'Atpakaï';
$strBinary = 'Binârais';
$strBinaryDoNotEdit = 'Binârais - netiek labots';
$strBookmarkDeleted = 'Ieraksts tika dzçsts.';
$strBookmarkLabel = 'Nosaukums';
$strBookmarkQuery = 'Saglabâtie SQL-vaicâjumi';
$strBookmarkThis = 'Saglabât ðo SQL-vaicâjumu';
$strBookmarkView = 'Tikai apskatît';
$strBrowse = 'Apskatît';
$strBzip = 'saarhivçts ar bzip';

$strCantLoadMySQL = 'nevar ielâdçt MySQL paplaðinâjumu,<br />lûdzu pârbaudiet PHP konfigurâciju.';
$strCantRenameIdxToPrimary = 'Nevar pârsaukt indeksu par PRIMARY!';
$strCardinality = 'Kardinalitâte';
$strCarriage = 'Rindas nobeiguma simbols: \\r';
$strChange = 'Labot';
$strChangePassword = 'Mainît paroli';
$strCheckAll = 'Iezîmçt visu';
$strCheckDbPriv = 'Pârbaudît privilçìijas uz datubâzi';
$strCheckTable = 'Pârbaudît tabulu';
$strColumn = 'Kolonna';
$strColumnNames = 'Kolonnu nosaukumi';
$strCompleteInserts = 'Pilnas INSERT izteiksmes';
$strConfirm = 'Vai Jûs tieðâm gribat to darît?';
$strCookiesRequired = 'Ðî lapa nestrâdâs korekti, ja \'Cookies\' ir atslçgtas jûsu pârlûkprogrammas konfigurâcijâ.';
$strCopyTable = 'Kopçt tabulu uz (datubâze<b>.</b>tabula):';
$strCopyTableOK = 'Tabula %s tika pârkopçta uz %s.';
$strCreate = 'Izveidot';
$strCreateIndex = 'Izveidot indeksu uz&nbsp;%s&nbsp;laukiem';
$strCreateIndexTopic = 'Izveidot jaunu indeksu';
$strCreateNewDatabase = 'Izveidot jaunu datubâzi';
$strCreateNewTable = 'Izveidot jaunu tabulu datubâzç %s';
$strCriteria = 'Kritçrijs';

$strData = 'Dati';
$strDatabase = 'Datubâze ';
$strDatabaseHasBeenDropped = 'Datubâze %s tika izdzçsta.';
$strDatabases = 'datubâzes';
$strDatabasesStats = 'Datubâzu statistika';
$strDatabaseWildcard = 'Datubâze (var lietot aizstâjçjzîmes):';
$strDataOnly = 'Tikai dati';
$strDefault = 'Noklusçts';
$strDelete = 'Dzçst';
$strDeleted = 'Ieraksts tika dzçsts';
$strDeletedRows = 'Ieraksti dzçsti:';
$strDeleteFailed = 'Dzçðana nenotika!';
$strDeleteUserMessage = 'Jûs nodzçsât lietotâju %s.';
$strDescending = 'Dilstoðâ secîbâ';
$strDisplay = 'Attçlot';
$strDisplayOrder = 'Attçloðanas secîba:';
$strDoAQuery = 'Izpildît "vaicâjumu pçc parauga" (aizstâjçjzîme: "%")';
$strDocu = 'Dokumentâcija';
$strDoYouReally = 'Vai Jûs tieðâm gribat ';
$strDrop = 'Likvidçt';
$strDropDB = 'Likvidçt datubâzi %s';
$strDropTable = 'Likvidçt tabulu';
$strDumpingData = 'Dati tabulai';
$strDynamic = 'dinamisks';

$strEdit = 'Labot';
$strEditPrivileges = 'Mainît privilçìijas';
$strEffective = 'Efektîvs';
$strEmpty = 'Iztukðot';
$strEmptyResultSet = 'MySQL atgrieza tukðo rezultâtu (0 rindas).';
$strEnd = 'Beigas';
$strEnglishPrivileges = ' Piezîme: MySQL privilçìiju apzîmçjumi tiek rakstîti angïu valodâ ';
$strError = 'Kïûda';
$strExtendedInserts = 'Paplaðinâtâs INSERT izteiksmes';
$strExtra = 'Ekstras';

$strField = 'Lauks';
$strFieldHasBeenDropped = 'Lauks %s tika izdzçsts';
$strFields = 'Lauku skaits';
$strFieldsEmpty = ' Lauku skaits ir nulle! ';
$strFieldsEnclosedBy = 'Lauki iekïauti iekð';
$strFieldsEscapedBy = 'Glâbjoðâ (escape) rakstzîme ir';
$strFieldsTerminatedBy = 'Lauki atdalîti ar';
$strFixed = 'fiksçts';
$strFlushTable = 'Atsvaidzinât tabulu ("FLUSH")';
$strFormat = 'Formats';
$strFormEmpty = 'Formâ trûkst vçrtîbu!';
$strFullText = 'Pilni teksti';
$strFunction = 'Funkcija';

$strGenTime = 'Izveidoðanas laiks';
$strGo = 'Aiziet!';
$strGrants = 'Tiesîbas';
$strGzip = 'saarhivçts ar gzip';

$strHasBeenAltered = 'tika modificçta.';
$strHasBeenCreated = 'tika izveidota.';
$strHome = 'Sâkumlapa';
$strHomepageOfficial = 'Oficiâlâ phpMyAdmin mâjaslapa';
$strHomepageSourceforge = 'phpMyAdmin lejuplâdes lapa iekð Sourceforge';
$strHost = 'Hosts';
$strHostEmpty = 'Hosts nav norâdîts!';

$strIdxFulltext = 'Pilni teksti';
$strIfYouWish = 'Ja Jûs vçlaties ielâdçt tikai daþas tabulas kolonnas, norâdiet to nosaukumus, atdalot tos ar komatu.';
$strIgnore = 'Ignorçt';
$strIndex = 'Indekss';
$strIndexes = 'Indeksi';
$strIndexHasBeenDropped = 'Indekss %s tika izdzçsts';
$strIndexName = 'Indeksa nosaukums&nbsp;:';
$strIndexType = 'Indeksa tips&nbsp;:';
$strInsert = 'Pievienot';
$strInsertAsNewRow = 'Ievietot kâ jaunu rindu';
$strInsertedRows = 'Rindas pievienotas:';
$strInsertNewRow = 'Pievienot jaunu rindu';
$strInsertTextfiles = 'Ievietot tabulâ datus no teksta faila';
$strInstructions = 'Instrukcijas';
$strInUse = 'lietoðanâ';
$strInvalidName = '"%s" ir rezervçts vârds, Jûs nevarat lietot to kâ datubâzes/tabulas/lauka nosaukumu.';

$strKeepPass = 'Nemainît paroli';
$strKeyname = 'Atslçgas nosaukums';
$strKill = 'Nogalinât';

$strLength = 'Garums';
$strLengthSet = 'Garums/Vçrtîbas*';
$strLimitNumRows = 'Rindu skaits vienâ lapâ';
$strLineFeed = 'Rindas beigu simbols: \\n';
$strLines = 'Rindas';
$strLinesTerminatedBy = 'Rindas atdalîtas ar';
$strLocationTextfile = 'Teksta faila atraðanâs vieta';
$strLogin = 'Ieiet';
$strLogout = 'Iziet';
$strLogPassword = 'Parole:';
$strLogUsername = 'Lietotâjvârds:';

$strModifications = 'Grozîjumi tika saglabâti';
$strModify = 'Modificçt';
$strModifyIndexTopic = 'Modificçt indeksu';
$strMoveTable = 'Pârvietot tabulu uz (datubâze<b>.</b>tabula):';
$strMoveTableOK = 'Tabula %s tika pârvietota uz %s.';
$strMySQLReloaded = 'MySQL serveris tika pârlâdçts.';
$strMySQLSaid = 'MySQL teica: ';
$strMySQLServerProcess = 'MySQL %pma_s1% strâdâ uz %pma_s2% kâ %pma_s3%';
$strMySQLShowProcess = 'Parâdît procesus';
$strMySQLShowStatus = 'Parâdît MySQL izpildes laika informâciju';
$strMySQLShowVars = 'Parâdît MySQL sistçmas mainîgos';

$strName = 'Nosaukums';
$strNbRecords = 'Rindu skaits';
$strNext = 'Nâkamais';
$strNo = 'Nç';
$strNoDatabases = 'Nav datubâzu';
$strNoDropDatabases = '"DROP DATABASE" komanda ir aizliegta.';
$strNoFrames = 'phpMyAdmin ir vairâk draudzîgs <b>freimu atbalstoðu</b> pârlûkprogrammu.';
$strNoIndex = 'Nav definçti indeksi!';
$strNoIndexPartsDefined = 'Nav definçto indeksa daïu!';
$strNoModification = 'Netika labots';
$strNone = 'Nekas';
$strNoPassword = 'Nav paroles';
$strNoPrivileges = 'Nav privilçìiju';
$strNoQuery = 'Nav SQL vaicâjuma!';
$strNoRights = 'Jums nav pietiekoði tiesîbu, lai atrastos ðeit tagad!';
$strNoTablesFound = 'Tabulas nav atrastas ðajâ datubâzç.';
$strNotNumber = 'Tas nav numurs!';
$strNotValidNumber = ' nav derîgs lauku skaits!';
$strNoUsersFound = 'Lietotâji netika atrasti.';
$strNull = 'Nulle';

$strOftenQuotation = 'Parasti pçdiòas. NEOBLIGÂTS nozîmç, ka tikai \'char\' un \'varchar\' tipa lauki tiek norobeþoti ar ðo simbolu.';
$strOptimizeTable = 'Optimizçt tabulu';
$strOptionalControls = 'Neobligâts. Nosaka, kâ rakstît vai lasît speciâlâs rakstzîmes.';
$strOptionally = 'NEOBLIGÂTS';
$strOr = 'Vai';
$strOverhead = 'Pârtçriòð';

$strPartialText = 'Daïçji teksti';
$strPassword = 'Parole';
$strPasswordEmpty = 'Parole nav norâdîta!';
$strPasswordNotSame = 'Paroles nesakrît!';
$strPHPVersion = 'PHP Versija';
$strPmaDocumentation = 'phpMyAdmin dokumentâcija';
$strPmaUriError = '<tt>$cfgPmaAbsoluteUri</tt> direktîvai ir JÂBÛT nodefinçtai Jûsu konfigurâcijas failâ!';
$strPos1 = 'Sâkums';
$strPrevious = 'Iepriekðçjie';
$strPrimary = 'Primârâ';
$strPrimaryKey = 'Primârâ atslçga';
$strPrimaryKeyHasBeenDropped = 'Primârâ atslçga tika izdzçsta';
$strPrimaryKeyName = 'Primârâs atslçgas nosaukumam jâbût... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>jâbût</b> tikai un <b>vienîgi</b> primârâs atslçgas indeksa nosaukumam!)';
$strPrintView = 'Izdrukas versija';
$strPrivileges = 'Privilçìijas';
$strProperties = 'Îpaðîbas';

$strQBE = 'Vaicâjums pçc parauga';
$strQBEDel = 'Dzçst';
$strQBEIns = 'Ielikt';
$strQueryOnDb = 'SQL-vaicâjums uz datubâzes <b>%s</b>:';

$strRecords = 'Ieraksti';
$strReferentialIntegrity = 'Pârbaudît referenciâlo integritâti:';
$strReloadFailed = 'Nesanâca pârlâdçt MySQL serveri.';
$strReloadMySQL = 'Pârlâdçt MySQL serveri';
$strRememberReload = 'Neaizmirstiet pârlâdçt serveri.';
$strRenameTable = 'Pârsaukt tabulu uz';
$strRenameTableOK = 'Tabula %s tika pârsaukta par %s';
$strRepairTable = 'Restaurçt tabulu';
$strReplace = 'Aizvietot';
$strReplaceTable = 'Aizvietot tabulas datus ar datiem no faila';
$strReset = 'Atcelt';
$strReType = 'Atkârtojiet';
$strRevoke = 'Atsaukt';
$strRevokeGrant = 'Atòemt \'Grant\' tiesîbas';
$strRevokeGrantMessage = 'Jûs atòçmât \'Grant\' tiesîbas lietotâjam %s';
$strRevokeMessage = 'Jûs atòçmât privilçgijas lietotâjam %s';
$strRevokePriv = 'Atòemt privilçìijas';
$strRowLength = 'Rindas garums';
$strRows = 'Rindas';
$strRowsFrom = 'rindas sâkot no';
$strRowSize = ' Rindas izmçrs ';
$strRowsModeHorizontal = 'horizontâlâ';
$strRowsModeOptions = '%s skatâ un atkârtot virsrakstus ik pçc %s rindâm';
$strRowsModeVertical = 'vertikâlâ';
$strRowsStatistic = 'Rindas statistika';
$strRunning = 'atrodas uz %s';
$strRunQuery = 'Izpildît vaicâjumu';
$strRunSQLQuery = 'Izpildît SQL-vaicâjumu(s) uz datubâzes %s';

$strSave = 'Saglabât';
$strSelect = 'Atlasît';
$strSelectADb = 'Lûdzu izvçlieties datubâzi';
$strSelectAll = 'Iezîmçt visu';
$strSelectFields = 'Izvçlieties laukus (kaut vienu):';
$strSelectNumRows = 'vaicâjumâ';
$strSend = 'Saglabât kâ failu';
$strServerChoice = 'Servera izvçle';
$strServerVersion = 'Servera versija';
$strSetEnumVal = 'Ja lauka tips ir "enum" vai "set", lûdzu ievadiet vçrtîbas atbilstoði ðim formatam: \'a\',\'b\',\'c\'...<br />Ja Jums vajag ielikt atpakaïçjo slîpsvîtru (\) vai vienkârðo pçdiòu (\') kâdâ no ðîm vçrtîbâm, lieciet tâs priekðâ atpakaïçjo slîpsvîtru (piemçram, \'\\\\xyz\' vai \'a\\\'b\').';
$strShow = 'Râdît';
$strShowAll = 'Râdît visu';
$strShowCols = 'Râdît kolonnas';
$strShowingRecords = 'Parâdu rindas';
$strShowPHPInfo = 'Parâdît PHP informâciju';
$strShowTables = 'Râdît tabulas';
$strShowThisQuery = ' Râdît ðo vaicâjumu ðeit atkal ';
$strSingly = '(vienkârði)';
$strSize = 'Izmçrs';
$strSort = 'Kârtoðana';
$strSpaceUsage = 'Diska vietas lietoðana';
$strSQLQuery = 'SQL-vaicâjums';
$strStartingRecord = 'Sâkot no rindas';
$strStatement = 'Parametrs';
$strStrucCSV = 'CSV dati';
$strStrucData = 'Struktûra un dati';
$strStrucDrop = 'Pievienot tabulu dzçðanas komandas';
$strStrucExcelCSV = 'CSV dati MS Excel formâtâ';
$strStrucOnly = 'Tikai struktûra';
$strSubmit = 'Nosûtît';
$strSuccess = 'Jûsu SQL-vaicâjums tika veiksmîgi izpildîts';
$strSum = 'Kopumâ';

$strTable = 'Tabula ';
$strTableComments = 'Komentârs tabulai';
$strTableEmpty = 'Tabulas nosaukums nav norâdîts!';
$strTableHasBeenDropped = 'Tabula %s tika izdzçsta';
$strTableHasBeenEmptied = 'Tabula %s tika iztukðota';
$strTableHasBeenFlushed = 'Tabula %s tika atsvaidzinâta';
$strTableMaintenance = 'Tabulas apkalpoðana';
$strTables = '%s tabula(s)';
$strTableStructure = 'Tabulas struktûra tabulai';
$strTableType = 'Tabulas tips';
$strTextAreaLength = ' Sava garuma dçï,<br /> ðis lauks var bût nerediìçjams ';
$strTheContent = 'Jûsu faila saturs tika ievietots.';
$strTheContents = 'Faila saturs aizvieto izvçlçtâs tabulas saturu rindiòâm ar identisko primârâs vai unikâlâs atslçgas vçrtîbu.';
$strTheTerminator = 'Lauku atdalîtâjs.';
$strTotal = 'kopâ';
$strType = 'Tips';

$strUncheckAll = 'Neiezîmçt neko';
$strUnique = 'Unikâlais';
$strUnselectAll = 'Neiezîmçt neko';
$strUpdatePrivMessage = 'Jûs modificçjât privilçìijas objektam %s.';
$strUpdateProfile = 'Modificçt profilu:';
$strUpdateProfileMessage = 'Profils tika modificçts.';
$strUpdateQuery = 'Modificçðanas vaicâjums';
$strUsage = 'Aizòem';
$strUseBackquotes = 'Lietot apostrofa simbolu [`] tabulu un lauku nosaukumiem';
$strUser = 'Lietotâjs';
$strUserEmpty = 'Lietotâja vârds nav norâdîts!';
$strUserName = 'Lietotâjvârds';
$strUsers = 'Lietotâji';
$strUseTables = 'Lietot tabulas';

$strValue = 'Vçrtîba';
$strViewDump = 'Apskatît tabulas dampu (shçmu)';
$strViewDumpDB = 'Apskatît datubâzes dampu (shçmu)';

$strWelcome = 'Laipni lûgti %s';
$strWithChecked = 'Ar iezîmçto:';
$strWrongUser = 'Kïûdains lietotâjvârds/parole. Pieeja aizliegta.';

$strYes = 'Jâ';

$strZip = 'arhivçts ar zip';

// To translate
?>

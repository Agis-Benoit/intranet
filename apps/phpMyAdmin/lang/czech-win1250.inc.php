<?php
/* $Id: czech-win1250.inc.php,v 1.127.2.2 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Czech language file by
 *   Michal Èihaø <nijel at users.sourceforge.net>
 */

$charset = 'windows-1250';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = '.';
$byteUnits = array('bajtù', 'kB', 'MB', 'GB');

$day_of_week = array('Nedìle', 'Pondìlí', 'Úterý', 'Støeda', 'Ètvrtek', 'Pátek', 'Sobota');
$month = array('ledna', 'února', 'bøezna', 'dubna', 'kvìtna', 'èervna', 'èervence', 'srpna', 'záøí', 'øíjna', 'listopadu', 'prosince');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%a %e. %b %Y, %H:%M';


$strAccessDenied = 'Pøístup odepøen';
$strAction = 'Akce';
$strAddDeleteColumn = 'Pøidat/Smazat sloupec';
$strAddDeleteRow = 'Pøidat/Smazat øádek s podmínkou';
$strAddNewField = 'Pøidat nový sloupec';
$strAddPriv = 'Pøidat nové privilegium';
$strAddPrivMessage = 'Oprávnìní bylo pøidáno.';
$strAddSearchConditions = 'Pøidat vyhledávací parametry (obsah dotazu po pøíkazu "WHERE"):';
$strAddToIndex = 'Pøidat do indexu  &nbsp;%s&nbsp;sloupcù';
$strAddUser = 'Pøidat nového uivatele';
$strAddUserMessage = 'Uivatel byl pøidán.';
$strAffectedRows = 'Ovlivnìné øádky:';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Zpìt';
$strAfterInsertNewInsert = 'Vloit dalí øádek';
$strAll = 'Vechno';
$strAlterOrderBy = 'Zmìnit poøadí tabulky podle';
$strAnalyzeTable = 'Analyzovat tabulku';
$strAnd = 'a';
$strAnIndex = 'K&nbsp;tabulce %s byl pøidán index';
$strAny = 'Jakýkoliv';
$strAnyColumn = 'Jakýkoliv sloupec';
$strAnyDatabase = 'Jakákoliv databáze';
$strAnyHost = 'Jakýkoliv poèítaè';
$strAnyTable = 'Jakákoliv tabulka';
$strAnyUser = 'Jakýkoliv uivatel';
$strAPrimaryKey = 'V&nbsp;tabulce %s byl vytvoøen primární klíè';
$strAscending = 'Vzestupnì';
$strAtBeginningOfTable = 'Na zaèátku tabulky';
$strAtEndOfTable = 'Na konci tabulky';
$strAttr = 'Vlastnosti';

$strBack = 'Zpìt';
$strBinary = ' Binární ';
$strBinaryDoNotEdit = ' Binární - neupravujte ';
$strBookmarkDeleted = 'Poloka byla smazána z&nbsp;oblíbených.';
$strBookmarkLabel = 'Název';
$strBookmarkQuery = 'Oblíbený SQL dotaz';
$strBookmarkThis = 'Pøidat tento SQL dotaz do oblíbených';
$strBookmarkView = 'Jen zobrazit';
$strBrowse = 'Projít';
$strBzip = '"zabzipováno"';

$strCantLoadMySQL = 'nelze nahrát rozíøení pro MySQL,<br />prosím zkontrolujte nastavení PHP.';
$strCantRenameIdxToPrimary = 'Index nemùete pøejmenovat na "PRIMARY"!';
$strCardinality = 'Mohutnost';
$strCarriage = 'Návrat vozíku (CR): \\r';
$strChange = 'Zmìnit';
$strChangePassword = 'Zmìnit heslo';
$strCheckAll = 'Zakrtnout ve';
$strCheckDbPriv = 'Zkontrolovat oprávnìní pro databázi';
$strCheckTable = 'Zkontrolovat tabulku';
$strColumn = 'Sloupec';
$strColumnNames = 'Názvy sloupcù';
$strCompleteInserts = 'Uplné inserty';
$strConfirm = 'Opravdu chcete toto provést?';
$strCookiesRequired = 'Bìhem tohoto kroku musíte mít povoleny cookies.';
$strCopyTable = 'Kopírovat tabulku do (databáze<b>.</b>tabulka):';
$strCopyTableOK = 'Tabulka %s byla zkopírována do %s.';
$strCreate = 'Vytvoøit';
$strCreateIndex = 'Vytvoøit index na&nbsp;%s&nbsp;sloupcích';
$strCreateIndexTopic = 'Vytvoøit nový index';
$strCreateNewDatabase = 'Vytvoøit novou databázi';
$strCreateNewTable = 'Vytvoøit novou tabulku v&nbsp;databázi %s';
$strCriteria = 'Podmínka';

$strData = 'Data';
$strDatabase = 'Databáze ';
$strDatabaseHasBeenDropped = 'Databáze %s byla zruena.';
$strDatabases = 'databáze';
$strDatabasesStats = 'Statistiky databází';
$strDatabaseWildcard = 'Databáze (zástupné znaky povoleny):';
$strDataOnly = ' Jen data';
$strDefault = 'Výchozí';
$strDelete = 'Smazat';
$strDeleted = 'Øádek byl smazán';
$strDeletedRows = 'Smazané øádky:';
$strDeleteFailed = 'Smazání selhalo!';
$strDeleteUserMessage = 'Byl smazán uivatel %s.';
$strDescending = 'Sestupnì';
$strDisplay = 'Zobrazit';
$strDisplayOrder = 'Seøadit podle:';
$strDoAQuery = 'Provést "dotaz podle pøíkladu" (zástupný znak: "%")';
$strDocu = 'Dokumentace';
$strDoYouReally = 'Opravdu si pøejete vykonat pøíkaz';
$strDrop = 'Odstranit';
$strDropDB = 'Odstranit databázi %s';
$strDropTable = 'Smazat tabulku';
$strDumpingData = 'Dumpuji data pro tabulku';
$strDynamic = 'dynamický';

$strEdit = 'Upravit';
$strEditPrivileges = 'Upravit oprávnìní';
$strEffective = 'Efektivní';
$strEmpty = 'Vyprázdnit';
$strEmptyResultSet = 'MySQL vrátil prázdný výsledek (tj. nulový poèet øádkù).';
$strEnd = 'Konec';
$strEnglishPrivileges = 'Poznámka: názvy oprávnìní v&nbsp;MySQL jsou uvádìny anglicky';
$strError = 'Chyba';
$strExtendedInserts = 'Rozíøené inserty';
$strExtra = 'Extra';

$strField = 'Sloupec';
$strFieldHasBeenDropped = 'Sloupec %s byl odstranìn';
$strFields = 'Poèet sloupcù';
$strFieldsEmpty = ' Nebyl zadán poèet sloupcù! ';
$strFieldsEnclosedBy = 'Názvy sloupcù uzavøené do';
$strFieldsEscapedBy = 'Názvy sloupcù escapovány';
$strFieldsTerminatedBy = 'Sloupce oddìlené';
$strFixed = 'pevný';
$strFlushTable = 'Vyprázdnit vyrovnávací pamì pro tabulku ("FLUSH")';
$strFormat = 'Formát';
$strFormEmpty = 'Chybìjící hodnota ve formuláøi!';
$strFullText = 'Celé texty';
$strFunction = 'Funkce';

$strGenTime = 'Vygenerováno';
$strGo = 'Proveï';
$strGrants = 'Oprávnìní';
$strGzip = '"zagzipováno"';

$strHasBeenAltered = 'byla zmìnìna.';
$strHasBeenCreated = 'byla vytvoøena.';
$strHome = 'Hlavní strana';
$strHomepageOfficial = 'Oficiální stránka phpMyAdmina';
$strHomepageSourceforge = 'Nová stránka phpMyAdmina';
$strHost = 'Poèítaè';
$strHostEmpty = 'Jméno poèítaèe je prázdné!';

$strIdxFulltext = 'Fulltext';
$strIfYouWish = 'Pokud si pøeje natáhnout jenom urèité sloupce z tabulky, specifikuj je jako seznam sloupcù oddìlených èárkou.';
$strIgnore = 'Ignorovat';
$strIndex = 'Index';
$strIndexes = 'Indexy';
$strIndexHasBeenDropped = 'Index %s byl odstranìn';
$strIndexName = 'Jméno indexu&nbsp;:';
$strIndexType = 'Typ indexu&nbsp;:';
$strInsert = 'Vloit';
$strInsertAsNewRow = 'Vloit jako nový øádek';
$strInsertedRows = 'Vloeno øádkù:';
$strInsertNewRow = 'Vloit nový øádek';
$strInsertTextfiles = 'Vloit textové soubory do tabulky';
$strInstructions = 'Instrukce';
$strInUse = 'právì se pouívá';
$strInvalidName = '"%s" je rezervované slovo a proto ho nemùete poít jako jméno databáze/tabulky/sloupce.';

$strKeepPass = 'Nemìnit heslo';
$strKeyname = 'Klíèovy název';
$strKill = 'Zabít';

$strLength = 'Délka';
$strLengthSet = 'Délka/Mnoina*';
$strLimitNumRows = 'záznamu na stránku';
$strLineFeed = 'Ukonèení øádku (Linefeed): \\n';
$strLines = 'Øádek';
$strLinesTerminatedBy = 'Øádky ukonèené';
$strLocationTextfile = 'Umístìní textového souboru';
$strLogin = 'Pøihláení';
$strLogout = 'Odhlásit se';
$strLogPassword = 'Heslo:';
$strLogUsername = 'Jméno:';

$strModifications = 'Zmìny byly uloeny';
$strModify = 'Úpravy';
$strModifyIndexTopic = 'Upravit index';
$strMoveTable = 'Pøesunout tabulku do (databáze<b>.</b>tabulka):';
$strMoveTableOK = 'Tabulka %s byla pøesunuta do %s.';
$strMySQLReloaded = 'MySQL znovu naèteno.';
$strMySQLSaid = 'MySQL hlásí: ';
$strMySQLServerProcess = 'MySQL %pma_s1% sputìné na %pma_s2%, pøihláen %pma_s3%';
$strMySQLShowProcess = 'Zobrazit procesy';
$strMySQLShowStatus = 'Ukázat MySQL informace o&nbsp;bìhu';
$strMySQLShowVars = 'Ukázat MySQL systémové promìnné';

$strName = 'Název';
$strNbRecords = 'øádkù';
$strNext = 'Dalí';
$strNo = 'Ne';
$strNoDatabases = 'ádné databáze';
$strNoDropDatabases = 'Pøíkaz "DROP DATABASE" je vypnutý.';
$strNoFrames = 'phpMyAdmin se lépe pouívá v&nbsp;prohlíeèi podporujícím rámy ("FRAME").';
$strNoIndex = 'ádný index nebyl definován!';
$strNoIndexPartsDefined = 'ádná èást indexu nebyla definována!';
$strNoModification = 'ádná zmìna';
$strNone = 'ádný';
$strNoPassword = 'ádné heslo';
$strNoPrivileges = 'ádná oprávnìní';
$strNoQuery = 'ádný SQL dotaz!';
$strNoRights = 'Nemáte dostateèná práva na provedení této akce!';
$strNoTablesFound = 'V&nbsp;databázi nebyla nalezena ani jedna tabulka.';
$strNotNumber = 'Toto není èíslo!';
$strNotValidNumber = ' není platné èíslo øádku!';
$strNoUsersFound = 'ádný uivatel nenalezen.';
$strNull = 'Nulový';

$strOftenQuotation = 'Èasto uvozující znaky. Volitelnì znamená, e pouze poloky u kterých je to nutné (obvykle typu CHAR a VARCHAR) jsou uzavøeny do uzavíracích znakù.';
$strOptimizeTable = 'Optimalizovat tabulku';
$strOptionalControls = 'Volitelné. Urèuje jak zapisovat nebo èíst speciální znaky.';
$strOptionally = 'Volitelnì';
$strOr = 'nebo';
$strOverhead = 'Navíc';

$strPartialText = 'Zkrácené texty';
$strPassword = 'Heslo';
$strPasswordEmpty = 'Heslo je prázdné!';
$strPasswordNotSame = 'Hesla nejsou stejná!';
$strPHPVersion = 'Verze PHP';
$strPmaDocumentation = 'Dokumentace phpMyAdmina';
$strPmaUriError = 'Parametr <tt>$cfgPmaAbsoluteUri</tt> MUSÍ být nastaveno v&nbsp;konfiguraèním souboru!';
$strPos1 = 'Zaèátek';
$strPrevious = 'Pøedchozí';
$strPrimary = 'Primární';
$strPrimaryKey = 'Primární klíè';
$strPrimaryKeyHasBeenDropped = 'Primární klíè byl odstranìn';
$strPrimaryKeyName = 'Jméno primárního klíèe musí být "PRIMARY"!';
$strPrimaryKeyWarning = '("PRIMARY" <b>musí</b> být jméno <b>pouze</b> primárního klíèe!)';
$strPrintView = 'Náhled k vytitìní';
$strPrivileges = 'Oprávnìní';
$strProperties = 'Vlastnosti';

$strQBE = 'Dotaz podle pøíkladu';
$strQBEDel = 'smazat';
$strQBEIns = 'pøidat';
$strQueryOnDb = 'SQL dotaz na databázi <b>%s</b>:';

$strRecords = 'Záznamù';
$strReferentialIntegrity = 'Zkontrolovat integritu odkazù:';
$strReloadFailed = 'Znovunaètení MySQL selhalo.';
$strReloadMySQL = 'Znovunaètení MySQL';
$strRememberReload = 'Nezapomeòte znovu naèíst server.';
$strRenameTable = 'Pøejmenovat tabulku na';
$strRenameTableOK = 'Tabulka %s byla pøejmenována na %s';
$strRepairTable = 'Opravit tabulku';
$strReplace = 'Pøepsat';
$strReplaceTable = 'Pøepsat data tabulky souborem';
$strReset = 'Pùvodní (reset)';
$strReType = 'Napsat znovu';
$strRevoke = 'Zruit';
$strRevokeGrant = 'Zruit povolení pøidìlovat práva';
$strRevokeGrantMessage = 'Bylo zrueno oprávnìní pøidìlovat práva pro %s';
$strRevokeMessage = 'Byla zruena práva pro %s';
$strRevokePriv = 'Zruit práva';
$strRowLength = 'Délka øádku';
$strRows = 'Øádkù';
$strRowsFrom = 'øádkù zaèínající od';
$strRowSize = ' Velikost øádku ';
$strRowsModeVertical = 'svislém';
$strRowsModeHorizontal = 'vodorovném';
$strRowsModeOptions = 've %s reimu a opakovat hlavièky po %s øádcích.';
$strRowsStatistic = 'Statistika øádkù';
$strRunning = 'na %s';
$strRunQuery = 'Provést dotaz';
$strRunSQLQuery = 'Spustit SQL dotaz(y) na databázi %s';

$strSave = 'Ulo';
$strSelect = 'Vybrat';
$strSelectADb = 'Prosím vyberte databázi';
$strSelectAll = 'Vybrat ve';
$strSelectFields = 'Zvolte sloupec (alespoò jeden):';
$strSelectNumRows = 'v&nbsp;dotazu';
$strSend = 'Poslat';
$strServerChoice = 'Výbìr serveru';
$strServerVersion = 'Verze MySQL';
$strSetEnumVal = 'Pokud je sloupec typu "enum" nebo "set", zadávejte hodnoty v&nbsp;následujícím formátu: \'a\',\'b\',\'c\'...<br />Pokud potøebujete zadat zpìtné lomítko ("\") nebo jednoduché uvozovky ("\'") mezi tìmito hodnotami, napite pøed nì zpìtné lomítko (pøíklad: \'\\\\xyz\' nebo \'a\\\'b\').';
$strShow = 'Zobrazit';
$strShowAll = 'Zobrazit ve';
$strShowCols = 'Zobrazit sloupce';
$strShowingRecords = 'Zobrazeny záznamy';
$strShowPHPInfo = 'Zobrazit informace o&nbsp;PHP';
$strShowTables = 'Zobrazit tabulky';
$strShowThisQuery = 'Zobrazit zde tento dotaz znovu';
$strSingly = '(po jednom)';
$strSize = 'Velikost';
$strSort = 'Øadit';
$strSpaceUsage = 'Vyuití místa';
$strSQLQuery = 'SQL-dotaz';
$strStartingRecord = 'Poèáteèní záznam';
$strStatement = 'Údaj';
$strStrucCSV = 'CSV data';
$strStrucData = 'Strukturu a data';
$strStrucDrop = 'Pøidej \'DROP TABLE\'';
$strStrucExcelCSV = 'CSV data pro Ms Excel';
$strStrucOnly = 'Pouze strukturu';
$strSubmit = 'Odeli';
$strSuccess = 'Tvùj SQL-dotaz byl úspìnì vykonán';
$strSum = 'Celkem';

$strTable = 'Tabulka ';
$strTableComments = 'Komentáøe k tabulce';
$strTableEmpty = 'Jméno tabulky je prázdné!';
$strTableHasBeenDropped = 'Tabulka %s byla odstranìna';
$strTableHasBeenEmptied = 'Tabulka %s byla vyprázdnìna';
$strTableHasBeenFlushed = 'Vyrovnávací pamì pro tabulku %s byla vyprázdnìna';
$strTableMaintenance = ' Údrba tabulky ';
$strTables = '%s tabulek';
$strTableStructure = 'Struktura tabulky';
$strTableType = 'Typ tabulky';
$strTextAreaLength = 'Tento sloupec moná nepùjde <br />(kvùli délce) upravit ';
$strTheContent = 'Obsah souboru byl vloen';
$strTheContents = 'Obsah souboru pøepíe obsah zvolené tabulky v tìch øádcích, kde je stejný primární nebo unikátní klíè.';
$strTheTerminator = 'Sloupce jsou oddìleny tímto znakem.';
$strTotal = 'celkem';
$strType = 'Typ';

$strUncheckAll = 'Odkrtnout ve';
$strUnique = 'Unikátní';
$strUnselectAll = 'Odznaèit ve';
$strUpdatePrivMessage = 'Byla aktualizovana oprávnìní pro %s.';
$strUpdateProfile = 'Zmìny pøístupu:';
$strUpdateProfileMessage = 'Pøístup byl zmìnìn.';
$strUpdateQuery = 'Aktualizovat dotaz';
$strUsage = 'Pouívá';
$strUseBackquotes = 'Pouít zpìtné uvozovky u&nbsp;jmen tabulek a sloupcù';
$strUser = 'Uivatel';
$strUserEmpty = 'Jméno uivatele je prázdné!';
$strUserName = 'Jméno uivatele';
$strUsers = 'Uivatelé';
$strUseTables = 'Pouít tabulky';

$strValue = 'Hodnota';
$strViewDump = 'Uka výpis (dump) tabulky';
$strViewDumpDB = 'Uka výpis (dump) databáze';

$strWelcome = 'Vítej v %s';
$strWithChecked = 'Zakrtnuté:';
$strWrongUser = 'patné uivatelské jméno/heslo. Pøístup odepøen.';

$strYes = 'Ano';

$strZip = '"zazipováno"';

// To translate
?>

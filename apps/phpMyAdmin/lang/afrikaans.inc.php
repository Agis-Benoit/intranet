<?php
/* $Id: afrikaans.inc.php,v 1.1.2.1 2002/08/04 12:58:15 rabus Exp $ */

/*
     translated by Andreas Pauley <pauley@buitegroep.org.za>

Dit lyk nogal snaaks in Afrikaans ;-).
Laat weet my asb. as jy aan beter taalgebruik kan dink.
*/

$charset = 'iso-8859-1';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('So', 'Ma', 'Di', 'Wo', 'Do', 'Fr', 'Sa');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = 'Toegang Geweier';
$strAction = 'Aksie';
$strAddDeleteColumn = 'Voeg By/Verwyder Veld Kolomme';
$strAddDeleteRow = 'Voeg By/Verwyder Kriteria Ry';
$strAddNewField = 'Voeg \'n nuwe veld by';
$strAddPriv = 'Voeg nuwe regte by';
$strAddPrivMessage = 'Jy het nuwe regte bygevoeg';
$strAddSearchConditions = 'Voeg soek kriteria by (laaste deel van die "where" in SQL SELECT):';
$strAddToIndex = 'Voeg by indeks &nbsp;%s&nbsp;kolom(me)';
$strAddUser = 'Voeg \'n nuwe gebruiker by';
$strAddUserMessage = 'Jy het \'n nuwe gebruiker bygevoeg.';
$strAffectedRows = 'Geaffekteerde rye:';
$strAfter = 'Na %s';
$strAfterInsertBack = 'Terug na vorige bladsy';
$strAfterInsertNewInsert = 'Voeg \'n nuwe ry by';
$strAll = 'Alle';
$strAlterOrderBy = 'Verander tabel sorteer volgens';
$strAnalyzeTable = 'Analiseer tabel';
$strAnd = 'En';
$strAnIndex = '\'n Indeks is bygevoeg op %s';
$strAny = 'Enige';
$strAnyColumn = 'Enige Kolom';
$strAnyDatabase = 'Enige databasis';
$strAnyHost = 'Enige gasheer (host)';
$strAnyTable = 'Enige tabel';
$strAnyUser = 'Enige gebruiker';
$strAPrimaryKey = '\'n primere sleutel is bygevoeg op %s';
$strAscending = 'Dalend';
$strAtBeginningOfTable = 'By Begin van Tabel';
$strAtEndOfTable = 'By Einde van Tabel';
$strAttr = 'Kenmerke';

$strBack = 'Terug';
$strBinary = 'Biner';
$strBinaryDoNotEdit = 'Biner - moenie verander nie';
$strBookmarkDeleted = 'Die boekmerk is verwyder.';
$strBookmarkLabel = 'Etiket';
$strBookmarkQuery = 'Geboekmerkde SQL-stelling';
$strBookmarkThis = 'Boekmerk hierdie SQL-stelling';
$strBookmarkView = 'Kyk slegs';
$strBrowse = 'Beloer Data';
$strBzip = '"ge-bzip"';

$strCantLoadMySQL = 'kan ongelukkig nie die MySQL module laai nie, <br />kyk asb. na die PHP opstelling.';
$strCantRenameIdxToPrimary = 'Kannie die indeks hernoem na PRIMER!';
$strCardinality = 'Cardinality';
$strCarriage = 'Carriage return: \\r';
$strChange = 'Verander';
$strChangePassword = 'Verander wagwoord';
$strCheckAll = 'Kies Alles';
$strCheckDbPriv = 'Kontroleer Databasis Regte';
$strCheckTable = 'Kontroleer tabel';
$strColumn = 'Kolom';
$strColumnNames = 'Kolom name';
$strCompleteInserts = 'Voltooi invoegings';
$strConfigureTableCoord = 'Stel asb. die koordinate op van tabel %s';
$strConfirm = 'Wil jy dit regtig doen?';
$strCookiesRequired = 'HTTP Koekies moet van nou af geaktifeer wees.';
$strCopyTable = 'Kopieer tabel na (databasis<b>.</b>tabel):';
$strCopyTableOK = 'Tabel %s is gekopieer na %s.';
$strCreate = 'Skep';
$strCreateIndex = 'Skep \'n indeks op&nbsp;%s&nbsp;kolomme';
$strCreateIndexTopic = 'Skep \'n nuwe indeks';
$strCreateNewDatabase = 'Skep \'n nuwe databasis';
$strCreateNewTable = 'Skep \'n nuwe tabel op databasis %s';
$strCriteria = 'Kriteria';

$strData = 'Data';
$strDatabase = 'Databasis ';
$strDatabaseHasBeenDropped = 'Databasis %s is verwyder.';
$strDatabases = 'databasisse';
$strDatabasesStats = 'Databasis statistieke';
$strDatabaseWildcard = 'Databasis (wildcards toegelaat):';
$strDataOnly = 'Slegs Data';
$strDefault = 'Verstekwaarde (default)';
$strDelete = 'Verwyder';
$strDeleted = 'Die ry is verwyder';
$strDeletedRows = 'Verwyderde rye:';
$strDeleteFailed = 'Verwyder aksie het misluk!';
$strDeleteUserMessage = 'Jy het die gebruiker %s verwyder.';
$strDescending = 'Dalend';
$strDisplay = 'Vertoon';
$strDisplayOrder = 'Vertoon volgorde:';
$strDoAQuery = 'Doen \'n "Navraag dmv Voorbeeld" (wildcard: "%")';
$strDocu = 'Dokumentasie';
$strDoYouReally = 'Wil jy regtig ';
$strDrop = 'Verwyder';
$strDropDB = 'Verwyder databasis %s';
$strDropTable = 'Verwyder tabel';
$strDumpingData = 'Stort data vir tabel';
$strDynamic = 'dinamies';

$strEdit = 'Verander';
$strEditPrivileges = 'Verander Regte';
$strEffective = 'Effektief';
$strEmpty = 'Maak Leeg';
$strEmptyResultSet = 'MySQL het niks teruggegee nie (dus nul rye).';
$strEnd = 'Einde';
$strEnglishPrivileges = ' Nota: MySQL regte name word in Engels vertoon ';
$strError = 'Fout';
$strExtendedInserts = 'Uitgebreide toevoegings';
$strExtra = 'Ekstra';

$strField = 'Veld';
$strFieldHasBeenDropped = 'Veld %s is verwyder';
$strFields = 'Velde';
$strFieldsEmpty = ' Die veld telling is leeg! ';
$strFieldsEnclosedBy = 'Velde omring met';
$strFieldsEscapedBy = 'Velde ontsnap (escaped) deur';
$strFieldsTerminatedBy = 'Velde beeindig deur';
$strFixed = 'vaste (fixed)';
$strFlushTable = 'Spoel die tabel ("FLUSH")';
$strFormat = 'Formaat';
$strFormEmpty = 'Daar ontbreek \'n waarde in die vorm !';
$strFullText = 'Volle Tekste';
$strFunction = 'Funksie';

$strGenTime = 'Generasie Tyd';
$strGo = 'Gaan';
$strGrants = 'Vergunnings';
$strGzip = '"ge-gzip"';

$strHasBeenAltered = 'is verander.';
$strHasBeenCreated = 'is geskep.';
$strHome = 'Tuis';
$strHomepageOfficial = 'Amptelike phpMyAdmin Tuisblad';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Aflaai bladsy';
$strHost = 'Gasheer (host)';
$strHostEmpty = 'Die gasheer naam is leeg!';

$strIdxFulltext = 'Volteks';
$strIfYouWish = 'Indien jy slegs sommige van \'n tabel se kolomme wil laai, spesifiseer \'n komma-geskeide veldlys.';
$strIgnore = 'Ignoreer';
$strIndex = 'Indeks';
$strIndexes = 'Indekse';
$strIndexHasBeenDropped = 'Indeks %s is verwyder';
$strIndexName = 'Indeks naam&nbsp;:';
$strIndexType = 'Indeks tipe&nbsp;:';
$strInsert = 'Voeg by';
$strInsertAsNewRow = 'Voeg by as \'n nuwe ry';
$strInsertedRows = 'Toegevoegde rye:';
$strInsertNewRow = 'Voeg nuwe ry by';
$strInsertTextfiles = 'Voeg data vanaf \'n teks leer in die tabel in';
$strInstructions = 'Instruksies';
$strInUse = 'in gebruik';
$strInvalidName = '"%s" is \'n gereserveerde woord, jy kan dit nie as \'n databasis/tabel/veld naam gebruik nie.';

$strKeepPass = 'Moenie die wagwoord verander nie';
$strKeyname = 'Sleutelnaam';
$strKill = 'Vermoor';

$strLength = 'Lengte';
$strLengthSet = 'Lengte/Waardes*';
$strLimitNumRows = 'Hoeveelheid rye per bladsy';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Lyne';
$strLinesTerminatedBy = 'Lyne beeindig deur';
$strLocationTextfile = 'Soek die teksleer';
$strLogin = 'Teken aan';
$strLogout = 'Teken uit';
$strLogPassword = 'Wagwoord:';
$strLogUsername = 'Gebruiker Naam:';

$strModifications = 'Veranderinge is gestoor';
$strModify = 'Verander';
$strModifyIndexTopic = 'Verander \'n indeks';
$strMoveTable = 'Skuif tabel na (databasis<b>.</b>tabel):';
$strMoveTableOK = 'Tabel %s is geskuif na %s.';
$strMySQLReloaded = 'MySQL is herlaai.';
$strMySQLSaid = 'MySQL het gepraat: ';
$strMySQLServerProcess = 'MySQL %pma_s1% hardloop op %pma_s2% as %pma_s3%';
$strMySQLShowProcess = 'Wys prosesse';
$strMySQLShowStatus = 'Wys MySQL in-proses informasie';
$strMySQLShowVars = 'Wys MySQL stelsel veranderlikes';

$strName = 'Naam';
$strNext = 'Volgende';
$strNo = 'Nee';
$strNoDatabases = 'Geen databasisse';
$strNoDropDatabases = '"DROP DATABASE" stellings word nie toegelaat nie.';
$strNoFrames = 'phpMyAdmin verkies \'n <b>frames-kapabele</b> blaaier.';
$strNoIndex = 'Geen indeks gedefinieer!';
$strNoIndexPartsDefined = 'Geen indeks dele gedefinieer!';
$strNoModification = 'Geen verandering';
$strNone = 'Geen';
$strNoPassword = 'Geen Wagwoord';
$strNoPhp = 'Sonder PHP Kode';
$strNoPrivileges = 'Geen Regte';
$strNoQuery = 'Geen SQL stelling!';
$strNoRights = 'Jy het nie genoeg regte om nou hier te wees nie!';
$strNoTablesFound = 'Geen tabelle in databasis gevind nie.';
$strNotNumber = 'Hierdie is nie \'n nommer nie';
$strNotValidNumber = ' is nie \'n geldige ry-nommer nie!';
$strNoUsersFound = 'Geen gebruiker(s) gevind nie.';
$strNull = 'Null';

$strOftenQuotation = 'Dikwels kwotasie-karakters. OPSIONEEL beteken dat slegs char en varchar velde ingeslote is binne die "enclosed by"-character.';
$strOptimizeTable = 'Optimaliseer tabel';
$strOptionalControls = 'Opsioneel. Kontroleer hoe om spesiale karakters te lees en skryf.';
$strOptionally = 'OPSIONEEL';
$strOr = 'Of';
$strOverhead = 'Overhead';

$strPartialText = 'Gedeeltelike Tekste';
$strPassword = 'Wagwoord';
$strPasswordEmpty = 'Die wagwoord is leeg!';
$strPasswordNotSame = 'Die wagwoorde is verskillend!';
$strPHPVersion = 'PHP Version';
$strPmaDocumentation = 'phpMyAdmin dokumentasie';
$strPmaUriError = 'Die <tt>$cfgPmaAbsoluteUri</tt> veranderlike MOET gestel wees in jou konfigurasie leer!';
$strPos1 = 'Begin';
$strPrevious = 'Vorige';
$strPrimary = 'Primere';
$strPrimaryKey = 'Primere sleutel';
$strPrimaryKeyHasBeenDropped = 'Die primere sleutel is verwyder';
$strPrimaryKeyName = 'Die naam van die primere sleutel moet PRIMARY wees!';
$strPrimaryKeyWarning = '("PRIMARY" <b>moet</b> die naam wees van die primere sleutel, en <b>slegs</b> van die primere sleutel!)';
$strPrintView = 'Drukker mooi (print view)';
$strPrivileges = 'Regte';
$strProperties = 'Eienskappe';

$strQBE = 'Navraag dmv Voorbeeld';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'SQL-navraag op databasis <b>%s</b>:';

$strRecords = 'Rekords';
$strReferentialIntegrity = 'Toets referential integrity:';
$strReloadFailed = 'MySQL herlaai het misluk.';
$strReloadMySQL = 'Herlaai MySQL';
$strRememberReload = 'Onthou om die bediener (server) te herlaai.';
$strRenameTable = 'Hernoem tabel na';
$strRenameTableOK = 'Tabel %s is vernoem na %s';
$strRepairTable = 'Herstel tabel';
$strReplace = 'Vervang';
$strReplaceTable = 'Vervang tabel data met leer (file)';
$strReset = 'Herstel';
$strReType = 'Tik weer';
$strRevoke = 'Herroep';
$strRevokeGrant = 'Herroep Vergunning';
$strRevokeGrantMessage = 'Jy het die Vergunnings-reg herroep vir %s';
$strRevokeMessage = 'Jy het die regte herroep vir %s';
$strRevokePriv = 'Herroep Regte';
$strRowLength = 'Ry lengte';
$strRows = 'Rye';
$strRowsFrom = 'ry(e) beginnende vanaf rekord #';
$strRowSize = ' Ry grootte ';
$strRowsModeHorizontal = 'horisontale';
$strRowsModeOptions = 'in %s formaat en herhaal opskrifte na %s selle';
$strRowsModeVertical = 'vertikale';
$strRowsStatistic = 'Ry Statistiek';
$strRunning = 'op bediener %s';
$strRunQuery = 'Doen Navraag';
$strRunSQLQuery = 'Hardloop SQL stellings op databasis %s';

$strSave = 'Stoor';
$strSelect = 'Kies';
$strSelectADb = 'Kies asb. \'n databasis';
$strSelectAll = 'Kies Alles';
$strSelectFields = 'Kies Velde (ten minste een):';
$strSelectNumRows = 'in navraag';
$strSend = 'Stoor as leer (file)';
$strServerChoice = 'Bediener Keuse';
$strServerVersion = 'Bediener weergawe';
$strSetEnumVal = 'If field type is "enum" or "set", please enter the values using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';
$strShow = 'Wys';
$strShowAll = 'Wys alles';
$strShowCols = 'Wys kolomme';
$strShowingRecords = 'Vertoon rye';
$strShowPHPInfo = 'Wys PHP informasie';
$strShowTables = 'Wys tabelle';
$strShowThisQuery = ' Wys hierdie navraag weer hier ';
$strSingly = '(afsonderlik)';
$strSize = 'Grootte';
$strSort = 'Sorteer';
$strSpaceUsage = 'Spasie verbruik';
$strSQLQuery = 'SQL-stelling';
$strStatement = 'Stellings';
$strStrucCSV = 'CSV data';
$strStrucData = 'Struktuur en data';
$strStrucDrop = 'Voeg \'drop table\' by';
$strStrucExcelCSV = 'CSV vir M$ Excel data';
$strStrucOnly = 'Slegs struktuur';
$strSubmit = 'Stuur';
$strSuccess = 'Jou SQL-navraag is suksesvol uitgevoer';
$strSum = 'Som';

$strTable = 'tabel ';
$strTableComments = 'Tabel kommentaar';
$strTableEmpty = 'Die tabel naam is leeg!';
$strTableHasBeenDropped = 'Tabel %s is verwyder';
$strTableHasBeenEmptied = 'Tabel %s is leeg gemaak';
$strTableHasBeenFlushed = 'Tabel %s is geflush';
$strTableMaintenance = 'Tabel instandhouding';
$strTables = '%s tabel(le)';
$strTableStructure = 'Tabel struktuur vir tabel';
$strTableType = 'Tabel tipe';
$strTextAreaLength = ' Omrede sy lengte,<br /> is hierdie veld moontlik nie veranderbaar nie ';
$strTheContent = 'Die inhoud van jou leer is ingevoeg.';
$strTheContents = 'Die inhoud van die leer vervang die inhoud van die geselekteerde tabel vir rye met \'n identiese primere of unieke sleutel.';
$strTheTerminator = 'Die beeindiger (terminator) van die velde.';
$strTotal = 'totaal';
$strType = 'Tipe';

$strUncheckAll = 'Kies Niks';
$strUnique = 'Uniek';
$strUnselectAll = 'Selekteer Niks';
$strUpdatePrivMessage = 'Jy het die regte opgedateer vir %s.';
$strUpdateProfile = 'Verander profiel:';
$strUpdateProfileMessage = 'Die profiel is opgedateer.';
$strUpdateQuery = 'Verander Navraag';
$strUsage = 'Gebruik';
$strUseBackquotes = 'Omring tabel en veldname met backquotes';
$strUser = 'Gebruiker';
$strUserEmpty = 'Die gebruiker naam ontbreek!';
$strUserName = 'Gebruiker naam';
$strUsers = 'Gebruikers';
$strUseTables = 'Gebruik Tabelle';

$strValue = 'Waarde';
$strViewDump = 'Sien die storting (skema) van die tabel';
$strViewDumpDB = 'Sien die storting (skema) van die databasis';

$strWelcome = 'Welkom by %s';
$strWithChecked = 'Met gekose:';
$strWrongUser = 'Verkeerde gebruikernaam/wagwoord. Toegang geweier.';

$strYes = 'Ja';

$strZip = '"ge-zip"';

// To translate
$strNbRecords = 'Number of rows'; //to translate
$strStartingRecord = 'Starting row'; //to translate
?>

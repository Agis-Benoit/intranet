<?php
/* $Id: croatian-iso8859-2.inc.php,v 1.1.2.1 2002/04/27 14:12:24 loic1 Exp $ */

/**
 * Translation made by: Sime Essert <sime@nofrx.org>
 */


$charset = 'iso-8859-2';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Byteova', 'KB', 'MB', 'GB');

$day_of_week = array('Ned', 'Pon', 'Uto', 'Sri', 'Èet', 'Pet', 'Sub');
$month = array('Sij', 'Vel', 'O¾u', 'Tra', 'Svi', 'Lip', 'Srp', 'Kol', 'Ruj', 'Lis', 'Stu', 'Pro');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B %Y. u %H:%M';


$strAccessDenied = 'Pristup odbijen';
$strAction = 'Akcija';
$strAddDeleteColumn = 'Dodaj/izbri¹i stupac';
$strAddDeleteRow = 'Dodaj/izbri¹i polje za kriterij';
$strAddNewField = 'Dodaj novi stupac';
$strAddPriv = 'Dodaj novu privilegiju';
$strAddPrivMessage = 'Privilegija je dodana';
$strAddSearchConditions = 'Dodaj uvjete pretra¾ivanja (dio "where" upita):';
$strAddToIndex = 'Dodaj kljuè';
$strAddUser = 'Dodaj novog korisnika';
$strAddUserMessage = 'Korisnik dodan';
$strAffectedRows = 'Promijenjeno redaka:';
$strAfter = 'Nakon %s';
$strAfterInsertBack = 'Natrag na prethodnu stranicu';
$strAfterInsertNewInsert = 'Dodaj jo¹ jedan red';
$strAll = 'Sve';
$strAlterOrderBy = 'Promijeni redoslijed u tablici';
$strAnalyzeTable = 'Analiziraj tablicu';
$strAnd = 'i';
$strAnIndex = 'Kljuè je upravo dodan %s';
$strAny = 'Bilo koji';
$strAnyColumn = 'Bilo koji stupac';
$strAnyDatabase = 'Bilo koja baza podataka';
$strAnyHost = 'Bilo koji server';
$strAnyTable = 'Bilo koja tablica';
$strAnyUser = 'Bilo koji korisnik';
$strAPrimaryKey = 'Primarni kljuè je upravo dodan %s';
$strAscending = 'Rastuæi';
$strAtBeginningOfTable = 'Na poèetku tablice';
$strAtEndOfTable = 'Na kraju tablice';
$strAttr = 'Svojstva';

$strBack = 'Nazad';
$strBinary = 'Binarno';
$strBinaryDoNotEdit = 'Binarno - ne mijenjaj';
$strBookmarkDeleted = 'Oznaka je upravo izbrisana.';
$strBookmarkLabel = 'Naziv';
$strBookmarkQuery = 'Oznaèeni SQL-upit';
$strBookmarkThis = 'Oznaèi SQL-upit';
$strBookmarkView = 'Vidi samo';
$strBrowse = 'Pregled';
$strBzip = '"bzip-ano"';

$strCantLoadMySQL = 'Ne mogu uèitati MySql ekstenziju,<br /> molim provjerite PHP konfiguraciju.';
$strCantRenameIdxToPrimary = 'Ne mogu promijeniti kljuè u PRIMARY (primarni) !';
$strCardinality = 'Kardinalnost';
$strCarriage = 'Novi red (carriage return): \\r';
$strChange = 'Promijeni';
$strChangePassword = 'Promijeni ¹ifru';
$strCheckAll = 'Oznaèi sve';
$strCheckDbPriv = 'Provjeri privilegije baze podataka';
$strCheckTable = 'Provjeri tablicu';
$strColumn = 'Stupac';
$strColumnNames = 'Imena stupaca';
$strCompleteInserts = 'Kompletan INSERT (sa imenima polja)';
$strConfirm = 'Da li stvarno to ¾elite uèiniti?';
$strCookiesRequired = '<i>Cookies</i> moraju biti omoguæeni.';
$strCopyTable = 'Kopiram tablicu u (baza<b>.</b>tablica):';
$strCopyTableOK = 'Tablica %s je upravo kopirana u %s.';
$strCreate = 'Napravi';
$strCreateIndex = 'Napravi kljuè sa&nbsp;%s&nbsp;stupcem(aca)';
$strCreateIndexTopic = 'Napravi novi kljuè';
$strCreateNewDatabase = 'Napravi bazu podataka';
$strCreateNewTable = 'Napravi novu tablicu u bazi ';
$strCriteria = 'Kriterij';

$strData = 'Podaci';
$strDatabase = 'Baza podataka ';
$strDatabaseHasBeenDropped = 'Baza %s je izbrisana.';
$strDatabases = 'baze';
$strDatabasesStats = 'Statistika baze';
$strDatabaseWildcard = 'Baza (<i>wildcard</i> znakovi dozvoljeni):';
$strDataOnly = 'Samo podaci';
$strDefault = 'Default';
$strDelete = 'Izbri¹i';
$strDeleted = 'Red je izbrisan';
$strDeletedRows = 'Izbrisani redovi:';
$strDeleteFailed = 'Brisanje nije uspjelo!';
$strDeleteUserMessage = 'Upravo ste izbrisali korisnika: %s.';
$strDescending = 'Opadajuæi';
$strDisplay = 'Prika¾i';
$strDisplayOrder = 'Redoslijed prikaza:';
$strDoAQuery = 'Napravi "upit po primjeru" (<i>wildcard</i>: "%")';
$strDocu = 'Dokumentacija';
$strDoYouReally = 'Da li stvarno ¾elite ';
$strDrop = 'Izbri¹i';
$strDropDB = 'Izbri¹i bazu %s';
$strDropTable = 'Izbri¹i tablicu';
$strDumpingData = 'Izvoz <i>(dump)</i> podataka tablice';
$strDynamic = 'dinamièno';

$strEdit = 'Promijeni';
$strEditPrivileges = 'Promijeni privilegije';
$strEffective = 'Efektivno';
$strEmpty = 'Isprazni';
$strEmptyResultSet = 'MySQL je vratio prazan rezultat (nula redaka).';
$strEnd = 'Kraj';
$strEnglishPrivileges = 'Opaska: MySQL imena privilegija moraju biti engleskom ';
$strError = 'Gre¹ka';
$strExtendedInserts = 'Pro¹ireni INSERT';
$strExtra = 'Dodatno';

$strField = 'Polje';
$strFieldHasBeenDropped = 'Polje %s izbrisano';
$strFields = 'Broj polja';
$strFieldsEmpty = ' Broj polja je nula! ';
$strFieldsEnclosedBy = 'Podaci ograðeni sa';
$strFieldsEscapedBy = '<i>Escape</i> znak &nbsp; &nbsp; &nbsp;';
$strFieldsTerminatedBy = 'Podaci razdvojeni sa';
$strFixed = 'sreðeno';
$strFlushTable = 'Osvje¾i tablicu';
$strFormat = 'Format';
$strFormEmpty = 'Nedostaje vrijednost u formi !';
$strFullText = 'Pun tekst';
$strFunction = 'Funkcija';

$strGenTime = 'Vrijeme podizanja';
$strGo = 'Kreni';
$strGrants = 'Omoguæi';
$strGzip = '"gzip-ano"';

$strHasBeenAltered = 'je promijenjen.';
$strHasBeenCreated = 'je kreiran/a.';
$strHome = 'Poèetna stranica';
$strHomepageOfficial = 'phpMyAdmin WEB site';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Stranica';
$strHost = 'Host (domena)';
$strHostEmpty = 'Ime domene je prazno!';

$strIdxFulltext = 'Puni tekst';
$strIfYouWish = 'Ukoliko ¾elite pregledati samo neke stupce u tablici, navedite ih razdvojene zarezom';
$strIgnore = 'Ignoriraj';
$strIndex = 'Kljuè';
$strIndexes = 'Kljuèevi';
$strIndexHasBeenDropped = 'Kljuè %s je izbrisan';
$strIndexName = 'Ime kljuèa :';
$strIndexType = 'Vrsta kljuèa :';
$strInsert = 'Novi redak';
$strInsertAsNewRow = 'Unesi kao novi redak';
$strInsertedRows = 'Uneseni reci:';
$strInsertNewRow = 'Unesi novi redak';
$strInsertTextfiles = 'Ubaci podatke iz tekstualne datoteke';
$strInstructions = 'Uputstva';
$strInUse = 'se koristi';
$strInvalidName = '"%s" je rezervirana rijeè, \nne mo¾e se koristiti kao ime polja, tablice ili baze.';

$strKeepPass = 'Ne mijenjaj lozinku';
$strKeyname = 'Ime Kljuèa';
$strKill = 'Zaustavi';

$strLength = 'Du¾ina';
$strLengthSet = 'Du¾ina/Vrijednost*';
$strLimitNumRows = 'Broj redaka po stranici';
$strLineFeed = '<i>Linefeed</i>: \\n';
$strLines = 'Linije';
$strLinesTerminatedBy = 'Linije zavr¹avaju na';
$strLocationTextfile = 'Lokacija tekstualne datoteke';
$strLogin = 'Prijava';
$strLogout = 'Odjava';
$strLogPassword = 'Lozinka:';
$strLogUsername = 'Korisnièko ime:';

$strModifications = 'Izmjene su spremljene';
$strModify = 'Promijeni';
$strModifyIndexTopic = 'Promijeni kljuè';
$strMoveTable = 'Preimenuj tablicu u (baza<b>.</b>tablica):';
$strMoveTableOK = 'Tablica %s se sada zove %s.';
$strMySQLReloaded = 'MySQL je ponovno pokrenut (<i>reload</i>).';
$strMySQLSaid = 'MySQL poruka: ';
$strMySQLServerProcess = 'MySQL %pma_s1% pokrenut na %pma_s2%, prijavljen kao %pma_s3%';
$strMySQLShowProcess = 'Prika¾i listu procesa';
$strMySQLShowStatus = 'Prika¾i MySQL runtime informacije';
$strMySQLShowVars = 'Prika¾i MySQL sistemske varijable';

$strName = 'Ime';
$strNbRecords = 'Broj redaka';
$strNext = 'Sljedeæi';
$strNo = 'Ne';
$strNoDatabases = 'Baza ne postoji';
$strNoDropDatabases = '"DROP DATABASE" naredba je onemoguæena.';
$strNoFrames = 'phpMyAdmin preferira preglednike koji podr¾avaju frame-ove.';
$strNoIndex = 'Kljuè nije definiran!';
$strNoIndexPartsDefined = 'Dijelovi kljuèa nisu definirani!';
$strNoModification = 'Nema nikakvih promjena';
$strNone = 'Ni¹ta';
$strNoPassword = 'Nema lozinke';
$strNoPrivileges = 'Nema privilegija';
$strNoQuery = 'Nema SQL upita!';
$strNoRights = 'Nemate dovoljno prava za ovo podruèje!';
$strNoTablesFound = 'Tablica nije pronaðena u bazi.';
$strNotNumber = 'To nije broj!';
$strNotValidNumber = ' nije odgovarajuæi broj redaka!';
$strNoUsersFound = 'Korisnik(ci) nije pronaðen.';
$strNull = 'Null';

$strOftenQuotation = 'Navodnici koji se koriste. OPCIONO se misli da neka polja mogu, ali ne moraju biti pod navodnicima.';
$strOptimizeTable = 'Optimiziraj tablicu';
$strOptionalControls = 'Opciono. Znak koji prethodi specijalnim znakovima.';
$strOptionally = 'OPCIONO';
$strOr = 'ili';
$strOverhead = 'Prekoraèenje';

$strPartialText = 'Dio teksta';
$strPassword = 'Lozinka';
$strPasswordEmpty = 'Lozinka je prazna!';
$strPasswordNotSame = 'Lozinka se ne podudara!';
$strPHPVersion = 'verzija PHP-a';
$strPmaDocumentation = 'phpMyAdmin dokumentacija';
$strPmaUriError = '<tt>$cfgPmaAbsoluteUri</tt> dio mora biti namje¹ten u konfiguracijskoj datoteci (config.inc.php)!';
$strPos1 = 'Poèetak';
$strPrevious = 'Prethodna';
$strPrimary = 'Primarni';
$strPrimaryKey = 'Primarni kljuè';
$strPrimaryKeyHasBeenDropped = 'Primarni kljuè je izbrisan';
$strPrimaryKeyName = 'Ime primarnog kljuèa mora biti... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>mora</b> biti ime i <b>samo</b> ime primarnog kljuèa!)';
$strPrintView = 'Sa¾etak';
$strPrivileges = 'Privilegije';
$strProperties = 'Svojstva';

$strQBE = 'Upit po primjeru';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'SQL upit na bazi <b>%s</b>:';

$strRecords = 'Reci';
$strReferentialIntegrity = 'Provjeri ispravnost veza:';
$strReloadFailed = 'ponovno pokretanje MySQL-a nije uspjelo.';
$strReloadMySQL = 'Ponovo pokreni MySQL (<i>reload</i>)';
$strRememberReload = 'Ne zaboravite ponovo pokrenuti (<i>reload</i>) server.';
$strRenameTable = 'Promijeni ime tablice u ';
$strRenameTableOK = 'Tablici %s promjenjeno ime u %s';
$strRepairTable = 'Popravi tablicu';
$strReplace = 'Zamijeni';
$strReplaceTable = 'Zamijeni podatke u tablici sa datotekom';
$strReset = 'Resetiraj';
$strReType = 'Ponovite unos';
$strRevoke = 'Opozovi';
$strRevokeGrant = 'Opozovi Grant';
$strRevokeGrantMessage = 'Opozvali ste Grant privilegije za  %s';
$strRevokeMessage = 'Opozvali ste privilegije za %s';
$strRevokePriv = 'Opozovi privilegije';
$strRowLength = 'Du¾ina retka';
$strRows = 'Redaka';
$strRowsFrom = ' redaka poèev¹i od retka';
$strRowSize = ' Velièina retka ';
$strRowsModeHorizontal = 'horizontalnom';
$strRowsModeOptions = 'u %s naèinu i ispi¹i zaglavlje poslije svakog %s retka';
$strRowsModeVertical = 'vertikalnom';
$strRowsStatistic = 'Statistika redaka';
$strRunning = 'pokrenuto na %s';
$strRunQuery = 'Izvr¹i SQL upit';
$strRunSQLQuery = 'Izvr¹i SQL upit(e) na bazi ';

$strSave = 'Spremi';
$strSelect = 'Oznaèi';
$strSelectADb = 'Izaberite bazu';
$strSelectAll = 'Oznaèi sve';
$strSelectFields = 'Izaberite polja (najmanje jedno)';
$strSelectNumRows = 'u upitu';
$strSend = 'Spremi u datoteku';
$strServerChoice = 'Izbor servera';
$strServerVersion = 'Verzija servera';
$strSetEnumVal = 'Ako je polje "enum" ili "set", unesite vrijednosti u formatu: \'a\',\'b\',\'c\'...<br />Ako vam zatreba <i>backslash</i> ("\") ili jednostruki navodnik ("\'") navedite ih koristeæi <i>backslash</i> (npr. \'\\\\xyz\' ili \'a\\\'b\').';
$strShow = 'Prika¾i';
$strShowAll = 'Prika¾i sve';
$strShowCols = 'Prika¾i stupce';
$strShowingRecords = 'Prikaz redaka';
$strShowPHPInfo = 'Prika¾i informacije o PHP-u';
$strShowTables = 'Prika¾i tablice';
$strShowThisQuery = ' Prika¾i ovaj upit ponovo ';
$strSingly = '(po jednom polju)';
$strSize = 'Velièina';
$strSort = 'Sortiranje';
$strSpaceUsage = 'Zauzeæe';
$strSQLQuery = 'SQL-upit';
$strStartingRecord = 'Poèetni redak';
$strStatement = 'Ime';
$strStrucCSV = 'CSV format';
$strStrucData = 'Struktura i podaci';
$strStrucDrop = 'Dodaj \'drop table\'';
$strStrucExcelCSV = 'CSV za Ms Excel';
$strStrucOnly = 'Samo struktura';
$strSubmit = 'Pokreni';
$strSuccess = 'Va¹ SQL upit je uspje¹no izvr¹en';
$strSum = 'Ukupno';

$strTable = 'tablica ';
$strTableComments = 'Komentar tablice';
$strTableEmpty = 'Ime tablice je prazno!';
$strTableHasBeenDropped = 'Tablica %s je izbrisana';
$strTableHasBeenEmptied = 'Tablica %s je ispra¾njena';
$strTableHasBeenFlushed = 'Tablica %s je osvje¾ena';
$strTableMaintenance = 'Radnje na tablici';
$strTables = '%s tablica/e';
$strTableStructure = 'Struktura tablice';
$strTableType = 'Vrsta tablice';
$strTextAreaLength = ' Zbog velièine ovog polja,<br /> polje mo¾da neæete moæi mijenjati ';
$strTheContent = 'Sadr¾aj datoteke je stavljen u bazu.';
$strTheContents = 'Sadr¾aj tablice zamijeni sa sadr¾ajem datoteke sa identiènim primarnim i jedinstvenim (unique) kljuèem.';
$strTheTerminator = 'Znak za odjeljivanje polja u datoteci.';
$strTotal = 'ukupno';
$strType = 'Vrsta';

$strUncheckAll = 'Makni oznake';
$strUnique = 'Jedinstveni kljuè';
$strUnselectAll = 'Makni oznake';
$strUpdatePrivMessage = 'Promijenili ste privilegije za %s.';
$strUpdateProfile = 'Promijeni profil:';
$strUpdateProfileMessage = 'Profil je promijenjen.';
$strUpdateQuery = 'Promijeni SQL-upit';
$strUsage = 'Zauzeæe';
$strUseBackquotes = 'Koristi \' za ogranièavanje imena polja';
$strUser = 'Korisnik';
$strUserEmpty = 'Ime korisnika je prazno!';
$strUserName = 'Ime korisnika';
$strUsers = 'Korisnici';
$strUseTables = 'Koristi tablice';

$strValue = 'Vrijednost';
$strViewDump = 'Prika¾i dump (shemu) tablice';
$strViewDumpDB = 'Prika¾i dump (shemu) baze';

$strWelcome = 'Dobrodo¹li u %s';
$strWithChecked = 'Oznaèeno:';
$strWrongUser = 'Pogre¹no korisnièko ime/lozinka. Pristup odbijen.';

$strYes = 'Da';

$strZip = '"zip-ano"';

// To translate
?>

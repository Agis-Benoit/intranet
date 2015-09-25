<?php
/* $Id: galician.inc.php,v 1.71 2002/04/20 14:24:35 loic1 Exp $ */

/**
 * Translated by Xosé Calvo <xosecalvo at terra.es>
 */

$charset = 'iso-8859-1';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = 'Acceso Negado';
$strAction = 'Acción';
$strAddDeleteColumn = 'Adicionar/Eliminar columnas de campo';
$strAddDeleteRow = 'Adicionar/Eliminar filas de criterios';
$strAddNewField = 'Adicionar un novo campo';
$strAddPriv = 'Adicionar un novo privilexio';
$strAddPrivMessage = 'Privilexio adicionado.';
$strAddSearchConditions = 'Condición da pesquisa (ou sexa, o complemento da cláusula "WHERE"):';
$strAddToIndex = 'Adicionar ao índice &nbsp;%s&nbsp;coluna(s)';
$strAddUser = 'Adicionar un novo usuario';
$strAddUserMessage = 'Usuario adicionado.';
$strAffectedRows = 'Filas que van ser afectadas:';
$strAfter = 'Despois de %s';
$strAfterInsertBack = 'Voltar';
$strAfterInsertNewInsert = 'Inserir un novo rexistro';
$strAll = 'Todos';
$strAlterOrderBy = 'Ordenar a tabela por';
$strAnalyzeTable = 'Analizar a tabela';
$strAnd = 'E';
$strAnIndex = 'Adicionouse un índice a %s';
$strAny = 'Calquer';
$strAnyColumn = 'Calquer columna';
$strAnyDatabase = 'Calquer banco de datos';
$strAnyHost = 'Calquer servidor';
$strAnyTable = 'Calquer tabela';
$strAnyUser = 'Calquer usuario';
$strAPrimaryKey = 'Adicionouse unha chave primaria a %s';
$strAscending = 'Ascendente';
$strAtBeginningOfTable = 'No comezo da tabela';
$strAtEndOfTable = 'Ao final da tabela';
$strAttr = 'Atributos';

$strBack = 'Voltar';
$strBinary = ' Binario ';
$strBinaryDoNotEdit= ' Binario - non editar ';
$strBookmarkDeleted = 'Eliminouse o marcador.';
$strBookmarkLabel = 'Nome';
$strBookmarkQuery = 'A procura de SQL foi gardada';
$strBookmarkThis = 'Gardar esta procura de SQL';
$strBookmarkView = 'Só visualizar';
$strBrowse = 'Visualizar';
$strBzip = 'comprimido no formato "bzipped"';

$strCantLoadMySQL = 'Non foi posible carregar a extensión do MySQL;<br>comprobe, por favor, a configuración do PHP.';
$strCantRenameIdxToPrimary = 'Non se pode facer que este índice sexa PRIMARIO!';
$strCardinality = 'Cardinalidade';
$strCarriage = 'Carácter de retorno: \\r';
$strChange = 'Mudar';
$strChangePassword = 'Trocar o contrasinal';
$strCheckAll = 'Marcá-los todos';
$strCheckDbPriv = 'Verificar os privilexios do banco de datos';
$strCheckTable = 'Verificar a tabela';
$strColumn = 'Columna';
$strColumnNames = 'Nomes das Columnas';
$strCompleteInserts = 'Insercións completas';
$strConfirm = 'Está seguro/a?';
$strCookiesRequired = 'A partir de aqui debe permitir cookies.';
$strCopyTable = 'Copiar a tabela a (base_de_datos<b>.</b>tabela):';
$strCopyTableOK = 'Tabela \$table copiada para \$new_name.';
$strCreate = 'Crear';
$strCreateIndex = 'Crear un índice en&nbsp;%s&nbsp;colunas';
$strCreateIndexTopic = 'Crear un novo índice';
$strCreateNewDatabase = 'Crear un novo banco de datos';
$strCreateNewTable = 'Crear unha tabela nova na base de datos %s';
$strCriteria = 'Criterio';

$strData = 'Datos';
$strDatabase = 'Banco de Datos ';
$strDatabaseHasBeenDropped = 'A base de datos %s foi eliminada.';
$strDatabases = 'Bancos de Datos';
$strDatabasesStats = 'Estatísticas dos bancos de datos';
$strDatabaseWildcard = 'Base de datos (permítese usar os comodíns):';
$strDataOnly = 'Só os datos';
$strDefault = 'Padrón';
$strDelete = 'Eliminar';
$strDeleted = 'Rexistro eliminado';
$strDeletedRows = 'Filas borradas:';
$strDeleteFailed = 'Non foi posible eliminar!';
$strDeleteUserMessage = 'Acaba de eliminar o usuario %s.';
$strDescending = 'Descendente';
$strDisplay = 'Mostrar';
$strDisplayOrder = 'Mostrar en orde:';
$strDoAQuery = 'Faga unha "procura por exemplo" (o comodín é "%")';
$strDocu = 'Documentación';
$strDoYouReally = 'Seguro? ';
$strDrop = 'Eliminar';
$strDropDB = 'Elimina o banco de datos %s';
$strDropTable = 'Eliminar a tabela';
$strDumpingData = 'Extraindo datos da tabela';
$strDynamic = 'dinámico';

$strEdit = 'Modificar';
$strEditPrivileges = 'Modificar privilexios';
$strEffective = 'Efectivo';
$strEmpty = 'Borrar';
$strEmptyResultSet = 'MySQL retornou um conxunto vacío (ex. cero rexistros).';
$strEnd = 'Fin';
$strEnglishPrivileges = ' Nota: os nomes de privilexios do MySQL están en inglés';
$strError = 'Erro';
$strExtendedInserts = 'Insercións extendidas';
$strExtra = 'Extra';

$strField = 'Campo';
$strFieldHasBeenDropped = 'Eliminouse o campo %s';
$strFields = 'Campos';
$strFieldsEmpty = ' O reconto de campos di que non hai nengún! ';
$strFieldsEnclosedBy = 'Os campos delimítanse con';
$strFieldsEscapedBy = 'Os campos escápanse con';
$strFieldsTerminatedBy = 'Os campos rematan por';
$strFixed = 'fixo';
$strFlushTable = 'Fechar a tabela ("FLUSH")';
$strFormat = 'Formato';
$strFormEmpty = 'Falta un valor no formulario!';
$strFullText = 'Textos completos';
$strFunction = 'Funcións';

$strGenTime = 'Xerado en';
$strGo = 'Executar';
$strGrants = 'Conceder';
$strGzip = 'comprimido no formato "gzipped"';

$strHasBeenAltered = 'foi alterado.';
$strHasBeenCreated = 'foi creado.';
$strHome = 'Comezo ("Home")';
$strHomepageOfficial = 'Páxina Oficial do phpMyAdmin';
$strHomepageSourceforge = 'Páxina do phpMyAdmin en Sourceforge';
$strHost = 'Servidor';
$strHostEmpty = 'O nome do servidor está vacío!';

$strIdxFulltext = 'Texto completo';
$strIfYouWish = 'Para carregar só algunhas columnas da tabela, faga unha lista separada por vírgulas.';
$strIgnore = 'Ignorar';
$strIndex = 'Índice';
$strIndexHasBeenDropped = 'Eliminouse o índice %s';
$strIndexName = 'Nome do índice&nbsp;:';
$strIndexType = 'Tipo de índice&nbsp;:';
$strIndexes = 'Índices';
$strInsert = 'Inserir';
$strInsertAsNewRow = 'Inserir unha nova columna';
$strInsertedRows = 'Filas inseridas:';
$strInsertNewRow = 'Inserir un novo rexistro';
$strInsertTextfiles = 'Inserir un arquivo de texto na tabela';
$strInstructions = 'Instruccións';
$strInUse = 'en uso';
$strInvalidName = '"%s" i unha palabra reservada. Non se pode utilizar como nome dun banco de datos, dunha tabela ou dun campo.';

$strKeepPass = 'Non mude o contrasinal';
$strKeyname = 'Nome chave';
$strKill = 'Matar (kill)';

$strLength = 'Tamaño';
$strLengthSet = 'Tamaño/Definir*';
$strLimitNumRows = 'Número de rexistros por páxina';
$strLineFeed = 'Carácter de alimentación de liña: \\n';
$strLines = 'Liñas';
$strLinesTerminatedBy = 'As liñas rematan por';
$strLocationTextfile = 'Localización do arquivo de texto';
$strLogin = 'Entrada (login)';
$strLogout = 'Sair';
$strLogPassword = 'Contrasinal:';
$strLogUsername = 'Nome de usuario:';

$strModifications = 'As modificacións foron gardadas';
$strModify = 'Modificar';
$strModifyIndexTopic = 'Modificar un índice';
$strMoveTable = 'Mover a tabela a (base_de_datos<b>.</b>tabela):';
$strMoveTableOK = 'Moveuse a tabela %s para %s.';
$strMySQLReloaded = 'MySQL reiniciado.';
$strMySQLSaid = 'Mensaxes do MySQL: ';
$strMySQLShowProcess = 'Mostrar os procesos';
$strMySQLShowStatus = 'Mostrar información de tempo de execución do MySQL';
$strMySQLShowVars = 'Mostrar as variables de sistema do MySQL';

$strName = 'Nome';
$strNbRecords = 'Número de rexistros';
$strNext = 'Seguinte';
$strNo = 'Non';
$strNoDatabases = 'Non hai nengún banco de datos';
$strNoDropDatabases = 'Os comandos "Eliminar banco de datos" non están permitidos.';
$strNoFrames = 'phpMyAdmin usa-se mellor cun navegador que <b>acepte molduras</b>.';
$strNoIndex = 'Non se definiu un índice';
$strNoIndexPartsDefined = 'Non se definiron partes do índice';
$strNoModification = 'Sen cambios';
$strNone = 'Nengun';
$strNoPassword = 'Sen Contrasinal';
$strNoPrivileges = 'Sen Privilexios';
$strNoQuery = 'Non hai procura SQL!';
$strNoRights = 'Non ten direitos suficientes para estar aquí agora!';
$strNoTablesFound = 'Non se achou nengunha tabela no banco de datos';
$strNotNumber = 'Non é un número!';
$strNotValidNumber = ' non é un número válido para unha fila!';
$strNoUsersFound = 'Non se achou nengun(s) usuario(s).';
$strNull = 'Nulo';

$strOftenQuotation = 'Xeralmente son aspas. OPCIONAL significa que só os campos de caracteres son delimitados por caracteres "delimitadores"';
$strOptimizeTable = 'Optimizar a tabela';
$strOptionalControls = 'Opcional. Controla como se han de ler e escreber os caracteres especiais.';
$strOptionally = 'OPCIONAL';
$strOr = 'ou';
$strOverhead = 'De máis (Overhead)';

$strPartialText = 'Textos parciais';
$strPassword = 'Contrasinal';
$strPasswordEmpty = 'O contrasinal está vacío!';
$strPasswordNotSame = 'Os contrasinais non son os mesmos!';
$strPHPVersion = 'Versión do PHP';
$strPmaDocumentation = 'Documentación do phpMyAdmin';
$strPmaUriError = 'A directiva <tt>$cfgPmaAbsoluteUri</tt> DEBE estar asignada no seu ficheiro de configuración.';
$strPos1 = 'Inicio';
$strPrevious = 'Anterior';
$strPrimary = 'Primaria';
$strPrimaryKey = 'Chave primaria';
$strPrimaryKeyHasBeenDropped = 'Eliminouse a chave primaria';
$strPrimaryKeyName = 'O nome da chave primaria debe ser... PRIMARIA';
$strPrimaryKeyWarning = '("PRIMARIA" <b>debe</b> ser o nome de e <b>só de</b> unha chave primaria)';
$strPrintView = 'Visualización previa da impresión';
$strPrivileges = 'Privilexios';
$strProperties = 'Propiedades';

$strQBE = 'Procurar pondo un exemplo ("QBE")';
$strQBEDel = 'Eliminar';
$strQBEIns = 'Inserir';
$strQueryOnDb = 'Procura tipo SQL no banco de datos <b>%s</b>:';

$strRecords = 'Rexistros';
$strReferentialIntegrity = 'Comprobar a integridade das referencias:';
$strReloadFailed = 'A reinicialización do MySQL fallou.';
$strReloadMySQL = 'Reinicializar o MySQL';
$strRememberReload = 'Lembre-se recarregar o servidor.';
$strRenameTable = 'Renomear a tabela para';
$strRenameTableOK = 'Tabela \$table renomeada para \$new_name';
$strRepairTable = 'Reparar a tabela';
$strReplace = 'Substituir';
$strReplaceTable = 'Substituir os datos da tabela polos do ficheiro';
$strReset = 'Reiniciar';
$strReType = 'Reescreber';
$strRevoke = 'Revogar';
$strRevokeGrant = 'Revogar privilexio de conceder';
$strRevokeGrantMessage = 'Retirou-lle o privilexio de Permitir a %s';
$strRevokeMessage = 'Retirou-lle os privilexios a %s';
$strRevokePriv = 'Revogar privilexios';
$strRowLength = 'Lonxitude da fila';
$strRows = 'Filas';
$strRowsFrom = 'filas, a comezar da';
$strRowSize= ' Tamaño da fila ';
$strRowsModeVertical= 'vertical';
$strRowsModeHorizontal= 'horizontal';
$strRowsModeOptions= 'en modo %s e repetir os cabezallos de cada %s celas';
$strRowsStatistic = 'Estatistícas da Fila';
$strRunning = 'a rodar no servidor %s';
$strMySQLServerProcess = 'MySQL %pma_s1% a rodar no servidor %pma_s2% como %pma_s3%';
$strRunQuery = 'Enviar esta procura';
$strRunSQLQuery = 'Efectuar unha procura SQL na base de datos %s';

$strSave = 'Gardar';
$strSelect = 'Procurar';
$strSelectADb = 'Seleccione unha base de dados';
$strSelectAll = 'Seleccionar todo';
$strSelectFields = 'Seleccione os campos (mínimo 1)';
$strSelectNumRows = 'a procurar';
$strSend = 'Enviar <I>(gravar nun ficheiro)</I><br>';
$strServerChoice = 'Escolla de Servidor';
$strServerVersion = 'Versión do servidor';
$strSetEnumVal = 'Se o tipo de campo é "enum" ou "set", introduza os valores usando este formato: \'a\',\'b\',\'c\'...<br />Se precisar pór unha barra invertida (" \ ") ou aspas simples (" \' ") entre estes valores, preceda a barra e as aspas de barras invertidas (por exemplo \'\\\\xyz\' ou \'a\\\'b\').';
$strShow = 'Mostrar';
$strShowAll = 'Ver todos os rexistros';
$strShowCols = 'Mostrar as columnas';
$strShowingRecords = 'Mostrando rexistros ';
$strShowPHPInfo = 'Mostrar información sobre o PHP';
$strShowTables = 'Mostrar as tabelas';
$strShowThisQuery = ' Mostrar esta procura aquí outra vez ';
$strSingly = 'a refacer logo de insercións e destrucións (shingly)';
$strSize = 'Tamaño';
$strSort = 'Ordenar';
$strSpaceUsage = 'Uso do espazo';
$strSQLQuery = 'comando SQL';
$strStartingRecord = 'A comezar un rexistro'; //FUZZY
$strStatement = 'Informacións';
$strStrucCSV = 'Datos CSV';
$strStrucData = 'Estructura e datos';
$strStrucDrop = 'Adicionar \'Eliminar tabela anterior se existe\'';
$strStrucExcelCSV = 'CSV (para datos de Ms Excel)';
$strStrucOnly = 'Só a estructura';
$strSubmit = 'Submeter';
$strSuccess = 'O seu comando de SQL executou-se com éxito';
$strSum = 'Suma';

$strTable = 'tabela ';
$strTableComments = 'Comentarios da tabela';
$strTableEmpty = 'O nome da tabela está vacío!';
$strTableHasBeenDropped = 'Eliminouse a tabela %s';
$strTableHasBeenEmptied = 'Vaciouse a tabela %s';
$strTableHasBeenFlushed = 'Fechouse a tabela %s';
$strTableMaintenance = 'Tabela de manutención';
$strTables = '%s tabela(s)';
$strTableStructure = 'Estructura da tabela';
$strTableType = 'Tipo da tabela';
$strTextAreaLength = ' Por causa da sua lonxitude,<br> este campo pode non ser editable ';
$strTheContent = 'O conteúdo do seu arquivo foi inserido';
$strTheContents = 'O conteúdo do arquivo substituíu o conteúdo da tabela que tiña a mesma chave primaria ou única';
$strTheTerminator = 'O carácter que separa os campos.';
$strTotal = 'total';
$strType = 'Tipo';

$strUncheckAll = 'Quitar-lles as marcas a todos';
$strUnique = 'Único';
$strUnselectAll = 'Non seleccionar nada';
$strUpdatePrivMessage = 'Acaba de actualizar os privilexios de %s.';
$strUpdateProfile = 'Actualizar o perfil:';
$strUpdateProfileMessage = 'Actualizouse o perfil.';
$strUpdateQuery = 'Actualizar a procura';
$strUsage = 'Uso';
$strUseBackquotes = 'Protexer os nomes das tabelas e dos campos con&nbsp;" ` "';
$strUser = 'Usuario';
$strUserEmpty = 'O nome do usuario está vacío!';
$strUserName = 'Nome do usuario';
$strUsers = 'Usuarios';
$strUseTables = 'Usar as tabelas';

$strValue = 'Valor';
$strViewDump = 'Ver o esquema do volcado da tabela';
$strViewDumpDB = 'Ver o esquema do volcado do banco de datos';

$strWelcome = 'Benvida/o a %s';
$strWithChecked = 'Todos os marcados';
$strWrongUser = 'Usuario ou contrasinal errado. Acceso negado.';

$strYes = 'Si';

$strZip = 'comprimido no formato "zipped"';

// To translate
?>

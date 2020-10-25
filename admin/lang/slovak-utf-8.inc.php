<?php

/* $Id: slovak-utf-8.inc.php,v 2.38 2004/07/17 22:58:30 rabus Exp $ */

/* By: lubos klokner <erkac@vault-tec.sk> */

$charset = 'utf-8';
$allow_recoding = true;
$text_dir = 'ltr';
$left_font_family = '"verdana ce", "arial ce", verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'tahoma, "verdana ce", "arial ce", helvetica, arial, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = ['Bajtov', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];

$day_of_week = ['Ne', 'Po', 'Út', 'St', 'Št', 'Pi', 'So'];
$month = ['Jan', 'Feb', 'Mar', 'Apr', 'Máj', 'Jún', 'Júl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d.%B, %Y - %H:%M';
$timespanfmt = '%s dní, %s hodín, %s minút a %s sekúnd';

$strAPrimaryKey = 'Bol pridaný primárny kľúč pre %s';
$strAbortedClients = 'Prerušené';
$strAbsolutePathToDocSqlDir = 'Prosím zadajte absolútnu cestu k adresáru docSQL na serveri.';
$strAccessDenied = 'Prístup zamietnutý';
$strAccessDeniedExplanation = 'phpMyAdmin sa pokúsil pripojiť k MySQL serveru ale ten spojenie odmietol. Skontrolujte prosím meno serveru, používateľské meno a heslo v súbore config.inc.php a s tým, ktoré ste dostali o administrátora MySQL servera.';
$strAction = 'Akcia';
$strAddAutoIncrement = 'Pridať hodnotu AUTO_INCREMENT';
$strAddConstraints = 'Pridať obmedzenia';
$strAddDeleteColumn = 'Pridať/Odobrať polia stĺpcov';
$strAddDeleteRow = 'Pridať/Odobrať kritéria riadku';
$strAddDropDatabase = 'Pridať DROP DATABASE';
$strAddHeaderComment = 'Pridať vlastný komentár do hlavičky (\\n oddeľuje riadky)';
$strAddIfNotExists = 'Pridať IF NOT EXISTS';
$strAddIntoComments = 'Pridať do komentárov';
$strAddNewField = 'Pridať nové pole';
$strAddPrivilegesOnDb = 'Pridať oprávnenia pre nasledujúcu databázu';
$strAddPrivilegesOnTbl = 'Pridať oprávnenia pre nasledujúcu tabuľku';
$strAddSearchConditions = 'Pridať vyhľadávacie parametre (obsah dotazu po "where" príkaze):';
$strAddToIndex = 'Pridať do indexu &nbsp;%s&nbsp;stĺpec';
$strAddUser = 'Pridať nového používateľa';
$strAddUserMessage = 'Používateľ bol pridaný.';
$strAddedColumnComment = 'Pridaný komentár k stĺpcu';
$strAddedColumnRelation = 'Pridaný vzťah pre stĺpec';
$strAdministration = 'Administrácia';
$strAffectedRows = ' Ovplyvnené riadky: ';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Späť';
$strAfterInsertNewInsert = 'Vložiť nový záznam';
$strAfterInsertSame = 'Späť na túto stránku';
$strAll = 'Všetko';
$strAllTableSameWidth = 'zobraziť všetky tabuľky s rovnakou šírkou?';
$strAlterOrderBy = 'Zmeniť poradie tabuľky podľa';
$strAnIndex = 'Bol pridaný index pre %s';
$strAnalyzeTable = 'Analyzovať tabuľku';
$strAnd = 'a';
$strAny = 'Akýkoľvek';
$strAnyHost = 'Akýkoľvek hostiteľ';
$strAnyUser = 'Akýkoľvek používateľ';
$strArabic = 'Arabština';
$strArmenian = 'Arménština';
$strAscending = 'Vzostupne';
$strAtBeginningOfTable = 'Na začiatku tabuľky';
$strAtEndOfTable = 'Na konci tabuľky';
$strAttr = 'Atribúty';
$strAutodetect = 'Automaticky zistiť';
$strAutomaticLayout = 'Automatické rozvrhnutie';

$strBack = 'Späť';
$strBaltic = 'Baltické';
$strBeginCut = 'ZAČIATOK VÝSEKU';
$strBeginRaw = 'ZAČIATOK TOKU';
$strBinary = 'Binárny';
$strBinaryDoNotEdit = 'Binárny - neupravujte ';
$strBookmarkAllUsers = 'Dovoliť používať túto položku všetkým používateľom';
$strBookmarkDeleted = 'Záznam z obľúbených bol zmazaný.';
$strBookmarkLabel = 'Názov';
$strBookmarkOptions = 'Vlastnosti obľúbených';
$strBookmarkQuery = 'Obľúbený SQL dotaz';
$strBookmarkThis = 'Pridať tento SQL dotaz do obľúbených';
$strBookmarkView = 'Iba prezrieť';
$strBrowse = 'Prechádzať';
$strBrowseForeignValues = 'Prejsť hodnoty cudzích kľúčov';
$strBulgarian = 'Bulharsky';
$strBzError = 'nepodarilo sa skomprimovať výstup z dôvodu chybného rozšírenia pre kompresiu Bz2 v tejto verzii php. Doporučuje sa nastaviť <code>$cfg[\'BZipDump\']</code> v konfigurácii phpMyAdmin na <code>FALSE</code>. Ak si želáte používať kompresiu Bz2 mali by ste nainštalovať novšiu verziu php. Viac informácií získate z popisu chyby: %s.';
$strBzip = '"bzipped"';

$strCSVOptions = 'CSV nastavenia';
$strCalendar = 'Kalendár';
$strCannotLogin = 'Nedá sa prihlásiť k MySQL serveru';
$strCantLoad = 'nedá sa nahrať rozšírenie %s,<br>prosím skontrolujte konfiguráciu PHP';
$strCantLoadRecodeIconv = 'Nie je možné nahrať rozšírenie iconv alebo recode potrebné pre prevod znakových sad. Upravte nastavenie php tak aby umožňovalo použiť tieto rozšírenia alebo vypnite túto vlastnosť v konfigurácii phpMyAdmina.';
$strCantRenameIdxToPrimary = 'Nie je možné premenovať index na PRIMARY!';
$strCantUseRecodeIconv = 'Nie je možné použiť funkcie iconv,libiconv a recode_string aj napriek tomu, že rozšírenia sú nahrané. Skontrolujte prosím nastavenie PHP.';
$strCardinality = 'Mohutnosť';
$strCarriage = 'Návrat vozíku (Carriage return): \\r';
$strCaseInsensitive = 'nerozlišovať veľké a malé písmená';
$strCaseSensitive = 'rozlišovať veľké a malé písmená';
$strCentralEuropean = 'Stredná Európa';
$strChange = 'Zmeniť';
$strChangeCopyMode = 'Vytvoriť používateľa s rovnakými právami a...';
$strChangeCopyModeCopy = '... zachovať pôvodného používateľa.';
$strChangeCopyModeDeleteAndReload = ' ... zmazať pôvodného používateľa z tabuliek používateľov a potom znovunačítať oprávnenia.';
$strChangeCopyModeJustDelete = ' ... zmazať pôvodného používateľa z tabuliek používateľov.';
$strChangeCopyModeRevoke = ' ... odobrať všetky oprávnenia pôvodnému používateľovi a následne ho zmazať.';
$strChangeCopyUser = 'Zmeniť informácie o používateľovi / Kopírovať používateľa';
$strChangeDisplay = 'Zvolte, ktoré pole zobraziť';
$strChangePassword = 'Zmeniť heslo';
$strCharset = 'Znaková sada';
$strCharsetOfFile = 'Znaková sada súboru:';
$strCharsets = 'Znakové sady';
$strCharsetsAndCollations = 'Znakové sady a porovnávanie';
$strCheckAll = 'Označiť všetko';
$strCheckOverhead = 'Zvoliť neoptimálne';
$strCheckPrivs = 'Skontrolovať oprávnenia';
$strCheckPrivsLong = 'Skontrolovať oprávnenia pre databázu &quot;%s&quot;.';
$strCheckTable = 'Skontrolovať tabuľku';
$strChoosePage = 'Prosím zvolte si Stránku, ktorú chcete upraviť';
$strColComFeat = 'Zobrazovať komentáre stĺpcov';
$strCollation = 'Porovnávanie';
$strColumnNames = 'Názvy stĺpcov';
$strColumnPrivileges = 'Oprávnenia pre jednotlivé stĺpce';
$strCommand = 'Príkaz';
$strComments = 'Komentáre';
$strCommentsForTable = 'KOMENTÁRE PRE TABUĽKU';
$strCompleteInserts = 'Úplné vloženie';
$strCompression = 'Kompresia';
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br>This might happen if php finds a parse error in it or php cannot find the file.<br>Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br>If you recieve a blank page, everything is fine.';
$strConfigureTableCoord = 'Prosím skonfigurujte koordináty pre tabuľku %s';
$strConnectionError = 'Nepodarilo sa pripojiť: chybné nastavenia.';
$strConnections = 'Spojenia';
$strConstraintsForDumped = 'Obmedzenie pre exportované tabuľky';
$strConstraintsForTable = 'Obmedzenie pre tabuľku';
$strCookiesRequired = 'Cookies musia byť povolené, pokiaľ chcete pokračovať.';
$strCopyTable = 'Skopírovať tabuľku do (databáza<b>.</b>tabuľka):';
$strCopyTableOK = 'Tabuľka %s bola skorírovaná do %s.';
$strCopyTableSameNames = 'Nedá sa skopírovať tabuľka sama do seba!';
$strCouldNotKill = 'Neporadilo za zabiť vlákno %s. Jeho beh bol pravdepodobne už ukončený.';
$strCreate = 'Vytvoriť';
$strCreateIndex = 'Vytvoriť index na&nbsp;%s&nbsp;stĺpcoch';
$strCreateIndexTopic = 'Vytvoriť nový index';
$strCreateNewDatabase = 'Vytvoriť novú databázu';
$strCreateNewTable = 'Vytvoriť novú tabuľku v databáze %s';
$strCreatePage = 'Vytvoriť novú Stránku';
$strCreatePdfFeat = 'Vytváranie PDF';
$strCreationDates = 'Dátum vytvorenia, poslednej zmeny a kontroly';
$strCriteria = 'Kritéria';
$strCroatian = 'Chorvátsky';
$strCyrillic = 'Cyrilika';
$strCzech = 'Česky';
$strCzechSlovak = 'Čeština/Slovenčina';

$strDBComment = 'Komentár k databáze: ';
$strDBGContext = 'Kontext';
$strDBGContextID = 'Kontext ID';
$strDBGHits = 'Zásahov';
$strDBGLine = 'Riadok';
$strDBGMaxTimeMs = 'Max. čas, ms';
$strDBGMinTimeMs = 'Min čas, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Čas/Zásah, ms';
$strDBGTotalTimeMs = 'Celkový čas, ms';
$strDBRename = 'Premenovať databázu na';
$strDanish = 'Dánsky';
$strData = 'Dáta';
$strDataDict = 'Dátový slovník';
$strDataOnly = 'Iba dáta';
$strDatabase = 'Databáza';
$strDatabaseEmpty = 'Meno databázy je prázdne!';
$strDatabaseExportOptions = 'Nastavenia exportu databáz';
$strDatabaseHasBeenDropped = 'Databáza %s bola zmazaná.';
$strDatabaseNoTable = 'Táto databáza neobsahuje žiadne tabuľky!';
$strDatabases = 'databáz(y)';
$strDatabasesDropped = 'Úspešne zrušených databáz: %s.';
$strDatabasesStats = 'Štatistiky databázy';
$strDatabasesStatsDisable = 'Skryť štatistiky';
$strDatabasesStatsEnable = 'Zobraziť štatistiky';
$strDatabasesStatsHeavyTraffic = 'Poznámka: Aktivovanie štatistík databázy môže spôsobiť značné zvýšenie sieťovej prevádzky medzi databázou a web serverom.';
$strDbPrivileges = 'Oprávnenia pre jednotlivé databázy';
$strDbSpecific = 'závislé na databáze';
$strDefault = 'Predvolené';
$strDefaultValueHelp = 'Pre predvolené hodnoty, prosím zadajte iba jednu hodnotu bez úvodzoviek alebo uvádzacích znakov, napr.: a';
$strDefragment = 'Defragmentovať tabuľku';
$strDelOld = 'Aktuálna stránka sa odkazuje na tabuľky, ktoré už neexistujú, želáte si odstrániť tieto odkazy?';
$strDelayedInserts = 'Použiť oneskorené vloženia';
$strDelete = 'Zmazať';
$strDeleteAndFlush = 'Odstrániť používateľov a znovunačítať práva.';
$strDeleteAndFlushDescr = 'Toto je najčistejšie riešenie, ale znovunačítanie práv môže chvíľu trvať.';
$strDeleted = 'Riadok bol zmazaný';
$strDeletedRows = 'Zmazané riadky:';
$strDeleting = 'Odstraňuje sa %s';
$strDescending = 'Zostupne';
$strDescription = 'Popis';
$strDictionary = 'slovník';
$strDisableForeignChecks = 'Vypnúť kontrolu cudzích kľúčov';
$strDisabled = 'Vypnuté';
$strDisplayFeat = 'Zobraziť vlastnosti';
$strDisplayOrder = 'Zobraziť zoradené:';
$strDisplayPDF = 'Zobraziť schému PDF';
$strDoAQuery = 'Vykonať "dotaz podľa príkladu" (nahradzujúci znak: "%")';
$strDoYouReally = 'Skutočne chcete vykonať príkaz ';
$strDocu = 'Dokumentácia';
$strDrop = 'Odstrániť';
$strDropDatabaseStrongWarning = 'Chystáte sa ZRUŠIŤ celú databázu!';
$strDropSelectedDatabases = 'Zrušiť vybrané databázy';
$strDropUsersDb = 'Odstrániť databázy s rovnakým menom ako majú používatelia.';
$strDumpSaved = 'Dump (schéma) bol uložený do súboru %s.';
$strDumpXRows = 'Zobraziť %s riadkov od riadku %s.';
$strDumpingData = 'Sťahujem dáta pre tabuľku';
$strDynamic = 'dynamický';

$strEdit = 'Upraviť';
$strEditPDFPages = 'Upraviť PDF Stránky';
$strEditPrivileges = 'Upraviť oprávnenia';
$strEffective = 'Efektívny';
$strEmpty = 'Vyprázdniť';
$strEmptyResultSet = 'MySQL vrátil prázdny výsledok (tj. nulový počet riadkov).';
$strEnabled = 'Zapnuté';
$strEncloseInTransaction = 'Uzatvoriť príkazy v transakcii';
$strEnd = 'Koniec';
$strEndCut = 'KONIEC VÝSEKU';
$strEndRaw = 'KONIEC TOKU';
$strEnglish = 'Anglicky';
$strEnglishPrivileges = ' Poznámka: názvy MySQL oprávnení sú uvádzané v angličtine. ';
$strError = 'Chyba';
$strEstonian = 'Estónsky';
$strExcelEdition = 'Verzia Excelu';
$strExcelOptions = 'Nastavenie exportu do Excelu';
$strExecuteBookmarked = 'Spustiť obľúbený dotaz';
$strExplain = 'Vysvetliť SQL';
$strExport = 'Exportovať';
$strExtendedInserts = 'Rozšírené vkladanie';
$strExtra = 'Extra';

$strFailedAttempts = 'Nepodarených pokusov';
$strField = 'Pole';
$strFieldHasBeenDropped = 'Pole %s bolo odstránené';
$strFields = 'Polia';
$strFieldsEmpty = ' Počet polí je prázdny! ';
$strFieldsEnclosedBy = 'Polia uzatvorené';
$strFieldsEscapedBy = 'Polia uvedené pomocou';
$strFieldsTerminatedBy = 'Polia ukončené';
$strFileAlreadyExists = 'Súbor %s už existuje na servery, zmente názov súboru alebo zvolte prepísanie súboru.';
$strFileCouldNotBeRead = 'Súbor sa nedá prečítať';
$strFileNameTemplate = 'Vzor pre názov súboru';
$strFileNameTemplateHelp = 'Použite __DB__ ako názov databázy, __TABLE__ ako názov tabuľky a akékoľvek parametre pre %sfunkciu strftime%s pre vloženie dát. Prípona súboru bude pridaná automaticky podľa typu. Akýkoľvek iný text zostane zachovaný.';
$strFileNameTemplateRemember = 'zapamätať si vzor';
$strFixed = 'pevný';
$strFlushPrivilegesNote = 'Poznámka: phpMyAdmin získava práva používateľov priamo z tabuliek MySQL. Obsah týchto tabuliek sa môže líšiť od práv, ktoré používa server, ak boli tieto tabuľky ručne upravené. V tomto prípade sa odporúča vykonať %sznovunačítanie práv%s predtým ako budete pokračovať.';
$strFlushTable = 'Vyprázdniť tabuľku ("FLUSH")';
$strFormEmpty = 'Chýbajúca položka vo formulári !';
$strFormat = 'Formát';
$strFullText = 'Plné texty';
$strFunction = 'Funkcia';

$strGenBy = 'Vygenerované';
$strGenTime = 'Vygenerované:';
$strGeneralRelationFeat = 'Možnosti všeobecných vzťahov';
$strGeorgian = 'Gruzínčina';
$strGerman = 'Nemecky';
$strGlobal = 'globálny';
$strGlobalPrivileges = 'Globálne práva';
$strGlobalValue = 'Globálna hodnota';
$strGo = 'Vykonaj';
$strGrantOption = 'Prideliť';
$strGreek = 'Gréčtina';
$strGzip = '"gzip-ované"';

$strHasBeenAltered = 'bola zmenená.';
$strHasBeenCreated = 'bola vytvorená.';
$strHaveToShow = 'Zvolte prosím aspoň jeden stĺpec, ktorý chcete zobraziť';
$strHebrew = 'Hebrejsky';
$strHome = 'Domov';
$strHomepageOfficial = 'Oficiálne stránky phpMyAdmin-a';
$strHost = 'Hostiteľ';
$strHostEmpty = 'Názov hostiteľa je prázdny!';
$strHungarian = 'Maďarsky';

$strId = 'ID';
$strIdxFulltext = 'Celý text';
$strIfYouWish = 'Ak si želáte nahrať iba určité stĺpce tabuľky, špecifikujte ich ako zoznam polí oddelený čiarkou.';
$strIgnore = 'Ignorovať';
$strIgnoreInserts = 'Použiť IGNORE';
$strIgnoringFile = 'Ignorujem súbor %s';
$strImportDocSQL = 'Importovať súbory docSQL';
$strImportFiles = 'Importovať súbory';
$strImportFinished = 'Importovanie ukončené';
$strInUse = 'práve sa používa';
$strIndex = 'Index';
$strIndexHasBeenDropped = 'Index pre %s bol odstránený';
$strIndexName = 'Meno indexu&nbsp;:';
$strIndexType = 'Typ indexu&nbsp;:';
$strIndexes = 'Indexy';
$strInnodbStat = 'Stav InnoDB';
$strInsecureMySQL = 'Konfiguračný súbor obsahuje nastavenia (root bez hesla), ktoré zodpovedajú predvolenému privilegovanému MySQL účtu. Ak MySQL server beží s týmto nastavením, nie je zabezpečený proti napadnutiu, táto bezpečnostná chyba by mala byť urýchlene odstránená.';
$strInsert = 'Vložiť';
$strInsertAsNewRow = 'Vložiť ako nový riadok';
$strInsertNewRow = 'Vložiť nový riadok';
$strInsertTextfiles = 'Vložiť textové súbory do tabuľky';
$strInsertedRowId = 'Id vloženého riadku:';
$strInsertedRows = 'Vložené riadky:';
$strInstructions = 'Inštrukcie';
$strInternalNotNecessary = '* Vnútorný vzťah nie je nutný ak už vzťah existuje v InnoDB.';
$strInternalRelations = 'Interné vzťahy';

$strJapanese = 'Japončina';
$strJumpToDB = 'Na databázu &quot;%s&quot;.';
$strJustDelete = 'Iba odstrániť používateľlov z tabuliek práv.';
$strJustDeleteDescr = '&quot;Odstránení&quot; používatelia budú mať k serveru ako predtým až do znovunačítania práv.';

$strKeepPass = 'Nezmeniť heslo';
$strKeyname = 'Kľúčový názov';
$strKill = 'Zabiť';
$strKorean = 'Kórejčina';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'Nastavenia LaTeX';
$strLandscape = 'Na šírku';
$strLatexCaption = 'Nadpis tabuľky';
$strLatexContent = 'Obsah tabuľky __TABLE__';
$strLatexContinued = '(pokračovanie)';
$strLatexContinuedCaption = 'Nadpis pokračovania tabuľky';
$strLatexIncludeCaption = 'Zahrnúť nadpis tabuľky';
$strLatexLabel = 'Návestie';
$strLatexStructure = 'Štruktúra tabuľky __TABLE__';
$strLengthSet = 'Dĺžka/Nastaviť*';
$strLimitNumRows = 'záznamov na stránku';
$strLineFeed = 'Ukončenie riadku (Linefeed): \\n';
$strLinesTerminatedBy = 'Riadky ukončené';
$strLinkNotFound = 'Linka nebola nájdená';
$strLinksTo = 'Linkovať na';
$strLithuanian = 'Litovsky';
$strLoadExplanation = 'Automaticky sú nastavené najlepšie hodnoty, ak toto nastavenie nebude fungovať, môžete skúsiť druhú možnosť.';
$strLoadMethod = 'Parametre pre príkaz LOAD';
$strLocalhost = 'Lokálny';
$strLocationTextfile = 'Lokácia textového súboru';
$strLogPassword = 'Heslo:';
$strLogServer = 'Server';
$strLogUsername = 'Používateľ:';
$strLogin = 'Login';
$strLoginInformation = 'Prihlásenie';
$strLogout = 'Odhlásiť sa';

$strMIMETypesForTable = 'MIME TYPY PRE TABUĽKU';
$strMIME_MIMEtype = 'MIME typ';
$strMIME_available_mime = 'Dostupné MIME typy';
$strMIME_available_transform = 'Dostupné transformácie';
$strMIME_description = 'Popis';
$strMIME_nodescription = 'Nie je dostupný žiadny popis pre túto transformáciu.<br>Kontaktujte autora, ktorý %s vytára.';
$strMIME_transformation = 'Transformácia pri prehliadaní';
$strMIME_transformation_note = 'Pre zoznam dostupných parametrov a ich MIME typov kliknite na %spopisy transformácií';
$strMIME_transformation_options = 'Parametre transformácie';
$strMIME_transformation_options_note = 'Prosím zadajte hodnoty pre parametre transformácie v nasledujúcom tvare: \'a\',\'b\',\'c\'...<br>Ak potrebujete použiť spätné lomítko ("\") alebo jednoduché úvodzovky ("\'") medzi týmito hodnotami, vložte pred nich spätné lomítko (napr. \'\\\\xyz\' alebo \'a\\\'b\').';
$strMIME_without = 'MIME typy zobrazené kurzívou nemajú vlastnú transformačnú funkciu';
$strMaximumSize = 'Maximálna veľkosť: %s%s';
$strModifications = 'Zmeny boli uložené';
$strModify = 'Zmeniť';
$strModifyIndexTopic = 'Modifikovať index';
$strMoreStatusVars = 'Ďalšie informácie o stave';
$strMoveTable = 'Presunúť tabuľku do (databáza<b>.</b>tabuľka):';
$strMoveTableOK = 'Tabuľka %s bola presunutá do %s.';
$strMoveTableSameNames = 'Nedá sa presunúť tabuľka sama do seba!';
$strMultilingual = 'mnohojazyčný';
$strMustSelectFile = 'Zvolte prosím súbor, ktorý si želáte vložiť.';
$strMySQLCharset = 'Znaková sada v MySQL';
$strMySQLReloaded = 'MySQL znovu-načítaná.';
$strMySQLSaid = 'MySQL hlási: ';
$strMySQLServerProcess = 'MySQL %pma_s1% beží na %pma_s2% ako %pma_s3%';
$strMySQLShowProcess = 'Zobraziť procesy';
$strMySQLShowStatus = 'Zobraziť MySQL informácie o behu';
$strMySQLShowVars = 'Zobraziť MySQL systémové premenné';

$strName = 'Názov';
$strNeedPrimaryKey = 'Pre túto tabuľku by ste mali definovať primárny kľúč.';
$strNext = 'Ďalší';
$strNo = 'Nie';
$strNoDatabases = 'Žiadne databázy';
$strNoDatabasesSelected = 'Neboli vybrané žiadne databázy.';
$strNoDescription = 'bez Popisu';
$strNoDropDatabases = 'Možnosť "DROP DATABASE" vypnutá.';
$strNoExplain = 'Preskočiť vysvetlenie SQL';
$strNoFrames = 'phpMyAdmin funguje lepšie s prehliadačmi podporujúcimi <b>rámy</b>.';
$strNoIndex = 'Nebol definovaný žiadny index!';
$strNoIndexPartsDefined = 'Časti indexu neboli definované!';
$strNoModification = 'Žiadna zmena';
$strNoOptions = 'Tento formát nemá žiadne nastavenia';
$strNoPassword = 'Žiadne heslo';
$strNoPermission = 'Web server nemá oprávenia na uloženie do súboru %s.';
$strNoPhp = 'bez PHP kódu';
$strNoPrivileges = 'Žiadne oprávnenia';
$strNoQuery = 'Žiadny SQL dotaz!';
$strNoRights = 'Nemáte dostatočné práva na vykonanie tejto akcie!';
$strNoRowsSelected = 'Nebol vybraný žiadny riadok';
$strNoSpace = 'Nedostatok miesta pre uloženie súboru %s.';
$strNoTablesFound = 'Neboli nájdené žiadne tabuľky v tejto datábaze.';
$strNoUsersFound = 'Nebol nájdený žiadny používateľ.';
$strNoValidateSQL = 'Preskočiť potvrdenie platnosti SQL';
$strNone = 'Žiadny';
$strNotNumber = 'Toto nie je číslo!';
$strNotOK = 'chyba';
$strNotSet = 'Tabuľka <b>%s</b> nebola nájdená alebo nie je nastavená v %s';
$strNotValidNumber = ' nie je platné číslo riadku!';
$strNull = 'Nulový';
$strNumSearchResultsInTable = '%s výskyt(ov)v tabuľke <i>%s</i>';
$strNumSearchResultsTotal = '<b>Celkovo:</b> <i>%s</i> výskyt(ov)';
$strNumTables = 'Tabuľky';

$strOK = 'OK';
$strOftenQuotation = 'Často uvodzujúce znaky. Voliteľne znamená, že iba polia typu char a varchar sú uzatvorené do "uzatváracích" znakov.';
$strOperations = 'Operácie';
$strOperator = 'Operátor';
$strOptimizeTable = 'Optimalizovať tabuľku';
$strOptionalControls = 'Voliteľné. Určuje ako zapisovať alebo čítať špeciálne znaky.';
$strOptionally = 'Voliteľne';
$strOr = 'alebo';
$strOverhead = 'Naviac';
$strOverwriteExisting = 'Prepísať existujúci súbor(y)';

$strPHP40203 = 'Používate PHP 4.2.3, ktoré ma vážnu chybu pri práci s viac bajtovými znakmi (mbstring). V PHP je táto chyba zdokumentovaná pod číslom 19404. Nedoporučuje sa používať túto verziu PHP s phpMyAdminom.';
$strPHPVersion = 'Verzia PHP';
$strPageNumber = 'Číslo stránky:';
$strPaperSize = 'Veľkosť stránky';
$strPartialText = 'Čiastočné texty';
$strPassword = 'Heslo';
$strPasswordChanged = 'Heslo pre %s bolo úspešne zmenené.';
$strPasswordEmpty = 'Heslo je prázdne!';
$strPasswordNotSame = 'Heslá sa nezhodujú!';
$strPdfDbSchema = 'Schéma databázy "%s"  - Strana %s';
$strPdfInvalidTblName = 'Tabuľka "%s" neexistuje!';
$strPdfNoTables = 'Žiadne tabuľky';
$strPerHour = 'za hodinu';
$strPerMinute = 'za minútu';
$strPerSecond = 'za sekundu';
$strPhoneBook = 'adresár';
$strPhp = 'Vytvoriť PHP kód';
$strPmaDocumentation = 'phpMyAdmin Dokumentácia';
$strPmaUriError = 'Direktíva <tt>$cfg[\'PmaAbsoluteUri\']</tt> v konfiguračnom súbore MUSÍ byť nastavená!';
$strPortrait = 'Na výšku';
$strPos1 = 'Začiatok';
$strPrevious = 'Predchádzajúci';
$strPrimary = 'Primárny';
$strPrimaryKeyHasBeenDropped = 'Primárny kľúč bol zrušený';
$strPrimaryKeyName = 'Názov primárneho kľúča musí byť... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>musí</b> byť <b>iba</b> meno primárneho kľúča!)';
$strPrint = 'Vytlačiť';
$strPrintView = 'Náhľad k tlači';
$strPrintViewFull = 'Náhľad tlače (s kompletnými textami)';
$strPrivDescAllPrivileges = 'Všetky oprávnenia okrem GRANT.';
$strPrivDescAlter = 'Povolí meniť štruktúru existujúcich tabuliek.';
$strPrivDescCreateDb = 'Povolí vytváranie nových databáz a tabuliek.';
$strPrivDescCreateTbl = 'Povolí vytváranie nových tabuliek.';
$strPrivDescCreateTmpTable = 'Povolí vytváranie dočasných tabuliek.';
$strPrivDescDelete = 'Povolí mazanie dát.';
$strPrivDescDropDb = 'Povolí odstraňovanie databáz a tabuliek.';
$strPrivDescDropTbl = 'Povolí odstraňovanie tabuliek.';
$strPrivDescExecute = 'Povolí spúšťanie uložených procedúr. Nefunguje v tejto verzii MySQL.';
$strPrivDescFile = 'Povolí importovanie a exportovanie dát zo/do súborov na serveri.';
$strPrivDescGrant = 'Povolí pridávanie uživatelov a práv bez znovunačítania tabuliek práv.';
$strPrivDescIndex = 'Povolí vytváranie a mazanie indexov.';
$strPrivDescInsert = 'Povolí vkladanie a nahradzovanie dát.';
$strPrivDescLockTables = 'Povolí zmaknutie tabuliek pre aktuálne vlákno.';
$strPrivDescMaxConnections = 'Obmedzí počet nových spojení, ktoré môže používateľ vytvoriť za hodinu.';
$strPrivDescMaxQuestions = 'Obmedzí počet dotazov, ktoré môže používateľ odoslať za hodinu.';
$strPrivDescMaxUpdates = 'Obmedzí počet príkazov meniacich tabuľku alebo databázu, ktorá môže používateľ odoslať za hodinu.';
$strPrivDescProcess3 = 'Povolí zabíjanie procesov iným používateľlom.';
$strPrivDescProcess4 = 'Povolí prezeranie kompletných dotazov v zozname procesov.';
$strPrivDescReferences = 'Nefunguje v tejto verzii MySQL.';
$strPrivDescReload = 'Povolí znovunačítanie nastavení a vyprázdňovanie vyrovnávacích pamätí serveru.';
$strPrivDescReplClient = 'Povolí používateľovi zistiť kde je hlavný / pomocný server.';
$strPrivDescReplSlave = 'Potrebné pre replikáciu pomocných serverov.';
$strPrivDescSelect = 'Povolí čítanie dát.';
$strPrivDescShowDb = 'Povolí prístup ku kompletnému zoznamu databáz.';
$strPrivDescShutdown = 'Povolí vypnutie serveru.';
$strPrivDescSuper = 'Povolí spojenie aj v prípade, že bol dosiahnutý maximálny počet spojení. Potrebné pre väčšinu operácií pri správe serveru ako nastavovanie globálny premenných alebo zabíjanie procesov iných používateľov.';
$strPrivDescUpdate = 'Povolí menenie dát.';
$strPrivDescUsage = 'Žiadne práva.';
$strPrivileges = 'Oprávnenia';
$strPrivilegesReloaded = 'Práva boli úspešne znovunačítané.';
$strProcesslist = 'Zoznam procesov';
$strProperties = 'Vlastnosti';
$strPutColNames = 'Pridať názvy polí na prvý riadok';

$strQBE = 'Dotaz podľa príkladu';
$strQBEDel = 'Zmazať';
$strQBEIns = 'Vložiť';
$strQueryFrame = 'SQL okno';
$strQueryOnDb = ' SQL dotaz v databáze <b>%s</b>:';
$strQuerySQLHistory = 'SQL história';
$strQueryStatistics = '<b>Query statistics</b>: Since its startup, %s queries have been sent to the server.';
$strQueryTime = 'Dotaz zabral %01.4f sek.';
$strQueryType = 'Typ dotazu';
$strQueryWindowLock = 'Neprepisovať tento dotaz z hlavného okna';

$strReType = 'Potvrdiť';
$strReceived = 'Prijaté';
$strRecords = 'Záznamov';
$strReferentialIntegrity = 'Skontrolovať referenčnú integritu:';
$strRefresh = 'Obnoviť';
$strRelationNotWorking = 'Prídavné vlastnosti pre prácu s prepojenými tabuľkami boli deaktivované. Ak chcete zistiť prečo, kliknite %ssem%s.';
$strRelationView = 'Zobraziť spojitosti';
$strRelationalSchema = 'Relačná schéma';
$strRelations = 'Prepojenia';
$strRelationsForTable = 'VZŤAHY PRE TABUĽKU';
$strReloadFailed = 'Znovu-načítanie MySQL bolo neúspešné.';
$strReloadMySQL = 'Znovu-načítať MySQL';
$strReloadingThePrivileges = 'Znovunačítanie práv';
$strRemoveSelectedUsers = 'Odstrániť vybraných používateľov';
$strRenameDatabaseOK = 'Databáza %s bola premenovaná na %s';
$strRenameTable = 'Premenovať tabuľku na';
$strRenameTableOK = 'Tabuľka %s bola premenovaná na %s';
$strRepairTable = 'Opraviť tabuľku';
$strReplace = 'Nahradiť';
$strReplaceNULLBy = 'Nahradiť NULL hodnoty';
$strReplaceTable = 'Nahradiť dáta v tabuľke súborom';
$strReset = 'Pôvodné (Reset)';
$strResourceLimits = 'Obmedzenie zdrojov';
$strRevoke = 'Zrušiť';
$strRevokeAndDelete = 'Odobranie všetkých aktívnych práv používateľom a ich následné odstránenie.';
$strRevokeAndDeleteDescr = 'Užívatelia budú mať stále právo USAGE (používanie) až do znovunačítania práv.';
$strRevokeMessage = 'Boli zrušené oprávnenia pre %s';
$strRowLength = 'Dĺžka riadku';
$strRowSize = ' Veľkosť riadku ';
$strRows = 'Riadkov';
$strRowsFrom = 'riadky začínajú od';
$strRowsModeFlippedHorizontal = 'vodorovnom (otočené hlavičky)';
$strRowsModeHorizontal = 'horizontálnom';
$strRowsModeOptions = 'v(o) %s móde a opakovať hlavičky po každých %s bunkách';
$strRowsModeVertical = 'vertikálnom';
$strRowsStatistic = 'Štatistika riadku';
$strRunQuery = 'Odošli dotaz';
$strRunSQLQuery = 'Spustiť SQL dotaz/dotazy na databázu %s';
$strRunning = 'beží na %s';
$strRussian = 'Ruština';

$strSQL = 'SQL';
$strSQLExportType = 'Typ vytvorených dotazov';
$strSQLOptions = 'SQL nastavenia';
$strSQLParserBugMessage = 'Je možné, že ste našli chybu v SQL syntaktickom analyzátore. Preskúmajte podrobne SQL dotaz, predovšetkým správnosť umiestnenia úvodzoviek. Ďalšia možnosť je, že nahrávate súbor s binárnymi dátami nezapísanými v úvodzovkách. Môžete tiež vyskúšať použiť príkazový riadok MySQL na odstránenie problému. Pokial stále máte problémy alebo syntaktický analyzátor SQL stále hlási chybu v dotaze, ktorý v príkazovom riadku funguje, prosím pokúste sa zredukovať dotaz na čo najmenší, v ktorom sa problém ešte vyskytuje a ohláste chybu na stránke phpMyAdmina spolu so sekciou VÝPIS uvedenú nižšie:';
$strSQLParserUserError = 'Vyskytla sa chyba v SQL dotaze. Nižšie uvedený MySQL výstup (ak je nejaký) Vám môže pomôcť odstrániť problém';
$strSQLQuery = 'SQL dotaz';
$strSQLResult = 'výsledok SQL';
$strSQPBugInvalidIdentifer = 'Neplatný identifikátor';
$strSQPBugUnclosedQuote = 'Neuzatvorené úvodzovky';
$strSQPBugUnknownPunctuation = 'Neznámy interpunkčný reťazec';
$strSave = 'Uložiť';
$strSaveOnServer = 'Uložiť na server do adresára %s';
$strScaleFactorSmall = 'Mierka je príliš mala na roztiahnutie schémy na stránku';
$strSearch = 'Hľadať';
$strSearchFormTitle = 'Hľadať v databáze';
$strSearchInTables = 'V tabuľke(ách):';
$strSearchNeedle = 'Slovo(á) alebo hodnotu(y), ktoré chcete vyhľadať (nahradzujúci znak: "%"):';
$strSearchOption1 = 'najmenej jedno zo slov';
$strSearchOption2 = 'všetky slová';
$strSearchOption3 = 'presný výraz';
$strSearchOption4 = 'ako regulárny výraz';
$strSearchResultsFor = 'Prehľadať výsledky na "<i>%s</i>" %s:';
$strSearchType = 'Nájdi:';
$strSecretRequired = 'Nastavte prosím kľúč pre šifrovanie cookies v konfiguračnom súbore (blowfish_secret).';
$strSelectADb = 'Prosím vyberte si databázu';
$strSelectAll = 'Označiť všetko';
$strSelectFields = 'Zvoliť pole (najmenej jedno):';
$strSelectNumRows = 'v dotaze';
$strSelectTables = 'Vybrať Tabuľky';
$strSend = 'Pošli';
$strSent = 'Odoslané';
$strServer = 'Server';
$strServerChoice = 'Voľba serveru';
$strServerNotResponding = 'Server neodpovedá';
$strServerStatus = 'Stav serveru';
$strServerStatusUptime = 'Tento server beží %s. Bol spustený %s.';
$strServerTabProcesslist = 'Procesy';
$strServerTabVariables = 'Premenné';
$strServerTrafficNotes = '<b>Server traffic</b>: These tables show the network traffic statistics of this MySQL server since its startup.';
$strServerVars = 'Premenné a nastavenia serveru';
$strServerVersion = 'Verzia serveru';
$strSessionValue = 'Hodnota sedenia';
$strSetEnumVal = 'Ak je pole typu "enum" alebo "set", prosím zadávajte hodnoty v tvare: \'a\',\'b\',\'c\'...<br>Ak dokonca potrebujete zadať spätné lomítko ("\") alebo apostrof ("\'") pri týchto hodnotách, zadajte ich napríklad takto \'\\\\xyz\' alebo \'a\\\'b\'.';
$strShow = 'Ukázať';
$strShowAll = 'Zobraziť všetko';
$strShowColor = 'Zobraziť farbu';
$strShowDatadictAs = 'Formát dátového slovníka';
$strShowFullQueries = 'Zobraziť kompletné dotazy';
$strShowGrid = 'Zobraziť mriežku';
$strShowPHPInfo = 'Zobraziť informácie o PHP';
$strShowTableDimension = 'Zobraziť rozmery tabuliek';
$strShowTables = 'Zobraziť tabuľky';
$strShowThisQuery = ' Zobraziť tento dotaz znovu ';
$strShowingRecords = 'Ukázať záznamy ';
$strSimplifiedChinese = 'Zjednodušená Čínština';
$strSingly = '(po jednom)';
$strSize = 'Veľkosť';
$strSort = 'Triediť';
$strSortByKey = 'Zoradiť podľa kľúča';
$strSpaceUsage = 'Zabrané miesto';
$strSpanish = 'Španielsky';
$strSplitWordsWithSpace = 'Slová sú rozdelené medzerou (" ").';
$strStatCheckTime = 'Posledná kontrola';
$strStatCreateTime = 'Vytvorenie';
$strStatUpdateTime = 'Posledná zmena';
$strStatement = 'Údaj';
$strStatus = 'Stav';
$strStrucCSV = 'CSV dáta';
$strStrucData = 'Štruktúru a dáta';
$strStrucDrop = 'Pridaj \'vymaž tabuľku\'';
$strStrucExcelCSV = 'CSV pre Ms Excel dáta';
$strStrucNativeExcel = 'Natívne dáta MS Excel';
$strStrucOnly = 'Iba štruktúru';
$strStructPropose = 'Navrhnúť štruktúru tabuľky';
$strStructure = 'Štruktúra';
$strSubmit = 'Odošli';
$strSuccess = 'SQL dotaz bol úspešne vykonaný';
$strSum = 'Celkom';
$strSwedish = 'Švédsky';
$strSwitchToTable = 'Prepnúť na skopírovanú tabuľku';

$strTable = 'Tabuľka';
$strTableComments = 'Komentár k tabuľke';
$strTableEmpty = 'Tabuľka je prázdna!';
$strTableHasBeenDropped = 'Tabuľka %s bola odstránená';
$strTableHasBeenEmptied = 'Tabuľka %s bola vyprázdená';
$strTableHasBeenFlushed = 'Tabuľka %s bola vyprázdnená';
$strTableMaintenance = 'Údržba tabuľky';
$strTableOfContents = 'Obsah';
$strTableOptions = 'Parametre tabuľky';
$strTableStructure = 'Štruktúra tabuľky pre tabuľku';
$strTableType = 'Typ tabuľky';
$strTables = '%s tabuľka(y)';
$strTakeIt = 'zvoliť';
$strTblPrivileges = 'Oprávnenia pre jednotlivé tabuľky';
$strTextAreaLength = ' Toto možno nepôjde upraviť,<br> kvôli svojej dĺžke ';
$strThai = 'Thajčina';
$strTheContent = 'Obsah Vášho súboru bol vložený.';
$strTheContents = 'Obsah súboru prepíše obsah vybranej tabuľky v riadkoch s identickým primárnym alebo unikátnym kľúčom.';
$strTheTerminator = 'Ukončenie polí.';
$strTheme = 'Vzhľad';
$strThisHost = 'Tento počítač';
$strThisNotDirectory = 'Nebol zadaný adresár';
$strThreadSuccessfullyKilled = 'Vlákno %s bol úspešne zabité.';
$strTime = 'Čas';
$strToggleScratchboard = 'zobraziť grafický návrh';
$strTotal = 'celkovo';
$strTotalUC = 'Celkom';
$strTraditionalChinese = 'Tradičná Čínština';
$strTraffic = 'Prevádzka';
$strTransformation_application_octetstream__download = 'Zobrazí odkaz na stiahnutie dát. Prvý parameter je meno súboru, druhý je meno stĺpca v tabuľke obsahujúci meno súboru. Ak zadáte druhý parameter, prvý musí byť prázdny.';
$strTransformation_image_jpeg__inline = 'Zobrazí náhľad obrázku s odkazom na obrázok; parametre šírka a výška v bodoch (pomer strán obrázku zostane zachovaný)';
$strTransformation_image_jpeg__link = 'Zobrazí odkaz na obrázok (napr. stiahnutie poľa blob).';
$strTransformation_image_png__inline = 'Zobrazí image/jpeg: inline';
$strTransformation_text_plain__dateformat = 'Zobrazí dátum alebo čas (TIME, TIMESTAMP alebo DATETIME) podľa miestneho nastavenia. Prvý parameter je posun (v hodinách), ktorá bude pridaný k zadanému času (predvolený je 0). Druhý parameter je formátovací reťazec pre php funkciu strftime().';
$strTransformation_text_plain__external = 'PLATÍ IBA PRE LINUX: Spustí externú aplikáciu, na jej štandardný vstup pošle pole a zobrazí výstup programu. Predvolený program je Tidy, ktorý pekne sformátuje HTML. Z bezpečnostných dôvodov musíte ručne upraviť obsah súboru libraries/transformations/text_plain__external.inc.php a pridať do neho povolené aplikácie. Prvý parameter je číslo aplikácie, ktorú chcete použiť a druhý parametre sú parametre tejto aplikácie. Ak je tretí parameter nastavený na 1, výstup bude skonvertovaný funkciou htmlspecialchars() (predvolený je 1). Štvrtý parameter v prípade, že je nastavený na 1 pridá k výstupnému textu parameter NOWRAP, čím zabezpečí zachovanie formátovania (predvolený je 1)';
$strTransformation_text_plain__formatted = 'Zachová pôvodné formátovanie poľa tak ako je uložené v databáze.';
$strTransformation_text_plain__imagelink = 'Zobrazí obrázok a odkaz z poľa obsahujúceho odkaz na obrázok. Prvý parameter je prefix URL (napr. "http://domena.sk/"), druhý a tretí parameter určujú šírku a výšku obrázku.';
$strTransformation_text_plain__link = 'Zobrazí odkaz z poľa obsahujúceho odkaz. Prvý parameter je prefix URL (napr. "http://domena.sk/"), druhý parameter je text odkazu.';
$strTransformation_text_plain__substr = 'Zobrazí iba časť reťazca. Prvý parameter je posun od začiatku (predvolený je 0) a druhý určuje dĺžku textu, ktorá sa ma zobraziť, ak nie je zadaný bude zobrazený zvyšok textu. Tretí parameter určuje znaky, ktoré budú pridané na koniec skráteného textu (predvolené je ...).';
$strTransformation_text_plain__unformatted = 'Zobrazí HTML kód pomocou HMTL entít. Prípadný HTML kód sa zobrazí v pôvodnom stave.';
$strTruncateQueries = 'Zobraziť skrátene dotazy';
$strTurkish = 'Turecky';
$strType = 'Typ';

$strUkrainian = 'Ukrajinsky';
$strUncheckAll = 'Odznačiť všetko';
$strUnicode = 'Unicode';
$strUnique = 'Unikátny';
$strUnknown = 'neznámy';
$strUnselectAll = 'Odznačiť všetko';
$strUpdComTab = 'Prosím prečítajte si dokumentáciu ako aktualizovať tabuľku s informáciami o stĺpcoch (Column_comments Table)';
$strUpdatePrivMessage = 'Boli aktualizované oprávnenia pre %s.';
$strUpdateProfileMessage = 'Profil bol aktualizovaný.';
$strUpdateQuery = 'Aktualizovať dotaz';
$strUpgrade = 'Mali by ste aktualizovať %s na verziu %s alebo vyššiu.';
$strUsage = 'Využitie';
$strUseBackquotes = ' Použiť opačný apostrof pri názvoch tabuliek a polí ';
$strUseHostTable = 'Použiť tabuľku s hostiteľmi';
$strUseTables = 'Použiť tabuľky';
$strUseTextField = 'Požiť textové pole';
$strUseThisValue = 'Použiť túto hodnotu';
$strUser = 'Používateľ';
$strUserAlreadyExists = 'Používateľ %s už existuje!';
$strUserEmpty = 'Meno používateľa je prázdne!';
$strUserName = 'Meno používateľa';
$strUserNotFound = 'Zvolený používateľ nebol nájdený v tabuľke práv.';
$strUserOverview = 'Prehľad užívatelov';
$strUsersDeleted = 'Vybraní užívatelia bol úspešne odstránený.';
$strUsersHavingAccessToDb = 'Používatelia majúci prístup k &quot;%s&quot;';

$strValidateSQL = 'Potvrdiť platnosť SQL';
$strValidatorError = 'SQL validator nemohol byť inicializovaný. Prosím skontrolujte, či sú nainštalované všetky potrebné rozšírenia php, tak ako sú popísané v %sdocumentation%s.';
$strValue = 'Hodnota';
$strVar = 'Premenná';
$strViewDump = 'Zobraziť dump (schému) tabuľky';
$strViewDumpDB = 'Zobraziť dump (schému) databázy';
$strViewDumpDatabases = 'Export databáz';

$strWebServerUploadDirectory = 'upload adresár web serveru';
$strWebServerUploadDirectoryError = 'Adresár určený pre upload súborov sa nedá otvoriť';
$strWelcome = 'Vitajte v %s';
$strWestEuropean = 'Západná Európa';
$strWildcard = 'nahradzujúci znak';
$strWindowNotFound = 'Cieľové okno prehliadača nemohlo byť aktualizované. Možno ste zatvorili rodičovské okno, alebo prehliadač blokuje operácie medzi oknami z dôvodu bezpečnostných nastavení';
$strWithChecked = 'Výber:';
$strWritingCommentNotPossible = 'Komentár sa nedá zapísať';
$strWritingRelationNotPossible = 'Vzťah sa nedá zapísať';
$strWrongUser = 'Zlé používateľské meno alebo heslo. Prístup zamietnutý.';

$strXML = 'XML';

$strYes = 'Áno';

$strZeroRemovesTheLimit = 'Poznámka: Nastavenie týchto parametrov na 0 (nulu) odstráni obmedzenia.';
$strZip = '"zo zipované"';

$strHexForBinary = 'Use hexadecimal for binary fields';  //to translate
$strIcelandic = 'Icelandic';  //to translate
$strLatvian = 'Latvian';  //to translate
$strPolish = 'Polish';  //to translate
$strRomanian = 'Romanian';  //to translate
$strSlovenian = 'Slovenian';  //to translate
$strTraditionalSpanish = 'Traditional Spanish';  //to translate
$strSlovak = 'Slovak';  //to translate
$strMySQLConnectionCollation = 'MySQL connection collation';  //to translate

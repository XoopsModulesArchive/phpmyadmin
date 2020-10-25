<?php

/* $Id: slovak-iso-8859-2.inc.php,v 2.38 2004/07/17 22:58:30 rabus Exp $ */

/* By: lubos klokner <erkac@vault-tec.sk> */

$charset = 'iso-8859-2';
$text_dir = 'ltr';
$left_font_family = '"verdana ce", "arial ce", verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'tahoma, "verdana ce", "arial ce", helvetica, arial, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = ['Bajtov', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];

$day_of_week = ['Ne', 'Po', 'Út', 'St', '©t', 'Pi', 'So'];
$month = ['Jan', 'Feb', 'Mar', 'Apr', 'Máj', 'Jún', 'Júl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d.%B, %Y - %H:%M';
$timespanfmt = '%s dní, %s hodín, %s minút a %s sekúnd';

$strAPrimaryKey = 'Bol pridaný primárny kµúè pre %s';
$strAbortedClients = 'Preru¹ené';
$strAbsolutePathToDocSqlDir = 'Prosím zadajte absolútnu cestu k adresáru docSQL na serveri.';
$strAccessDenied = 'Prístup zamietnutý';
$strAccessDeniedExplanation = 'phpMyAdmin sa pokúsil pripoji» k MySQL serveru ale ten spojenie odmietol. Skontrolujte prosím meno serveru, pou¾ívateµské meno a heslo v súbore config.inc.php a s tým, ktoré ste dostali o administrátora MySQL servera.';
$strAction = 'Akcia';
$strAddAutoIncrement = 'Prida» hodnotu AUTO_INCREMENT';
$strAddConstraints = 'Prida» obmedzenia';
$strAddDeleteColumn = 'Prida»/Odobra» polia ståpcov';
$strAddDeleteRow = 'Prida»/Odobra» kritéria riadku';
$strAddDropDatabase = 'Prida» DROP DATABASE';
$strAddHeaderComment = 'Prida» vlastný komentár do hlavièky (\\n oddeµuje riadky)';
$strAddIfNotExists = 'Prida» IF NOT EXISTS';
$strAddIntoComments = 'Prida» do komentárov';
$strAddNewField = 'Prida» nové pole';
$strAddPrivilegesOnDb = 'Prida» oprávnenia pre nasledujúcu databázu';
$strAddPrivilegesOnTbl = 'Prida» oprávnenia pre nasledujúcu tabuµku';
$strAddSearchConditions = 'Prida» vyhµadávacie parametre (obsah dotazu po "where" príkaze):';
$strAddToIndex = 'Prida» do indexu &nbsp;%s&nbsp;ståpec';
$strAddUser = 'Prida» nového pou¾ívateµa';
$strAddUserMessage = 'Pou¾ívateµ bol pridaný.';
$strAddedColumnComment = 'Pridaný komentár k ståpcu';
$strAddedColumnRelation = 'Pridaný vz»ah pre ståpec';
$strAdministration = 'Administrácia';
$strAffectedRows = ' Ovplyvnené riadky: ';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Spä»';
$strAfterInsertNewInsert = 'Vlo¾i» nový záznam';
$strAfterInsertSame = 'Spä» na túto stránku';
$strAll = 'V¹etko';
$strAllTableSameWidth = 'zobrazi» v¹etky tabuµky s rovnakou ¹írkou?';
$strAlterOrderBy = 'Zmeni» poradie tabuµky podµa';
$strAnIndex = 'Bol pridaný index pre %s';
$strAnalyzeTable = 'Analyzova» tabuµku';
$strAnd = 'a';
$strAny = 'Akýkoµvek';
$strAnyHost = 'Akýkoµvek hostiteµ';
$strAnyUser = 'Akýkoµvek pou¾ívateµ';
$strArabic = 'Arab¹tina';
$strArmenian = 'Armén¹tina';
$strAscending = 'Vzostupne';
$strAtBeginningOfTable = 'Na zaèiatku tabuµky';
$strAtEndOfTable = 'Na konci tabuµky';
$strAttr = 'Atribúty';
$strAutodetect = 'Automaticky zisti»';
$strAutomaticLayout = 'Automatické rozvrhnutie';

$strBack = 'Spä»';
$strBaltic = 'Baltické';
$strBeginCut = 'ZAÈIATOK VÝSEKU';
$strBeginRaw = 'ZAÈIATOK TOKU';
$strBinary = 'Binárny';
$strBinaryDoNotEdit = 'Binárny - neupravujte ';
$strBookmarkAllUsers = 'Dovoli» pou¾íva» túto polo¾ku v¹etkým pou¾ívateµom';
$strBookmarkDeleted = 'Záznam z obµúbených bol zmazaný.';
$strBookmarkLabel = 'Názov';
$strBookmarkOptions = 'Vlastnosti obµúbených';
$strBookmarkQuery = 'Obµúbený SQL dotaz';
$strBookmarkThis = 'Prida» tento SQL dotaz do obµúbených';
$strBookmarkView = 'Iba prezrie»';
$strBrowse = 'Prechádza»';
$strBrowseForeignValues = 'Prejs» hodnoty cudzích kµúèov';
$strBulgarian = 'Bulharsky';
$strBzError = 'nepodarilo sa skomprimova» výstup z dôvodu chybného roz¹írenia pre kompresiu Bz2 v tejto verzii php. Doporuèuje sa nastavi» <code>$cfg[\'BZipDump\']</code> v konfigurácii phpMyAdmin na <code>FALSE</code>. Ak si ¾eláte pou¾íva» kompresiu Bz2 mali by ste nain¹talova» nov¹iu verziu php. Viac informácií získate z popisu chyby: %s.';
$strBzip = '"bzipped"';

$strCSVOptions = 'CSV nastavenia';
$strCalendar = 'Kalendár';
$strCannotLogin = 'Nedá sa prihlási» k MySQL serveru';
$strCantLoad = 'nedá sa nahra» roz¹írenie %s,<br>prosím skontrolujte konfiguráciu PHP';
$strCantLoadRecodeIconv = 'Nie je mo¾né nahra» roz¹írenie iconv alebo recode potrebné pre prevod znakových sad. Upravte nastavenie php tak aby umo¾òovalo pou¾i» tieto roz¹írenia alebo vypnite túto vlastnos» v konfigurácii phpMyAdmina.';
$strCantRenameIdxToPrimary = 'Nie je mo¾né premenova» index na PRIMARY!';
$strCantUseRecodeIconv = 'Nie je mo¾né pou¾i» funkcie iconv,libiconv a recode_string aj napriek tomu, ¾e roz¹írenia sú nahrané. Skontrolujte prosím nastavenie PHP.';
$strCardinality = 'Mohutnos»';
$strCarriage = 'Návrat vozíku (Carriage return): \\r';
$strCaseInsensitive = 'nerozli¹ova» veµké a malé písmená';
$strCaseSensitive = 'rozli¹ova» veµké a malé písmená';
$strCentralEuropean = 'Stredná Európa';
$strChange = 'Zmeni»';
$strChangeCopyMode = 'Vytvori» pou¾ívateµa s rovnakými právami a...';
$strChangeCopyModeCopy = '... zachova» pôvodného pou¾ívateµa.';
$strChangeCopyModeDeleteAndReload = ' ... zmaza» pôvodného pou¾ívateµa z tabuliek pou¾ívateµov a potom znovunaèíta» oprávnenia.';
$strChangeCopyModeJustDelete = ' ... zmaza» pôvodného pou¾ívateµa z tabuliek pou¾ívateµov.';
$strChangeCopyModeRevoke = ' ... odobra» v¹etky oprávnenia pôvodnému pou¾ívateµovi a následne ho zmaza».';
$strChangeCopyUser = 'Zmeni» informácie o pou¾ívateµovi / Kopírova» pou¾ívateµa';
$strChangeDisplay = 'Zvolte, ktoré pole zobrazi»';
$strChangePassword = 'Zmeni» heslo';
$strCharset = 'Znaková sada';
$strCharsetOfFile = 'Znaková sada súboru:';
$strCharsets = 'Znakové sady';
$strCharsetsAndCollations = 'Znakové sady a porovnávanie';
$strCheckAll = 'Oznaèi» v¹etko';
$strCheckOverhead = 'Zvoli» neoptimálne';
$strCheckPrivs = 'Skontrolova» oprávnenia';
$strCheckPrivsLong = 'Skontrolova» oprávnenia pre databázu &quot;%s&quot;.';
$strCheckTable = 'Skontrolova» tabuµku';
$strChoosePage = 'Prosím zvolte si Stránku, ktorú chcete upravi»';
$strColComFeat = 'Zobrazova» komentáre ståpcov';
$strCollation = 'Porovnávanie';
$strColumnNames = 'Názvy ståpcov';
$strColumnPrivileges = 'Oprávnenia pre jednotlivé ståpce';
$strCommand = 'Príkaz';
$strComments = 'Komentáre';
$strCommentsForTable = 'KOMENTÁRE PRE TABU¥KU';
$strCompleteInserts = 'Úplné vlo¾enie';
$strCompression = 'Kompresia';
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br>This might happen if php finds a parse error in it or php cannot find the file.<br>Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br>If you recieve a blank page, everything is fine.';
$strConfigureTableCoord = 'Prosím skonfigurujte koordináty pre tabuµku %s';
$strConnectionError = 'Nepodarilo sa pripoji»: chybné nastavenia.';
$strConnections = 'Spojenia';
$strConstraintsForDumped = 'Obmedzenie pre exportované tabuµky';
$strConstraintsForTable = 'Obmedzenie pre tabuµku';
$strCookiesRequired = 'Cookies musia by» povolené, pokiaµ chcete pokraèova».';
$strCopyTable = 'Skopírova» tabuµku do (databáza<b>.</b>tabuµka):';
$strCopyTableOK = 'Tabuµka %s bola skorírovaná do %s.';
$strCopyTableSameNames = 'Nedá sa skopírova» tabuµka sama do seba!';
$strCouldNotKill = 'Neporadilo za zabi» vlákno %s. Jeho beh bol pravdepodobne u¾ ukonèený.';
$strCreate = 'Vytvori»';
$strCreateIndex = 'Vytvori» index na&nbsp;%s&nbsp;ståpcoch';
$strCreateIndexTopic = 'Vytvori» nový index';
$strCreateNewDatabase = 'Vytvori» novú databázu';
$strCreateNewTable = 'Vytvori» novú tabuµku v databáze %s';
$strCreatePage = 'Vytvori» novú Stránku';
$strCreatePdfFeat = 'Vytváranie PDF';
$strCreationDates = 'Dátum vytvorenia, poslednej zmeny a kontroly';
$strCriteria = 'Kritéria';
$strCroatian = 'Chorvátsky';
$strCyrillic = 'Cyrilika';
$strCzech = 'Èesky';
$strCzechSlovak = 'Èe¹tina/Slovenèina';

$strDBComment = 'Komentár k databáze: ';
$strDBGContext = 'Kontext';
$strDBGContextID = 'Kontext ID';
$strDBGHits = 'Zásahov';
$strDBGLine = 'Riadok';
$strDBGMaxTimeMs = 'Max. èas, ms';
$strDBGMinTimeMs = 'Min èas, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Èas/Zásah, ms';
$strDBGTotalTimeMs = 'Celkový èas, ms';
$strDBRename = 'Premenova» databázu na';
$strDanish = 'Dánsky';
$strData = 'Dáta';
$strDataDict = 'Dátový slovník';
$strDataOnly = 'Iba dáta';
$strDatabase = 'Databáza';
$strDatabaseEmpty = 'Meno databázy je prázdne!';
$strDatabaseExportOptions = 'Nastavenia exportu databáz';
$strDatabaseHasBeenDropped = 'Databáza %s bola zmazaná.';
$strDatabaseNoTable = 'Táto databáza neobsahuje ¾iadne tabuµky!';
$strDatabases = 'databáz(y)';
$strDatabasesDropped = 'Úspe¹ne zru¹ených databáz: %s.';
$strDatabasesStats = '©tatistiky databázy';
$strDatabasesStatsDisable = 'Skry» ¹tatistiky';
$strDatabasesStatsEnable = 'Zobrazi» ¹tatistiky';
$strDatabasesStatsHeavyTraffic = 'Poznámka: Aktivovanie ¹tatistík databázy mô¾e spôsobi» znaèné zvý¹enie sie»ovej prevádzky medzi databázou a web serverom.';
$strDbPrivileges = 'Oprávnenia pre jednotlivé databázy';
$strDbSpecific = 'závislé na databáze';
$strDefault = 'Predvolené';
$strDefaultValueHelp = 'Pre predvolené hodnoty, prosím zadajte iba jednu hodnotu bez úvodzoviek alebo uvádzacích znakov, napr.: a';
$strDefragment = 'Defragmentova» tabuµku';
$strDelOld = 'Aktuálna stránka sa odkazuje na tabuµky, ktoré u¾ neexistujú, ¾eláte si odstráni» tieto odkazy?';
$strDelayedInserts = 'Pou¾i» oneskorené vlo¾enia';
$strDelete = 'Zmaza»';
$strDeleteAndFlush = 'Odstráni» pou¾ívateµov a znovunaèíta» práva.';
$strDeleteAndFlushDescr = 'Toto je najèistej¹ie rie¹enie, ale znovunaèítanie práv mô¾e chvíµu trva».';
$strDeleted = 'Riadok bol zmazaný';
$strDeletedRows = 'Zmazané riadky:';
$strDeleting = 'Odstraòuje sa %s';
$strDescending = 'Zostupne';
$strDescription = 'Popis';
$strDictionary = 'slovník';
$strDisableForeignChecks = 'Vypnú» kontrolu cudzích kµúèov';
$strDisabled = 'Vypnuté';
$strDisplayFeat = 'Zobrazi» vlastnosti';
$strDisplayOrder = 'Zobrazi» zoradené:';
$strDisplayPDF = 'Zobrazi» schému PDF';
$strDoAQuery = 'Vykona» "dotaz podµa príkladu" (nahradzujúci znak: "%")';
$strDoYouReally = 'Skutoène chcete vykona» príkaz ';
$strDocu = 'Dokumentácia';
$strDrop = 'Odstráni»';
$strDropDatabaseStrongWarning = 'Chystáte sa ZRU©I« celú databázu!';
$strDropSelectedDatabases = 'Zru¹i» vybrané databázy';
$strDropUsersDb = 'Odstráni» databázy s rovnakým menom ako majú pou¾ívatelia.';
$strDumpSaved = 'Dump (schéma) bol ulo¾ený do súboru %s.';
$strDumpXRows = 'Zobrazi» %s riadkov od riadku %s.';
$strDumpingData = 'S»ahujem dáta pre tabuµku';
$strDynamic = 'dynamický';

$strEdit = 'Upravi»';
$strEditPDFPages = 'Upravi» PDF Stránky';
$strEditPrivileges = 'Upravi» oprávnenia';
$strEffective = 'Efektívny';
$strEmpty = 'Vyprázdni»';
$strEmptyResultSet = 'MySQL vrátil prázdny výsledok (tj. nulový poèet riadkov).';
$strEnabled = 'Zapnuté';
$strEncloseInTransaction = 'Uzatvori» príkazy v transakcii';
$strEnd = 'Koniec';
$strEndCut = 'KONIEC VÝSEKU';
$strEndRaw = 'KONIEC TOKU';
$strEnglish = 'Anglicky';
$strEnglishPrivileges = ' Poznámka: názvy MySQL oprávnení sú uvádzané v angliètine. ';
$strError = 'Chyba';
$strEstonian = 'Estónsky';
$strExcelEdition = 'Verzia Excelu';
$strExcelOptions = 'Nastavenie exportu do Excelu';
$strExecuteBookmarked = 'Spusti» obµúbený dotaz';
$strExplain = 'Vysvetli» SQL';
$strExport = 'Exportova»';
$strExtendedInserts = 'Roz¹írené vkladanie';
$strExtra = 'Extra';

$strFailedAttempts = 'Nepodarených pokusov';
$strField = 'Pole';
$strFieldHasBeenDropped = 'Pole %s bolo odstránené';
$strFields = 'Polia';
$strFieldsEmpty = ' Poèet polí je prázdny! ';
$strFieldsEnclosedBy = 'Polia uzatvorené';
$strFieldsEscapedBy = 'Polia uvedené pomocou';
$strFieldsTerminatedBy = 'Polia ukonèené';
$strFileAlreadyExists = 'Súbor %s u¾ existuje na servery, zmente názov súboru alebo zvolte prepísanie súboru.';
$strFileCouldNotBeRead = 'Súbor sa nedá preèíta»';
$strFileNameTemplate = 'Vzor pre názov súboru';
$strFileNameTemplateHelp = 'Pou¾ite __DB__ ako názov databázy, __TABLE__ ako názov tabuµky a akékoµvek parametre pre %sfunkciu strftime%s pre vlo¾enie dát. Prípona súboru bude pridaná automaticky podµa typu. Akýkoµvek iný text zostane zachovaný.';
$strFileNameTemplateRemember = 'zapamäta» si vzor';
$strFixed = 'pevný';
$strFlushPrivilegesNote = 'Poznámka: phpMyAdmin získava práva pou¾ívateµov priamo z tabuliek MySQL. Obsah týchto tabuliek sa mô¾e lí¹i» od práv, ktoré pou¾íva server, ak boli tieto tabuµky ruène upravené. V tomto prípade sa odporúèa vykona» %sznovunaèítanie práv%s predtým ako budete pokraèova».';
$strFlushTable = 'Vyprázdni» tabuµku ("FLUSH")';
$strFormEmpty = 'Chýbajúca polo¾ka vo formulári !';
$strFormat = 'Formát';
$strFullText = 'Plné texty';
$strFunction = 'Funkcia';

$strGenBy = 'Vygenerované';
$strGenTime = 'Vygenerované:';
$strGeneralRelationFeat = 'Mo¾nosti v¹eobecných vz»ahov';
$strGeorgian = 'Gruzínèina';
$strGerman = 'Nemecky';
$strGlobal = 'globálny';
$strGlobalPrivileges = 'Globálne práva';
$strGlobalValue = 'Globálna hodnota';
$strGo = 'Vykonaj';
$strGrantOption = 'Prideli»';
$strGreek = 'Gréètina';
$strGzip = '"gzip-ované"';

$strHasBeenAltered = 'bola zmenená.';
$strHasBeenCreated = 'bola vytvorená.';
$strHaveToShow = 'Zvolte prosím aspoò jeden ståpec, ktorý chcete zobrazi»';
$strHebrew = 'Hebrejsky';
$strHome = 'Domov';
$strHomepageOfficial = 'Oficiálne stránky phpMyAdmin-a';
$strHost = 'Hostiteµ';
$strHostEmpty = 'Názov hostiteµa je prázdny!';
$strHungarian = 'Maïarsky';

$strId = 'ID';
$strIdxFulltext = 'Celý text';
$strIfYouWish = 'Ak si ¾eláte nahra» iba urèité ståpce tabuµky, ¹pecifikujte ich ako zoznam polí oddelený èiarkou.';
$strIgnore = 'Ignorova»';
$strIgnoreInserts = 'Pou¾i» IGNORE';
$strIgnoringFile = 'Ignorujem súbor %s';
$strImportDocSQL = 'Importova» súbory docSQL';
$strImportFiles = 'Importova» súbory';
$strImportFinished = 'Importovanie ukonèené';
$strInUse = 'práve sa pou¾íva';
$strIndex = 'Index';
$strIndexHasBeenDropped = 'Index pre %s bol odstránený';
$strIndexName = 'Meno indexu&nbsp;:';
$strIndexType = 'Typ indexu&nbsp;:';
$strIndexes = 'Indexy';
$strInnodbStat = 'Stav InnoDB';
$strInsecureMySQL = 'Konfiguraèný súbor obsahuje nastavenia (root bez hesla), ktoré zodpovedajú predvolenému privilegovanému MySQL úètu. Ak MySQL server be¾í s týmto nastavením, nie je zabezpeèený proti napadnutiu, táto bezpeènostná chyba by mala by» urýchlene odstránená.';
$strInsert = 'Vlo¾i»';
$strInsertAsNewRow = 'Vlo¾i» ako nový riadok';
$strInsertNewRow = 'Vlo¾i» nový riadok';
$strInsertTextfiles = 'Vlo¾i» textové súbory do tabuµky';
$strInsertedRowId = 'Id vlo¾eného riadku:';
$strInsertedRows = 'Vlo¾ené riadky:';
$strInstructions = 'In¹trukcie';
$strInternalNotNecessary = '* Vnútorný vz»ah nie je nutný ak u¾ vz»ah existuje v InnoDB.';
$strInternalRelations = 'Interné vz»ahy';

$strJapanese = 'Japonèina';
$strJumpToDB = 'Na databázu &quot;%s&quot;.';
$strJustDelete = 'Iba odstráni» pou¾ívateµlov z tabuliek práv.';
$strJustDeleteDescr = '&quot;Odstránení&quot; pou¾ívatelia budú ma» k serveru ako predtým a¾ do znovunaèítania práv.';

$strKeepPass = 'Nezmeni» heslo';
$strKeyname = 'Kµúèový názov';
$strKill = 'Zabi»';
$strKorean = 'Kórejèina';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'Nastavenia LaTeX';
$strLandscape = 'Na ¹írku';
$strLatexCaption = 'Nadpis tabuµky';
$strLatexContent = 'Obsah tabuµky __TABLE__';
$strLatexContinued = '(pokraèovanie)';
$strLatexContinuedCaption = 'Nadpis pokraèovania tabuµky';
$strLatexIncludeCaption = 'Zahrnú» nadpis tabuµky';
$strLatexLabel = 'Návestie';
$strLatexStructure = '©truktúra tabuµky __TABLE__';
$strLengthSet = 'Då¾ka/Nastavi»*';
$strLimitNumRows = 'záznamov na stránku';
$strLineFeed = 'Ukonèenie riadku (Linefeed): \\n';
$strLinesTerminatedBy = 'Riadky ukonèené';
$strLinkNotFound = 'Linka nebola nájdená';
$strLinksTo = 'Linkova» na';
$strLithuanian = 'Litovsky';
$strLoadExplanation = 'Automaticky sú nastavené najlep¹ie hodnoty, ak toto nastavenie nebude fungova», mô¾ete skúsi» druhú mo¾nos».';
$strLoadMethod = 'Parametre pre príkaz LOAD';
$strLocalhost = 'Lokálny';
$strLocationTextfile = 'Lokácia textového súboru';
$strLogPassword = 'Heslo:';
$strLogServer = 'Server';
$strLogUsername = 'Pou¾ívateµ:';
$strLogin = 'Login';
$strLoginInformation = 'Prihlásenie';
$strLogout = 'Odhlási» sa';

$strMIMETypesForTable = 'MIME TYPY PRE TABU¥KU';
$strMIME_MIMEtype = 'MIME typ';
$strMIME_available_mime = 'Dostupné MIME typy';
$strMIME_available_transform = 'Dostupné transformácie';
$strMIME_description = 'Popis';
$strMIME_nodescription = 'Nie je dostupný ¾iadny popis pre túto transformáciu.<br>Kontaktujte autora, ktorý %s vytára.';
$strMIME_transformation = 'Transformácia pri prehliadaní';
$strMIME_transformation_note = 'Pre zoznam dostupných parametrov a ich MIME typov kliknite na %spopisy transformácií';
$strMIME_transformation_options = 'Parametre transformácie';
$strMIME_transformation_options_note = 'Prosím zadajte hodnoty pre parametre transformácie v nasledujúcom tvare: \'a\',\'b\',\'c\'...<br>Ak potrebujete pou¾i» spätné lomítko ("\") alebo jednoduché úvodzovky ("\'") medzi týmito hodnotami, vlo¾te pred nich spätné lomítko (napr. \'\\\\xyz\' alebo \'a\\\'b\').';
$strMIME_without = 'MIME typy zobrazené kurzívou nemajú vlastnú transformaènú funkciu';
$strMaximumSize = 'Maximálna veµkos»: %s%s';
$strModifications = 'Zmeny boli ulo¾ené';
$strModify = 'Zmeni»';
$strModifyIndexTopic = 'Modifikova» index';
$strMoreStatusVars = 'Ïal¹ie informácie o stave';
$strMoveTable = 'Presunú» tabuµku do (databáza<b>.</b>tabuµka):';
$strMoveTableOK = 'Tabuµka %s bola presunutá do %s.';
$strMoveTableSameNames = 'Nedá sa presunú» tabuµka sama do seba!';
$strMultilingual = 'mnohojazyèný';
$strMustSelectFile = 'Zvolte prosím súbor, ktorý si ¾eláte vlo¾i».';
$strMySQLCharset = 'Znaková sada v MySQL';
$strMySQLReloaded = 'MySQL znovu-naèítaná.';
$strMySQLSaid = 'MySQL hlási: ';
$strMySQLServerProcess = 'MySQL %pma_s1% be¾í na %pma_s2% ako %pma_s3%';
$strMySQLShowProcess = 'Zobrazi» procesy';
$strMySQLShowStatus = 'Zobrazi» MySQL informácie o behu';
$strMySQLShowVars = 'Zobrazi» MySQL systémové premenné';

$strName = 'Názov';
$strNeedPrimaryKey = 'Pre túto tabuµku by ste mali definova» primárny kµúè.';
$strNext = 'Ïal¹í';
$strNo = 'Nie';
$strNoDatabases = '®iadne databázy';
$strNoDatabasesSelected = 'Neboli vybrané ¾iadne databázy.';
$strNoDescription = 'bez Popisu';
$strNoDropDatabases = 'Mo¾nos» "DROP DATABASE" vypnutá.';
$strNoExplain = 'Preskoèi» vysvetlenie SQL';
$strNoFrames = 'phpMyAdmin funguje lep¹ie s prehliadaèmi podporujúcimi <b>rámy</b>.';
$strNoIndex = 'Nebol definovaný ¾iadny index!';
$strNoIndexPartsDefined = 'Èasti indexu neboli definované!';
$strNoModification = '®iadna zmena';
$strNoOptions = 'Tento formát nemá ¾iadne nastavenia';
$strNoPassword = '®iadne heslo';
$strNoPermission = 'Web server nemá oprávenia na ulo¾enie do súboru %s.';
$strNoPhp = 'bez PHP kódu';
$strNoPrivileges = '®iadne oprávnenia';
$strNoQuery = '®iadny SQL dotaz!';
$strNoRights = 'Nemáte dostatoèné práva na vykonanie tejto akcie!';
$strNoRowsSelected = 'Nebol vybraný ¾iadny riadok';
$strNoSpace = 'Nedostatok miesta pre ulo¾enie súboru %s.';
$strNoTablesFound = 'Neboli nájdené ¾iadne tabuµky v tejto datábaze.';
$strNoUsersFound = 'Nebol nájdený ¾iadny pou¾ívateµ.';
$strNoValidateSQL = 'Preskoèi» potvrdenie platnosti SQL';
$strNone = '®iadny';
$strNotNumber = 'Toto nie je èíslo!';
$strNotOK = 'chyba';
$strNotSet = 'Tabuµka <b>%s</b> nebola nájdená alebo nie je nastavená v %s';
$strNotValidNumber = ' nie je platné èíslo riadku!';
$strNull = 'Nulový';
$strNumSearchResultsInTable = '%s výskyt(ov)v tabuµke <i>%s</i>';
$strNumSearchResultsTotal = '<b>Celkovo:</b> <i>%s</i> výskyt(ov)';
$strNumTables = 'Tabuµky';

$strOK = 'OK';
$strOftenQuotation = 'Èasto uvodzujúce znaky. Voliteµne znamená, ¾e iba polia typu char a varchar sú uzatvorené do "uzatváracích" znakov.';
$strOperations = 'Operácie';
$strOperator = 'Operátor';
$strOptimizeTable = 'Optimalizova» tabuµku';
$strOptionalControls = 'Voliteµné. Urèuje ako zapisova» alebo èíta» ¹peciálne znaky.';
$strOptionally = 'Voliteµne';
$strOr = 'alebo';
$strOverhead = 'Naviac';
$strOverwriteExisting = 'Prepísa» existujúci súbor(y)';

$strPHP40203 = 'Pou¾ívate PHP 4.2.3, ktoré ma vá¾nu chybu pri práci s viac bajtovými znakmi (mbstring). V PHP je táto chyba zdokumentovaná pod èíslom 19404. Nedoporuèuje sa pou¾íva» túto verziu PHP s phpMyAdminom.';
$strPHPVersion = 'Verzia PHP';
$strPageNumber = 'Èíslo stránky:';
$strPaperSize = 'Veµkos» stránky';
$strPartialText = 'Èiastoèné texty';
$strPassword = 'Heslo';
$strPasswordChanged = 'Heslo pre %s bolo úspe¹ne zmenené.';
$strPasswordEmpty = 'Heslo je prázdne!';
$strPasswordNotSame = 'Heslá sa nezhodujú!';
$strPdfDbSchema = 'Schéma databázy "%s"  - Strana %s';
$strPdfInvalidTblName = 'Tabuµka "%s" neexistuje!';
$strPdfNoTables = '®iadne tabuµky';
$strPerHour = 'za hodinu';
$strPerMinute = 'za minútu';
$strPerSecond = 'za sekundu';
$strPhoneBook = 'adresár';
$strPhp = 'Vytvori» PHP kód';
$strPmaDocumentation = 'phpMyAdmin Dokumentácia';
$strPmaUriError = 'Direktíva <tt>$cfg[\'PmaAbsoluteUri\']</tt> v konfiguraènom súbore MUSÍ by» nastavená!';
$strPortrait = 'Na vý¹ku';
$strPos1 = 'Zaèiatok';
$strPrevious = 'Predchádzajúci';
$strPrimary = 'Primárny';
$strPrimaryKeyHasBeenDropped = 'Primárny kµúè bol zru¹ený';
$strPrimaryKeyName = 'Názov primárneho kµúèa musí by»... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>musí</b> by» <b>iba</b> meno primárneho kµúèa!)';
$strPrint = 'Vytlaèi»';
$strPrintView = 'Náhµad k tlaèi';
$strPrintViewFull = 'Náhµad tlaèe (s kompletnými textami)';
$strPrivDescAllPrivileges = 'V¹etky oprávnenia okrem GRANT.';
$strPrivDescAlter = 'Povolí meni» ¹truktúru existujúcich tabuliek.';
$strPrivDescCreateDb = 'Povolí vytváranie nových databáz a tabuliek.';
$strPrivDescCreateTbl = 'Povolí vytváranie nových tabuliek.';
$strPrivDescCreateTmpTable = 'Povolí vytváranie doèasných tabuliek.';
$strPrivDescDelete = 'Povolí mazanie dát.';
$strPrivDescDropDb = 'Povolí odstraòovanie databáz a tabuliek.';
$strPrivDescDropTbl = 'Povolí odstraòovanie tabuliek.';
$strPrivDescExecute = 'Povolí spú¹»anie ulo¾ených procedúr. Nefunguje v tejto verzii MySQL.';
$strPrivDescFile = 'Povolí importovanie a exportovanie dát zo/do súborov na serveri.';
$strPrivDescGrant = 'Povolí pridávanie u¾ivatelov a práv bez znovunaèítania tabuliek práv.';
$strPrivDescIndex = 'Povolí vytváranie a mazanie indexov.';
$strPrivDescInsert = 'Povolí vkladanie a nahradzovanie dát.';
$strPrivDescLockTables = 'Povolí zmaknutie tabuliek pre aktuálne vlákno.';
$strPrivDescMaxConnections = 'Obmedzí poèet nových spojení, ktoré mô¾e pou¾ívateµ vytvori» za hodinu.';
$strPrivDescMaxQuestions = 'Obmedzí poèet dotazov, ktoré mô¾e pou¾ívateµ odosla» za hodinu.';
$strPrivDescMaxUpdates = 'Obmedzí poèet príkazov meniacich tabuµku alebo databázu, ktorá mô¾e pou¾ívateµ odosla» za hodinu.';
$strPrivDescProcess3 = 'Povolí zabíjanie procesov iným pou¾ívateµlom.';
$strPrivDescProcess4 = 'Povolí prezeranie kompletných dotazov v zozname procesov.';
$strPrivDescReferences = 'Nefunguje v tejto verzii MySQL.';
$strPrivDescReload = 'Povolí znovunaèítanie nastavení a vyprázdòovanie vyrovnávacích pamätí serveru.';
$strPrivDescReplClient = 'Povolí pou¾ívateµovi zisti» kde je hlavný / pomocný server.';
$strPrivDescReplSlave = 'Potrebné pre replikáciu pomocných serverov.';
$strPrivDescSelect = 'Povolí èítanie dát.';
$strPrivDescShowDb = 'Povolí prístup ku kompletnému zoznamu databáz.';
$strPrivDescShutdown = 'Povolí vypnutie serveru.';
$strPrivDescSuper = 'Povolí spojenie aj v prípade, ¾e bol dosiahnutý maximálny poèet spojení. Potrebné pre väè¹inu operácií pri správe serveru ako nastavovanie globálny premenných alebo zabíjanie procesov iných pou¾ívateµov.';
$strPrivDescUpdate = 'Povolí menenie dát.';
$strPrivDescUsage = '®iadne práva.';
$strPrivileges = 'Oprávnenia';
$strPrivilegesReloaded = 'Práva boli úspe¹ne znovunaèítané.';
$strProcesslist = 'Zoznam procesov';
$strProperties = 'Vlastnosti';
$strPutColNames = 'Prida» názvy polí na prvý riadok';

$strQBE = 'Dotaz podµa príkladu';
$strQBEDel = 'Zmaza»';
$strQBEIns = 'Vlo¾i»';
$strQueryFrame = 'SQL okno';
$strQueryOnDb = ' SQL dotaz v databáze <b>%s</b>:';
$strQuerySQLHistory = 'SQL história';
$strQueryStatistics = '<b>Query statistics</b>: Since its startup, %s queries have been sent to the server.';
$strQueryTime = 'Dotaz zabral %01.4f sek.';
$strQueryType = 'Typ dotazu';
$strQueryWindowLock = 'Neprepisova» tento dotaz z hlavného okna';

$strReType = 'Potvrdi»';
$strReceived = 'Prijaté';
$strRecords = 'Záznamov';
$strReferentialIntegrity = 'Skontrolova» referenènú integritu:';
$strRefresh = 'Obnovi»';
$strRelationNotWorking = 'Prídavné vlastnosti pre prácu s prepojenými tabuµkami boli deaktivované. Ak chcete zisti» preèo, kliknite %ssem%s.';
$strRelationView = 'Zobrazi» spojitosti';
$strRelationalSchema = 'Relaèná schéma';
$strRelations = 'Prepojenia';
$strRelationsForTable = 'VZ«AHY PRE TABU¥KU';
$strReloadFailed = 'Znovu-naèítanie MySQL bolo neúspe¹né.';
$strReloadMySQL = 'Znovu-naèíta» MySQL';
$strReloadingThePrivileges = 'Znovunaèítanie práv';
$strRemoveSelectedUsers = 'Odstráni» vybraných pou¾ívateµov';
$strRenameDatabaseOK = 'Databáza %s bola premenovaná na %s';
$strRenameTable = 'Premenova» tabuµku na';
$strRenameTableOK = 'Tabuµka %s bola premenovaná na %s';
$strRepairTable = 'Opravi» tabuµku';
$strReplace = 'Nahradi»';
$strReplaceNULLBy = 'Nahradi» NULL hodnoty';
$strReplaceTable = 'Nahradi» dáta v tabuµke súborom';
$strReset = 'Pôvodné (Reset)';
$strResourceLimits = 'Obmedzenie zdrojov';
$strRevoke = 'Zru¹i»';
$strRevokeAndDelete = 'Odobranie v¹etkých aktívnych práv pou¾ívateµom a ich následné odstránenie.';
$strRevokeAndDeleteDescr = 'U¾ívatelia budú ma» stále právo USAGE (pou¾ívanie) a¾ do znovunaèítania práv.';
$strRevokeMessage = 'Boli zru¹ené oprávnenia pre %s';
$strRowLength = 'Då¾ka riadku';
$strRowSize = ' Veµkos» riadku ';
$strRows = 'Riadkov';
$strRowsFrom = 'riadky zaèínajú od';
$strRowsModeFlippedHorizontal = 'vodorovnom (otoèené hlavièky)';
$strRowsModeHorizontal = 'horizontálnom';
$strRowsModeOptions = 'v(o) %s móde a opakova» hlavièky po ka¾dých %s bunkách';
$strRowsModeVertical = 'vertikálnom';
$strRowsStatistic = '©tatistika riadku';
$strRunQuery = 'Odo¹li dotaz';
$strRunSQLQuery = 'Spusti» SQL dotaz/dotazy na databázu %s';
$strRunning = 'be¾í na %s';
$strRussian = 'Ru¹tina';

$strSQL = 'SQL';
$strSQLExportType = 'Typ vytvorených dotazov';
$strSQLOptions = 'SQL nastavenia';
$strSQLParserBugMessage = 'Je mo¾né, ¾e ste na¹li chybu v SQL syntaktickom analyzátore. Preskúmajte podrobne SQL dotaz, predov¹etkým správnos» umiestnenia úvodzoviek. Ïal¹ia mo¾nos» je, ¾e nahrávate súbor s binárnymi dátami nezapísanými v úvodzovkách. Mô¾ete tie¾ vyskú¹a» pou¾i» príkazový riadok MySQL na odstránenie problému. Pokial stále máte problémy alebo syntaktický analyzátor SQL stále hlási chybu v dotaze, ktorý v príkazovom riadku funguje, prosím pokúste sa zredukova» dotaz na èo najmen¹í, v ktorom sa problém e¹te vyskytuje a ohláste chybu na stránke phpMyAdmina spolu so sekciou VÝPIS uvedenú ni¾¹ie:';
$strSQLParserUserError = 'Vyskytla sa chyba v SQL dotaze. Ni¾¹ie uvedený MySQL výstup (ak je nejaký) Vám mô¾e pomôc» odstráni» problém';
$strSQLQuery = 'SQL dotaz';
$strSQLResult = 'výsledok SQL';
$strSQPBugInvalidIdentifer = 'Neplatný identifikátor';
$strSQPBugUnclosedQuote = 'Neuzatvorené úvodzovky';
$strSQPBugUnknownPunctuation = 'Neznámy interpunkèný re»azec';
$strSave = 'Ulo¾i»';
$strSaveOnServer = 'Ulo¾i» na server do adresára %s';
$strScaleFactorSmall = 'Mierka je príli¹ mala na roztiahnutie schémy na stránku';
$strSearch = 'Hµada»';
$strSearchFormTitle = 'Hµada» v databáze';
$strSearchInTables = 'V tabuµke(ách):';
$strSearchNeedle = 'Slovo(á) alebo hodnotu(y), ktoré chcete vyhµada» (nahradzujúci znak: "%"):';
$strSearchOption1 = 'najmenej jedno zo slov';
$strSearchOption2 = 'v¹etky slová';
$strSearchOption3 = 'presný výraz';
$strSearchOption4 = 'ako regulárny výraz';
$strSearchResultsFor = 'Prehµada» výsledky na "<i>%s</i>" %s:';
$strSearchType = 'Nájdi:';
$strSecretRequired = 'Nastavte prosím kµúè pre ¹ifrovanie cookies v konfiguraènom súbore (blowfish_secret).';
$strSelectADb = 'Prosím vyberte si databázu';
$strSelectAll = 'Oznaèi» v¹etko';
$strSelectFields = 'Zvoli» pole (najmenej jedno):';
$strSelectNumRows = 'v dotaze';
$strSelectTables = 'Vybra» Tabuµky';
$strSend = 'Po¹li';
$strSent = 'Odoslané';
$strServer = 'Server';
$strServerChoice = 'Voµba serveru';
$strServerNotResponding = 'Server neodpovedá';
$strServerStatus = 'Stav serveru';
$strServerStatusUptime = 'Tento server be¾í %s. Bol spustený %s.';
$strServerTabProcesslist = 'Procesy';
$strServerTabVariables = 'Premenné';
$strServerTrafficNotes = '<b>Server traffic</b>: These tables show the network traffic statistics of this MySQL server since its startup.';
$strServerVars = 'Premenné a nastavenia serveru';
$strServerVersion = 'Verzia serveru';
$strSessionValue = 'Hodnota sedenia';
$strSetEnumVal = 'Ak je pole typu "enum" alebo "set", prosím zadávajte hodnoty v tvare: \'a\',\'b\',\'c\'...<br>Ak dokonca potrebujete zada» spätné lomítko ("\") alebo apostrof ("\'") pri týchto hodnotách, zadajte ich napríklad takto \'\\\\xyz\' alebo \'a\\\'b\'.';
$strShow = 'Ukáza»';
$strShowAll = 'Zobrazi» v¹etko';
$strShowColor = 'Zobrazi» farbu';
$strShowDatadictAs = 'Formát dátového slovníka';
$strShowFullQueries = 'Zobrazi» kompletné dotazy';
$strShowGrid = 'Zobrazi» mrie¾ku';
$strShowPHPInfo = 'Zobrazi» informácie o PHP';
$strShowTableDimension = 'Zobrazi» rozmery tabuliek';
$strShowTables = 'Zobrazi» tabuµky';
$strShowThisQuery = ' Zobrazi» tento dotaz znovu ';
$strShowingRecords = 'Ukáza» záznamy ';
$strSimplifiedChinese = 'Zjednodu¹ená Èín¹tina';
$strSingly = '(po jednom)';
$strSize = 'Veµkos»';
$strSort = 'Triedi»';
$strSortByKey = 'Zoradi» podµa kµúèa';
$strSpaceUsage = 'Zabrané miesto';
$strSpanish = '©panielsky';
$strSplitWordsWithSpace = 'Slová sú rozdelené medzerou (" ").';
$strStatCheckTime = 'Posledná kontrola';
$strStatCreateTime = 'Vytvorenie';
$strStatUpdateTime = 'Posledná zmena';
$strStatement = 'Údaj';
$strStatus = 'Stav';
$strStrucCSV = 'CSV dáta';
$strStrucData = '©truktúru a dáta';
$strStrucDrop = 'Pridaj \'vyma¾ tabuµku\'';
$strStrucExcelCSV = 'CSV pre Ms Excel dáta';
$strStrucNativeExcel = 'Natívne dáta MS Excel';
$strStrucOnly = 'Iba ¹truktúru';
$strStructPropose = 'Navrhnú» ¹truktúru tabuµky';
$strStructure = '©truktúra';
$strSubmit = 'Odo¹li';
$strSuccess = 'SQL dotaz bol úspe¹ne vykonaný';
$strSum = 'Celkom';
$strSwedish = '©védsky';
$strSwitchToTable = 'Prepnú» na skopírovanú tabuµku';

$strTable = 'Tabuµka';
$strTableComments = 'Komentár k tabuµke';
$strTableEmpty = 'Tabuµka je prázdna!';
$strTableHasBeenDropped = 'Tabuµka %s bola odstránená';
$strTableHasBeenEmptied = 'Tabuµka %s bola vyprázdená';
$strTableHasBeenFlushed = 'Tabuµka %s bola vyprázdnená';
$strTableMaintenance = 'Údr¾ba tabuµky';
$strTableOfContents = 'Obsah';
$strTableOptions = 'Parametre tabuµky';
$strTableStructure = '©truktúra tabuµky pre tabuµku';
$strTableType = 'Typ tabuµky';
$strTables = '%s tabuµka(y)';
$strTakeIt = 'zvoli»';
$strTblPrivileges = 'Oprávnenia pre jednotlivé tabuµky';
$strTextAreaLength = ' Toto mo¾no nepôjde upravi»,<br> kvôli svojej då¾ke ';
$strThai = 'Thajèina';
$strTheContent = 'Obsah Vá¹ho súboru bol vlo¾ený.';
$strTheContents = 'Obsah súboru prepí¹e obsah vybranej tabuµky v riadkoch s identickým primárnym alebo unikátnym kµúèom.';
$strTheTerminator = 'Ukonèenie polí.';
$strTheme = 'Vzhµad';
$strThisHost = 'Tento poèítaè';
$strThisNotDirectory = 'Nebol zadaný adresár';
$strThreadSuccessfullyKilled = 'Vlákno %s bol úspe¹ne zabité.';
$strTime = 'Èas';
$strToggleScratchboard = 'zobrazi» grafický návrh';
$strTotal = 'celkovo';
$strTotalUC = 'Celkom';
$strTraditionalChinese = 'Tradièná Èín¹tina';
$strTraffic = 'Prevádzka';
$strTransformation_application_octetstream__download = 'Zobrazí odkaz na stiahnutie dát. Prvý parameter je meno súboru, druhý je meno ståpca v tabuµke obsahujúci meno súboru. Ak zadáte druhý parameter, prvý musí by» prázdny.';
$strTransformation_image_jpeg__inline = 'Zobrazí náhµad obrázku s odkazom na obrázok; parametre ¹írka a vý¹ka v bodoch (pomer strán obrázku zostane zachovaný)';
$strTransformation_image_jpeg__link = 'Zobrazí odkaz na obrázok (napr. stiahnutie poµa blob).';
$strTransformation_image_png__inline = 'Zobrazí image/jpeg: inline';
$strTransformation_text_plain__dateformat = 'Zobrazí dátum alebo èas (TIME, TIMESTAMP alebo DATETIME) podµa miestneho nastavenia. Prvý parameter je posun (v hodinách), ktorá bude pridaný k zadanému èasu (predvolený je 0). Druhý parameter je formátovací re»azec pre php funkciu strftime().';
$strTransformation_text_plain__external = 'PLATÍ IBA PRE LINUX: Spustí externú aplikáciu, na jej ¹tandardný vstup po¹le pole a zobrazí výstup programu. Predvolený program je Tidy, ktorý pekne sformátuje HTML. Z bezpeènostných dôvodov musíte ruène upravi» obsah súboru libraries/transformations/text_plain__external.inc.php a prida» do neho povolené aplikácie. Prvý parameter je èíslo aplikácie, ktorú chcete pou¾i» a druhý parametre sú parametre tejto aplikácie. Ak je tretí parameter nastavený na 1, výstup bude skonvertovaný funkciou htmlspecialchars() (predvolený je 1). ©tvrtý parameter v prípade, ¾e je nastavený na 1 pridá k výstupnému textu parameter NOWRAP, èím zabezpeèí zachovanie formátovania (predvolený je 1)';
$strTransformation_text_plain__formatted = 'Zachová pôvodné formátovanie poµa tak ako je ulo¾ené v databáze.';
$strTransformation_text_plain__imagelink = 'Zobrazí obrázok a odkaz z poµa obsahujúceho odkaz na obrázok. Prvý parameter je prefix URL (napr. "http://domena.sk/"), druhý a tretí parameter urèujú ¹írku a vý¹ku obrázku.';
$strTransformation_text_plain__link = 'Zobrazí odkaz z poµa obsahujúceho odkaz. Prvý parameter je prefix URL (napr. "http://domena.sk/"), druhý parameter je text odkazu.';
$strTransformation_text_plain__substr = 'Zobrazí iba èas» re»azca. Prvý parameter je posun od zaèiatku (predvolený je 0) a druhý urèuje då¾ku textu, ktorá sa ma zobrazi», ak nie je zadaný bude zobrazený zvy¹ok textu. Tretí parameter urèuje znaky, ktoré budú pridané na koniec skráteného textu (predvolené je ...).';
$strTransformation_text_plain__unformatted = 'Zobrazí HTML kód pomocou HMTL entít. Prípadný HTML kód sa zobrazí v pôvodnom stave.';
$strTruncateQueries = 'Zobrazi» skrátene dotazy';
$strTurkish = 'Turecky';
$strType = 'Typ';

$strUkrainian = 'Ukrajinsky';
$strUncheckAll = 'Odznaèi» v¹etko';
$strUnicode = 'Unicode';
$strUnique = 'Unikátny';
$strUnknown = 'neznámy';
$strUnselectAll = 'Odznaèi» v¹etko';
$strUpdComTab = 'Prosím preèítajte si dokumentáciu ako aktualizova» tabuµku s informáciami o ståpcoch (Column_comments Table)';
$strUpdatePrivMessage = 'Boli aktualizované oprávnenia pre %s.';
$strUpdateProfileMessage = 'Profil bol aktualizovaný.';
$strUpdateQuery = 'Aktualizova» dotaz';
$strUpgrade = 'Mali by ste aktualizova» %s na verziu %s alebo vy¹¹iu.';
$strUsage = 'Vyu¾itie';
$strUseBackquotes = ' Pou¾i» opaèný apostrof pri názvoch tabuliek a polí ';
$strUseHostTable = 'Pou¾i» tabuµku s hostiteµmi';
$strUseTables = 'Pou¾i» tabuµky';
$strUseTextField = 'Po¾i» textové pole';
$strUseThisValue = 'Pou¾i» túto hodnotu';
$strUser = 'Pou¾ívateµ';
$strUserAlreadyExists = 'Pou¾ívateµ %s u¾ existuje!';
$strUserEmpty = 'Meno pou¾ívateµa je prázdne!';
$strUserName = 'Meno pou¾ívateµa';
$strUserNotFound = 'Zvolený pou¾ívateµ nebol nájdený v tabuµke práv.';
$strUserOverview = 'Prehµad u¾ívatelov';
$strUsersDeleted = 'Vybraní u¾ívatelia bol úspe¹ne odstránený.';
$strUsersHavingAccessToDb = 'Pou¾ívatelia majúci prístup k &quot;%s&quot;';

$strValidateSQL = 'Potvrdi» platnos» SQL';
$strValidatorError = 'SQL validator nemohol by» inicializovaný. Prosím skontrolujte, èi sú nain¹talované v¹etky potrebné roz¹írenia php, tak ako sú popísané v %sdocumentation%s.';
$strValue = 'Hodnota';
$strVar = 'Premenná';
$strViewDump = 'Zobrazi» dump (schému) tabuµky';
$strViewDumpDB = 'Zobrazi» dump (schému) databázy';
$strViewDumpDatabases = 'Export databáz';

$strWebServerUploadDirectory = 'upload adresár web serveru';
$strWebServerUploadDirectoryError = 'Adresár urèený pre upload súborov sa nedá otvori»';
$strWelcome = 'Vitajte v %s';
$strWestEuropean = 'Západná Európa';
$strWildcard = 'nahradzujúci znak';
$strWindowNotFound = 'Cieµové okno prehliadaèa nemohlo by» aktualizované. Mo¾no ste zatvorili rodièovské okno, alebo prehliadaè blokuje operácie medzi oknami z dôvodu bezpeènostných nastavení';
$strWithChecked = 'Výber:';
$strWritingCommentNotPossible = 'Komentár sa nedá zapísa»';
$strWritingRelationNotPossible = 'Vz»ah sa nedá zapísa»';
$strWrongUser = 'Zlé pou¾ívateµské meno alebo heslo. Prístup zamietnutý.';

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

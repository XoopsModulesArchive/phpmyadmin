<?php

/* $Id: slovenian-windows-1250.inc.php,v 2.35 2004/07/17 22:58:30 rabus Exp $ */

/* By: urska.colner, agenda d.o.o. <urska.colner@agenda.si>, uros kositer, agenda d.o.o. <urosh@agenda.si> */

$charset = 'windows-1250';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];

$day_of_week = ['Ned', 'Pon', 'Tor', 'Sre', 'Èet', 'Pet', 'Sob'];
$month = ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'];
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y ob %I:%M %p';
$timespanfmt = '%s dni, %s ur, %s minut in %s sekund';

$strAPrimaryKey = 'Na %s je dodan primarni kljuè';
$strAbortedClients = 'Prekinjeno';
$strAbsolutePathToDocSqlDir = 'Vnesite absolutno pot do docSQL mape na strežniku';
$strAccessDenied = 'Dostop zavrnjen';
$strAccessDeniedExplanation = 'phpMyAdmin se je poskušal povezati na MySQL strežnik, ki je zavrnil povezavo. Preverite, ali gostitelj, uporabniško ime in geslo v datoteki config.inc.php ustrezajo podatkom administratorja MySQL strežnika.';
$strAction = 'Akcija';
$strAddAutoIncrement = 'Dodaj AUTO_INCREMENT vrednost';
$strAddConstraints = 'Dodaj omejitve';
$strAddDeleteColumn = 'Dodaj/Odstrani stolpec \'Polje\'';
$strAddDeleteRow = 'Dodaj/Odstrani vrstico \'Kriterij\'';
$strAddDropDatabase = 'Dodaj DROP DATABASE';
$strAddHeaderComment = 'Dodaj prilagojen komentar v glavo (\\n prelomi vrstice)';
$strAddIfNotExists = 'Dodaj ÈE NE OBSTAJA';
$strAddIntoComments = 'Dodaj med komentarje';
$strAddNewField = 'Dodaj novo polje';
$strAddPrivilegesOnDb = 'Dodaj privilegije na naslednji podatkovni bazi';
$strAddPrivilegesOnTbl = 'Dodaj privilegije na naslednji tabeli';
$strAddSearchConditions = 'Dodaj iskalne pogoje (telo "where" stavka):';
$strAddToIndex = 'Dodaj indeksu &nbsp;%s&nbsp;stolpec(ce)';
$strAddUser = 'Dodaj novega uporabnika';
$strAddUserMessage = 'Dodali ste novega uporabnika.';
$strAddedColumnComment = 'Dodan komentar za stolpec';
$strAddedColumnRelation = 'Dodana relacija za stolpec';
$strAdministration = 'Administracija';
$strAffectedRows = 'Spremenjene vrstice:';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Nazaj na prejšnjo stran';
$strAfterInsertNewInsert = 'Vstavi še eno novo vrstico';
$strAfterInsertSame = 'Pojdi nazaj na stran';
$strAll = 'Vse/Vsi';
$strAllTableSameWidth = 'prikažem vse tabele enake širine?';
$strAlterOrderBy = 'Spremeni vrstni red prikaza tabele za';
$strAnIndex = 'Na %s je dodan indeks';
$strAnalyzeTable = 'Analiziraj tabelo';
$strAnd = 'In';
$strAny = 'Katerikoli';
$strAnyHost = 'Katerikoli gostitelj';
$strAnyUser = 'Katerikoli uporabnik';
$strArabic = 'Arabsko';
$strArmenian = 'Armensko';
$strAscending = 'Narašèajoèe';
$strAtBeginningOfTable = 'Na zaèetku tabele';
$strAtEndOfTable = 'Na koncu tabele';
$strAttr = 'Atributi';
$strAutodetect = 'Samodejno zaznaj';
$strAutomaticLayout = 'Samodejna postavitev';

$strBack = 'Nazaj';
$strBaltic = 'Baltsko';
$strBeginCut = 'ZAÈETEK IZREZA';
$strBeginRaw = 'BEGIN RAW';
$strBinary = 'Binarno';
$strBinaryDoNotEdit = 'Binarno - ne urejaj';
$strBookmarkAllUsers = 'Dovoli dostop do zaznamka vsem uporabnikom';
$strBookmarkDeleted = 'Zaznamek je odstranjen.';
$strBookmarkLabel = 'Nalepka';
$strBookmarkOptions = 'Možnosti zaznamka';
$strBookmarkQuery = 'Oznaèena SQL-poizvedba';
$strBookmarkThis = 'Oznaèi to SQL-poizvedbo';
$strBookmarkView = 'Samo pogled';
$strBrowse = 'Prebrskaj';
$strBrowseForeignValues = 'Prebrskaj tuje vrednosti';
$strBulgarian = 'Bolgarsko';
$strBzError = 'phpMyAdmin ni uspel stisniti odloženih podatkov zaradi neuporabne konènice Bz2 v tej razlièici php. Zelo dobro bi bilo, da v konfiguracijski datoteki za phpMyAdmin spremenite ukaz <code>$cfg[\'BZipDump\']</code> v <code>FALSE</code>. Èe želite izvajati stiskanje s pomoèjo Bz2, boste morali posodobiti php v novejšo razlièico. Za podrobnosti si oglejte php poroèilo o napaki %s.';
$strBzip = '"bzipano"';

$strCSVOptions = 'CSV možnosti';
$strCalendar = 'Koledar';
$strCannotLogin = 'Ne morem se prijaviti v MySQL strežnik';
$strCantLoad = 'ne morem naložiti podaljška %s,<br>prosim preverite PHP konfiguracijo';
$strCantLoadRecodeIconv = 'Ni mogoèe naložiti iconv ali recode ekstenzij, ki so potrebne za pretvorbe kodnih tabel, konfigurirajte php tako, da bo omogoèal uporabo teh ekstenzij ali onemogoèite pretvarjanje kodnih tabel v phpMyAdmin.';
$strCantRenameIdxToPrimary = 'Indeksa ni mogoèe preimenovati v PRIMARY!';
$strCantUseRecodeIconv = 'Ni mogoèe uporabljati iconv, libiconv ali recode_string funkcij, èeprav so ekstenzije normalno naložene. Preverite konfiguracijo php.';
$strCardinality = 'Kardinalnost';
$strCarriage = 'Znak za pomik na zaèetek vrste (Carriage return): \\r';
$strCaseInsensitive = 'ne razlikuj velikih in malih èrk';
$strCaseSensitive = 'razlikuj velike in male èrke';
$strCentralEuropean = 'Centralno evropsko';
$strChange = 'Spremeni';
$strChangeCopyMode = 'Ustvari novega uporabnika z enakimi pravicami in ...';
$strChangeCopyModeCopy = '... obdrži starega.';
$strChangeCopyModeDeleteAndReload = ' ... izbriši starega uporabnika s seznama uporabnikov ter ponovno naloži njegove pravice.';
$strChangeCopyModeJustDelete = ' ... izbriši starega s seznama uporabnikov.';
$strChangeCopyModeRevoke = ' ... preklièi vse aktivne pravice starega uporabnika ter jih izbriši.';
$strChangeCopyUser = 'Spremeni prijavne informacije / Kopiraj uporabnika';
$strChangeDisplay = 'Izberite polje za prikaz';
$strChangePassword = 'Spremeni geslo';
$strCharset = 'Nabor znakov';
$strCharsetOfFile = 'Nabor znakov datoteke:';
$strCharsets = 'Nabori znakov';
$strCharsetsAndCollations = 'Nabori znakov in pravila za razvršèanje znakov';
$strCheckAll = 'Oznaèi vse';
$strCheckOverhead = 'Preveri prekoraèene';
$strCheckPrivs = 'Preveri privilegije';
$strCheckPrivsLong = 'Preveri privilegije za podatkovno bazo &quot;%s&quot;.';
$strCheckTable = 'Preveri tabelo';
$strChoosePage = 'Izberite stran za urejanje';
$strColComFeat = 'Prikazovanje komentarjev stolpcev';
$strCollation = 'Pravilo za razvršèanje znakov';
$strColumnNames = 'Imena stolpcev';
$strColumnPrivileges = 'Privilegiji tipièni za stolpec';
$strCommand = 'Ukaz';
$strComments = 'Komentarji';
$strCommentsForTable = 'KOMENTARJI ZA TABELO';
$strCompleteInserts = 'Popolne \'insert\' poizvedbe';
$strCompression = 'Stiskanje';
$strConfigFileError = 'phpMyAdmin ni mogel prebrati konfiguracijske datoteke!<br>To se lahko zgodi, èe php pri prevajanju konfiguracijske datoteke najde napako ali pa ne najde datoteke.<br>Prosimo, odprite konfiguracijsko datoteko s povezavo, ki je navedena spodaj in preberite dobljeno sporoèilo o napaki. V veèini primerov gre za manjkajoèi narekovaj ali podpièje.<br>Èe dobite prazno stran, je vse v redu.';
$strConfigureTableCoord = 'Prosimo, konfigurirajte koordinate za tabelo %s';
$strConnectionError = 'Povezava ni mogoèa: neveljavne nastavitve.';
$strConnections = 'Povezave';
$strConstraintsForDumped = 'Omejitve tabel za povzetek stanja';
$strConstraintsForTable = 'Omejitve za tabelo';
$strCookiesRequired = 'Èe želite še dalje uporabljati program, morate omogoèiti piškotke.';
$strCopyTable = 'Kopiraj tabelo v (podatkovna_baza<b>.</b>tabela):';
$strCopyTableOK = 'Tabela %s je skopirana v %s.';
$strCopyTableSameNames = 'Tabele ni mogoèe kopirati same vase!';
$strCouldNotKill = 'phpMyAdmin ni uspel prekiniti teme %s. Verjetno je že prekinjena.';
$strCreate = 'Ustvari';
$strCreateIndex = 'Ustvari indeks na&nbsp;%s&nbsp;stolpcih';
$strCreateIndexTopic = 'Ustvari nov indeks';
$strCreateNewDatabase = 'Ustvari novo podatkovno bazo';
$strCreateNewTable = 'Ustvari novo tabelo v podatkovni bazi %s';
$strCreatePage = 'Ustvari novo stran';
$strCreatePdfFeat = 'Ustvarjanje PDF datotek';
$strCreationDates = 'Datumi za ustvarjeno/posodobljeno/preverjeno';
$strCriteria = 'Kriteriji';
$strCroatian = 'Hrvaško';
$strCyrillic = 'Cirilica';
$strCzech = 'Èeško';
$strCzechSlovak = 'Èeškoslovaško';

$strDBComment = 'Komentar zbirke podatkov: ';
$strDBGContext = 'Kontekst';
$strDBGContextID = 'Kontekst ID';
$strDBGHits = 'Zadetki';
$strDBGLine = 'Vrstica';
$strDBGMaxTimeMs = 'Najveèji èas, ms';
$strDBGMinTimeMs = 'Najmanjši èas, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Èas/Zadetek, ms';
$strDBGTotalTimeMs = 'Skupni èas, ms';
$strDBRename = 'Preimenuj podatkovno bazo v';
$strDanish = 'Dansko';
$strData = 'Podatki';
$strDataDict = 'Podatkovni slovar';
$strDataOnly = 'Samo podatki';
$strDatabase = 'Podatkovna baza';
$strDatabaseEmpty = 'Ime podatkovne baze je prazno!';
$strDatabaseExportOptions = 'Možnosti za izvoz baze podatkov';
$strDatabaseHasBeenDropped = 'Podatkovna baza %s je zavržena.';
$strDatabaseNoTable = 'Ta baza podatkov ne vsebuje tabele!!';
$strDatabases = 'podatkovne baze';
$strDatabasesDropped = '%s podatkovne baze so uspešno zavržene.';
$strDatabasesStats = 'Statistika podatkovnih baz';
$strDatabasesStatsDisable = 'Onemogoèi statistiko';
$strDatabasesStatsEnable = 'Omogoèi statistiko';
$strDatabasesStatsHeavyTraffic = 'Obvestilo: Omogoèitev statistike podatkovne baze lahko povzroèi moèno poveèan promet med spletnim in podatkovnim strežnikom.';
$strDbPrivileges = 'Privilegiji tipièni za podatkovno bazo';
$strDbSpecific = 'glede na zbirko podatkov';
$strDefault = 'Privzeto';
$strDefaultValueHelp = 'Za privzete vrednosti vnesite samo vrednosti, brez poševnice nazaj ali narekovaja, npr.: a';
$strDelOld = 'Trenutna stran vsebuje sklice na tabele, ki ne obstajajo veè. Ali želite izbrisati te sklice?';
$strDelayedInserts = 'Uporabi zakasnjeno vstavljanje';
$strDelete = 'Izbriši';
$strDeleteAndFlush = 'Izbriši uporabnike in potem osveži privilegije.';
$strDeleteAndFlushDescr = 'To je najboljši naèin, vendar lahko osveževanje privilegijev traja nekaj èasa.';
$strDeleted = 'Vrstica je izbrisana';
$strDeletedRows = 'Izbrisane vrstice:';
$strDeleting = 'Brišem %s';
$strDescending = 'Padajoèe';
$strDescription = 'Opis';
$strDictionary = 'slovar';
$strDisabled = 'Onemogoèeno';
$strDisplayFeat = 'Prikaži lastnosti';
$strDisplayOrder = 'Vrstni red prikaza:';
$strDisplayPDF = 'Prikaži PDF shemo';
$strDoAQuery = 'Izvedi "query by example" (nadomestni znak: "%")';
$strDoYouReally = 'Ali res želite ';
$strDocu = 'Dokumentacija';
$strDrop = 'Zavrži';
$strDropDatabaseStrongWarning = 'S tem dejanjem boste UNIÈILI celotno bazo podatkov!';
$strDropSelectedDatabases = 'Zavrži izbrane podatkovne baze';
$strDropUsersDb = 'Izbriši podatkovne baze, ki imajo enako ime kot uporabniki.';
$strDumpSaved = 'Dump je shranjen v datoteko %s.';
$strDumpXRows = 'Odloži %s vrstic, zaèni z zapisom # %s.';
$strDumpingData = 'Odloži podatke za tabelo';
$strDynamic = 'dinamièno';

$strEdit = 'Uredi';
$strEditPDFPages = 'Uredi PDF strani';
$strEditPrivileges = 'Uredi privilegije';
$strEffective = 'Uèinkovito';
$strEmpty = 'Izprazni';
$strEmptyResultSet = 'MySQL je vrnil kot rezultat prazno množico (npr. niè vrstic).';
$strEnabled = 'Omogoèeno';
$strEncloseInTransaction = 'Vkljuèi izvoz v transakcijo';
$strEnd = 'Konec';
$strEndCut = 'KONEC IZREZA';
$strEndRaw = 'END RAW';
$strEnglish = 'Angleško';
$strEnglishPrivileges = ' Opomba: Imena MySQL privilegijev so zapisana v anglešèini ';
$strError = 'Napaka';
$strEstonian = 'Estonsko';
$strExcelEdition = 'Izdaja za Excel';
$strExcelOptions = 'Možnosti za Excel';
$strExecuteBookmarked = 'Izvedi izbrano poizvedbo';
$strExplain = 'Razloži SQL stavek';
$strExport = 'Izvozi';
$strExtendedInserts = 'Razširjene \'insert\' poizvedbe';
$strExtra = 'Dodatno';

$strFailedAttempts = 'Neuspeli poizkusi';
$strField = 'Polje';
$strFieldHasBeenDropped = 'Polje %s je zavrženo';
$strFields = 'Polja';
$strFieldsEmpty = ' Števec polj je prazen! ';
$strFieldsEnclosedBy = 'Polja obdana z';
$strFieldsEscapedBy = 'Polja izognjena z';
$strFieldsTerminatedBy = 'Polja zakljuèena z';
$strFileAlreadyExists = 'Datoteka %s že obstaja na strežniku, spremenite ime novi ali prepišite obstojeèo datoteko.';
$strFileCouldNotBeRead = 'Ne morem prebrati datoteke';
$strFileNameTemplate = 'Predloga datoteke';
$strFileNameTemplateHelp = 'Uporabi __DB__ za ime zbirke podatkov, __TABLE__ za ime tabele in možnosti %sany strftime%s za navedbo èasa, pripone pa bodo dodane samodejno. Ostalo besedilo ostane nespremenjeno.';
$strFileNameTemplateRemember = 'Shrani predlogo';
$strFixed = 'fiksno';
$strFlushPrivilegesNote = 'Obvestilo: phpMyAdmin dobi podatke o uporabnikovih privilegijih iz MySQL tabel privilegijev. Vsebina teh tabel se lahko razlikuje od privilegijev, ki jih uporablja strežnik, èe so bile tabele roèno spremenjene. V tem primeru morate, preden nadaljujete, osvežiti privilegije.';
$strFlushTable = 'Poèisti tabelo ("FLUSH")';
$strFormEmpty = 'V obliki manjka vrednost !';
$strFormat = 'Oblika';
$strFullText = 'Polna besedila';
$strFunction = 'Funkcija';

$strGenBy = 'Ustvaril';
$strGenTime = 'Èas nastanka';
$strGeneralRelationFeat = 'Splošne lastnosti relacij';
$strGeorgian = 'Gruzijsko';
$strGerman = 'Nemško';
$strGlobal = 'globalno';
$strGlobalPrivileges = 'Globalni privilegiji';
$strGlobalValue = 'Skupna vrednost';
$strGo = 'Izvedi';
$strGrantOption = 'Dovoli';
$strGreek = 'Grško';
$strGzip = '"gzipano"';

$strHasBeenAltered = 'je bil spremenjen(a).';
$strHasBeenCreated = 'je bil ustvarjen(a).';
$strHaveToShow = 'Za prikaz morate izbrati morate vsaj en stolpec';
$strHebrew = 'Hebrejsko';
$strHome = 'Domov';
$strHomepageOfficial = 'Uradna domaèa stran phpMyAdmin';
$strHost = 'Gostitelj';
$strHostEmpty = 'Ime gostitelja je prazno!';
$strHungarian = 'Madžarsko';

$strId = 'ID';
$strIdxFulltext = 'Polno besedilo';
$strIfYouWish = 'Èe bi radi naložili samo nekatere stolpce tabele, jih navedite v seznamu, kjer jih loèite z vejico.';
$strIgnore = 'Prezri';
$strIgnoreInserts = 'Uporabi možnost prezri vstavke';
$strIgnoringFile = 'Prezrl sem datoteko %s';
$strImportDocSQL = 'Uvozi docSQL datoteke';
$strImportFiles = 'Uvozi datoteke';
$strImportFinished = 'Uvoz konèan';
$strInUse = 'v uporabi';
$strIndex = 'Indeks';
$strIndexHasBeenDropped = 'Indeks %s je zavržen';
$strIndexName = 'Ime indeksa&nbsp;:';
$strIndexType = 'Vrsta indeksa&nbsp;:';
$strIndexes = 'Indeksi';
$strInnodbStat = 'InnoDB stanje';
$strInsecureMySQL = 'Konfiguracijska datoteka vsebuje nastavitve (uporabnik root brez gesla), ki odgovarjajo privzetemu privlegiranemu raèunu MySQLa. MySQL strežnik teèe s privzetimi nastavitvami, zato je izpostavljen vdorom. Èimprej odpravite ti dve varnostni luknji.';
$strInsert = 'Vstavi';
$strInsertAsNewRow = 'Vstavi kot novo vrstico';
$strInsertNewRow = 'Vstavi novo vrstico';
$strInsertTextfiles = 'V tabelo vstavi podatke iz datoteke z besedilom';
$strInsertedRowId = 'Vstavljen id vrstice:';
$strInsertedRows = 'Vstavljene vrstice:';
$strInstructions = 'Navodila';
$strInternalNotNecessary = '* Notranja relacija je nepotrebna, èe obstaja tudi v InnoDB.';
$strInternalRelations = 'Notranje relacije';

$strJapanese = 'Japonsko';
$strJumpToDB = 'Preskoèi na podatkovno bazo &quot;%s&quot;.';
$strJustDelete = 'Samo izbriši uporabnike iz tabel privilegijev.';
$strJustDeleteDescr = '&quot;Izbrisani&quot; uporabniki lahko še vedno normalno dostopajo do strežnika, dokler ne osvežite privilegijev';

$strKeepPass = 'Ne spreminjaj gesla';
$strKeyname = 'Ime kljuèa';
$strKill = 'Prekini proces';
$strKorean = 'Korejsko';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'Možnosti za LaTeX';
$strLandscape = 'Ležeèe';
$strLatexCaption = 'Ime tabele';
$strLatexContent = 'Vsebina tabele __TABLE__';
$strLatexContinued = '(nadaljevanje)';
$strLatexContinuedCaption = 'Nadaljevanje imena tabele';
$strLatexIncludeCaption = 'Vkljuèi ime tabele';
$strLatexLabel = 'Oznaèi kljuè';
$strLatexStructure = 'Struktura tabele __TABLE__';
$strLengthSet = 'Dolžina/Vrednosti*';
$strLimitNumRows = 'Število vrstic na stran';
$strLineFeed = 'Pomik v novo vrsto (Linefeed): \\n';
$strLinesTerminatedBy = 'Vrstice zakljuèene z';
$strLinkNotFound = 'Povezave ni mogoèe najti';
$strLinksTo = 'Povezave z';
$strLithuanian = 'Litvansko';
$strLoadExplanation = 'Privzeto je izbrana najboljša metoda, ki pa jo lahko v primeru neuspeha zamenjate.';
$strLoadMethod = 'LOAD metoda';
$strLocalhost = 'Lokalno';
$strLocationTextfile = 'Lokacija datoteke z besedilom';
$strLogPassword = 'Geslo:';
$strLogServer = 'Strežnik';
$strLogUsername = 'Uporabniško ime:';
$strLogin = 'Prijava';
$strLoginInformation = 'Podatki o prijavi';
$strLogout = 'Odjava';

$strMIMETypesForTable = 'VRSTE MIME ZA TABELO';
$strMIME_MIMEtype = 'MIME-vrsta';
$strMIME_available_mime = 'Razpoložljive MIME-vrste';
$strMIME_available_transform = 'Razpoložljive pretvorbe';
$strMIME_description = 'Opis';
$strMIME_nodescription = 'Za to pretvorbo ni na voljo opisa.<br>Za funkcije %s se pozanimajte pri avtorju.';
$strMIME_transformation = 'Pretvorba z brskalnikom';
$strMIME_transformation_note = 'Seznam razpoložljivih možnosti pretvorbe in pretvorbe MIME-vrst boste videli, èe kliknete na %sopise transformacij%s';
$strMIME_transformation_options = 'Možnosti pretvorbe';
$strMIME_transformation_options_note = 'Vrednosti za možnosti pretvorbe vnesite v naslednji obliki: \'a\',\'b\',\'c\'...<br>Èe želite med vrednosti vnesti poševnico nazaj ("\") ali enojni narekovaj ("\'"), morate pred ta znak postaviti (še eno) poševnico nazaj (npr. \'\\\\xyz\' ali \'a\\\'b\').';
$strMIME_without = 'MIME-vrste, ki so napisano ležeèe, nimajo lastne pretvorbene funkcije';
$strMaximumSize = 'Najveèja velikost: %s%s';
$strModifications = 'Spremembe so shranjene';
$strModify = 'Spremeni';
$strModifyIndexTopic = 'Spremeni indeks';
$strMoreStatusVars = 'Dodatne statusne spremenljivke';
$strMoveTable = 'Premakni tabelo v (podatkovna_baza<b>.</b>tabela):';
$strMoveTableOK = 'Tabela %s je bila premaknjena v %s.';
$strMoveTableSameNames = 'Tabele ni mogoèe premakniti same vase!';
$strMultilingual = 'veèjezièno';
$strMustSelectFile = 'Izberite datoteko, ki jo želite vstaviti.';
$strMySQLCharset = 'MySQL kodna tabela';
$strMySQLReloaded = 'MySQL ponovno naložen.';
$strMySQLSaid = 'MySQL je vrnil: ';
$strMySQLServerProcess = 'MySQL %pma_s1% teèe na %pma_s2% kot %pma_s3%';
$strMySQLShowProcess = 'Pokaži procese';
$strMySQLShowStatus = 'Pokaži tekoèe informacije o MySQL';
$strMySQLShowVars = 'Pokaži sistemske spremenljivke MySQL';

$strName = 'Ime';
$strNeedPrimaryKey = 'Doloèite primarni kljuè za to tabelo.';
$strNext = 'Naslednji';
$strNo = 'Ne';
$strNoDatabases = 'Brez podatkovnih baz';
$strNoDatabasesSelected = 'Ni izbranih podatkovnih baz.';
$strNoDescription = 'brez opisa';
$strNoDropDatabases = '"DROP DATABASE" poizvedbe so izkljuèene.';
$strNoExplain = 'Preskoèi razlago SQL stavka';
$strNoFrames = 'phpMyAdmin je prijaznejši z brskalnikom, ki podpira okvirje.';
$strNoIndex = 'Ni definiranega indeksa!';
$strNoIndexPartsDefined = 'Ni definiranega dela indeksa!';
$strNoModification = 'Brez sprememb';
$strNoOptions = 'Za to obliko ni možnosti';
$strNoPassword = 'Brez gesla';
$strNoPermission = 'Spletni strežnik nima dovoljenja za shranjevanje datoteke %s';
$strNoPhp = 'Brez kode PHP';
$strNoPrivileges = 'Brez privilegijev';
$strNoQuery = 'Brez SQL poizvedbe!';
$strNoRights = 'Nimate dovolj pravic, da bi bili sedaj tukaj!';
$strNoSpace = 'Ni dovolj prostora za shranjevanje datoteke %s.';
$strNoTablesFound = 'V podatkovni bazi ni mogoèe najti tabel.';
$strNoUsersFound = 'Ni mogoèe najti uporabnika(ov).';
$strNoValidateSQL = 'Preskoèi preverjanje pravilnosti SQL stavka';
$strNone = 'Brez';
$strNotNumber = 'To ni število!';
$strNotOK = 'Ni v redu';
$strNotSet = 'Tabele <b>%s</b> ni mogoèe najti ali pa ni v %s';
$strNotValidNumber = ' ni veljavna številka vrstice!';
$strNull = 'Null';
$strNumSearchResultsInTable = '%s zadetek(ov) v tabeli <i>%s</i>';
$strNumSearchResultsTotal = '<b>Skupaj:</b> <i>%s</i> zadetek(ov)';
$strNumTables = 'Ttabel';

$strOK = 'V redu';
$strOftenQuotation = 'Pogosti narekovaji. OPCIJSKO pomeni, da so samo polja tipa \'char\' in \'varchar\' obdana s temi znaki.';
$strOperations = 'Operacije';
$strOperator = 'Operator';
$strOptimizeTable = 'Optimiraj tabelo';
$strOptionalControls = 'Opcijsko. Narekuje naèin pisanja in branja posebnih znakov.';
$strOptionally = 'OPCIJSKO';
$strOr = 'Ali';
$strOverhead = 'Presežek';
$strOverwriteExisting = 'Prepiši obstojeèo(e) datoteko(e)';

$strPHP40203 = 'Uporabljate PHP 4.2.3, ki ima resne težave z veèbitnimi stavki (mbstring). Glej PHP poroèilo o hrošèu 19404. Ta verzija PHP ni priporoèljiva za uporabo s phpMyAdmin.';
$strPHPVersion = 'Razlièica PHP';
$strPageNumber = 'Številka strani:';
$strPaperSize = 'Velikost papirja';
$strPartialText = 'Delna besedila';
$strPassword = 'Geslo';
$strPasswordChanged = 'Geslo za %s je uspešno spremenjeno.';
$strPasswordEmpty = 'Geslo je prazno!';
$strPasswordNotSame = 'Gesli se ne ujemata!';
$strPdfDbSchema = 'Shema podatkovne baze "%s" - Stran %s';
$strPdfInvalidTblName = 'Tabela "%s" ne obstaja!';
$strPdfNoTables = 'Ni tabel';
$strPerHour = 'na uro';
$strPerMinute = 'na minuto';
$strPerSecond = 'na sekundo';
$strPhoneBook = 'telefonski imenik';
$strPhp = 'Ustvari PHP kodo';
$strPmaDocumentation = 'phpMyAdmin dokumentacija';
$strPmaUriError = 'Ukaz <tt>$cfg[\'PmaAbsoluteUri\']</tt> mora biti definiran v konfiguracijski datoteki!';
$strPortrait = 'Pokonèno';
$strPos1 = 'Zaèetek';
$strPrevious = 'Prejšnji';
$strPrimary = 'Primarni';
$strPrimaryKeyHasBeenDropped = 'Primarni kljuè je zavržen';
$strPrimaryKeyName = 'Ime primarnega kljuèa mora biti... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>mora</b> biti ime <b>samo</b> primarnega kljuèa!)';
$strPrint = 'Natisni';
$strPrintView = 'Pogled postavitve tiskanja';
$strPrintViewFull = 'Pogled za tiskanje (s polnimi besedili)';
$strPrivDescAllPrivileges = 'Vsebuje vse privilegije razen GRANT.';
$strPrivDescAlter = 'Omogoèa spreminjanje strukture obstojeèih tabel.';
$strPrivDescCreateDb = 'Omogoèa ustvarjanje novih podatkovnih baz in tabel.';
$strPrivDescCreateTbl = 'Omogoèa ustvarjanje novih tabel.';
$strPrivDescCreateTmpTable = 'Omogoèa ustvarjanje zaèasnih tabel.';
$strPrivDescDelete = 'Omogoèa brisanje podatkov.';
$strPrivDescDropDb = 'Omogoèa brisanje podatkovnih baz in tabel.';
$strPrivDescDropTbl = 'Omogoèa brisanje tabel.';
$strPrivDescExecute = 'Omogoèa poganjanje shranjenih postopkov; V tej verziji MySQL nima pomena.';
$strPrivDescFile = 'Omogoèa uvažanje in izvažanje podatkov v datoteke.';
$strPrivDescGrant = 'Omogoèa dodajanje uporabnikov in privilegijev brez osveževanja privilegijev.';
$strPrivDescIndex = 'Omogoèa ustvarjanje in brisanje indeksov.';
$strPrivDescInsert = 'Omogoèa vstavljanje in zamenjavo podatkov.';
$strPrivDescLockTables = 'Omogoèa zaklepanje tabel za trenutno temo.';
$strPrivDescMaxConnections = 'Omeji število povezav, ki jih uporabnik lahko odpre v eni uri.';
$strPrivDescMaxQuestions = 'Omeji število poizved, ki jih uporabnik lahko pošlje strežniku v eni uri.';
$strPrivDescMaxUpdates = 'Omeji število ukazov za spremembo tabel ali podatkovne baze, ki jih uporabnik lahko izvrši v eni uri.';
$strPrivDescProcess3 = 'Omogoèa ukinjanje procesov drugih uporabnikov.';
$strPrivDescProcess4 = 'Omogoèa pregled popolnih poizvedb v spisku procesov.';
$strPrivDescReferences = 'V tej verziji MySQL nima pomena.';
$strPrivDescReload = 'Omogoèa osveževanje strežnikovih nastavitev in praznjenje strežnikovih predpomnilnikov.';
$strPrivDescReplClient = 'Da uporabniku pravico poizvedovati kje so njegovi nadrejeni / podrjeni strežniki.';
$strPrivDescReplSlave = 'Potrebno za podrejene strežnike pri replikaciji.';
$strPrivDescSelect = 'Omogoèa branje podatkov.';
$strPrivDescShowDb = 'Omogoèa dostop do popolnega spiska podatkovnih baz';
$strPrivDescShutdown = 'Omogoèa ugašanje strežnika.';
$strPrivDescSuper = 'Omogoèa priklaplanje tudi èe je že doseženo najveèje dovoljeno število priklopov; Potrebno za veèino administrativnih nalog kot sta postavljanje globalnih spremenljivk in ukinjanje procesov drugih uporabnikov.';
$strPrivDescUpdate = 'Omogoèa spreminjanje podatkov.';
$strPrivDescUsage = 'Brez privilegijev.';
$strPrivileges = 'Privilegiji';
$strPrivilegesReloaded = 'Uspešno sem osvežil privilegije.';
$strProcesslist = 'Seznam procesov';
$strProperties = 'Lastnosti';
$strPutColNames = 'Postavi imena polj v prvo vrstico';

$strQBE = 'Poizvedba';
$strQBEDel = 'Briši';
$strQBEIns = 'Vstavi';
$strQueryFrame = 'Okno za iskanje';
$strQueryOnDb = 'SQL-poizvedba na podatkovni bazi <b>%s</b>:';
$strQuerySQLHistory = 'SQL-zgodovina';
$strQueryStatistics = '<b>Statistika poizvedbe</b>: Od zagona je bilo strežniku poslanih %s poizvedb.';
$strQueryTime = 'Poizvedba je potrebovala %01.4f s';
$strQueryType = 'Vrsta poizvedbe';
$strQueryWindowLock = 'Ne prepiši te poizvedbe od zunaj';

$strReType = 'Ponovno vnesi';
$strReceived = 'Prejeto';
$strRecords = 'Zapisi';
$strReferentialIntegrity = 'Preveri referenèno integriteto:';
$strRelationNotWorking = 'Dodatne funkcije za delo s povezanimi tabelami so bile izkjuèene. Èe želite izvedeti zakaj, kliknite %stukaj%s.';
$strRelationView = 'Pogled relacij';
$strRelationalSchema = 'Relacijska shema';
$strRelations = 'Relacije';
$strRelationsForTable = 'RELACIJE ZA TABELO';
$strReloadFailed = 'Ponovno nalaganje MySQL ni uspelo.';
$strReloadMySQL = 'Ponovno naloži MySQL';
$strReloadingThePrivileges = 'Osvežujem privilegije';
$strRemoveSelectedUsers = 'Izbriši izbrane uporabnike';
$strRenameDatabaseOK = 'Baza podatkov %s je preimenovana v %s';
$strRenameTable = 'Preimenuj tabelo v';
$strRenameTableOK = 'Tabela %s je preimenovana v %s';
$strRepairTable = 'Popravi tabelo';
$strReplace = 'Zamenjaj';
$strReplaceNULLBy = 'Zamenjaj NULL z';
$strReplaceTable = 'Podatke v tabeli zamenjaj z datoteko';
$strReset = 'Ponastavi';
$strResourceLimits = 'Omejitve virov';
$strRevoke = 'Odvzemi';
$strRevokeAndDelete = 'Odvzemi uporabnikom aktivne privilegije in jih potem izbriši.';
$strRevokeAndDeleteDescr = 'Uporabniki bodo še vedno imeli USAGE privilegije, dokler ne osvežite privilegijev.';
$strRevokeMessage = 'Odvzeli ste privilegije za %s';
$strRowLength = 'Dolžina vrstice';
$strRowSize = ' Velikost vrstice ';
$strRows = 'Vrstice';
$strRowsFrom = 'vrstice naprej od zapisa #';
$strRowsModeFlippedHorizontal = 'vodoravno (zasukani naslovi)';
$strRowsModeHorizontal = 'vodoravnem';
$strRowsModeOptions = 'v %s naèinu in ponovi glavo po %s celicah';
$strRowsModeVertical = 'navpiènem';
$strRowsStatistic = 'Statistika vrstic';
$strRunQuery = 'Izvedi poizvedbo';
$strRunSQLQuery = 'Izvedi SQL poizvedbo/poizvedbe na podatkovni bazi %s';
$strRunning = 'teèe na %s';
$strRussian = 'Rusko';

$strSQL = 'SQL';
$strSQLExportType = 'Vrsta izvoza';
$strSQLOptions = 'SQL možnosti';
$strSQLParserBugMessage = 'Obstaja možnost, da ste v SQL razèlenjevalniku naleteli na hrošèa. Temeljito preglejte poizvedbo in preverite, èe so citati pravilni in èe se ujemajo. Možno je tudi, da prenašate binarno datoteko, ki je izven podroèja besedila citata. Poizvedbo lahko preizkusite tudi na vmesniku ukazne vrstice MySQL. Èe je strežnik MySQL izpisal napako, vam le-ta lahko pomaga pri ugotavljanju težav. Èe se bodo težave nadaljevale, ali èe razèlenjevalniku ne uspe tam, kjer vmesniku ukazne vrstice uspe, potem zmanjšajte vnešeno SQL poizvedbo na tisto poizvedbo, ki povzroèa težave in pošljite poroèilo o napaki skupaj s podatki iz spodnjega odseka IZREZA.';
$strSQLParserUserError = 'Izgleda, da je v SQL poizvedbi prišlo do napake. Èe je strežnik MySQL izpisal napako, vam le-ta lahko pomaga pri ugotavljanju težav.';
$strSQLQuery = 'SQL-poizvedba';
$strSQLResult = 'Rezultat SQL';
$strSQPBugInvalidIdentifer = 'Neveljavni identifikator';
$strSQPBugUnclosedQuote = 'Odprt citat';
$strSQPBugUnknownPunctuation = 'Neznan niz loèil';
$strSave = 'Shrani';
$strSaveOnServer = 'Shrani na strežnik, v imenik %s';
$strScaleFactorSmall = 'Faktor poveèava je premajhen, da bi spravili shemo na eno stran';
$strSearch = 'Iskanje';
$strSearchFormTitle = 'Išèi v podatkovni bazi';
$strSearchInTables = 'V tabelah:';
$strSearchNeedle = 'Iskane besede ali vrednosti (nadomestni znak: "%"):';
$strSearchOption1 = 'katerokoli besedo';
$strSearchOption2 = 'vse besede';
$strSearchOption3 = 'toèno doloèeno frazo';
$strSearchOption4 = 'kot \'regular expression\'';
$strSearchResultsFor = 'Rezultati iskanja "<i>%s</i>" %s:';
$strSearchType = 'Najdi:';
$strSecretRequired = 'Konfiguracijski datoteki morate sedaj doloèiti skrivno geslo (blowfish_secret).';
$strSelectADb = 'Prosimo, izberite podatkovno bazo';
$strSelectAll = 'Izberi vse';
$strSelectFields = 'Izberite polja (vsaj eno):';
$strSelectNumRows = 'in poizvedba';
$strSelectTables = 'Izberi tabele';
$strSend = 'Shrani kot datoteko';
$strSent = 'Poslano';
$strServer = 'Strežnik';
$strServerChoice = 'Izbira strežnika';
$strServerStatus = 'Podatki o izvajanju';
$strServerStatusUptime = 'MySQL strežnik deluje že %s. Zagnal se je %s.';
$strServerTabProcesslist = 'Procesi';
$strServerTabVariables = 'Spremenljivke';
$strServerTrafficNotes = '<b>Promet na strežniku</b>: V teh tabelah je prikazana statistika obremenitve omrežja za ta MySQL strežnik, odkar je bil zagnan.';
$strServerVars = 'Spremenljivke in nastavitve strežnika';
$strServerVersion = 'Razlièica strežnika';
$strSessionValue = 'Vrednost seje';
$strSetEnumVal = 'Èe je polje vrste "enum" ali "set", navedite vrednosti v obliki: \'a\',\'b\',\'c\'...<br> Èe želite med vrednostmi uporabiti poševnico ("\") ali enojni narekovaj ("\'"), pred tem znakom vnesite poševnico (n.pr. \'\\\\xyz\' ali \'a\\\'b\').';
$strShow = 'Pokaži';
$strShowAll = 'Pokaži vse';
$strShowColor = 'Pokaži barvo';
$strShowDatadictAs = 'Oblika podatkovnega slovarja';
$strShowFullQueries = 'Pokaži celotne poizvedbe';
$strShowGrid = 'Pokaži mrežo';
$strShowPHPInfo = 'Pokaži podatke o PHP';
$strShowTableDimension = 'Pokaži dimenzije tabel';
$strShowTables = 'Pokaži tabele';
$strShowThisQuery = ' Ponovno pokaži poizvedbo v tem oknu ';
$strShowingRecords = 'Prikazujem vrstice';
$strSimplifiedChinese = 'Poenostavljeno kitajsko';
$strSingly = '(posamezno)';
$strSize = 'Velikost';
$strSort = 'Sortiraj';
$strSortByKey = 'Uredi po kljuèu';
$strSpaceUsage = 'Poraba prostora';
$strSplitWordsWithSpace = 'Besede so loèene s presledkom (" ").';
$strStatCheckTime = 'Zadnjiè pregledano';
$strStatCreateTime = 'Ustvarjeno';
$strStatUpdateTime = 'Zadnjiè posodobljeno';
$strStatement = 'Izjave';
$strStatus = 'Stanje';
$strStrucCSV = 'CSV podatki';
$strStrucData = 'Struktura in podatki';
$strStrucDrop = 'Dodaj DROP TABLE poizvedbo';
$strStrucExcelCSV = 'CSV podatki za Ms Excel';
$strStrucOnly = 'Samo struktura';
$strStructPropose = 'Predlagaj strukturo tabele';
$strStructure = 'Struktura';
$strSubmit = 'Pošlji';
$strSuccess = 'SQL-poizvedba je bila uspešno izvedena';
$strSum = 'Vsota';
$strSwedish = 'Švedsko';
$strSwitchToTable = 'Preklopi na kopirano tabelo';

$strTable = 'Tabela';
$strTableComments = 'Komentar tabele';
$strTableEmpty = 'Ime tabele je prazno!';
$strTableHasBeenDropped = 'Tabela %s je zavržena';
$strTableHasBeenEmptied = 'Tabela %s je izpraznjena';
$strTableHasBeenFlushed = 'Tabela %s je osvežena';
$strTableMaintenance = 'Vzdrževanje tabele';
$strTableOfContents = 'Vsebina';
$strTableOptions = 'Možnosti tabele';
$strTableStructure = 'Struktura tabele';
$strTableType = 'Vrsta tabele';
$strTables = '%s tabel';
$strTblPrivileges = 'Privilegiji tipièni za tabelo';
$strTextAreaLength = ' Zaradi njegove dolžine<br> polja ne bo mogoèe urejati ';
$strThai = 'Tajsko';
$strTheContent = 'Vsebina datoteke je vnešena.';
$strTheContents = 'Vsebina datoteke zamenja vsebino izbrane tabele v vrsticah z identiènim primarnim ali unikatnim kljuèem.';
$strTheTerminator = 'Zakljuèni znak polj.';
$strThisHost = 'Ta strežnik';
$strThisNotDirectory = 'To ni bila mapa';
$strThreadSuccessfullyKilled = 'Tema %s je bila prekinjena.';
$strTime = 'Èas';
$strToggleScratchboard = 'preklopi odložišèe (scratchboard)';
$strTotal = 'skupaj';
$strTotalUC = 'Skupaj';
$strTraditionalChinese = 'Tradicionalno kitajsko';
$strTraffic = 'Promet';
$strTransformation_application_octetstream__download = 'Prikaži povezavo za prenos binarnih podatkov polja. Prva možnost je ime binarne datoteke. Druga možnost je možno ime polja v vrstici tabele, ki vsebuje to ime datoteke. Èe vnesete drugo možnost, mora biti prva možnost prazna';
$strTransformation_image_jpeg__inline = 'Prikaže slièico, na katero lahko kliknete; možnosti: širina, višina v slikovnih pikah (obdrži prvotna razmerja)';
$strTransformation_image_jpeg__link = 'Pokaže povezavo na grafiko (neposredni BLOB prenos, ipd.).';
$strTransformation_image_png__inline = 'Pokaži sliko/jpeg: vkljuèeno';
$strTransformation_text_plain__dateformat = 'Oblikuje polje TIME, TIMESTAMP ali DATETIME glede na lokalne oblike za prikaz èasa. Prva možnost je odmik (v urah), ki bo dodan polju timestamp (Privzeto: 0). Druga možnost je drugaèna oblika prikaza datuma, glede na parametre za PHP strftime().';
$strTransformation_text_plain__external = 'SAMO ZA LINUX: Zažene zunanjo aplikacijo in podaja podatke za fielddata preko standardnega vhoda. Vrne standardni izhod aplikacije. Privzeto je Tidy, za tiskanje HTML-kode. Zaradi varnostnih razlogov morate roèno urediti datoteko libraries/transformations/text_plain__external.inc.php in vstaviti orodja za zaganjanje. Prva možnost je številka programa, ki ga želite uporabiti, druga možnost pa so parametri za program. Èe tretji parameter nastavite na 1, bo s pomoèjo htmlspecialchars() pretvoril izhod (Privzeto: 1). Èe nastavite èetrti parameter na 1, bo v celico z vsebino (content cell) vnesel NOWRAP in tako prikazal celoten izhod brez preoblikovanja (Privzeto: 1)';
$strTransformation_text_plain__formatted = 'Ohrani izvirno oblikovanje polja, brez izgubljanja vsebine.';
$strTransformation_text_plain__imagelink = 'Prikaže sliko in povezavo, polje vsebuje ime datoteke; najprej je predpona, npr. "http://domena.com/", druga možnost je širina v slikovnih pikah, tretja pa višina.';
$strTransformation_text_plain__link = 'Prikaže povezavo, polje vsebuje ime datoteke; prva možnost je predpona, npr. "http://domena.com/", druga pa ime povezave.';
$strTransformation_text_plain__substr = 'Vrne le del niza. Prva možnost je odmik, ki doloèa, kje se bo zaèelo prikazano besedilo (Privzeto: 0). Druga možnost je odmik, ki pove, koliko besedila bo prikazanega. Èe ni doloèen, bo izpisano vse preostalo besedilo. Tretja možnost pa doloèa, kateri znaki bodo pripeti vrnjenemu podnizu (Privzeto: ...) .';
$strTransformation_text_plain__unformatted = 'Pokaže HTML-kodo namesto HTML elementov. HTML oblikovanje ne bo prikazano.';
$strTruncateQueries = 'Skrèi prikazane poizvedbe';
$strTurkish = 'Turško';
$strType = 'Vrsta';

$strUkrainian = 'Ukrajinsko';
$strUncheckAll = 'Odznaèi vse';
$strUnicode = 'Unicode';
$strUnique = 'Unikaten';
$strUnknown = 'neznano';
$strUnselectAll = 'Preklièi izbor vsega';
$strUpdComTab = 'Navodila za posodobitev tabele Column_comments\' najdete v dokumentaciji';
$strUpdatePrivMessage = 'Posodobili ste privilegije za %s.';
$strUpdateProfileMessage = 'Profil je posodobljen.';
$strUpdateQuery = 'Osveži poizvedbo';
$strUpgrade = '%s bi morali nadgraditi v verzijo %s ali novejšo.';
$strUsage = 'Uporaba';
$strUseBackquotes = 'Obdaj imena tabel in polj z enojnimi poševnimi narekovaji';
$strUseHostTable = 'Uporabi tabelo gostiteljev';
$strUseTables = 'Uporabi tabele';
$strUseTextField = 'Uporabi tekstovno polje';
$strUseThisValue = 'Uporabi to vrednost';
$strUser = 'Uporabnik';
$strUserAlreadyExists = 'Uporabnik %s že obstaja!';
$strUserEmpty = 'Uporabniško ime je prazno!';
$strUserName = 'Uporabniško ime';
$strUserNotFound = 'Izbranega uporabnika v tabelah privilegijev nisem našel.';
$strUserOverview = 'Pregled uporabnikov';
$strUsersDeleted = 'Uspešno sem izbrisal izbrane uporabnike.';
$strUsersHavingAccessToDb = 'Uporabniški dostop do &quot;%s&quot;';

$strValidateSQL = 'Preveri pravilnost SQL stavka';
$strValidatorError = 'Ne morem inicializirati SQL validatorja. Prosim preverite, èe so namešèeni vsi php razširitve, kot je navedeno v %dokumenaciji%.';
$strValue = 'Vrednost';
$strVar = 'Spremenljivka';
$strViewDump = 'Preglej povzetek stanja tabele';
$strViewDumpDB = 'Preglej povzetek stanja podatkovne baze';
$strViewDumpDatabases = 'Pokaži povzetek stanja podatkovnih baz';

$strWebServerUploadDirectory = 'imenik za nalaganje datotek';
$strWebServerUploadDirectoryError = 'Imenik, ki ste ga doloèili za nalaganje, je nedosegljiv';
$strWelcome = 'Dobrodošli v %s';
$strWestEuropean = 'Zahodno evropsko';
$strWildcard = 'nadomestni znak';
$strWindowNotFound = 'Ciljnega okna ni bilo mogoèe osvežiti. Morda ste zaprli nadrejeno okno ali pa vaš brskalnik blokira osveževanje varnostnih parametrov med okni.';
$strWithChecked = 'Z oznaèenim:';
$strWritingCommentNotPossible = 'Zapisovanje komentarjev ni mogoèe';
$strWritingRelationNotPossible = 'Zapisovanje relacij ni mogoèe';
$strWrongUser = 'Napaèno uporabniško ime/geslo. Dostop zavrnjen.';

$strXML = 'XML';

$strYes = 'Da';

$strZeroRemovesTheLimit = 'Obvestilo: Èe postavite vrednost na 0 (niè), boste odstranili omejitev.';
$strZip = '"zipano"';

$strRefresh = 'Refresh';  //to translate
$strDefragment = 'Defragment table';  //to translate
$strNoRowsSelected = 'No rows selected';  //to translate
$strSpanish = 'Spanish';  //to translate
$strStrucNativeExcel = 'Native MS Excel data';  //to translate
$strDisableForeignChecks = 'Disable foreign key checks';  //to translate
$strServerNotResponding = 'The server is not responding';  //to translate
$strTheme = 'Theme / Style';  //to translate
$strTakeIt = 'take it';  //to translate
$strHexForBinary = 'Use hexadecimal for binary fields';  //to translate
$strIcelandic = 'Icelandic';  //to translate
$strLatvian = 'Latvian';  //to translate
$strPolish = 'Polish';  //to translate
$strRomanian = 'Romanian';  //to translate
$strSlovenian = 'Slovenian';  //to translate
$strTraditionalSpanish = 'Traditional Spanish';  //to translate
$strSlovak = 'Slovak';  //to translate
$strMySQLConnectionCollation = 'MySQL connection collation';  //to translate

<?php

/* $Id: serbian_cyrillic-utf-8.inc.php,v 2.40 2004/07/20 19:22:58 lem9 Exp $ */

/**
 * Translated by:
 *     Igor Mladenovic <mligor@zimco.com>, David Trajkovic <tdavid@ptt.yu>
 *     Mihailo Stefanovic <mikis@users.sourceforge.net>, Branislav Jovanovic <fangorn@eunet.yu>
 */
$charset = 'utf-8';
$allow_recoding = true;
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = ['бајтова', 'КБ', 'МБ', 'ГБ', 'ТБ', 'ПБ', 'ЕБ'];

$day_of_week = ['Нед', 'Пон', 'Уто', 'Сре', 'Чет', 'Пет', 'Суб'];
$month = ['јан', 'феб', 'мар', 'апр', 'мај', 'јун', 'јул', 'авг', 'сеп', 'окт', 'нов', 'дец'];
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B %Y. у %H:%M';
$timespanfmt = '%s дана, %s сати, %s минута и %s секунди';

$strAPrimaryKey = 'Примарни кључ је управо додат %s';
$strAbortedClients = 'Прекинуто';
$strAbsolutePathToDocSqlDir = 'Унесите комплетну путању до директоријума docSQL на веб серверу';
$strAccessDenied = 'Приступ одбијен';
$strAccessDeniedExplanation = 'phpMyAdmin је покушао да се повеже на MySQL сервер, али је сервер одбио повезивање. Проверите назив домаћина, корисничко име и лозинку у config.inc.php и уверите се да одговарају подацима које сте добили од администратора MySQL сервера.';
$strAction = 'Акција';
$strAddAutoIncrement = 'Додај AUTO_INCREMENT вредност';
$strAddConstraints = 'Додај ограничења';
$strAddDeleteColumn = 'Додај/обриши колону';
$strAddDeleteRow = 'Додај/обриши поље за критеријум';
$strAddDropDatabase = 'Додај DROP DATABASE';
$strAddHeaderComment = 'Додај коментар у заглавље (\\n раздваја линије)';
$strAddIfNotExists = 'Додај \'IF NOT EXISTS\'';
$strAddIntoComments = 'Додај у коментаре';
$strAddNewField = 'Додај ново поље';
$strAddPrivilegesOnDb = 'Додај привилегије на следећој бази';
$strAddPrivilegesOnTbl = 'Додај привилегије на следећој табели';
$strAddSearchConditions = 'Додај услове претраживања (део "WHERE" упита):';
$strAddToIndex = 'Додај у кључ &nbsp;%s&nbsp;колона(е)';
$strAddUser = 'Додај новог корисника';
$strAddUserMessage = 'Додали сте новог корисника.';
$strAddedColumnComment = 'Додат је коментар колони';
$strAddedColumnRelation = 'Додата је релација колони';
$strAdministration = 'Администрација';
$strAffectedRows = 'Обухваћено редова:';
$strAfter = 'После %s';
$strAfterInsertBack = 'Назад на претходну страну';
$strAfterInsertNewInsert = 'Додај још један нови ред';
$strAfterInsertSame = 'Врати се на ову страну';
$strAll = 'Све';
$strAllTableSameWidth = 'Приказ свих табела исте ширине?';
$strAlterOrderBy = 'Промени редослед у табели';
$strAnIndex = 'Кључ је управо додат %s';
$strAnalyzeTable = 'Анализирај табелу';
$strAnd = 'и';
$strAny = 'Било који';
$strAnyHost = 'Било који домаћин';
$strAnyUser = 'Било који корисник';
$strArabic = 'Арапски';
$strArmenian = 'Јерменски';
$strAscending = 'Растући';
$strAtBeginningOfTable = 'На почетку табеле';
$strAtEndOfTable = 'На крају табеле';
$strAttr = 'Атрибути';
$strAutodetect = 'аутоматски';
$strAutomaticLayout = 'Аутоматски распоред';

$strBack = 'Назад';
$strBaltic = 'Балтички';
$strBeginCut = 'ПОЧЕТАК РЕЗ';
$strBeginRaw = 'ПОЧЕТАК СИРОВО';
$strBinary = 'Бинарни';
$strBinaryDoNotEdit = 'Бинарни - не мењај';
$strBookmarkAllUsers = 'Дозволи сваком кориснику да приступа овом упамћеном упиту';
$strBookmarkDeleted = 'Обележивач је управо обрисан.';
$strBookmarkLabel = 'Назив';
$strBookmarkOptions = 'Опције обележивача';
$strBookmarkQuery = 'Запамћен SQL-упит';
$strBookmarkThis = 'Запамти SQL-упит';
$strBookmarkView = 'Види само';
$strBrowse = 'Преглед';
$strBrowseForeignValues = 'Прегледај стране вредности';
$strBulgarian = 'Бугарски';
$strBzError = 'phpMyAdmin није могао да компресује садржај базе због неисправне BZ2 екстензије у овој верзији PHP-а. Препоручује се да подесите <code>$cfg[\'BZipDump\']</code> директиву у вашoj phpMyAdmin конфигурационоj датотеци на <code>FALSE</code>. Ако желите да користите могућности BZ2 компресије, требало би да пређете на новију верзију PHP-а. Видите PHP извештај о грешкама %s за детаље.';
$strBzip = '"бзип-овано"';

$strCSVOptions = 'CSV опције';
$strCalendar = 'Календар';
$strCannotLogin = 'Не могу да се пријавим на MySQL сервер';
$strCantLoad = 'не могу да учитам екстензију %s,<br>молим проверите PHP конфигурацију';
$strCantLoadRecodeIconv = 'Не могу да учитам iconv или recode екстензије потребне за конверзију скупова знакова, подесите PHP да дозволи коришћење ових екстензија или онемогућите конверзију скупова знакова у phpMyAdmin-у.';
$strCantRenameIdxToPrimary = 'Не могу да променим кључ у PRIMARY (примарни) !';
$strCantUseRecodeIconv = 'Не могу да користим iconv или libiconv или recode_string функције иако екстензија пријављује да је учитана. Проверите вашу PHP конфигурацију.';
$strCardinality = 'Кардиналност';
$strCarriage = 'Нови ред (carriage return): \\r';
$strCaseInsensitive = 'Не разликује мала и велика слова';
$strCaseSensitive = 'Разликује мала и велика слова';
$strCentralEuropean = 'Централноевропски';
$strChange = 'Промени';
$strChangeCopyMode = 'Направи новог корисника са истим привилегијама и ...';
$strChangeCopyModeCopy = '... сачувај старе.';
$strChangeCopyModeDeleteAndReload = ' ... обриши старог из табеле корисника и затим поново учитај привилегије.';
$strChangeCopyModeJustDelete = ' ... обриши старе из табела корисника.';
$strChangeCopyModeRevoke = ' ... обустави све привилегије старог корисника и затим га обриши.';
$strChangeCopyUser = 'Промени информације о пријави / Копирај корисника';
$strChangeDisplay = 'Изабери поља за приказ';
$strChangePassword = 'Промени лозинку';
$strCharset = 'Карактер сет';
$strCharsetOfFile = 'Карактер сет датотеке:';
$strCharsets = 'Кодне стране';
$strCharsetsAndCollations = 'Карактер сетови и сортирање';
$strCheckAll = 'Означи све';
$strCheckOverhead = 'Провери прекорачења';
$strCheckPrivs = 'Провери привилегије';
$strCheckPrivsLong = 'Провери привилегије за базу &quot;%s&quot;.';
$strCheckTable = 'Провери табелу';
$strChoosePage = 'Изаберите страну коју мењате';
$strColComFeat = 'Приказујем коментаре колоне';
$strCollation = 'Сортирање';
$strColumnNames = 'Имена колона';
$strColumnPrivileges = 'Привилегије везане за колоне';
$strCommand = 'Наредба';
$strComments = 'Коментари';
$strCommentsForTable = 'КОМЕНТАРИ ТАБЕЛЕ';
$strCompleteInserts = 'Комплетан INSERT (са именима поља)';
$strCompression = 'Компресија';
$strConfigFileError = 'phpMyAdmin није могао да прочита вашу конфигурациону датотеку!<br>Ово се може десити ако PHP нађе грешку у процесирању или не може да пронађе датотеку.<br>Позовите конфигурациону датотеку директно користећи доњи линк и прочитајте поруке о грешци које добијате. У већини случајеве негде недостаје наводник или тачка-зарез.<br>Ако добијете празну страну, све је у реду.';
$strConfigureTableCoord = 'Подесите координате за табелу %s';
$strConnectionError = 'Не могу да се повежем: неисправна подешавања.';
$strConnections = 'Конекције';
$strConstraintsForDumped = 'Ограничења за извезене табеле';
$strConstraintsForTable = 'Ограничења за табеле';
$strCookiesRequired = 'Колачићи (Cookies) морају у овом случају бити активни.';
$strCopyTable = 'Копирај табелу у (база<b>.</b>табела):';
$strCopyTableOK = 'Табела %s је копирана у %s.';
$strCopyTableSameNames = 'Не могу да копирам табелу у саму себе!';
$strCouldNotKill = 'phpMyAdmin није могао да прекине процес %s. Вероватно је већ затворен.';
$strCreate = 'Направи';
$strCreateIndex = 'Направи кључ на&nbsp;%s&nbsp;колона';
$strCreateIndexTopic = 'Направи нови кључ';
$strCreateNewDatabase = 'Направи нову базу података';
$strCreateNewTable = 'Направи нову табелу у бази %s';
$strCreatePage = 'Направи нову страну';
$strCreatePdfFeat = 'Прављење PDF-ova';
$strCreationDates = 'Датуми креирања/ажурирања/провере';
$strCriteria = 'Критеријум';
$strCroatian = 'Хрватски';
$strCyrillic = 'Ћирилични';
$strCzech = 'Чешки';
$strCzechSlovak = 'Чешко-словачки';

$strDBComment = 'Коментар базе:';
$strDBGContext = 'Контекст';
$strDBGContextID = 'Контекст ИД';
$strDBGHits = 'Погодака';
$strDBGLine = 'Линија';
$strDBGMaxTimeMs = 'Max време, мс';
$strDBGMinTimeMs = 'Мин време, мс';
$strDBGModule = 'Модул';
$strDBGTimePerHitMs = 'Време/погодак, мс';
$strDBGTotalTimeMs = 'Укупно време, мс';
$strDBRename = 'Преименуј базу у';
$strDanish = 'Дански';
$strData = 'Подаци';
$strDataDict = 'Речник података';
$strDataOnly = 'Само подаци';
$strDatabase = 'База података';
$strDatabaseEmpty = 'Име базе није задато!';
$strDatabaseExportOptions = 'Опције за извоз базе';
$strDatabaseHasBeenDropped = 'База %s је одбачена.';
$strDatabaseNoTable = 'База не садржи табеле!';
$strDatabases = 'Базе';
$strDatabasesDropped = '%s база је успешно одбачено.';
$strDatabasesStats = 'Статистика базе';
$strDatabasesStatsDisable = 'Искључи статистике';
$strDatabasesStatsEnable = 'Укључи статистике';
$strDatabasesStatsHeavyTraffic = 'Напомена: укључивање статистика може проузроковати велики саобраћај између веб и MySQL сервера.';
$strDbPrivileges = 'Привилегије везане за базу';
$strDbSpecific = 'Специфично за базу';
$strDefault = 'Подразумевано';
$strDefaultValueHelp = 'За подразумевану вредност, унесите само једну вредност, без косих црта или наводника у овом облику: а';
$strDefragment = 'Дефрагментирај табелу';
$strDelOld = 'Тренутна страна има референце на табеле које више не постоје. Желите ли да обришете те референце?';
$strDelayedInserts = 'Користи одложена уметања';
$strDelete = 'Обриши';
$strDeleteAndFlush = 'Обриши кориснике и поново учитај привилегије.';
$strDeleteAndFlushDescr = 'Ово је најчистији начин, али поновно учитавање привилегина може да потраје.';
$strDeleted = 'Ред је обрисан';
$strDeletedRows = 'Обрисани редови:';
$strDeleting = 'Бришем %s';
$strDescending = 'Опадајући';
$strDescription = 'Опис';
$strDictionary = 'речник';
$strDisableForeignChecks = 'Искључи провере страних кључева';
$strDisabled = 'Онемогућено';
$strDisplayFeat = 'Прикажи особине';
$strDisplayOrder = 'Редослед приказа:';
$strDisplayPDF = 'Прикажи PDF схему';
$strDoAQuery = 'Направи "упит по примеру" (џокер: "%")';
$strDoYouReally = 'Да ли стварно хоћете да ';
$strDocu = 'Документација';
$strDrop = 'Одбаци';
$strDropDatabaseStrongWarning = 'Овим ћете УНИШТИТИ комплетну базу података!';
$strDropSelectedDatabases = 'Одбаци изабране базе';
$strDropUsersDb = 'Одбаци базе које се зову исто као корисници.';
$strDumpSaved = 'Садржај базе је сачуван у датотеку %s.';
$strDumpXRows = 'Прикажи %s редова почевши од реда %s.';
$strDumpingData = 'Приказ података табеле';
$strDynamic = 'динамички';

$strEdit = 'Промени';
$strEditPDFPages = 'Уређивање PDF страна';
$strEditPrivileges = 'Промени привилегије';
$strEffective = 'Ефективне';
$strEmpty = 'Испразни';
$strEmptyResultSet = 'MySQL је вратио празан резултат (нула редова).';
$strEnabled = 'Омогућено';
$strEncloseInTransaction = 'Обави извоз у трансакцији';
$strEnd = 'Крај';
$strEndCut = 'КРАЈ РЕЗ';
$strEndRaw = 'КРАЈ СИРОВО';
$strEnglish = 'Енглески';
$strEnglishPrivileges = ' Напомена: MySQL имена привилегија морају да буду на енглеском ';
$strError = 'Грешка';
$strEstonian = 'Естонски';
$strExcelEdition = 'Excel издање';
$strExcelOptions = 'Excel опције';
$strExecuteBookmarked = 'Изврши упамћен упит';
$strExplain = 'Објасни SQL';
$strExport = 'Извоз';
$strExtendedInserts = 'Проширени INSERT';
$strExtra = 'Додатно';

$strFailedAttempts = 'Неуспелих покушаја';
$strField = 'Поље';
$strFieldHasBeenDropped = 'Поље %s је обрисано';
$strFields = 'Поља';
$strFieldsEmpty = ' Број поља је нула! ';
$strFieldsEnclosedBy = 'Поља ограничена са';
$strFieldsEscapedBy = 'Ескејп карактер &nbsp; &nbsp; &nbsp;';
$strFieldsTerminatedBy = 'Поља раздвојена са';
$strFileAlreadyExists = 'Датотека %s већ постоји на серверу, промените име датотеке или укључите опцију преписивања.';
$strFileCouldNotBeRead = 'Датотеку није могуће прочитати';
$strFileNameTemplate = 'Шаблон имена датотеке';
$strFileNameTemplateHelp = 'Користи __DB__ за име базе, __TABLE__ за име табеле  и %sбило коју strftime%s опцију за спецификацију времена, и екстензија ће аутоматски бити додата. Сав остали текст биће сачуван.';
$strFileNameTemplateRemember = 'запамти шаблон';
$strFixed = 'сређено';
$strFlushPrivilegesNote = 'Напомена: phpMyAdmin узима привилегије корисника директно из MySQL табела привилегија. Садржај ове табеле може се разликовати од привилегија које сервер користи ако су вршене ручне измене. У том случају %sпоново учитајте привилегије%s пре него што наставите.';
$strFlushTable = 'Освежи табелу ("FLUSH")';
$strFormEmpty = 'Недостаје вредност у обрасцу!';
$strFormat = 'Формат';
$strFullText = 'Пун текст';
$strFunction = 'Функција';

$strGenBy = 'Генерисао';
$strGenTime = 'Време креирања';
$strGeneralRelationFeat = 'Опште особине релација';
$strGeorgian = 'Грузијски';
$strGerman = 'Немачки';
$strGlobal = 'глобално';
$strGlobalPrivileges = 'Глобалне привилегије';
$strGlobalValue = 'Глобална вредност';
$strGo = 'Крени';
$strGrantOption = 'Омогући';
$strGreek = 'Грчки';
$strGzip = '"гзип-овано"';

$strHasBeenAltered = 'је промењен(а).';
$strHasBeenCreated = 'је креиран(а).';
$strHaveToShow = 'Морате изабрати бар једну колону за приказ';
$strHebrew = 'Хебрејски';
$strHexForBinary = 'Користи хексадецимално за бинарна поља';
$strHome = 'Почетна страна';
$strHomepageOfficial = 'phpMyAdmin веб сајт';
$strHost = 'Домаћин';
$strHostEmpty = 'Име домаћина је празно!';
$strHungarian = 'Мађарски';

$strIcelandic = 'Исландски';
$strId = 'ID';
$strIdxFulltext = 'Текст кључ';
$strIfYouWish = 'Ако желите да излистате само неке колоне у табели, наведите их раздвојене зарезом';
$strIgnore = 'Игнориши';
$strIgnoreInserts = 'Игнориши дупликате при уметању';
$strIgnoringFile = 'Игноришем датотеку %s';
$strImportDocSQL = 'Увоз docSQL датотека';
$strImportFiles = 'Увоз датотека';
$strImportFinished = 'Увоз завршен';
$strInUse = 'се користи';
$strIndex = 'Кључ';
$strIndexHasBeenDropped = 'Кључ %s је обрисан';
$strIndexName = 'Име кључа :';
$strIndexType = 'Тип кључа :';
$strIndexes = 'Кључеви';
$strInnodbStat = 'InnoDB статус';
$strInsecureMySQL = 'Ваша конфигурациона датотека садржи подешавања (root без лозинке) која одговарају стандардном MySQL привилегованом налогу. Ваш MySQL сервер ради са овим подешавањима, отворен је за упаде, и заиста треба да исправите овај сигурносни ризик.';
$strInsert = 'Нови запис';
$strInsertAsNewRow = 'Унеси као нови ред';
$strInsertNewRow = 'Унеси нови ред';
$strInsertTextfiles = 'Увези податке из текстуалне датотеке';
$strInsertedRowId = 'ID уметнутих редова:';
$strInsertedRows = 'Унесено редова:';
$strInstructions = 'Упутства';
$strInternalNotNecessary = '* Унутрашња релација није неопходна када постоји и у InnoDB.';
$strInternalRelations = 'Унутрашње релације';

$strJapanese = 'Јапански';
$strJumpToDB = 'Пређи на базу &quot;%s&quot;.';
$strJustDelete = 'Само обриши кориснике из табеле привилегија.';
$strJustDeleteDescr = '&quot;Обрисани&quot; корисници ће и даље имати приступ серверу док привилегије не буду поново учитане.';

$strKeepPass = 'Немој да мењаш лозинку';
$strKeyname = 'Име кључа';
$strKill = 'Обустави';
$strKorean = 'Корејски';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'LaTeX опције';
$strLandscape = 'Положено';
$strLatexCaption = 'Коментар табеле';
$strLatexContent = 'Садржај табеле __TABLE__';
$strLatexContinued = '(настављено)';
$strLatexContinuedCaption = 'Настављен коментар табеле';
$strLatexIncludeCaption = 'Укључи коментар табеле';
$strLatexLabel = 'Ознака кључа';
$strLatexStructure = 'Структура табеле __TABLE__';
$strLatvian = 'Летонски';
$strLengthSet = 'Дужина/Вредност*';
$strLimitNumRows = 'Број редова по страни';
$strLineFeed = 'Ознака за крај линије: \\n';
$strLinesTerminatedBy = 'Линије се завршавају са';
$strLinkNotFound = 'Веза није пронађена';
$strLinksTo = 'Везе ка';
$strLithuanian = 'Литвански';
$strLoadExplanation = 'Најбољи метод је већ изабран, али га можете променити ако не ради.';
$strLoadMethod = 'LOAD метод';
$strLocalhost = 'Локални';
$strLocationTextfile = 'Локација текстуалне датотеке';
$strLogPassword = 'Лозинка:';
$strLogServer = 'Сервер';
$strLogUsername = 'Корисничко име:';
$strLogin = 'Пријављивање';
$strLoginInformation = 'Подаци о пријави';
$strLogout = 'Одјављивање';

$strMIMETypesForTable = 'MIME ТИПОВИ ЗА ТАБЕЛУ';
$strMIME_MIMEtype = 'MIME-типови';
$strMIME_available_mime = 'Доступни MIME-типови';
$strMIME_available_transform = 'Доступне трансформације';
$strMIME_description = 'Опис';
$strMIME_nodescription = 'Нема описа за ову трансформацију.<br>Молимо питајте аутора шта %s ради.';
$strMIME_transformation = 'Транформације читача';
$strMIME_transformation_note = 'За листу доступних опција трансформације и њихове трансформације MIME-типова, кликните на %sописе трансформација%s';
$strMIME_transformation_options = 'Опције трансформације';
$strMIME_transformation_options_note = 'Молимо унесите вредности за опције трансформације користећи овај облик: \'a\',\'b\',\'c\'...<br>Ако треба да унесете обрнуту косу црту ("\\") или апостроф ("\'") у те вредности, ставите обрнуту косу црту испред њих (на пример \'\\\\xyz\' или \'a\\\'b\').';
$strMIME_without = 'MIME-типови приказани у курзиву немају одвојене функције трансформације.';
$strMaximumSize = 'Максимална величина: %s%s';
$strModifications = 'Измене су сачуване';
$strModify = 'Промени';
$strModifyIndexTopic = 'Измени кључ';
$strMoreStatusVars = 'Још статусних променљивих';
$strMoveTable = 'Помери табелу у (база<b>.</b>табела):';
$strMoveTableOK = 'Табела %s је померена у %s.';
$strMoveTableSameNames = 'Не могу да преместим табелу у саму себе!';
$strMultilingual = 'вишејезички';
$strMustSelectFile = 'Морате изабрати датотеку коју желите да уметнете.';
$strMySQLCharset = 'MySQL сет карактера';
$strMySQLConnectionCollation = 'Сортирање за MySQL везу';
$strMySQLReloaded = 'MySQL поново покренут.';
$strMySQLSaid = 'MySQL рече: ';
$strMySQLServerProcess = 'MySQL %pma_s1% покренут на %pma_s2%, пријављен као %pma_s3%';
$strMySQLShowProcess = 'Прикажи листу процеса';
$strMySQLShowStatus = 'Прикажи MySQL информације о току рада';
$strMySQLShowVars = 'Прикажи MySQL системске променљиве';

$strName = 'Име';
$strNeedPrimaryKey = 'Требало би да дефинишете примарни кључ за ову табелу.';
$strNext = 'Следећи';
$strNo = 'Не';
$strNoDatabases = 'База не постоји';
$strNoDatabasesSelected = 'Није изабрана ни једна база.';
$strNoDescription = 'нема описа';
$strNoDropDatabases = '"DROP DATABASE" команда је онемогућена.';
$strNoExplain = 'Прескочи објашњавање SQL-a';
$strNoFrames = 'phpMyAdmin преферира читаче који подржавају оквире.';
$strNoIndex = 'Кључ није дефинисан!';
$strNoIndexPartsDefined = 'Делови кључа нису дефинисани!';
$strNoModification = 'Нема измена';
$strNoOptions = 'Не постоје опције за овај формат';
$strNoPassword = 'Нема лозинке';
$strNoPermission = 'Веб серверу није дозвољено да сачува датотеку %s.';
$strNoPhp = 'без PHP кода';
$strNoPrivileges = 'Нема привилегија';
$strNoQuery = 'Нема SQL упита!';
$strNoRights = 'Није Вам дозвољено да будете овде!';
$strNoRowsSelected = 'Нема одабраних редова';
$strNoSpace = 'Недовољно простора за снимање датотеке %s.';
$strNoTablesFound = 'Табеле нису пронађене у бази.';
$strNoUsersFound = 'Корисник није нађен.';
$strNoValidateSQL = 'Прескочи проверу SQL-a';
$strNone = 'нема';
$strNotNumber = 'Ово није број!';
$strNotOK = 'није у реду';
$strNotSet = '<b>%s</b> табела није пронађена или није постављена у %s';
$strNotValidNumber = 'није одговарајући број колоне!';
$strNull = 'Null';
$strNumSearchResultsInTable = '%s погодака унутар табеле <i>%s</i>';
$strNumSearchResultsTotal = '<b>Укупно:</b> <i>%s</i> погодака';
$strNumTables = 'Табеле';

$strOK = 'У реду';
$strOftenQuotation = 'Наводници који се користе. ОПЦИОНО се мисли да нека поља могу, али не морају да буду под знацима навода.';
$strOperations = 'Операције';
$strOperator = 'Оператор';
$strOptimizeTable = 'Оптимизуј табелу';
$strOptionalControls = 'Опционо. Знак који претходи специјалним знацима.';
$strOptionally = 'ОПЦИОНО';
$strOr = 'или';
$strOverhead = 'Прекорачење';
$strOverwriteExisting = 'Препиши постојеће датотеке';

$strPHP40203 = 'Користите PHP 4.2.3, који има озбиљан баг са вишебајтним стринговима (mbstring). Погледајте извештај о грешци бр. 19404. Ова верзија PHP-a се не препоручује за коришћење са phpMyAdmin.';
$strPHPVersion = 'верзија PHP-a';
$strPageNumber = 'Број стране:';
$strPaperSize = 'Димензије папира';
$strPartialText = 'Део текста';
$strPassword = 'Лозинка';
$strPasswordChanged = 'Лозинка за %s је успешно промењена.';
$strPasswordEmpty = 'Лозинка је празна!';
$strPasswordNotSame = 'Лозинке нису идентичне!';
$strPdfDbSchema = 'Схема базе "%s" - Страна %s';
$strPdfInvalidTblName = 'Табела "%s" не постоји!';
$strPdfNoTables = 'Нема табела';
$strPerHour = 'на сат';
$strPerMinute = 'у минуту';
$strPerSecond = 'у секунди';
$strPhoneBook = 'телефонски именик';
$strPhp = 'Направи PHP код';
$strPmaDocumentation = 'phpMyAdmin документација';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt> директива МОРА бити подешена у конфигурационој датотеци!';
$strPolish = 'Пољски';
$strPortrait = 'Усправно';
$strPos1 = 'Почетак';
$strPrevious = 'Претходна';
$strPrimary = 'Примарни';
$strPrimaryKeyHasBeenDropped = 'Примарни кључ је обрисан';
$strPrimaryKeyName = 'Име примарног кључа мора да буде... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>мора</b> бити име <b>само</b> примарног кључа!)';
$strPrint = 'Штампај';
$strPrintView = 'За штампу';
$strPrintViewFull = 'Поглед за штампу (са пуним текстом)';
$strPrivDescAllPrivileges = 'Укључује све привилегије осим GRANT.';
$strPrivDescAlter = 'Дозвољава измену структура постојећих табела.';
$strPrivDescCreateDb = 'Дозвољава креирање нових база и табела.';
$strPrivDescCreateTbl = 'Дозвољава креирање нових табела.';
$strPrivDescCreateTmpTable = 'Дозвољава креирање привремених табела..';
$strPrivDescDelete = 'Дозвољава брисање података.';
$strPrivDescDropDb = 'Дозвољава одбацивање база и табела.';
$strPrivDescDropTbl = 'Дозвољава одбацивање табела.';
$strPrivDescExecute = 'Дозвољава покретање сачуваних процедура. Нема ефекта у овој верзији MySQL-a.';
$strPrivDescFile = 'Дозвољава увоз података и њихов извоз у датотеке.';
$strPrivDescGrant = 'Дозвољава додавање корисника и привилегија без поновног учитавања табела привилегија.';
$strPrivDescIndex = 'Дозвољава креирање и брисање кључева.';
$strPrivDescInsert = 'Дозвољава уметање и замену података.';
$strPrivDescLockTables = 'Дозвољава закључавање табела текућим процесима.';
$strPrivDescMaxConnections = 'Ограничава број нових конекција које корисник може та отвори на сат.';
$strPrivDescMaxQuestions = 'Ограничава број упита које корисник може да упути серверу за сат.';
$strPrivDescMaxUpdates = 'Ограничава број команди које мењају табеле или базе које корисник може да изврши на сат.';
$strPrivDescProcess3 = 'Дозвољава прекидање процеса других корисника.';
$strPrivDescProcess4 = 'Дозвољава преглед комплетних упита у листи процеса.';
$strPrivDescReferences = 'Нема ефекта у овој верзији MySQL-a.';
$strPrivDescReload = 'Дозвољава поновно учитавање подешавања сервера и пражњење кеша сервера.';
$strPrivDescReplClient = 'Даје право кориснику да пита где су главни/помоћни сервери.';
$strPrivDescReplSlave = 'Потребно због помоћних сервера за репликацију.';
$strPrivDescSelect = 'Дозвољава читање података.';
$strPrivDescShowDb = 'Даје приступ комплетној листи база.';
$strPrivDescShutdown = 'Дозвољава гашење сервера.';
$strPrivDescSuper = ' Дозвољава повезивање иако је достигнут максималан број дозвољених веза; Неопходно за већину административних опција као што су подешавање глобалних променљивих или прекидање процеса осталих корисника.';
$strPrivDescUpdate = 'Дозвољава измену података.';
$strPrivDescUsage = 'Нема привилегија.';
$strPrivileges = 'Привилегије';
$strPrivilegesReloaded = 'Привилегије су успешно поново учитане.';
$strProcesslist = 'Листа процеса';
$strProperties = 'Својства';
$strPutColNames = 'Стави имена поља у први ред';

$strQBE = 'Упит по примеру';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryFrame = 'Прозор за упите';
$strQueryOnDb = 'SQL упит на бази <b>%s</b>:';
$strQuerySQLHistory = 'SQL историјат';
$strQueryStatistics = '<b>Статистике упита</b>: %s упита је постављено серверу од његовог покретања.';
$strQueryTime = 'Упит је трајао %01.4f секунди';
$strQueryType = 'Врста упита';
$strQueryWindowLock = 'Не преписуј овај упит изван прозора';

$strReType = 'Поновите унос';
$strReceived = 'Примљено';
$strRecords = 'Записи';
$strReferentialIntegrity = 'Провери референцијални интегритет:';
$strRefresh = 'Освежи';
$strRelationNotWorking = 'Додатне могућности за рад са повезаним табелама су искључене. Да бисте сазнали зашто, кликните %sовде%s.';
$strRelationView = 'Релациони поглед';
$strRelationalSchema = 'Релациона схема';
$strRelations = 'Релације';
$strRelationsForTable = 'РЕЛАЦИЈЕ ТАБЕЛЕ';
$strReloadFailed = 'Поновно покретање MySQL-a није успело.';
$strReloadMySQL = 'Поново покрени MySQL';
$strReloadingThePrivileges = 'Поново учитавам привилегије';
$strRemoveSelectedUsers = 'Уклони изабране кориснике';
$strRenameDatabaseOK = 'База %s је преименована у %s';
$strRenameTable = 'Промени име табеле у ';
$strRenameTableOK = 'Табели %s промењено име у %s';
$strRepairTable = 'Поправи табелу';
$strReplace = 'Замени';
$strReplaceNULLBy = 'Замени NULL са';
$strReplaceTable = 'Замени податке у табели са подацима из датотеке';
$strReset = 'Поништи';
$strResourceLimits = 'Ограничења ресурса';
$strRevoke = 'Забрани';
$strRevokeAndDelete = 'Обустави све активне привилегије корисника и затим их обриши.';
$strRevokeAndDeleteDescr = 'Корисници ће и даље имати USAGE привилегије док се привилегије поново не учитају.';
$strRevokeMessage = 'Забранили сте привилегије за %s';
$strRomanian = 'Румунски';
$strRowLength = 'Дужина реда';
$strRowSize = 'Величина реда';
$strRows = 'Редова';
$strRowsFrom = ' редова почев од реда';
$strRowsModeFlippedHorizontal = 'хоризонталном (ротирана заглавља)';
$strRowsModeHorizontal = 'хоризонталном';
$strRowsModeOptions = 'у %s моду и понови заглавље после сваког %s реда';
$strRowsModeVertical = 'вертикалном';
$strRowsStatistic = 'Статистике реда';
$strRunQuery = 'Изврши SQL упит';
$strRunSQLQuery = 'Изврши SQL упит(е) на бази %s';
$strRunning = 'на серверу %s';
$strRussian = 'Руски';

$strSQL = 'SQL';
$strSQLExportType = 'Тип извоза';
$strSQLOptions = 'SQL опције';
$strSQLParserBugMessage = 'Постоји могућност да сте пронашли баг у SQL парсеру. Молимо испитајте свој упит пажљиво, и проверите да су наводници исправни и да не недостају. Остали могући разлози грешке могу бити да сте послали бинарну датотеку ван области за обичан текст. Можете пробати свој упит у MySQL сучељу командне линије. Доња порука о грешци MySQL сервера, ако је има, може вам помоћи у откривању проблема. Ако и даље имате проблеме или ако парсер не успева тамо где успева сучеље командне линије, сведите свој SQL упит на један једини упит који ствара проблеме и пошаљите нам извештај о грешци са делом кода у доњој РЕЗ секцији:';
$strSQLParserUserError = 'Изгледа да постоји грешка у вашем SQL упиту. Овде је порука о грешки MySQL сервера, која вам може помоћи у откривању проблема';
$strSQLQuery = 'SQL упит';
$strSQLResult = 'SQL резултат';
$strSQPBugInvalidIdentifer = 'Неисправан иГ¤ентификатор';
$strSQPBugUnclosedQuote = 'Наводник није затворен';
$strSQPBugUnknownPunctuation = 'Непознат стринг интерпункције';
$strSave = 'Сачувај';
$strSaveOnServer = 'Сачувај на сервер у директоријум %s';
$strScaleFactorSmall = 'Фактор умањења је премали да би схема стала на једну страну';
$strSearch = 'Претраживање';
$strSearchFormTitle = 'Претраживање базе';
$strSearchInTables = 'Унутар табела:';
$strSearchNeedle = 'Речи или вредности које се траже (џокер: "%"):';
$strSearchOption1 = 'бар једну од речи';
$strSearchOption2 = 'све речи';
$strSearchOption3 = 'тачан израз';
$strSearchOption4 = 'као регуларни израз';
$strSearchResultsFor = 'Резултати претраге за "<i>%s</i>" %s:';
$strSearchType = 'Тражи:';
$strSecretRequired = 'Конфигурациона датотека захтева тајну лозинку (blowfish_secret).';
$strSelectADb = 'Изаберите базу';
$strSelectAll = 'Изабери све';
$strSelectFields = 'Изабери поља (најмање једно)';
$strSelectNumRows = 'у упиту';
$strSelectTables = 'Изабери табеле';
$strSend = 'Сачувај као датотеку';
$strSent = 'Послато';
$strServer = 'Сервер';
$strServerChoice = 'Избор сервера';
$strServerNotResponding = 'Сервер не одговара';
$strServerStatus = 'Информације о току рада';
$strServerStatusUptime = 'Овај MySQL сервер ради већ %s. Покренут је %s.';
$strServerTabProcesslist = 'Процеси';
$strServerTabVariables = 'Променљиве';
$strServerTrafficNotes = '<b>Саобраћај сервера</b>: Табеле показују статистике мрежног саобраћаја на овом MySQL серверу од његовог покретања.';
$strServerVars = 'Серверске променљиве и подешавања';
$strServerVersion = 'Верзија сервера';
$strSessionValue = 'Вредност сесије';
$strSetEnumVal = 'Ако је поље "enum" или "set", унесите вредности у формату: \'a\',\'b\',\'c\'...<br>Ако вам треба обрнута коса црта ("\\") или апостроф ("\'") користите их у "избегнутом" (escaped) облику (на пример \'\\\\xyz\' или \'a\\\'b\').';
$strShow = 'Прикажи';
$strShowAll = 'Прикажи све';
$strShowColor = 'Прикажи боју';
$strShowDatadictAs = 'Формат речника података';
$strShowFullQueries = 'Прикажи комплетне упите';
$strShowGrid = 'Прикажи мрежу';
$strShowPHPInfo = 'Прикажи информације о PHP-у';
$strShowTableDimension = 'Прикажи димензије табеле';
$strShowTables = 'Прикажи табеле';
$strShowThisQuery = 'Прикажи поново овај упит';
$strShowingRecords = 'Приказ записа';
$strSimplifiedChinese = 'Поједностављени кинески';
$strSingly = '(по једном пољу)';
$strSize = 'Величина';
$strSlovak = 'Словачки';
$strSlovenian = 'Словеначи';
$strSort = 'Сортирање';
$strSortByKey = 'Сортирај по кључу';
$strSpaceUsage = 'Заузеће';
$strSpanish = 'Шпански';
$strSplitWordsWithSpace = 'Речи се одвајају размаком (" ").';
$strStatCheckTime = 'Последња провера';
$strStatCreateTime = 'Направљено';
$strStatUpdateTime = 'Последња измена';
$strStatement = 'Име';
$strStatus = 'Статус';
$strStrucCSV = 'CSV формат';
$strStrucData = 'Структура и подаци';
$strStrucDrop = 'Додај \'DROP TABLE\'';
$strStrucExcelCSV = 'CSV за MS Excel';
$strStrucNativeExcel = 'Изворни MS Excel подаци';
$strStrucOnly = 'Само структура';
$strStructPropose = 'Предложи структуру табеле';
$strStructure = 'Структура';
$strSubmit = 'Пошаљи';
$strSuccess = 'Ваш SQL упит је успешно извршен';
$strSum = 'Укупно';
$strSwedish = 'Шведски';
$strSwitchToTable = 'Пређи на копирану табелу';

$strTable = 'Табела';
$strTableComments = 'Коментари табеле';
$strTableEmpty = 'Има табеле је празно!';
$strTableHasBeenDropped = 'Табела %s је одбачена';
$strTableHasBeenEmptied = 'Табела %s је испражњена';
$strTableHasBeenFlushed = 'Табела %s је освежена';
$strTableMaintenance = 'Радње на табели';
$strTableOfContents = 'Садржај';
$strTableOptions = 'Опције табеле';
$strTableStructure = 'Структура табеле';
$strTableType = 'Тип табеле';
$strTables = '%s табела';
$strTakeIt = 'преузми';
$strTblPrivileges = 'Привилегије везане за табеле';
$strTextAreaLength = 'Због њехове величине, поље<br>можда нећете моћи да измените';
$strThai = 'Тајски';
$strTheContent = 'Садржај датотеке је додат у базу.';
$strTheContents = 'Податке садржане у табели замени са подацима из датотеке који имају идентичне примарне и јединствене (unique) кључеве.';
$strTheTerminator = 'Сепаратор поља у датотеци.';
$strTheme = 'Тема / стил';
$strThisHost = 'Овај сервер';
$strThisNotDirectory = 'Ово није директоријум';
$strThreadSuccessfullyKilled = 'Процес %s је успешно прекинут.';
$strTime = 'Време';
$strToggleScratchboard = 'Укључи/искључи радну таблу';
$strTotal = 'укупно';
$strTotalUC = 'Укупно';
$strTraditionalChinese = 'Традиционални кинески';
$strTraditionalSpanish = 'Традиционални шпански';
$strTraffic = 'Саобраћај';
$strTransformation_application_octetstream__download = 'Приказује везу за преузимање бинарних података за поље. Прва опција је име бинарне датотеке. Друга опција је могуће име поља реда табеле који садржи име датотеке. Ако дате другу опцију, прва мора бити постављена на празан стринг';
$strTransformation_image_jpeg__inline = 'Приказује умањену слику на коју је могуће кликнути; опције: ширина, висина у пикселима (чува оригинални однос)';
$strTransformation_image_jpeg__link = 'Приказује линк ка овој снимци (нпр. директно преузимање из BLOB-а).';
$strTransformation_image_png__inline = 'Прикажи JPEG слике на страни';
$strTransformation_text_plain__dateformat = 'Узима TIME, TIMESTAMP или DATETIME поље и форматира га користећи локални облик приказивања датума. Прва опција је офсет (у сатима) који се додаје временској ознаци (подразумевано: 0). Друга опција је различит формат датума према параметрима који су доступни за PHP-ov strftime().';
$strTransformation_text_plain__external = 'САМО LINUX: Покреће екстерну апликацију и попуњава податке у пољима преко стандардног улаза. Враћа стандардни излаз апликације. Подразумевано је Tidy, за лепши приказ HTML кода. Због сигурносних разлога, морате ручно изменити датотеку libraries/transformations/text_plain__external.inc.php и додати алате које желите да користите. Прва опГ¶ија је број програма које желите да користите, а друга су параметри програма. Ако се трећи параметар постави на 1 излаз ће бити конвертован користећи htmlspecialchars() (подразумевано је 1). Ако је четврти параметар постављен на 1, NOWRAP ће бити додато ћелији са садржајем тако да ће излаз бити приказан без измена. (подразумевано 1)';
$strTransformation_text_plain__formatted = 'Чува оригинално форматирање поља. Escaping се не врши.';
$strTransformation_text_plain__imagelink = 'Приказује слику и линк, поље садржи назив датотеке; прва опција је префикс као "http://domain.com/", друга опција је ширина у пикселима, трећа је висина.';
$strTransformation_text_plain__link = 'Приказује линк, поље садржи назив датотеке; прва опција је префикс као "http://domain.com/", друга опција је наслов за линк.';
$strTransformation_text_plain__substr = 'Показује само део стринга. Прва опција је офсет који дефинише где почиње излаз вашег текста (подразумевано 0). Друга опција је офсет који показује колико ће текста бити приказано. Ако је нема, сав преостали текст ће бити приказан. Трећа опција одређује који ће знаци бити додати излазу када се прикаже подстринг (подразумевано: ...) .';
$strTransformation_text_plain__unformatted = 'Приказује HTML код као HTML ентитете. HTML форматирање се не приказује.';
$strTruncateQueries = 'Прикажи скраћене упите';
$strTurkish = 'Турски';
$strType = 'Тип';

$strUkrainian = 'Украјински';
$strUncheckAll = 'ниједно';
$strUnicode = 'Уникод';
$strUnique = 'Јединствени';
$strUnknown = 'непознат';
$strUnselectAll = 'ништа';
$strUpdComTab = 'Молимо погледајте у документацији како се ажурира табела Column_comments';
$strUpdatePrivMessage = 'Ажурирали сте привилегије за %s.';
$strUpdateProfileMessage = 'Профил је промењен.';
$strUpdateQuery = 'Ажурирај упит';
$strUpgrade = 'Требало би да унапредите ваш %s сервер на верзију %s или новију.';
$strUsage = 'Заузеће';
$strUseBackquotes = 'Користи \' за ограничавање имена поља';
$strUseHostTable = 'Користи табелу домаћина';
$strUseTables = 'Користи табеле';
$strUseTextField = 'Користи текст поље';
$strUseThisValue = 'Користи ову вредност';
$strUser = 'Корисник';
$strUserAlreadyExists = 'Корисник %s већ постоји!';
$strUserEmpty = 'Име корисника није унето!';
$strUserName = 'Име корисника';
$strUserNotFound = 'Изабрани корисник није пронађен у табели привилегија.';
$strUserOverview = 'Преглед корисника';
$strUsersDeleted = 'Изабрани корисници су успешно обрисани.';
$strUsersHavingAccessToDb = 'Корисници који имају приступ &quot;%s&quot;';

$strValidateSQL = 'Провери SQL';
$strValidatorError = 'SQL валидатор није могао да буде покренут. Проверите да ли су инсталиране неопходне PHP екстензије описане у  %sдокументацији%s.';
$strValue = 'Вредност';
$strVar = 'Променљива';
$strViewDump = 'Прикажи садржај (схему) табеле';
$strViewDumpDB = 'Прикажи садржај (схему) базе';
$strViewDumpDatabases = 'Прикажи садржај (схему) базе';

$strWebServerUploadDirectory = 'директоријум за слање веб сервера ';
$strWebServerUploadDirectoryError = 'Директоријум који сте изабрали за слање није доступан';
$strWelcome = 'Добродошли на %s';
$strWestEuropean = 'Западноевропски';
$strWildcard = 'џокер';
$strWindowNotFound = 'Одредишни прозор претраживача није могао да буде ажуриран. Можда сте затворили матични прозор, или ваш претраживач онемогућава ажурирање међу прозорима због сигурносних подешавања';
$strWithChecked = 'Означено:';
$strWritingCommentNotPossible = 'Писање коментара није могуће';
$strWritingRelationNotPossible = 'Уписивање релације није могуће';
$strWrongUser = 'Погрешно корисничко име/лозинка. Приступ одбијен.';

$strXML = 'XML';

$strYes = 'Да';

$strZeroRemovesTheLimit = 'Напомена: Постављање ових опција на 0 (нулу) уклања ограничења.';
$strZip = '"зиповано"';
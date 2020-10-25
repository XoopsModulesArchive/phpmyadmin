<?php

/* $Id: select_lang.lib.php,v 2.12 2004/08/03 00:26:46 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * phpMyAdmin Language Loading File
 */

/**
 * We need some elements of the superglobal $_SERVER array.
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';

/**
 * Define the path to the translations directory and get some variables
 * from system arrays if 'register_globals' is set to 'off'
 */
$lang_path = 'lang/';

/**
 * All the supported languages have to be listed in the array below.
 * 1. The key must be the "official" ISO 639 language code and, if required,
 *    the dialect code. It can also contain some informations about the
 *    charset (see the Russian case).
 * 2. The first of the values associated to the key is used in a regular
 *    expression to find some keywords corresponding to the language inside two
 *    environment variables.
 *    These values contains:
 *    - the "official" ISO language code and, if required, the dialect code
 *      also ('bu' for Bulgarian, 'fr([-_][[:alpha:]]{2})?' for all French
 *      dialects, 'zh[-_]tw' for Chinese traditional...), the dialect has to
 *      be specified as first;
 *    - the '|' character (it means 'OR');
 *    - the full language name.
 * 3. The second values associated to the key is the name of the file to load
 *    without the 'inc.php' extension.
 * 4. The last values associated to the key is the language code as defined by
 *    the RFC1766.
 *
 * Beware that the sorting order (first values associated to keys by
 * alphabetical reverse order in the array) is important: 'zh-tw' (chinese
 * traditional) must be detected before 'zh' (chinese simplified) for
 * example.
 *
 * When there are more than one charset for a language, we put the -utf-8
 * last because we need the default charset to be non-utf-8 to avoid
 * problems on MySQL < 4.1.x if AllowAnywhereRecoding is FALSE.
 *
 * For Russian, we put 1251 first, because MSIE does not accept 866
 * and users would not see anything.
 */
$available_languages = [
    'af-iso-8859-1' => ['af|afrikaans', 'afrikaans-iso-8859-1', 'af'],
'af-utf-8' => ['af|afrikaans', 'afrikaans-utf-8', 'af'],
'ar-win1256' => ['ar|arabic', 'arabic-windows-1256', 'ar'],
'ar-utf-8' => ['ar|arabic', 'arabic-utf-8', 'ar'],
'az-iso-8859-9' => ['az|azerbaijani', 'azerbaijani-iso-8859-9', 'az'],
'az-utf-8' => ['az|azerbaijani', 'azerbaijani-utf-8', 'az'],
'bg-win1251' => ['bg|bulgarian', 'bulgarian-windows-1251', 'bg'],
'bg-koi8-r' => ['bg|bulgarian', 'bulgarian-koi8-r', 'bg'],
'bg-utf-8' => ['bg|bulgarian', 'bulgarian-utf-8', 'bg'],
'bs-win1250' => ['bs|bosnian', 'bosnian-windows-1250', 'bs'],
'bs-utf-8' => ['bs|bosnian', 'bosnian-utf-8', 'bs'],
'ca-iso-8859-1' => ['ca|catalan', 'catalan-iso-8859-1', 'ca'],
'ca-utf-8' => ['ca|catalan', 'catalan-utf-8', 'ca'],
'cs-iso-8859-2' => ['cs|czech', 'czech-iso-8859-2', 'cs'],
'cs-win1250' => ['cs|czech', 'czech-windows-1250', 'cs'],
'cs-utf-8' => ['cs|czech', 'czech-utf-8', 'cs'],
'da-iso-8859-1' => ['da|danish', 'danish-iso-8859-1', 'da'],
'da-utf-8' => ['da|danish', 'danish-utf-8', 'da'],
'de-iso-8859-1' => ['de|german', 'german-iso-8859-1', 'de'],
'de-utf-8' => ['de|german', 'german-utf-8', 'de'],
'el-iso-8859-7' => ['el|greek',  'greek-iso-8859-7', 'el'],
'el-utf-8' => ['el|greek',  'greek-utf-8', 'el'],
'en-iso-8859-1' => ['en|english',  'english-iso-8859-1', 'en'],
'en-utf-8' => ['en|english',  'english-utf-8', 'en'],
'es-iso-8859-1' => ['es|spanish', 'spanish-iso-8859-1', 'es'],
'es-utf-8' => ['es|spanish', 'spanish-utf-8', 'es'],
'et-iso-8859-1' => ['et|estonian', 'estonian-iso-8859-1', 'et'],
'et-utf-8' => ['et|estonian', 'estonian-utf-8', 'et'],
'eu-iso-8859-1' => ['eu|basque', 'basque-iso-8859-1', 'eu'],
'eu-utf-8' => ['eu|basque', 'basque-utf-8', 'eu'],
'fa-win1256' => ['fa|persian', 'persian-windows-1256', 'fa'],
'fa-utf-8' => ['fa|persian', 'persian-utf-8', 'fa'],
'fi-iso-8859-1' => ['fi|finnish', 'finnish-iso-8859-1', 'fi'],
'fi-utf-8' => ['fi|finnish', 'finnish-utf-8', 'fi'],
'fr-iso-8859-1' => ['fr|french', 'french-iso-8859-1', 'fr'],
'fr-utf-8' => ['fr|french', 'french-utf-8', 'fr'],
'gl-iso-8859-1' => ['gl|galician', 'galician-iso-8859-1', 'gl'],
'gl-utf-8' => ['gl|galician', 'galician-utf-8', 'gl'],
'he-iso-8859-8-i' => ['he|hebrew', 'hebrew-iso-8859-8-i', 'he'],
'hi-utf-8' => ['hi|hindi', 'hindi-utf-8', 'hi'],
'hr-win1250' => ['hr|croatian', 'croatian-windows-1250', 'hr'],
'hr-iso-8859-2' => ['hr|croatian', 'croatian-iso-8859-2', 'hr'],
'hr-utf-8' => ['hr|croatian', 'croatian-utf-8', 'hr'],
'hu-iso-8859-2' => ['hu|hungarian', 'hungarian-iso-8859-2', 'hu'],
'hu-utf-8' => ['hu|hungarian', 'hungarian-utf-8', 'hu'],
'id-iso-8859-1' => ['id|indonesian', 'indonesian-iso-8859-1', 'id'],
'id-utf-8' => ['id|indonesian', 'indonesian-utf-8', 'id'],
'it-iso-8859-1' => ['it|italian', 'italian-iso-8859-1', 'it'],
'it-utf-8' => ['it|italian', 'italian-utf-8', 'it'],
'ja-euc' => ['ja|japanese', 'japanese-euc', 'ja'],
'ja-sjis' => ['ja|japanese', 'japanese-sjis', 'ja'],
'ja-utf-8' => ['ja|japanese', 'japanese-utf-8', 'ja'],
'ko-euc-kr' => ['ko|korean', 'korean-euc-kr', 'ko'],
'ko-utf-8' => ['ko|korean', 'korean-utf-8', 'ko'],
'ka-utf-8' => ['ka|georgian', 'georgian-utf-8', 'ka'],
'lt-win1257' => ['lt|lithuanian', 'lithuanian-windows-1257', 'lt'],
'lt-utf-8' => ['lt|lithuanian', 'lithuanian-utf-8', 'lt'],
'lv-win1257' => ['lv|latvian', 'latvian-windows-1257', 'lv'],
'lv-utf-8' => ['lv|latvian', 'latvian-utf-8', 'lv'],
'ms-iso-8859-1' => ['ms|malay', 'malay-iso-8859-1', 'ms'],
'ms-utf-8' => ['ms|malay', 'malay-utf-8', 'ms'],
'nl-iso-8859-1' => ['nl|dutch', 'dutch-iso-8859-1', 'nl'],
'nl-utf-8' => ['nl|dutch', 'dutch-utf-8', 'nl'],
'no-iso-8859-1' => ['no|norwegian', 'norwegian-iso-8859-1', 'no'],
'no-utf-8' => ['no|norwegian', 'norwegian-utf-8', 'no'],
'pl-iso-8859-2' => ['pl|polish', 'polish-iso-8859-2', 'pl'],
'pl-utf-8' => ['pl|polish', 'polish-utf-8', 'pl'],
'ptbr-iso-8859-1' => ['pt[-_]br|brazilian portuguese', 'brazilian_portuguese-iso-8859-1', 'pt-BR'],
'ptbr-utf-8' => ['pt[-_]br|brazilian portuguese', 'brazilian_portuguese-utf-8', 'pt-BR'],
'pt-iso-8859-1' => ['pt|portuguese', 'portuguese-iso-8859-1', 'pt'],
'pt-utf-8' => ['pt|portuguese', 'portuguese-utf-8', 'pt'],
'ro-iso-8859-1' => ['ro|romanian', 'romanian-iso-8859-1', 'ro'],
'ro-utf-8' => ['ro|romanian', 'romanian-utf-8', 'ro'],
'ru-win1251' => ['ru|russian', 'russian-windows-1251', 'ru'],
'ru-cp-866' => ['ru|russian', 'russian-cp-866', 'ru'],
'ru-koi8-r' => ['ru|russian', 'russian-koi8-r', 'ru'],
'ru-utf-8' => ['ru|russian', 'russian-utf-8', 'ru'],
'sk-iso-8859-2' => ['sk|slovak', 'slovak-iso-8859-2', 'sk'],
'sk-win1250' => ['sk|slovak', 'slovak-windows-1250', 'sk'],
'sk-utf-8' => ['sk|slovak', 'slovak-utf-8', 'sk'],
'sl-iso-8859-2' => ['sl|slovenian', 'slovenian-iso-8859-2', 'sl'],
'sl-win1250' => ['sl|slovenian', 'slovenian-windows-1250', 'sl'],
'sl-utf-8' => ['sl|slovenian', 'slovenian-utf-8', 'sl'],
'sq-iso-8859-1' => ['sq|albanian', 'albanian-iso-8859-1', 'sq'],
'sq-utf-8' => ['sq|albanian', 'albanian-utf-8', 'sq'],
'srlat-win1250' => ['sr[-_]lat|serbian latin', 'serbian_latin-windows-1250', 'sr-lat'],
'srlat-utf-8' => ['sr[-_]lat|serbian latin', 'serbian_latin-utf-8', 'sr-lat'],
'srcyr-win1251' => ['sr|serbian', 'serbian_cyrillic-windows-1251', 'sr'],
'srcyr-utf-8' => ['sr|serbian', 'serbian_cyrillic-utf-8', 'sr'],
'sv-iso-8859-1' => ['sv|swedish', 'swedish-iso-8859-1', 'sv'],
'sv-utf-8' => ['sv|swedish', 'swedish-utf-8', 'sv'],
'th-tis-620' => ['th|thai', 'thai-tis-620', 'th'],
'th-utf-8' => ['th|thai', 'thai-utf-8', 'th'],
'tr-iso-8859-9' => ['tr|turkish', 'turkish-iso-8859-9', 'tr'],
'tr-utf-8' => ['tr|turkish', 'turkish-utf-8', 'tr'],
'uk-win1251' => ['uk|ukrainian', 'ukrainian-windows-1251', 'uk'],
'uk-utf-8' => ['uk|ukrainian', 'ukrainian-utf-8', 'uk'],
'zhtw-big5' => ['zh[-_]tw|chinese traditional', 'chinese_traditional-big5', 'zh-TW'],
'zhtw-utf-8' => ['zh[-_]tw|chinese traditional', 'chinese_traditional-utf-8', 'zh-TW'],
'zh-gb2312' => ['zh|chinese simplified', 'chinese_simplified-gb2312', 'zh'],
'zh-utf-8' => ['zh|chinese simplified', 'chinese_simplified-utf-8', 'zh'],
];

/**
 * Analyzes some PHP environment variables to find the most probable language
 * that should be used
 *
 * @param string $str
 * @param mixed  $envType
 *
 * @global  array    the list of available translations
 * @global  string   the retained translation keyword
 */
function PMA_langDetect($str = '', $envType = '')
{
    global $available_languages;

    global $lang;

    foreach ($available_languages as $key => $value) {
        // $envType =  1 for the 'HTTP_ACCEPT_LANGUAGE' environment variable,

        //             2 for the 'HTTP_USER_AGENT' one

        $expr = $value[0];

        if (false === mb_strpos($expr, '[-_]')) {
            $expr = str_replace('|', '([-_][[:alpha:]]{2,3})?|', $expr);
        }

        if ((1 == $envType && eregi('^(' . $expr . ')(;q=[0-9]\\.[0-9])?$', $str))
            || (2 == $envType && eregi('(\(|\[|;[[:space:]])(' . $expr . ')(;|\]|\))', $str))) {
            $lang = $key;

            break;
        }
    }
} // end of the 'PMA_langDetect()' function

if (!isset($lang)) {
    if (isset($_GET) && !empty($_GET['lang'])) {
        $lang = $_GET['lang'];
    } else {
        if (isset($_POST) && !empty($_POST['lang'])) {
            $lang = $_POST['lang'];
        } else {
            if (isset($_COOKIE) && !empty($_COOKIE['pma_lang'])) {
                $lang = $_COOKIE['pma_lang'];
            }
        }
    }
}

/**
 * Do the work!
 */

// compatibility with config.inc.php <= v1.80
if (!isset($cfg['Lang']) && isset($cfgLang)) {
    $cfg['Lang'] = $cfgLang;

    unset($cfgLang);
}
if (!isset($cfg['DefaultLang']) && isset($cfgDefaultLang)) {
    $cfg['DefaultLang'] = $cfgDefaultLang;

    unset($cfgLang);
}

/**
 * 2004-02-15 rabus: Deactivated the code temporarily:
 *            We need to allow UTF-8 in order to be MySQL 4.1 compatible!

// Disable UTF-8 if $cfg['AllowAnywhereRecoding'] has been set to FALSE.
if (!isset($cfg['AllowAnywhereRecoding']) || !$cfg['AllowAnywhereRecoding']) {
    $available_language_files               = $available_languages;
    $available_languages                    = array();
    foreach ($available_language_files AS $tmp_lang => $tmp_lang_data) {
        if (substr($tmp_lang, -5) != 'utf-8') {
            $available_languages[$tmp_lang] = $tmp_lang_data;
        }
    } // end while
    unset($tmp_lang, $tmp_lang_data, $available_language_files);
} // end if
 */

// MySQL charsets map
$mysql_charset_map = [
    'big5' => 'big5',
'cp-866' => 'cp866',
'euc-jp' => 'ujis',
'euc-kr' => 'euckr',
'gb2312' => 'gb2312',
'gbk' => 'gbk',
'iso-8859-1' => 'latin1',
'iso-8859-2' => 'latin2',
'iso-8859-7' => 'greek',
'iso-8859-8' => 'hebrew',
'iso-8859-8-i' => 'hebrew',
'iso-8859-9' => 'latin5',
'iso-8859-13' => 'latin7',
'iso-8859-15' => 'latin1',
'koi8-r' => 'koi8r',
'shift_jis' => 'sjis',
'tis-620' => 'tis620',
'utf-8' => 'utf8',
'windows-1250' => 'cp1250',
'windows-1251' => 'cp1251',
'windows-1252' => 'latin1',
'windows-1256' => 'cp1256',
'windows-1257' => 'cp1257',
];

// Lang forced
if (!empty($cfg['Lang'])) {
    $lang = $cfg['Lang'];
}

// If '$lang' is defined, ensure this is a valid translation
if (!empty($lang) && empty($available_languages[$lang])) {
    $lang = '';
}

// Language is not defined yet :
// 1. try to findout user's language by checking its HTTP_ACCEPT_LANGUAGE
//    variable
if (empty($lang) && !empty($HTTP_ACCEPT_LANGUAGE)) {
    $accepted = explode(',', $HTTP_ACCEPT_LANGUAGE);

    $acceptedCnt = count($accepted);

    for ($i = 0; $i < $acceptedCnt && empty($lang); $i++) {
        PMA_langDetect($accepted[$i], 1);
    }
}
// 2. try to findout user's language by checking its HTTP_USER_AGENT variable
if (empty($lang) && !empty($HTTP_USER_AGENT)) {
    PMA_langDetect($HTTP_USER_AGENT, 2);
}

// 3. Didn't catch any valid lang : we use the default settings
if (empty($lang)) {
    $lang = $cfg['DefaultLang'];
}

// 4. Checks whether charset recoding should be allowed or not
$allow_recoding = false; // Default fallback value
if (!isset($convcharset) || empty($convcharset)) {
    $convcharset = $_COOKIE['pma_charset'] ?? $cfg['DefaultCharset'];
}

// 5. Defines the associated filename and load the translation
$lang_file = $lang_path . $available_languages[$lang][1] . '.inc.php';
require_once __DIR__ . '/' . $lang_file;

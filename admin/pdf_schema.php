<?php

/* $Id: pdf_schema.php,v 2.8 2004/05/31 19:24:11 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Contributed by Maxime Delorme and merged by lem9
 */

/**
 * Gets some core scripts
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';

/**
 * Settings for relation stuff
 */
require_once __DIR__ . '/libraries/relation.lib.php';
require_once __DIR__ . '/libraries/transformations.lib.php';

$cfgRelation = PMA_getRelationsParam();

/**
 * Now in ./libraries/relation.lib.php we check for all tables
 * that we need, but if we don't find them we are quiet about it
 * so people can work without.
 * This page is absolutely useless if you didn't set up your tables
 * correctly, so it is a good place to see which tables we can and
 * complain ;-)
 */
if (!$cfgRelation['pdfwork']) {
    echo '<font color="red">' . $strError . '</font><br>' . "\n";

    $url_to_goto = '<a href="' . $cfg['PmaAbsoluteUri'] . 'chk_rel.php?' . $url_query . '">';

    echo sprintf($strRelationNotWorking, $url_to_goto, '</a>') . "\n";
}

/**
 * Gets the "fpdf" libraries and defines the pdf font path
 */
require_once __DIR__ . '/libraries/fpdf/fpdf.php';
$FPDF_font_path = './libraries/fpdf/font/';

/**
 * Extends the "FPDF" class and prepares the work
 *
 *
 * @see     FPDF
 */
class PMA_PDF extends FPDF
{
    /**
     * Defines private properties
     */

    public $x_min;

    public $y_min;

    public $l_marg = 10;

    public $t_marg = 10;

    public $scale;

    public $title;

    public $PMA_links;

    public $Outlines = [];

    public $def_outlines;

    public $Alias;

    public $widths;

    /**
     * The PMA_PDF constructor
     *
     * This function just refers to the "FPDF" constructor: with PHP3 a class
     * must have a constructor
     *
     * @param mixed $orientation
     * @param mixed $unit
     * @param mixed $format
     *
     * @see     FPDF::FPDF()
     */
    public function __construct($orientation = 'L', $unit = 'mm', $format = 'A4')
    {
        $this->Alias = [];

        parent::__construct($orientation, $unit, $format);
    }

    // end of the "PMA_PDF()" method

    public function SetAlias($name, $value)
    {
        $this->Alias[$name] = $value;
    }

    public function _putpages()
    {
        if (count($this->Alias) > 0) {
            $nb = $this->page;

            foreach ($this->Alias as $alias => $value) {
                for ($n = 1; $n <= $nb; $n++) {
                    $this->pages[$n] = str_replace($alias, $value, $this->pages[$n]);
                }
            }
        }

        parent::_putpages();
    }

    /**
     * Sets the scaling factor, defines minimum coordinates and margins
     *
     * @param mixed $scale
     * @param mixed $x_min
     * @param mixed $y_min
     * @param mixed $l_marg
     * @param mixed $t_marg
     */
    public function PMA_PDF_setScale($scale = 1, $x_min = 0, $y_min = 0, $l_marg = -1, $t_marg = -1)
    {
        $this->scale = $scale;

        $this->x_min = $x_min;

        $this->y_min = $y_min;

        if (-1 != $this->l_marg) {
            $this->l_marg = $l_marg;
        }

        if (-1 != $this->t_marg) {
            $this->t_marg = $t_marg;
        }
    }

    // end of the "PMA_PDF_setScale" function

    /**
     * Outputs a scaled cell
     *
     * @param mixed $w
     * @param mixed $h
     * @param mixed $txt
     * @param mixed $border
     * @param mixed $ln
     * @param mixed $align
     * @param mixed $fill
     * @param mixed $link
     *
     * @see     FPDF::Cell()
     */
    public function PMA_PDF_cellScale($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = 0, $link = '')
    {
        $h /= $this->scale;

        $w /= $this->scale;

        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    // end of the "PMA_PDF_cellScale" function

    /**
     * Draws a scaled line
     *
     * @param mixed $x1
     * @param mixed $y1
     * @param mixed $x2
     * @param mixed $y2
     *
     * @see     FPDF::Line()
     */
    public function PMA_PDF_lineScale($x1, $y1, $x2, $y2)
    {
        $x1 = ($x1 - $this->x_min) / $this->scale + $this->l_marg;

        $y1 = ($y1 - $this->y_min) / $this->scale + $this->t_marg;

        $x2 = ($x2 - $this->x_min) / $this->scale + $this->l_marg;

        $y2 = ($y2 - $this->y_min) / $this->scale + $this->t_marg;

        $this->Line($x1, $y1, $x2, $y2);
    }

    // end of the "PMA_PDF_lineScale" function

    /**
     * Sets x and y scaled positions
     *
     * @param mixed $x
     * @param mixed $y
     *
     * @see     FPDF::SetXY()
     */
    public function PMA_PDF_setXyScale($x, $y)
    {
        $x = ($x - $this->x_min) / $this->scale + $this->l_marg;

        $y = ($y - $this->y_min) / $this->scale + $this->t_marg;

        $this->SetXY($x, $y);
    }

    // end of the "PMA_PDF_setXyScale" function

    /**
     * Sets the X scaled positions
     *
     * @param mixed $x
     *
     * @see     FPDF::SetX()
     */
    public function PMA_PDF_setXScale($x)
    {
        $x = ($x - $this->x_min) / $this->scale + $this->l_marg;

        $this->SetX($x);
    }

    // end of the "PMA_PDF_setXScale" function

    /**
     * Sets the scaled font size
     *
     * @param mixed $size
     *
     * @see     FPDF::SetFontSize()
     */
    public function PMA_PDF_setFontSizeScale($size)
    {
        // Set font size in points

        $size /= $this->scale;

        $this->SetFontSize($size);
    }

    // end of the "PMA_PDF_setFontSizeScale" function

    /**
     * Sets the scaled line width
     *
     * @param mixed $width
     *
     * @see     FPDF::SetLineWidth()
     */
    public function PMA_PDF_setLineWidthScale($width)
    {
        $width /= $this->scale;

        $this->SetLineWidth($width);
    }

    // end of the "PMA_PDF_setLineWidthScale" function

    /**
     * Displays an error message
     *
     * @param mixed $error_message
     *
     * @global  array    the PMA configuration array
     * @global  int  the current server id
     * @global  string   the current language
     * @global  string   the charset to convert to
     * @global  string   the current database name
     * @global  string   the current charset
     * @global  string   the current text direction
     * @global  string   a localized string
     * @global  string   an other localized string
     */
    public function PMA_PDF_die($error_message = '')
    {
        global $cfg;

        global $server, $lang, $convcharset, $db;

        global $charset, $text_dir, $strRunning, $strDatabase;

        require_once __DIR__ . '/header.inc.php';

        echo '<p><b>PDF - ' . $GLOBALS['strError'] . '</b></p>' . "\n";

        if (!empty($error_message)) {
            $error_message = htmlspecialchars($error_message, ENT_QUOTES | ENT_HTML5);
        }

        echo '<p>' . "\n";

        echo '    ' . $error_message . "\n";

        echo '</p>' . "\n";

        echo '<a href="db_details_structure.php?' . PMA_generate_common_url($db)
             . '">' . $GLOBALS['strBack'] . '</a>';

        echo "\n";

        require_once __DIR__ . '/footer.inc.php';
    }

    // end of the "PMA_PDF_die()" function

    /**
     * Aliases the "Error()" function from the FPDF class to the
     * "PMA_PDF_die()" one
     *
     * @param mixed $error_message
     *
     * @see     PMA_PDF_die()
     */
    public function Error($error_message = '')
    {
        $this->PMA_PDF_die($error_message);
    }

    // end of the "Error()" method

    public function Header()
    {
        //$datefmt

        // We only show this if we find something in the new pdf_pages table

        // This function must be named "Header" to work with the FPDF library

        global $cfgRelation,$db,$pdf_page_number,$with_doc;

        if ($with_doc) {
            $test_query = 'SELECT * FROM ' . PMA_backquote($cfgRelation['pdf_pages'])
                    . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                    . ' AND page_nr = \'' . $pdf_page_number . '\'';

            $test_rs = PMA_query_as_cu($test_query);

            $pages = @PMA_DBI_fetch_assoc($test_rs);

            $this->SetFont('', 'B', 14);

            $this->Cell(0, 6, ucfirst($pages['page_descr']), 'B', 1, 'C');

            $this->SetFont('', '');

            $this->Ln();
        }
    }

    public function Footer()
    {
        // This function must be named "Footer" to work with the FPDF library

        global $with_doc;

        if ($with_doc) {
            $this->SetY(-15);

            $this->SetFont('', '', 14);

            $this->Cell(0, 6, $GLOBALS['strPageNumber'] . ' ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');

            $this->Cell(0, 6, PMA_localisedDate(), 0, 1, 'R');

            $this->SetY(20);
        }
    }

    public function Bookmark($txt, $level = 0, $y = 0)
    {
        //Add a bookmark

        $this->Outlines[0][] = $level;

        $this->Outlines[1][] = $txt;

        $this->Outlines[2][] = $this->page;

        if (-1 == $y) {
            $y = $this->GetY();
        }

        $this->Outlines[3][] = round($this->hPt - $y * $this->k, 2);
    }

    public function _putbookmarks()
    {
        if (count($this->Outlines) > 0) {
            //Save object number

            $memo_n = $this->n;

            //Take the number of sub elements for an outline

            $nb_outlines = count($this->Outlines[0]);

            $first_level = [];

            $parent = [];

            $parent[0] = 1;

            for ($i = 0; $i < $nb_outlines; $i++) {
                $level = $this->Outlines[0][$i];

                $kids = 0;

                $last = -1;

                $prev = -1;

                $next = -1;

                if ($i > 0) {
                    $cursor = $i - 1;

                    //Take the previous outline in the same level

                    while ($this->Outlines[0][$cursor] > $level && $cursor > 0) {
                        $cursor--;
                    }

                    if ($this->Outlines[0][$cursor] == $level) {
                        $prev = $cursor;
                    }
                }

                if ($i < $nb_outlines - 1) {
                    $cursor = $i + 1;

                    while (isset($this->Outlines[0][$cursor]) && $this->Outlines[0][$cursor] > $level) {
                        //Take the immediate kid in level + 1

                        if ($this->Outlines[0][$cursor] == $level + 1) {
                            $kids++;

                            $last = $cursor;
                        }

                        $cursor++;
                    }

                    $cursor = $i + 1;

                    //Take the next outline in the same level

                    while ($this->Outlines[0][$cursor] > $level && ($cursor + 1 < count($this->Outlines[0]))) {
                        $cursor++;
                    }

                    if ($this->Outlines[0][$cursor] == $level) {
                        $next = $cursor;
                    }
                }

                $this->_newobj();

                $parent[$level + 1] = $this->n;

                if (0 == $level) {
                    $first_level[] = $this->n;
                }

                $this->_out('<<');

                $this->_out('/Title (' . $this->Outlines[1][$i] . ')');

                $this->_out('/Parent ' . $parent[$level] . ' 0 R');

                if (-1 != $prev) {
                    $this->_out('/Prev ' . ($memo_n + $prev + 1) . ' 0 R');
                }

                if (-1 != $next) {
                    $this->_out('/Next ' . ($this->n + $next - $i) . ' 0 R');
                }

                $this->_out('/Dest [' . (1 + (2 * $this->Outlines[2][$i])) . ' 0 R /XYZ null ' . $this->Outlines[3][$i] . ' null]');

                if ($kids > 0) {
                    $this->_out('/First ' . ($this->n + 1) . ' 0 R');

                    $this->_out('/Last ' . ($this->n + $last - $i) . ' 0 R');

                    $this->_out('/Count -' . $kids);
                }

                $this->_out('>>');

                $this->_out('endobj');
            }

            //First page of outlines

            $this->_newobj();

            $this->def_outlines = $this->n;

            $this->_out('<<');

            $this->_out('/Type');

            $this->_out('/Outlines');

            $this->_out('/First ' . $first_level[0] . ' 0 R');

            $this->_out('/Last ' . $first_level[count($first_level) - 1] . ' 0 R');

            $this->_out('/Count ' . count($first_level));

            $this->_out('>>');

            $this->_out('endobj');
        }
    }

    public function _putresources()
    {
        parent::_putresources();

        $this->_putbookmarks();
    }

    public function _putcatalog()
    {
        parent::_putcatalog();

        if (count($this->Outlines) > 0) {
            $this->_out('/Outlines ' . $this->def_outlines . ' 0 R');

            $this->_out('/PageMode /UseOutlines');
        }
    }

    public function SetWidths($w)
    {
        // column widths

        $this->widths = $w;
    }

    public function Row($data, $links)
    {
        // line height

        $nb = 0;

        $data_cnt = count($data);

        for ($i = 0; $i < $data_cnt; $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $il = $this->FontSize;

        $h = ($il + 1) * $nb;

        // page break if necessary

        $this->CheckPageBreak($h);

        // draw the cells

        $data_cnt = count($data);

        for ($i = 0; $i < $data_cnt; $i++) {
            $w = $this->widths[$i];

            // save current position

            $x = $this->GetX();

            $y = $this->GetY();

            // draw the border

            $this->Rect($x, $y, $w, $h);

            if (isset($links[$i])) {
                $this->Link($x, $y, $w, $h, $links[$i]);
            }

            // print text

            $this->MultiCell($w, $il + 1, $data[$i], 0, 'L');

            // go to right side

            $this->SetXY($x + $w, $y);
        }

        // go to line

        $this->Ln($h);
    }

    public function CheckPageBreak($h)
    {
        // if height h overflows, manual page break

        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }
    }

    public function NbLines($w, $txt)
    {
        // compute number of lines used by a multicell of width w

        $cw = &$this->CurrentFont['cw'];

        if (0 == $w) {
            $w = $this->w - $this->rMargin - $this->x;
        }

        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

        $s = str_replace("\r", '', $txt);

        $nb = mb_strlen($s);

        if ($nb > 0 and "\n" == $s[$nb - 1]) {
            $nb--;
        }

        $sep = -1;

        $i = 0;

        $j = 0;

        $l = 0;

        $nl = 1;

        while ($i < $nb) {
            $c = $s[$i];

            if ("\n" == $c) {
                $i++;

                $sep = -1;

                $j = $i;

                $l = 0;

                $nl++;

                continue;
            }

            if (' ' == $c) {
                $sep = $i;
            }

            $l += $cw[$c];

            if ($l > $wmax) {
                if (-1 == $sep) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }

                $sep = -1;

                $j = $i;

                $l = 0;

                $nl++;
            } else {
                $i++;
            }
        }

        return $nl;
    }
} // end of the "PMA_PDF" class

/**
 * Draws tables schema
 *
 *
 * @see     PMA_RT
 */
class PMA_RT_Table
{
    /**
     * Defines private properties
     */

    public $nb_fiels;

    public $table_name;

    public $width = 0;

    public $height;

    public $fields = [];

    public $height_cell = 6;

    public $x;

    public $y;

    public $primary = [];

    /**
     * Sets the width of the table
     *
     * @param mixed $ff
     *
     * @global  object    The current PDF document
     *
     * @see     PMA_PDF
     */
    public function PMA_RT_Table_setWidth($ff)
    {
        //  this looks buggy to me... does it really work if

        //  there are fields that require wider cells than the name of the table?

        global $pdf;

        foreach ($this->fields as $field) {
            $this->width = max($this->width, $pdf->GetStringWidth($field));
        }

        $this->width += $pdf->GetStringWidth('  ');

        $pdf->SetFont($ff, 'B');

        $this->width = max($this->width, $pdf->GetStringWidth('  ' . $this->table_name));

        $pdf->SetFont($ff, '');
    }

    // end of the "PMA_RT_Table_setWidth()" method

    /**
     * Sets the height of the table
     */
    public function PMA_RT_Table_setHeight()
    {
        $this->height = (count($this->fields) + 1) * $this->height_cell;
    }

    // end of the "PMA_RT_Table_setHeight()" method

    /**
     * Do draw the table
     *
     * @param mixed $show_info
     * @param mixed $ff
     * @param mixed $setcolor
     *
     * @global  object    The current PDF document
     *
     * @see     PMA_PDF
     */
    public function PMA_RT_Table_draw($show_info, $ff, $setcolor = 0)
    {
        global $pdf, $with_doc;

        $pdf->PMA_PDF_setXyScale($this->x, $this->y);

        $pdf->SetFont($ff, 'B');

        if ($setcolor) {
            $pdf->SetTextColor(200);

            $pdf->SetFillColor(0, 0, 128);
        }

        if ($with_doc) {
            $pdf->SetLink($pdf->PMA_links['RT'][$this->table_name]['-'], -1);
        } else {
            $pdf->PMA_links['doc'][$this->table_name]['-'] = '';
        }

        if ($show_info) {
            $pdf->PMA_PDF_cellScale($this->width, $this->height_cell, sprintf('%.0f', $this->width) . 'x' . sprintf('%.0f', $this->height) . ' ' . $this->table_name, 1, 1, 'C', $setcolor, $pdf->PMA_links['doc'][$this->table_name]['-']);
        } else {
            $pdf->PMA_PDF_cellScale($this->width, $this->height_cell, $this->table_name, 1, 1, 'C', $setcolor, $pdf->PMA_links['doc'][$this->table_name]['-']);
        }

        $pdf->PMA_PDF_setXScale($this->x);

        $pdf->SetFont($ff, '');

        $pdf->SetTextColor(0);

        $pdf->SetFillColor(255);

        foreach ($this->fields as $field) {
            // loic1 : PHP3 fix

            // if (in_array($field, $this->primary)) {

            if ($setcolor) {
                if (-1 != PMA_isInto($field, $this->primary)) {
                    $pdf->SetFillColor(215, 121, 123);
                }

                if ($field == $this->displayfield) {
                    $pdf->SetFillColor(142, 159, 224);
                }
            }

            if ($with_doc) {
                $pdf->SetLink($pdf->PMA_links['RT'][$this->table_name][$field], -1);
            } else {
                $pdf->PMA_links['doc'][$this->table_name][$field] = '';
            }

            $pdf->PMA_PDF_cellScale($this->width, $this->height_cell, ' ' . $field, 1, 1, 'L', $setcolor, $pdf->PMA_links['doc'][$this->table_name][$field]);

            $pdf->PMA_PDF_setXScale($this->x);

            $pdf->SetFillColor(255);
        } // end while

        /*if ($pdf->PageNo() > 1) {
            $pdf->PMA_PDF_die($GLOBALS['strScaleFactorSmall']);
        } */
    }

    // end of the "PMA_RT_Table_draw()" method

    /**
     * The "PMA_RT_Table" constructor
     *
     * @param mixed $table_name
     * @param mixed $ff
     * @param mixed $same_wide_width
     *
     * @global  object    The current PDF document
     * @global  int   The current page number (from the
     *                    $cfg['Servers'][$i]['table_coords'] table)
     * @global  array     The relations settings
     * @global  string    The current db name
     *
     * @see     PMA_PDF, PMA_RT_Table::PMA_RT_Table_setWidth,
     *          PMA_RT_Table::PMA_RT_Table_setHeight
     */
    public function __construct($table_name, $ff, &$same_wide_width)
    {
        global $pdf, $pdf_page_number, $cfgRelation, $db;

        $this->table_name = $table_name;

        $sql = 'DESCRIBE ' . PMA_backquote($table_name);

        $result = PMA_DBI_try_query($sql);

        if (!$result || !PMA_DBI_num_rows($result)) {
            $pdf->PMA_PDF_die(sprintf($GLOBALS['strPdfInvalidTblName'], $table_name));
        }

        // load fields

        while (false !== ($row = PMA_DBI_fetch_row($result))) {
            $this->fields[] = $row[0];
        }

        //height and width

        $this->PMA_RT_Table_setWidth($ff);

        $this->PMA_RT_Table_setHeight();

        if ($same_wide_width < $this->width) {
            $same_wide_width = $this->width;
        }

        //x and y

        $sql = 'SELECT x, y FROM '
                . PMA_backquote($cfgRelation['table_coords'])
                . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                . ' AND   table_name = \'' . PMA_sqlAddslashes($table_name) . '\''
                . ' AND   pdf_page_number = ' . $pdf_page_number;

        $result = PMA_query_as_cu($sql);

        if (!$result || !PMA_DBI_num_rows($result)) {
            $pdf->PMA_PDF_die(sprintf($GLOBALS['strConfigureTableCoord'], $table_name));
        }

        [$this->x, $this->y] = PMA_DBI_fetch_row($result);

        $this->x = (float) $this->x;

        $this->y = (float) $this->y;

        // displayfield

        $this->displayfield = PMA_getDisplayField($db, $table_name);

        // index

        $result = PMA_DBI_query('SHOW INDEX FROM ' . PMA_backquote($table_name) . ';');

        if (PMA_DBI_num_rows($result) > 0) {
            while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
                if ('PRIMARY' == $row['Key_name']) {
                    $this->primary[] = $row['Column_name'];
                }
            }
        } // end if
    }

    // end of the "PMA_RT_Table()" method
} // end class "PMA_RT_Table"

/**
 * Draws relation links
 *
 *
 * @see     PMA_RT
 */
class PMA_RT_Relation
{
    /**
     * Defines private properties
     */

    public $x_src;

    public $y_src;

    public $src_dir;

    public $dest_dir;

    public $x_dest;

    public $y_dest;

    public $w_tick = 5;

    /**
     * Gets arrows coordinates
     *
     * @param mixed $table
     * @param mixed $column
     *
     * @return  array     Arrows coordinates
     */
    public function PMA_RT_Relation_getXy($table, $column)
    {
        $pos = array_search($column, $table->fields, true);

        // x_left, x_right, y

        return [$table->x, $table->x + +$table->width, $table->y + ($pos + 1.5) * $table->height_cell];
    }

    // end of the "PMA_RT_Relation_getXy()" method

    /**
     * Do draws relation links
     *
     * @param mixed $change_color
     * @param mixed $i
     *
     * @global  object    The current PDF document
     *
     * @see     PMA_PDF
     */
    public function PMA_RT_Relation_draw($change_color, $i)
    {
        global $pdf;

        if ($change_color) {
            $d = $i % 6;

            $j = ($i - $d) / 6;

            $j %= 4;

            $j++;

            $case = [
                        [1, 0, 0],
                        [0, 1, 0],
                        [0, 0, 1],
                        [1, 1, 0],
                        [1, 0, 1],
                        [0, 1, 1],
                    ];

            [$a, $b, $c] = $case[$d];

            $e = (1 - ($j - 1) / 6);

            $pdf->SetDrawColor($a * 255 * $e, $b * 255 * $e, $c * 255 * $e);
        } else {
            $pdf->SetDrawColor(0);
        } // end if... else...

        $pdf->PMA_PDF_setLineWidthScale(0.2);

        $pdf->PMA_PDF_lineScale($this->x_src, $this->y_src, $this->x_src + $this->src_dir * $this->w_tick, $this->y_src);

        $pdf->PMA_PDF_lineScale($this->x_dest + $this->dest_dir * $this->w_tick, $this->y_dest, $this->x_dest, $this->y_dest);

        $pdf->PMA_PDF_setLineWidthScale(0.1);

        $pdf->PMA_PDF_lineScale($this->x_src + $this->src_dir * $this->w_tick, $this->y_src, $this->x_dest + $this->dest_dir * $this->w_tick, $this->y_dest);

        //arrow

        $root2 = 2 * sqrt(2);

        $pdf->PMA_PDF_lineScale($this->x_src + $this->src_dir * $this->w_tick * 0.75, $this->y_src, $this->x_src + $this->src_dir * (0.75 - 1 / $root2) * $this->w_tick, $this->y_src + $this->w_tick / $root2);

        $pdf->PMA_PDF_lineScale($this->x_src + $this->src_dir * $this->w_tick * 0.75, $this->y_src, $this->x_src + $this->src_dir * (0.75 - 1 / $root2) * $this->w_tick, $this->y_src - $this->w_tick / $root2);

        $pdf->PMA_PDF_lineScale($this->x_dest + $this->dest_dir * $this->w_tick / 2, $this->y_dest, $this->x_dest + $this->dest_dir * (0.5 + 1 / $root2) * $this->w_tick, $this->y_dest + $this->w_tick / $root2);

        $pdf->PMA_PDF_lineScale($this->x_dest + $this->dest_dir * $this->w_tick / 2, $this->y_dest, $this->x_dest + $this->dest_dir * (0.5 + 1 / $root2) * $this->w_tick, $this->y_dest - $this->w_tick / $root2);

        $pdf->SetDrawColor(0);
    }

    // end of the "PMA_RT_Relation_draw()" method

    /**
     * The "PMA_RT_Relation" constructor
     *
     * @param mixed $master_table
     * @param mixed $master_field
     * @param mixed $foreign_table
     * @param mixed $foreign_field
     *
     * @see     PMA_RT_Relation::PMA_RT_Relation_getXy
     */
    public function __construct($master_table, $master_field, $foreign_table, $foreign_field)
    {
        $src_pos = $this->PMA_RT_Relation_getXy($master_table, $master_field);

        $dest_pos = $this->PMA_RT_Relation_getXy($foreign_table, $foreign_field);

        $src_left = $src_pos[0] - $this->w_tick;

        $src_right = $src_pos[1] + $this->w_tick;

        $dest_left = $dest_pos[0] - $this->w_tick;

        $dest_right = $dest_pos[1] + $this->w_tick;

        $d1 = abs($src_left - $dest_left);

        $d2 = abs($src_right - $dest_left);

        $d3 = abs($src_left - $dest_right);

        $d4 = abs($src_right - $dest_right);

        $d = min($d1, $d2, $d3, $d4);

        if ($d == $d1) {
            $this->x_src = $src_pos[0];

            $this->src_dir = -1;

            $this->x_dest = $dest_pos[0];

            $this->dest_dir = -1;
        } else {
            if ($d == $d2) {
                $this->x_src = $src_pos[1];

                $this->src_dir = 1;

                $this->x_dest = $dest_pos[0];

                $this->dest_dir = -1;
            } else {
                if ($d == $d3) {
                    $this->x_src = $src_pos[0];

                    $this->src_dir = -1;

                    $this->x_dest = $dest_pos[1];

                    $this->dest_dir = 1;
                } else {
                    $this->x_src = $src_pos[1];

                    $this->src_dir = 1;

                    $this->x_dest = $dest_pos[1];

                    $this->dest_dir = 1;
                }
            }
        }

        $this->y_src = $src_pos[2];

        $this->y_dest = $dest_pos[2];
    }

    // end of the "PMA_RT_Relation()" method
} // end of the "PMA_RT_Relation" class

/**
 * Draws and send the database schema
 *
 *
 * @see     PMA_PDF
 */
class PMA_RT
{
    /**
     * Defines private properties
     */

    public $tables = [];

    public $relations = [];

    public $ff = 'Arial';

    public $x_max = 0;

    public $y_max = 0;

    public $scale;

    public $x_min = 100000;

    public $y_min = 100000;

    public $t_marg = 10;

    public $b_marg = 10;

    public $l_marg = 10;

    public $r_marg = 10;

    public $tablewidth;

    public $same_wide = 0;

    /**
     * Sets X and Y minimum and maximum for a table cell
     *
     * @param mixed $table
     */
    public function PMA_RT_setMinMax($table)
    {
        $this->x_max = max($this->x_max, $table->x + $table->width);

        $this->y_max = max($this->y_max, $table->y + $table->height);

        $this->x_min = min($this->x_min, $table->x);

        $this->y_min = min($this->y_min, $table->y);
    }

    // end of the "PMA_RT_setMinMax()" method

    /**
     * Defines relation objects
     *
     * @param mixed $master_table
     * @param mixed $master_field
     * @param mixed $foreign_table
     * @param mixed $foreign_field
     *
     * @see     PMA_RT_setMinMax()
     */
    public function PMA_RT_addRelation($master_table, $master_field, $foreign_table, $foreign_field)
    {
        if (!isset($this->tables[$master_table])) {
            $this->tables[$master_table] = new PMA_RT_Table($master_table, $this->ff, $this->tablewidth);

            $this->PMA_RT_setMinMax($this->tables[$master_table]);
        }

        if (!isset($this->tables[$foreign_table])) {
            $this->tables[$foreign_table] = new PMA_RT_Table($foreign_table, $this->ff, $this->tablewidth);

            $this->PMA_RT_setMinMax($this->tables[$foreign_table]);
        }

        $this->relations[] = new PMA_RT_Relation($this->tables[$master_table], $master_field, $this->tables[$foreign_table], $foreign_field);
    }

    // end of the "PMA_RT_addRelation()" method

    /**
     * Draws the grid
     *
     * @global  object  the current PMA_PDF instance
     *
     * @see     PMA_PDF
     */
    public function PMA_RT_strokeGrid()
    {
        global $pdf;

        $pdf->SetMargins(0, 0);

        $pdf->SetDrawColor(200, 200, 200);

        // Draws horizontal lines

        for ($l = 0; $l < 21; $l++) {
            $pdf->Line(0, $l * 10, $pdf->fh, $l * 10);

            // Avoid duplicates

            if ($l > 0) {
                $pdf->SetXY(0, $l * 10);

                $label = (string) sprintf('%.0f', ($l * 10 - $this->t_marg) * $this->scale + $this->y_min);

                $pdf->Cell(5, 5, ' ' . $label);
            } // end if
        } // end for

        // Draws vertical lines

        for ($j = 0; $j < 30; $j++) {
            $pdf->Line($j * 10, 0, $j * 10, $pdf->fw);

            $pdf->SetXY($j * 10, 0);

            $label = (string) sprintf('%.0f', ($j * 10 - $this->l_marg) * $this->scale + $this->x_min);

            $pdf->Cell(5, 7, $label);
        } // end for
    }

    // end of the "PMA_RT_strokeGrid()" method

    /**
     * Draws relation arrows
     *
     * @param mixed $change_color
     *
     * @see     PMA_RT_Relation::PMA_RT_Relation_draw()
     */
    public function PMA_RT_drawRelations($change_color)
    {
        $i = 0;

        foreach ($this->relations as $relation) {
            $relation->PMA_RT_Relation_draw($change_color, $i);

            $i++;
        } // end while
    }

    // end of the "PMA_RT_drawRelations()" method

    /**
     * Draws tables
     *
     * @param mixed $show_info
     * @param mixed $draw_color
     *
     * @see     PMA_RT_Table::PMA_RT_Table_draw()
     */
    public function PMA_RT_drawTables($show_info, $draw_color = 0)
    {
        foreach ($this->tables as $table) {
            $table->PMA_RT_Table_draw($show_info, $this->ff, $draw_color);
        }
    }

    // end of the "PMA_RT_drawTables()" method

    /**
     * Ouputs the PDF document to a file
     *
     * @global  object   The current PDF document
     * @global  string   The current database name
     * @global  int  The current page number (from the
     *                   $cfg['Servers'][$i]['table_coords'] table)
     *
     * @see     PMA_PDF
     */
    public function PMA_RT_showRt()
    {
        global $pdf, $db, $pdf_page_number, $cfgRelation;

        $pdf->SetFontSize(14);

        $pdf->SetLineWidth(0.2);

        $pdf->SetDisplayMode('fullpage');

        //  Get the name of this pdfpage to use as filename (Mike Beck)

        $_name_sql = 'SELECT page_descr FROM ' . PMA_backquote($cfgRelation['pdf_pages'])
                  . ' WHERE page_nr = ' . $pdf_page_number;

        $_name_rs = PMA_query_as_cu($_name_sql);

        if ($_name_rs) {
            $_name_row = PMA_DBI_fetch_row($_name_rs);

            $filename = $_name_row[0] . '.pdf';
        }

        // i don't know if there is a chance for this to happen, but rather be on the safe side:

        if (empty($filename)) {
            $filename = $pdf_page_number . '.pdf';
        }

        $pdf->Output($db . '_' . $filename, true);

        //$pdf->Output('', TRUE);
    }

    // end of the "PMA_RT_showRt()" method

    /**
     * The "PMA_RT" constructor
     *
     * @param mixed $which_rel
     * @param mixed $show_info
     * @param mixed $change_color
     * @param mixed $show_grid
     * @param mixed $all_tab_same_wide
     * @param mixed $orientation
     * @param mixed $paper
     *
     * @global  object   The current PDF document
     * @global  string   The current db name
     * @global  array    The relations settings
     *
     * @see     PMA_PDF
     */
    public function __construct($which_rel, $show_info = 0, $change_color = 0, $show_grid = 0, $all_tab_same_wide = 0, $orientation = 'L', $paper = 'A4')
    {
        global $pdf, $db, $cfgRelation, $with_doc;

        // Font face depends on the current language

        $this->ff = str_replace('"', '', mb_substr($GLOBALS['right_font_family'], 0, mb_strpos($GLOBALS['right_font_family'], ',')));

        $this->same_wide = $all_tab_same_wide;

        // Initializes a new document

        $pdf = new PMA_PDF('L', 'mm', $paper);

        $pdf->title = sprintf($GLOBALS['strPdfDbSchema'], $GLOBALS['db'], $which_rel);

        $pdf->cMargin = 0;

        $pdf->Open();

        $pdf->SetTitle($pdf->title);

        $pdf->SetAuthor('phpMyAdmin ' . PMA_VERSION);

        $pdf->AliasNbPages();

        // fonts added to phpMyAdmin and considered non-standard by fpdf

        // (Note: those tahoma fonts are iso-8859-2 based)

        if ('tahoma' == $this->ff) {
            $pdf->AddFont('tahoma', '', 'tahoma.php');

            $pdf->AddFont('tahoma', 'B', 'tahomab.php');
        }

        $pdf->SetFont($this->ff, '', 14);

        $pdf->SetAutoPageBreak('auto');

        // Gets tables on this page

        $tab_sql = 'SELECT table_name FROM ' . PMA_backquote($cfgRelation['table_coords'])
                  . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                  . ' AND pdf_page_number = ' . $which_rel;

        $tab_rs = PMA_query_as_cu($tab_sql);

        if (!$tab_rs || !PMA_DBI_num_rows($tab_rs) > 0) {
            $pdf->PMA_PDF_die($GLOBALS['strPdfNoTables']);
//            die('No tables');
        }

        while (false !== ($curr_table = @PMA_DBI_fetch_assoc($tab_rs))) {
            $alltables[] = PMA_sqlAddslashes($curr_table['table_name']);

            //$intable     = '\'' . implode('\', \'', $alltables) . '\'';
        }

        //              make doc                    //

        if ($with_doc) {
            $pdf->SetAutoPageBreak('auto', 15);

            $pdf->cMargin = 1;

            PMA_RT_DOC($alltables);

            $pdf->SetAutoPageBreak('auto');

            $pdf->cMargin = 0;
        }

        $pdf->AddPage();

        if ($with_doc) {
            $pdf->SetLink($pdf->PMA_links['RT']['-'], -1);

            $pdf->Bookmark($GLOBALS['strRelationalSchema']);

            $pdf->SetAlias('{00}', $pdf->PageNo());

            $this->t_marg = 18;

            $this->b_marg = 18;
        }

        /* snip */

        foreach ($alltables as $table) {
            if (!isset($this->tables[$table])) {
                $this->tables[$table] = new PMA_RT_Table($table, $this->ff, $this->tablewidth);
            }

            if ($this->same_wide) {
                $this->tables[$table]->width = $this->tablewidth;
            }

            $this->PMA_RT_setMinMax($this->tables[$table]);
        }

        // Defines the scale factor

        $this->scale = ceil(max(($this->x_max - $this->x_min) / ($pdf->fh - $this->r_marg - $this->l_marg), ($this->y_max - $this->y_min) / ($pdf->fw - $this->t_marg - $this->b_marg)) * 100) / 100;

        $pdf->PMA_PDF_setScale($this->scale, $this->x_min, $this->y_min, $this->l_marg, $this->t_marg);

        // Builds and save the PDF document

        $pdf->PMA_PDF_setLineWidthScale(0.1);

        if ($show_grid) {
            $pdf->SetFontSize(10);

            $this->PMA_RT_strokeGrid();
        }

        $pdf->PMA_PDF_setFontSizeScale(14);

//        $sql    = 'SELECT * FROM ' . PMA_backquote($cfgRelation['relation'])
//                .   ' WHERE master_db   = \'' . PMA_sqlAddslashes($db) . '\' '
//                .   ' AND foreign_db    = \'' . PMA_sqlAddslashes($db) . '\' '
//                .   ' AND master_table  IN (' . $intable . ')'
//                .   ' AND foreign_table IN (' . $intable . ')';
//        $result =  PMA_query_as_cu($sql);
//

        // lem9:

        // previous logic was checking master tables and foreign tables

        // but I think that looping on every table of the pdf page as a master

        // and finding its foreigns is OK (then we can support innodb)

        $seen_a_relation = false;

        foreach ($alltables as $one_table) {
            $exist_rel = PMA_getForeigners($db, $one_table, '', 'both');

            if ($exist_rel) {
                $seen_a_relation = true;

                foreach ($exist_rel as $master_field => $rel) {
                    // put the foreign table on the schema only if selected

                    // by the user

                    // (do not use array_search() because we would have to

                    // to do a === FALSE and this is not PHP3 compatible)

                    if (PMA_isInto($rel['foreign_table'], $alltables) > -1) {
                        $this->PMA_RT_addRelation($one_table, $master_field, $rel['foreign_table'], $rel['foreign_field']);
                    }
                } // end while
            } // end if
        } // end while

        // loic1: also show tables without relations
//        $norelations     = TRUE;
//        if ($result && PMA_DBI_num_rows($result) > 0) {
//            $norelations = FALSE;
//            while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
//                $this->PMA_RT_addRelation($row['master_table'] , $row['master_field'], $row['foreign_table'], $row['foreign_field']);
//            }
//        }

//        if ($norelations === false) {

        if ($seen_a_relation) {
            $this->PMA_RT_drawRelations($change_color);
        }

        $this->PMA_RT_drawTables($show_info, $change_color);

        $this->PMA_RT_showRt();
    }

    // end of the "PMA_RT()" method
} // end of the "PMA_RT" class

function PMA_RT_DOC($alltables)
{
    global  $db, $pdf, $orientation, $paper;

    //TOC

    $pdf->AddPage($GLOBALS['orientation']);

    $pdf->Cell(0, 9, $GLOBALS['strTableOfContents'], 1, 0, 'C');

    $pdf->Ln(15);

    $i = 1;

    foreach ($alltables as $table) {
        $pdf->PMA_links['doc'][$table]['-'] = $pdf->AddLink();

        $pdf->SetX(10);

        //$pdf->Ln(1);

        $pdf->Cell(0, 6, $GLOBALS['strPageNumber'] . ' {' . sprintf('%02d', $i) . '}', 0, 0, 'R', 0, $pdf->PMA_links['doc'][$table]['-']);

        $pdf->SetX(10);

        $pdf->Cell(0, 6, $i . ' ' . $table, 0, 1, 'L', 0, $pdf->PMA_links['doc'][$table]['-']);

        //$pdf->Ln(1);

        $result = PMA_DBI_query('SHOW FIELDS FROM ' . PMA_backquote($table) . ';');

        while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
            $pdf->SetX(20);

            $field_name = $row['Field'];

            $pdf->PMA_links['doc'][$table][$field_name] = $pdf->AddLink();

            //$pdf->Cell(0,6,$field_name,0,1,'L',0,$pdf->PMA_links['doc'][$table][$field_name]);
        }

        $lasttable = $table;

        $i++;
    }

    $pdf->PMA_links['RT']['-'] = $pdf->AddLink();

    $pdf->SetX(10);

    $pdf->Cell(0, 6, $GLOBALS['strPageNumber'] . ' {00}', 0, 0, 'R', 0, $pdf->PMA_links['doc'][$lasttable]['-']);

    $pdf->SetX(10);

    $pdf->Cell(0, 6, $i . ' ' . $GLOBALS['strRelationalSchema'], 0, 1, 'L', 0, $pdf->PMA_links['RT']['-']);

    $z = 0;

    foreach ($alltables as $table) {
        $z++;

        $pdf->AddPage($GLOBALS['orientation']);

        $pdf->Bookmark($table);

        $pdf->SetAlias('{' . sprintf('%02d', $z) . '}', $pdf->PageNo());

        $pdf->PMA_links['RT'][$table]['-'] = $pdf->AddLink();

        $pdf->SetLink($pdf->PMA_links['doc'][$table]['-'], -1);

        $pdf->SetFont('', 'B', 18);

        $pdf->Cell(0, 8, $z . ' ' . $table, 1, 1, 'C', 0, $pdf->PMA_links['RT'][$table]['-']);

        $pdf->SetFont('', '', 8);

        $pdf->Ln();

        $cfgRelation = PMA_getRelationsParam();

        if ($cfgRelation['commwork']) {
            $comments = PMA_getComments($db, $table);
        }

        if ($cfgRelation['mimework']) {
            $mime_map = PMA_getMIME($db, $table, true);
        }

        /**
         * Gets table informations
         */

        $result = PMA_DBI_query('SHOW TABLE STATUS LIKE \'' . PMA_sqlAddslashes($table, true) . '\';');

        $showtable = PMA_DBI_fetch_assoc($result);

        $num_rows = ($showtable['Rows'] ?? 0);

        $show_comment = ($showtable['Comment'] ?? '');

        $create_time = (isset($showtable['Create_time']) ? PMA_localisedDate(strtotime($showtable['Create_time'])) : '');

        $update_time = (isset($showtable['Update_time']) ? PMA_localisedDate(strtotime($showtable['Update_time'])) : '');

        $check_time = (isset($showtable['Check_time']) ? PMA_localisedDate(strtotime($showtable['Check_time'])) : '');

        PMA_DBI_free_result($result);

        unset($result);

        /**
         * Gets table keys and retains them
         */

        $result = PMA_DBI_query('SHOW KEYS FROM ' . PMA_backquote($table) . ';');

        $primary = '';

        $indexes = [];

        $lastIndex = '';

        $indexes_info = [];

        $indexes_data = [];

        $pk_array = []; // will be use to emphasis prim. keys in the table

        // view

        while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
            // Backups the list of primary keys

            if ('PRIMARY' == $row['Key_name']) {
                $primary .= $row['Column_name'] . ', ';

                $pk_array[$row['Column_name']] = 1;
            }

            // Retains keys informations

            if ($row['Key_name'] != $lastIndex) {
                $indexes[] = $row['Key_name'];

                $lastIndex = $row['Key_name'];
            }

            $indexes_info[$row['Key_name']]['Sequences'][] = $row['Seq_in_index'];

            $indexes_info[$row['Key_name']]['Non_unique'] = $row['Non_unique'];

            if (isset($row['Cardinality'])) {
                $indexes_info[$row['Key_name']]['Cardinality'] = $row['Cardinality'];
            }

            // I don't know what does following column mean....

            // $indexes_info[$row['Key_name']]['Packed']          = $row['Packed'];

            $indexes_info[$row['Key_name']]['Comment'] = $row['Comment'];

            $indexes_data[$row['Key_name']][$row['Seq_in_index']]['Column_name'] = $row['Column_name'];

            if (isset($row['Sub_part'])) {
                $indexes_data[$row['Key_name']][$row['Seq_in_index']]['Sub_part'] = $row['Sub_part'];
            }
        } // end while

        if ($result) {
            PMA_DBI_free_result($result);
        }

        /**
         * Gets fields properties
         */

        $result = PMA_DBI_query('SHOW FIELDS FROM ' . PMA_backquote($table) . ';');

        $fields_cnt = PMA_DBI_num_rows($result);

        // Check if we can use Relations (Mike Beck)

        if (!empty($cfgRelation['relation'])) {
            // Find which tables are related with the current one and write it in

            // an array

            $res_rel = PMA_getForeigners($db, $table);

            if (count($res_rel) > 0) {
                $have_rel = true;
            } else {
                $have_rel = false;
            }
        } else {
            $have_rel = false;
        } // end if

        /**
         * Displays the comments of the table if MySQL >= 3.23
         */

        $break = false;

        if (!empty($show_comment)) {
            $pdf->Cell(0, 3, $GLOBALS['strTableComments'] . ' : ' . $show_comment, 0, 1);

            $break = true;
        }

        if (!empty($create_time)) {
            $pdf->Cell(0, 3, $GLOBALS['strStatCreateTime'] . ': ' . $create_time, 0, 1);

            $break = true;
        }

        if (!empty($update_time)) {
            $pdf->Cell(0, 3, $GLOBALS['strStatUpdateTime'] . ': ' . $update_time, 0, 1);

            $break = true;
        }

        if (!empty($check_time)) {
            $pdf->Cell(0, 3, $GLOBALS['strStatCheckTime'] . ': ' . $check_time, 0, 1);

            $break = true;
        }

        if (true === $break) {
            $pdf->Cell(0, 3, '', 0, 1);

            $pdf->Ln();
        }

        $i = 0;

        $pdf->SetFont('', 'B');

        if (isset($orientation) && 'L' == $orientation) {
            $pdf->Cell(25, 8, ucfirst($GLOBALS['strField']), 1, 0, 'C');

            $pdf->Cell(20, 8, ucfirst($GLOBALS['strType']), 1, 0, 'C');

            $pdf->Cell(20, 8, ucfirst($GLOBALS['strAttr']), 1, 0, 'C');

            $pdf->Cell(10, 8, ucfirst($GLOBALS['strNull']), 1, 0, 'C');

            $pdf->Cell(20, 8, ucfirst($GLOBALS['strDefault']), 1, 0, 'C');

            $pdf->Cell(25, 8, ucfirst($GLOBALS['strExtra']), 1, 0, 'C');

            $pdf->Cell(45, 8, ucfirst($GLOBALS['strLinksTo']), 1, 0, 'C');

            if ('A4' == $paper) {
                $comments_width = 67;
            } else {
                // this is really intended for 'letter'

                // TODO: find optimal width for all formats

                $comments_width = 50;
            }

            $pdf->Cell($comments_width, 8, ucfirst($GLOBALS['strComments']), 1, 0, 'C');

            $pdf->Cell(45, 8, 'MIME', 1, 1, 'C');

            $pdf->SetWidths([25, 20, 20, 10, 20, 25, 45, $comments_width, 45]);
        } else {
            $pdf->Cell(20, 8, ucfirst($GLOBALS['strField']), 1, 0, 'C');

            $pdf->Cell(20, 8, ucfirst($GLOBALS['strType']), 1, 0, 'C');

            $pdf->Cell(20, 8, ucfirst($GLOBALS['strAttr']), 1, 0, 'C');

            $pdf->Cell(10, 8, ucfirst($GLOBALS['strNull']), 1, 0, 'C');

            $pdf->Cell(15, 8, ucfirst($GLOBALS['strDefault']), 1, 0, 'C');

            $pdf->Cell(15, 8, ucfirst($GLOBALS['strExtra']), 1, 0, 'C');

            $pdf->Cell(30, 8, ucfirst($GLOBALS['strLinksTo']), 1, 0, 'C');

            $pdf->Cell(30, 8, ucfirst($GLOBALS['strComments']), 1, 0, 'C');

            $pdf->Cell(30, 8, 'MIME', 1, 1, 'C');

            $pdf->SetWidths([20, 20, 20, 10, 15, 15, 30, 30, 30]);
        }

        $pdf->SetFont('', '');

        while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
            $bgcolor = ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo'];

            $i++;

            $type = $row['Type'];

            // reformat mysql query output - staybyte - 9. June 2001

            // loic1: set or enum types: slashes single quotes inside options

            if (preg_match('@^(set|enum)\((.+)\)$@i', $type, $tmp)) {
                $tmp[2] = mb_substr(preg_replace("@([^,])''@", "\\1\\'", ',' . $tmp[2]), 1);

                $type = $tmp[1] . '(' . str_replace(',', ', ', $tmp[2]) . ')';

                $type_nowrap = '';

                $binary = 0;

                $unsigned = 0;

                $zerofill = 0;
            } else {
                $type_nowrap = ' nowrap="nowrap"';

                $type = str_ireplace("BINARY", '', $type);

                $type = str_ireplace("ZEROFILL", '', $type);

                $type = str_ireplace("UNSIGNED", '', $type);

                if (empty($type)) {
                    $type = '&nbsp;';
                }

                $binary = mb_stristr($row['Type'], 'BINARY');

                $unsigned = mb_stristr($row['Type'], 'UNSIGNED');

                $zerofill = mb_stristr($row['Type'], 'ZEROFILL');
            }

            $strAttribute = ' ';

            if ($binary) {
                $strAttribute = 'BINARY';
            }

            if ($unsigned) {
                $strAttribute = 'UNSIGNED';
            }

            if ($zerofill) {
                $strAttribute = 'UNSIGNED ZEROFILL';
            }

            if (!isset($row['Default'])) {
                if ('' != $row['Null']) {
                    $row['Default'] = 'NULL';
                }
            }

            $field_name = $row['Field'];

            //$pdf->Ln();

            $pdf->PMA_links['RT'][$table][$field_name] = $pdf->AddLink();

            $pdf->Bookmark($field_name, 1, -1);

            $pdf->SetLink($pdf->PMA_links['doc'][$table][$field_name], -1);

            $pdf_row = [$field_name,
                        $type,
                        $strAttribute,
                        ('' == $row['Null']) ? $GLOBALS['strNo'] : $GLOBALS['strYes'],
                        ($row['Default'] ?? ''),
                            $row['Extra'],
                        ((isset($res_rel[$field_name])) ? $res_rel[$field_name]['foreign_table'] . ' -> ' . $res_rel[$field_name]['foreign_field'] : ''),
                        ($comments[$field_name] ?? ''),
                        ((isset($mime_map) && isset($mime_map[$field_name])) ? str_replace('_', '/', $mime_map[$field_name]['mimetype']) : ''),
                            ];

            $links[0] = $pdf->PMA_links['RT'][$table][$field_name];

            if (isset($res_rel[$field_name]['foreign_table']) and
                isset($res_rel[$field_name]['foreign_field']) and isset($pdf->PMA_links['doc'][$res_rel[$field_name]['foreign_table']][$res_rel[$field_name]['foreign_field']])
              ) {
                $links[6] = $pdf->PMA_links['doc'][$res_rel[$field_name]['foreign_table']][$res_rel[$field_name]['foreign_field']];
            } else {
                unset($links[6]);
            }

            $pdf->Row($pdf_row, $links);

            /*$pdf->Cell(20,8,$field_name,1,0,'L',0,$pdf->PMA_links['RT'][$table][$field_name]);
               //echo '    ' . $field_name . '&nbsp;' . "\n";
            }
        $pdf->Cell(20,8,$type,1,0,'L');
        $pdf->Cell(20,8,$strAttribute,1,0,'L');
        $pdf->Cell(15,8,,1,0,'L');
        $pdf->Cell(15,8,((isset($row['Default'])) ?  $row['Default'] : ''),1,0,'L');
        $pdf->Cell(15,8,$row['Extra'],1,0,'L');
           if ($have_rel) {
               if (isset($res_rel[$field_name])) {
                   $pdf->Cell(30,8,$res_rel[$field_name]['foreign_table'] . ' -> ' . $res_rel[$field_name]['foreign_field'],1,0,'L');
               }
            }
            if ($cfgRelation['commwork']) {
               if (isset($comments[$field_name])) {
                   $pdf->Cell(0,8,$comments[$field_name],1,0,'L');
               }
            } */
        } // end while

        $pdf->SetFont('', '', 14);

        PMA_DBI_free_result($result);
    }//end each
} // end function PMA_RT_DOC

/**
 * Main logic
 */
if (!isset($pdf_page_number)) {
    $pdf_page_number = 1;
}
$show_grid = (isset($show_grid) && 'on' == $show_grid) ? 1 : 0;
$show_color = (isset($show_color) && 'on' == $show_color) ? 1 : 0;
$show_table_dimension = (isset($show_table_dimension) && 'on' == $show_table_dimension) ? 1 : 0;
$all_tab_same_wide = (isset($all_tab_same_wide) && 'on' == $all_tab_same_wide) ? 1 : 0;
$with_doc = (isset($with_doc) && 'on' == $with_doc) ? 1 : 0;
$orientation = (isset($orientation) && 'P' == $orientation) ? 'P' : 'L';
$paper = $paper ?? 'A4';
PMA_DBI_select_db($db);

$rt = new PMA_RT($pdf_page_number, $show_table_dimension, $show_color, $show_grid, $all_tab_same_wide, $orientation, $paper);

<?php

class pdf extends FPDF {

    var $title = '';
    var $SubTitle = '';
    var $TitleHeader = '';
    var $Info = '';
    var $be_logo = '';
    var $orientation = 'L';
    var $unit = 'mm';
    var $size = 'A4';
    var $user = '';
    var $borderEnabled = false;
    var $widths = array();
    var $alignText = array();
    var $rowNameHead = array();
    var $wrapLines = false;
    var $heightHead = 0;

    function __construct($config = array()) {
        if (count($config) > 0)
            $this->initialize($config);
        $this->FPDF($this->orientation, $this->unit, $this->size);
        $this->SetAuthor('LSTR-NR');
        $this->SetFont("Arial", "B", 13);
        $this->SetMargins(5, 5);
    }

    private function initialize($config = array()) {
        foreach ($config as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    private function getWidthPage() {
        return round($this->w - $this->lMargin, 2);
    }

    private function getSizeHead() {
        return $this->heightHead;
    }

    private function getSizeFoot() {
        return round($this->h - 15, 2);
    }

    function setBorderEnabled($enabled) {
        $this->borderEnabled = $enabled;
    }

    private function AddLine($y = 0) {
        $posLeft = $this->lMargin;
        $this->line($posLeft, $y, $this->getWidthPage(), $y);
    }

    public function AddNameHead($data = array()) {
        $this->rowNameHead = $data;
    }

    public function AddValueConfig($data = array()) {
        $this->widths = $data["widths"];
        $this->alignText = $data["align"];
    }

    function addBorderExtrem($y) {
        $this->line($this->lMargin,$this->getSizeHead(),$this->lMargin, $y);
        $dist=$this->getWidthPage();
        $this->line($dist,$this->getSizeHead(), $dist, $y);
    }

    function heightLines($w, $str) {
        $lenT = ceil($this->GetStringWidth($str));
        $r = ceil(($lenT) / $w);
        $num = 1;
        if ($r == 1) {
            $num = 2;
        } else if ($r == 2) {
            $num = 5;
        } else if ($r == 3) {
            $num = 8;
        } else if ($r == 4) {
            $num = 11;
        }
        return ceil(($lenT + $num) / $w);
    }

    function PrintNameRow($data) {
        $i = 0;
        $this->SetFont('Arial', 'B', 7);
        foreach ($data as $cell) {
            $nameCol = explode("-", $cell);
            $w = $this->widths[$i];
            $a = isset($this->alignText[$i]) ? $this->alignText[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->MultiCell($w, 5, $nameCol[0], 0, $a, 0);
            $this->SetXY($x + $w, $y);
            $i++;
        }
    }

    function Header() {
        $wImage = 60;
        $posCenter = ($this->getWidthPage() / 2) - 50;
        $posLeft = $this->lMargin;
        $posRigth = $this->getWidthPage() - $wImage;

        $this->SetFont("Arial", "B", 15);
        $title = utf8_decode($this->title);
        $this->Text($posCenter, 9, $title, 0, 'C', 0);
        $this->Image($this->be_logo, $posRigth, 10, $wImage, 15);
        $this->Ln(10);
        $this->SetFont("Arial", "", 9);
        $org = utf8_decode($this->TitleHeader);
        $this->Text($posLeft, 15, utf8_decode($org), 0, 'C', 0);
        $org = utf8_decode($this->SubTitle);
        $this->Text($posLeft, 20, utf8_decode($org), 0, 'C', 0);
        $org = utf8_decode($this->Info);
        $this->Text($posLeft, 25, utf8_decode($org), 0, 'C', 0);
        $this->SetY(27);
        $this->AddLine($this->GetY());
        $yy = $this->GetY();
        $this->heightHead=$yy;
        foreach ($this->rowNameHead as $valH) {
            $this->PrintNameRow($valH);
            $yy+=5;
            $this->SetY($yy);
            $this->AddLine($this->GetY());
        }
    }

    function CheckPageBreak($h) {
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->Ln(20);
            $this->AddPage($this->CurOrientation);
        }
    }

    function addReportData($dataGrid, $fields, $colArray) {
        $this->SetFont('Arial', '', 7);
        $lastOrg = "";
        foreach ($dataGrid as $val) {
            $nb = 0;
            $i = 0;
            foreach ($fields as $f) {
                $nb = max($nb, $this->heightLines($this->widths[$i], $val[$colArray[$f - 1]]));
                $i++;
            }
            $this->CheckPageBreak(5 * $nb);
            $h = 0;
            $i = 0;

            $newOrg = "";
            if ($this->wrapLines) {
                if ($lastOrg != $val[$colArray[$i]]) {
                    $newOrg = $val[$colArray[$i]];
                }
                $lastOrg = $val[$colArray[$i]];
                $val[$colArray[$i]] = $newOrg;
            }

            foreach ($fields as $f) {
                $w = $this->widths[$i];
                $a = isset($this->alignText[$i]) ? $this->alignText[$i] : 'L';
                $x = $this->GetX();
                $y = $this->GetY();
                $valuePrint = $val[$colArray[$i++]];
                $needLine = true;
                if (is_array($valuePrint)) {
                    $needLine = false;
                    $sizeArr = count($valuePrint);
                    $count = 1;
                    foreach ($valuePrint as $valP) {
//                        $textCell = strtoupper(utf8_decode($valP));
                        $textCell = utf8_decode($valP);
                        $textCell=($textCell!="0000-00-00 00:00:00")?$textCell:"";
                        $this->MultiCell($w, 5, $textCell . $sizeArr, 0, $a, 0);
                        if ($count < $sizeArr)
                            $this->SetXY($x, $this->GetY());
                        $count++;
                    }
                } else {
//                    $textCell = strtoupper(utf8_decode($valuePrint));
                    $textCell = utf8_decode($valuePrint);
                    $textCell=($textCell!="0000-00-00 00:00:00")?$textCell:"";
                    $h = max($h, ($this->heightLines($w, $textCell)) * 5);
                    $this->MultiCell($w, 5, $textCell, 0, $a, 0);
                    $this->SetXY($x + $w, $y);
                }
            }
            $x1 = $this->lMargin;
            for ($index = 0; $index < $i - 1; $index++) {
                if ($val[$colArray[$index]] == "") {
                    $x1+=$this->widths[$index];
                    if (!isset($Rects[$index])) {
                        $Rects[$index] = $x1;
                    }
                }
            }
            if ($needLine)
                $this->Ln($h);
            if (!$this->wrapLines) {
                $this->AddLine($this->GetY());
            } else if ($newOrg != "") {
                $this->AddLine($y);
            }
        }
        if ($this->wrapLines) {
            $this->AddLine($this->GetY());
        }
        if ($this->borderEnabled) {
            $this->addBorderExtrem($this->GetY());
            if (isset($Rects))
                foreach ($Rects as $Rect) {
                    $this->line($Rect, $this->getSizeHead(), $Rect, $this->GetY());
                }
        }
    }

    function Footer() {
        $userPr = $this->user;
        $datePr = date("d/m/yy  h:i A");
        $CadPr = utf8_encode("Fecha Impresion: ");
        $pagina = utf8_encode('Pagina ');
        $posImage = $this->getWidthPage() / 2;
        $posRigth = $this->getWidthPage() - 30;
        $y = $this->getSizeFoot();

        $this->SetY($y);
        $this->AddLine($y);
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(25, 10, utf8_decode($CadPr), 0, 0, 'L');
        $this->SetFont('Arial', '', 7);
        $this->Cell(50, 10, $datePr, 0, 0, 'L');
        $this->SetX($posRigth);
        $this->Cell(50, 10, utf8_decode($pagina) . $this->PageNo() . ' de {nb}', 0, 0, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(25, 20, 'Usuario: ', 0, 0, 'L');
        $this->SetFont('Arial', '', 7);
        $this->Cell(10, 20, $userPr, 0, 0, 'L');
    }

}

?>
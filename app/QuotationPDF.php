<?php
namespace App;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\SystemSetting;
class QuotationPDF extends FPDF

{
var $widths;
var $aligns;
var $invID = 0 ;
var $invdate;
var $amount;

public function setValues($id,$date,$amnt)
{
	global $invID;
	global $invdate;
	global $amount;
	$invdate = $date;
	$invID = $id;
	$amount = $amnt;
	
}

function Header()
{
	global $invID;
	global $invdate;
	global $amount;
	// Logo
	$this->SetFont('Times','B',13);
	$this->SetFillColor(237, 228, 226);
	$this-> Cell(195, 10, "QUOTATION" ,1, 0, 'C', 1, '');
	$this->Ln();
	$this-> Cell(195, 40, " " ,1, 0, 'C', 0, '');
	$this->Ln(1);
	$this->Image('logo.png',10,22,30);
	//$this->Image('donbosco.png',170,20,40);
    // Arial bold 15
    
    // Move to the right
    
	// Title
	$this->SetFont('Times','',11);
	$systeminfo = SystemSetting::find(1);
	$title = $systeminfo->name;
	$address = $systeminfo->address;
	$email = $systeminfo->email;
	$phone = $systeminfo->phone;

	$this->Ln(5);
	
	$this->Cell(40,0,'',0,0,'C');
	$this->Cell(110,0,strtoupper($title),0,0,'L');
	$this-> Cell(45, 0, "Quotation No. : "."INV0".$invID,0, 0, 'L', 0, '');
	$this->Ln(7);
	$this->Cell(40,0,'',0,0,'C');
	$this->Cell(110,0,strtoupper($address),0,0,'L');
	$this-> Cell(45, 0, "Date : ".date('d-m-Y', strtotime($invdate)),0, 0, 'L', 0, '');
	$this->Ln(7);
	$this->Cell(40,0,'',0,0,'C');
	$this->Cell(110,0,strtolower($email),0,0,'L');
	$this-> Cell(45, 0, "Amount : ".number_format($amount,2),0, 0, 'L', 0, '');
	$this->Ln(7);
	$this->Cell(40,0,'',0,0,'C');
	$this->Cell(160,0,strtoupper('Phone : '.$phone),0,0,'L');

    // Line break
    $this->Ln(6);
}

function Footer()
{
	global $invID;
    // Go to 1.5 cm from bottom
    $this->SetY(-20);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
	$this->Line(10, $this->getY(), 200, $this->getY());
	$this->Line(10, $this->getY(), 200, $this->getY());
	$this-> Cell(0, 5, "Thank You and God Bless!",0, 0, 'C', 0, '');
	$this->Ln();
	$this-> Cell(0, 5, "Your purchase from us goes along way in helping poor bright young people to access quality education and a bright future!",0, 0, 'C', 0, '');
	$this->Ln();
	$this-> Cell(0, 5, "Printed: ". date('d-M-Y h:ia'). "  #NV0".$invID,0, 0, 'C', 0, '');
}



function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}
	
	

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data,$fill)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++){
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));}
	$h=7*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		
		
		//Print the text
		$this->MultiCell($w,7,$data[$i],0,$a,$fill);
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);

		
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		{
			$this->AddPage($this->CurOrientation);
			$this->SetXY(10,45);

			
			
			$this-> Cell(10, 10, "#",1, 0, 'C', 1, '');
			$this-> Cell(65, 10, "Description",1, 0, 'C', 1, '');
			$this-> Cell(35, 10, "Date",1, 0, 'C', 1, '');
			$this-> Cell(45, 10, "To",1, 0, 'C', 1, '');
			$this-> Cell(10, 10, "Txt",1, 0, 'C', 1, '');
			$this-> Cell(30, 10, "Amount",1, 0, 'C', 1, '');
			$this->Ln();

		}
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		{$w=$this->w-$this->rMargin-$this->x;}
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		{$nb--;}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			{$sep=$i;}
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					{$i++;}
			}
			else
				{$i=$sep+1;}
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			{$i++;}
	}
	return $nl;
}
}
?>

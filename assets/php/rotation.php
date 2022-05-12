<?php
require('assets/fpdf/fpdf.php');

class PDF_Rotate extends FPDF{
    var $angle=0;

    function Rotate($angle,$x=-1,$y=-1){
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0){
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }//fin del if
    }//fin de rotate

    function _endpage(){
        if($this->angle!=0){
            $this->angle=0;
            $this->_out('Q');
        }//fin del if
        parent::_endpage();
    }//fin end page
}//fin class pdf
?>
<?php

namespace App;

use \FPDF;
use Carbon\Carbon;

class OtFPDF extends FPDF
{
    function Header() //esto es el header del reporte, logo y titulos
	{
		$this->Image('images/logo.png', 5, 5, 50 );
		$this->SetFont('Arial','B',13);
		$this->Cell(30);
		$this->Cell(120,10, 'SIG ORDEN DE TRABAJO',0,0,'C');
		$this->Ln(20);
	}
	
	function Footer() //este es el final del reporte, donde contiene el numero de paginas, no tocar.
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
	}
	public function imprimirReporte($ot)
	{
		$nombre_contacto='Cliente Eliminado';
		$razon_social='-';
		$rut_contacto='-';	
		$rut_empresa='-';
		$giro='-';
		$direccion='-';
		$fono='-';
		if($ot->cotizacion->cliente){
		$nombre_contacto=$ot->cotizacion->cliente->nombre;
		$razon_social=$ot->cotizacion->cliente->razon_social;
		$rut_contacto=$ot->cotizacion->cliente->rut;	
		$rut_empresa=$ot->cotizacion->cliente->empresa;
		$giro=$ot->cotizacion->cliente->giro;
		$direccion=$ot->cotizacion->cliente->direccion.', '.$ot->cotizacion->cliente->comuna.', '.$ot->cotizacion->cliente->region;
		$fono=$ot->cotizacion->cliente->fono1;
		}
		$fecha=Carbon::now()->format('d-m-Y');

		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont('Arial','',13);
		$this->SetTextColor(300,0,0);
		$this->Cell(290,10, 'RUT: 76.316.657-0',0,0,'C');
		$this->Ln(8);
		$this->Cell(290,10, 'ORDEN DE TRABAJO',0,0,'C');
	    $this->Ln(8);
		$this->Cell(290,10, 'N '.$ot->id,0,0,'C');// a単adir el numero desde la ot
		$this->SetFont('Arial','B',11);
		$this->SetTextColor(0,0,0);

		
		$this->Ln(15);
		$this->Write(1,'Nombre Contacto: ');
		$this->SetFont('Arial','',11);
		$this->Ln(5);
		$this->Write(1, $nombre_contacto);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Razon Social: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $razon_social);
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Rut Empresa: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $rut_empresa);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Giro: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $giro);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Direccion: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $direccion);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Fono: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $fono);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Fecha: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $fecha);
		//$this->Image('images/ot.png', 130, 30, 80 ); se saca por que se genera en el header
		
		//$this->Image('images/b_back.png', 5, 250, 200 );
		$this->Ln(20);
		$this->SetFillColor(232,232,232);
		$this->SetFont('Arial','B',10);
		
		//Tabla Columna
		$this->Cell(15,6,'COD',1,0,'C',1);
		$this->Cell(13,6,'CANT',1,0,'C',1);
		$this->Cell(74,6,'DESCRIPCION',1,0,'C',1);
		$this->Cell(35,6,'PRECIO UNITARIO',1,0,'C',1);
		$hayDescuento = false;
		foreach($ot->cotizacion->producto as $producto){
			if($producto->pivot->descuento) $hayDescuento = true;
		}
		if($hayDescuento) $this->Cell(25,6,'DESCUENTO',1,0,'C',1);
		
		$this->Cell(30,6,'PRECIO TOTAL',1,0,'C',1);
		
		$this->SetFont('Arial','',10);
		$this->Ln(6);
		//WHILE DEL GARY
		foreach($ot->cotizacion->producto as $producto){
			$this->Cell(15,6,$producto->id,1,0,'C');
			$this->Cell(13,6,$producto->pivot->cantidad,1,0,'C');
			//if(strlen($producto->nombre)>35) $this->Cell(74,6,str_limit($producto->nombre, 35),1,0,'C');
			//else $this->Cell(74,6,$producto->nombre,1,0,'C');
			if(strlen($producto->nombre) > 80) $this->CellFitScale(74,6,str_limit($producto->nombre, 80),1,0,'C');
			else $this->CellFitScale(74,6,$producto->nombre,1,0,'C');
			$this->Cell(35,6,'$ '.number_format($producto->precio_venta,0,",","."),1,0,'C');
			if($hayDescuento){
				if($producto->pivot->descuento) $this->Cell(25,6,$producto->pivot->descuento.'%',1,0,'C');
				else $this->Cell(25,6,'',1,0,'C');
			} 
			if($producto->pivot->descuento) $this->Cell(30,6,'$ '.number_format($producto->precio_venta*(1-($producto->pivot->descuento/100))*$producto->pivot->cantidad,0,",","."),1,0,'C');
			else $this->Cell(30,6,'$ '.number_format($producto->precio_venta*$producto->pivot->cantidad,0,",","."),1,0,'C');
			
			$this->Ln(6);

			if(strlen($producto->nombre) > 80)
			{
				
				//$this->Cell(15,6,'Nombre',1,0,'C');
				$this->CellFitScale(167,6,substr($producto->nombre,80),1,0,'C');
				$this->Ln(6);
			}
		}
		// WHILE DEL GUARY
		$this->SetFont('Arial','',10);
		$this->Ln(15);
		if($ot->cotizacion->descuento){
		$this->Write(1,'DESCUENTO AL TOTAL: '.$ot->cotizacion->descuento.' (%)');
		$this->Ln(8);
		}
		$this->Write(1,'TOTAL NETO: $ '.number_format($ot->cotizacion->valor_neto,0,",","."));
		$this->Ln(8);
    	$this->Write(1,'IVA 19%: $ '.number_format($ot->cotizacion->valor_iva,0,",","."));
    	$this->Ln(8);
    	$this->Write(1,'MONTO TOTAL FINAL: $ '.number_format($ot->cotizacion->valor_total,0,",","."));

		$this->SetFont('Arial','B',11);
		$this->Ln(10);
		$this->Cell(50,6,'Vendedor: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->cotizacion->ventasuser->name,1,0,'C');
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Estado: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->otestado->nombre,1,0,'C');//Trae desde la base el estado
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Fecha de Ingreso: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->fecha,1,0,'C');//Trae desde la base la fecha de ingreso
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Fecha de Entrega: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->fecha_entrega,1,0,'C');//Trae desde la base la fecha de entrega
		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Observaciones: ');
		$this->SetFont('Arial','',11);
		$this->Write(1,$ot->comentario);
		//$this->Write(1,$diseno); colocar la data de observaciones ACA!
		$modo="I"; 
	    $nombre_archivo="Orden de Trabajo ".$ot->id." ".$ot->fecha.".pdf";  //el nombre colocarlo con parametro get por url igual para seleccionar y armar el reporte
	    $this->Output($nombre_archivo,$modo); 
	}
	public function generarReporte($ot)
	{
		$nombre_contacto='Cliente Eliminado';
		$razon_social='-';
		$rut_contacto='-';	
		$rut_empresa='-';
		$giro='-';
		$direccion='-';
		$fono='-';
		if($ot->cotizacion->cliente){
		$nombre_contacto=$ot->cotizacion->cliente->nombre;
		$razon_social=$ot->cotizacion->cliente->razon_social;
		$rut_contacto=$ot->cotizacion->cliente->rut;	
		$rut_empresa=$ot->cotizacion->cliente->empresa;
		$giro=$ot->cotizacion->cliente->giro;
		$direccion=$ot->cotizacion->cliente->direccion.', '.$ot->cotizacion->cliente->comuna.', '.$ot->cotizacion->cliente->region;
		$fono=$ot->cotizacion->cliente->fono1;
		}
		$fecha=Carbon::now()->format('d-m-Y');

		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont('Arial','',13);
		$this->SetTextColor(300,0,0);
		$this->Cell(290,10, 'RUT: 76.316.657-0',0,0,'C');
		$this->Ln(8);
		$this->Cell(290,10, 'ORDEN DE TRABAJO',0,0,'C');
	    $this->Ln(8);
		$this->Cell(290,10, 'N '.$ot->id,0,0,'C');// a単adir el numero desde la ot
		$this->SetFont('Arial','B',11);
		$this->SetTextColor(0,0,0);

		
		$this->Ln(15);
		$this->Write(1,'Nombre Contacto: ');
		$this->SetFont('Arial','',11);
		$this->Ln(5);
		$this->Write(1, $nombre_contacto);	
		
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Razon Social: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $razon_social);
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Rut Empresa: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $rut_empresa);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Giro: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $giro);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Direccion: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $direccion);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Fono: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $fono);	
		$this->Ln(8);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Fecha: ');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Write(1, $fecha);
		//$this->Image('images/ot.png', 130, 30, 80 ); se saca por que se genera en el header
		
		//$this->Image('images/b_back.png', 5, 250, 200 );
		$this->Ln(20);
		$this->SetFillColor(232,232,232);
		$this->SetFont('Arial','B',10);
		
		//Tabla Columna
		$this->Cell(15,6,'COD',1,0,'C',1);
		$this->Cell(13,6,'CANT',1,0,'C',1);
		$this->Cell(74,6,'DESCRIPCION',1,0,'C',1);
		$this->Cell(35,6,'PRECIO UNITARIO',1,0,'C',1);
		$hayDescuento = false;
		foreach($ot->cotizacion->producto as $producto){
			if($producto->pivot->descuento) $hayDescuento = true;
		}
		if($hayDescuento) $this->Cell(25,6,'DESCUENTO',1,0,'C',1);
		
		$this->Cell(30,6,'PRECIO TOTAL',1,0,'C',1);
		
		$this->SetFont('Arial','',10);
		$this->Ln(6);
		//WHILE DEL GARY
		foreach($ot->cotizacion->producto as $producto){
			$this->Cell(15,6,$producto->id,1,0,'C');
			$this->Cell(13,6,$producto->pivot->cantidad,1,0,'C');
			//if(strlen($producto->nombre)>35) $this->Cell(74,6,str_limit($producto->nombre, 35),1,0,'C');
			//else $this->Cell(74,6,$producto->nombre,1,0,'C');
			if(strlen($producto->nombre) > 80) $this->CellFitScale(74,6,str_limit($producto->nombre, 80),1,0,'C');
			else $this->CellFitScale(74,6,$producto->nombre,1,0,'C');
			
			$this->Cell(35,6,'$ '.number_format($producto->precio_venta,0,",","."),1,0,'C');
			if($hayDescuento){
				if($producto->pivot->descuento) $this->Cell(25,6,$producto->pivot->descuento.'%',1,0,'C');
				else $this->Cell(25,6,'',1,0,'C');
			} 
			if($producto->pivot->descuento) $this->Cell(30,6,'$ '.number_format($producto->precio_venta*(1-($producto->pivot->descuento/100))*$producto->pivot->cantidad,0,",","."),1,0,'C');
			else $this->Cell(30,6,'$ '.number_format($producto->precio_venta*$producto->pivot->cantidad,0,",","."),1,0,'C');
			
			$this->Ln(6);

			if(strlen($producto->nombre) > 80)
			{
				
				//$this->Cell(15,6,'Nombre',1,0,'C');
				$this->CellFitScale(167,6,substr($producto->nombre,80),1,0,'C');
				$this->Ln(6);
			}
		}
		// WHILE DEL GUARY
		$this->SetFont('Arial','',10);
		$this->Ln(15);
		if($ot->cotizacion->descuento){
		$this->Write(1,'DESCUENTO AL TOTAL: '.$ot->cotizacion->descuento.' (%)');
		$this->Ln(8);
		}
		$this->Write(1,'TOTAL NETO: $ '.number_format($ot->cotizacion->valor_neto,0,",","."));
		$this->Ln(8);
    	$this->Write(1,'IVA 19%: $ '.number_format($ot->cotizacion->valor_iva,0,",","."));
    	$this->Ln(8);
    	$this->Write(1,'MONTO TOTAL FINAL: $ '.number_format($ot->cotizacion->valor_total,0,",","."));

		$this->SetFont('Arial','B',11);
		$this->Ln(10);
		$this->Cell(50,6,'Vendedor: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->cotizacion->ventasuser->name,1,0,'C');
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Estado: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->otestado->nombre,1,0,'C');//Trae desde la base el estado
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Fecha de Ingreso: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->fecha,1,0,'C');//Trae desde la base la fecha de ingreso
		$this->Ln(6);
		$this->SetFont('Arial','B',11);
		$this->Cell(50,6,'Fecha de Entrega: ',1,0,'C',1);
		$this->SetFont('Arial','',11);
		$this->Cell(50,6,$ot->fecha_entrega,1,0,'C');//Trae desde la base la fecha de entrega
		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Write(1,'Observaciones: ');
		$this->SetFont('Arial','',11);
		$this->Write(1,$ot->comentario);
		//$this->Write(1,$diseno); colocar la data de observaciones ACA!
		$modo="F"; 
	    $nombre_archivo="Orden de Trabajo ".$ot->id." ".Carbon::now()->format('Y-m-d H_i_s').".pdf";  //el nombre colocarlo con parametro get por url igual para seleccionar y armar el reporte
	    $this->Output($nombre_archivo,$modo);
	    return $nombre_archivo; 
	}
	//Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
}

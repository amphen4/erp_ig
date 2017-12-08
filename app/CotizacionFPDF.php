<?php

namespace App;

use \FPDF;
use Carbon\Carbon;

class CotizacionFPDF extends FPDF
{
    function Header() //esto es el header del reporte, logo y titulos
	{
		$this->Image('images/logo.png', 5, 5, 50 );
		$this->SetFont('Arial','B',13);
		$this->Cell(30);
		$this->Cell(120,10, 'SIG COTIZACION',0,0,'C');
		$this->Ln(20);
	}
	
	function Footer() //este es el final del reporte, donde contiene el numero de paginas, no tocar.
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
	}

	function generarReporte($nombre_contacto, $razon_social, $rut_contacto, $rut_empresa, $giro, $direccion, $fono, $fecha, $cotizacion)
	{
		$this->SetFont('Arial','B',10);
		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont('Arial','',13);
		$this->SetTextColor(300,0,0);
		$this->Cell(290,10, 'RUT: 76.316.657-0',0,0,'C');
		$this->Ln(8);
		$this->Cell(290,10, 'COTIZACION',0,0,'C');
	    $this->Ln(8);
		$this->Cell(290,10, 'N '.$cotizacion->id,0,0,'C');// a単adir el numero desde la ot
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);

		//Datos del Reporte
		
		$this->Ln(15);
		$this->Write(1,'Razon Social: ');
		$this->SetFont('Arial','',10);
		$this->Ln(5);
		$this->Write(1, $razon_social);	
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Rut Empresa: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $rut_empresa);
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Nombre Contacto: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $nombre_contacto);
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Giro: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $giro);	
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Direccion: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $direccion);	
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Fono: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $fono);	
		$this->Ln(8);
		$this->SetFont('Arial','B',10);
		$this->Write(1,'Fecha: ');
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Write(1, $fecha);
		//$this->Image('images/cotizacion.png', 130, 10, 70 );
		$this->Image('images/data.png', 130, 60, 70 );
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
		foreach($cotizacion->producto as $producto){
			if($producto->pivot->descuento) $hayDescuento = true;
		}
		if($hayDescuento) $this->Cell(25,6,'DESCUENTO',1,0,'C',1);
		
		$this->Cell(30,6,'PRECIO TOTAL',1,0,'C',1);
		
		$this->SetFont('Arial','',10);
		$this->Ln(6);
		//WHILE DEL GARY
		foreach($cotizacion->producto as $producto){
			$this->Cell(15,6,$producto->id,1,0,'C');
			$this->Cell(13,6,$producto->pivot->cantidad,1,0,'C');
			if(strlen($producto->nombre)>35) $this->Cell(74,6,str_limit($producto->nombre, 35),1,0,'C');
			else $this->Cell(74,6,$producto->nombre,1,0,'C');
			
			$this->Cell(35,6,'$ '.number_format($producto->precio_venta,0,",","."),1,0,'C');
			if($hayDescuento){
				if($producto->pivot->descuento) $this->Cell(25,6,$producto->pivot->descuento.'%',1,0,'C');
				else $this->Cell(25,6,'',1,0,'C');
			} 
			if($producto->pivot->descuento) $this->Cell(30,6,'$ '.number_format($producto->precio_venta*(1-($producto->pivot->descuento/100))*$producto->pivot->cantidad,0,",","."),1,0,'C');
			else $this->Cell(30,6,'$ '.number_format($producto->precio_venta*$producto->pivot->cantidad,0,",","."),1,0,'C');
			
		
			$this->Ln(6);
		}
		// WHILE DEL GUARY
		$this->SetFont('Arial','',10);
		$this->Ln(15);
		if($cotizacion->descuento){
		$this->Write(1,'DESCUENTO AL TOTAL: '.$cotizacion->descuento.' (%)');
		$this->Ln(8);
		}
		$this->Write(1,'TOTAL NETO: $ '.number_format($cotizacion->valor_neto,0,",","."));
		$this->Ln(8);
    	$this->Write(1,'IVA 19%: $ '.number_format($cotizacion->valor_iva,0,",","."));
    	$this->Ln(8);
    	$this->Write(1,'MONTO TOTAL FINAL: $ '.number_format($cotizacion->valor_total,0,",","."));
		
		
		
		
		
		$this->SetFont('Arial','B',10);
		$this->Ln(25);
		$this->Write(1,'Vendedor: ');
		$this->Write(1,$cotizacion->ventasuser->name);
		$this->Ln(8);
		$this->Write(1,'Despacho: ');
		if($cotizacion->despacho) $this->Write(1,'Si');
		else  $this->Write(1,'');
		$this->Ln(8);
		$this->Write(1,'Montaje: ');
		if($cotizacion->montaje) $this->Write(1,'Si');
		else  $this->Write(1,'');
		$this->Ln(8);
		$this->Write(1,'Diseno: ');
		if($cotizacion->diseno) $this->Write(1,'Si');
		else $this->Write(1,'');
		$this->Ln(13);
		$this->Write(1,'Observaciones: ');
		$this->Write(7,$cotizacion->descripcion);
		$modo="F"; 
	    $nombre_archivo="Cotizacion ".$cotizacion->id." ".Carbon::now()->format('Y-m-d H_i_s').".pdf";
	    $this->Output($nombre_archivo,$modo);
	    return $nombre_archivo;
	}
	public function imprimirReporte($nombre_contacto, $razon_social, $rut_contacto, $rut_empresa, $giro, $direccion, $fono, $fecha, $cotizacion)
	{
		$this->SetFont('Arial','B',10);
		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont('Arial','',13);
		$this->SetTextColor(300,0,0);
		$this->Cell(290,10, 'RUT: 76.316.657-0',0,0,'C');
		$this->Ln(8);
		$this->Cell(290,10, 'COTIZACION',0,0,'C');
	    $this->Ln(8);
		$this->Cell(290,10, 'N '.$cotizacion->id,0,0,'C');// a単adir el numero desde la ot
		$this->SetFont('Arial','B',8);
		$this->SetTextColor(0,0,0);

		//Datos del Reporte
		
		$this->Ln(15);
		$this->Write(1,'Razon Social: ');
		$this->SetFont('Arial','',8);
		$this->Ln(5);
		$this->Write(1, $razon_social);	
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Rut Empresa: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $rut_empresa);
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Nombre Contacto: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $nombre_contacto);
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Giro: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $giro);	
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Direccion: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $direccion);	
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Fono: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $fono);	
		$this->Ln(8);
		$this->SetFont('Arial','B',8);
		$this->Write(1,'Fecha: ');
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Write(1, $fecha);
		//$this->Image('images/cotizacion.png', 130, 10, 70 );
		$this->Image('images/data.png', 130, 60, 70 );
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
		foreach($cotizacion->producto as $producto){
			if($producto->pivot->descuento) $hayDescuento = true;
		}
		if($hayDescuento) $this->Cell(25,6,'DESCUENTO',1,0,'C',1);
		
		$this->Cell(30,6,'PRECIO TOTAL',1,0,'C',1);
		
		$this->SetFont('Arial','',10);
		$this->Ln(6);
		//WHILE DEL GARY
		foreach($cotizacion->producto as $producto){
			$this->Cell(15,6,$producto->id,1,0,'C');
			$this->Cell(13,6,$producto->pivot->cantidad,1,0,'C');
			if(strlen($producto->nombre)>35) $this->Cell(74,6,str_limit($producto->nombre, 35),1,0,'C');
			else $this->Cell(74,6,$producto->nombre,1,0,'C');
			
			$this->Cell(35,6,'$ '.number_format($producto->precio_venta,0,",","."),1,0,'C');
			if($hayDescuento){
				if($producto->pivot->descuento) $this->Cell(25,6,$producto->pivot->descuento.'%',1,0,'C');
				else $this->Cell(25,6,'',1,0,'C');
			} 
			if($producto->pivot->descuento) $this->Cell(30,6,'$ '.number_format($producto->precio_venta*(1-($producto->pivot->descuento/100))*$producto->pivot->cantidad,0,",","."),1,0,'C');
			else $this->Cell(30,6,'$ '.number_format($producto->precio_venta*$producto->pivot->cantidad,0,",","."),1,0,'C');
			
		
			$this->Ln(6);
		}
		// WHILE DEL GUARY
		$this->SetFont('Arial','',10);
		$this->Ln(10);
		if($cotizacion->descuento){
		$this->Write(1,'DESCUENTO AL TOTAL: '.$cotizacion->descuento.' (%)');
		$this->Ln(8);
		}
		$this->Write(1,'TOTAL NETO: $ '.number_format($cotizacion->valor_neto,0,",","."));
		$this->Ln(8);
    	$this->Write(1,'IVA 19%: $ '.number_format($cotizacion->valor_iva,0,",","."));
    	$this->Ln(8);
    	$this->Write(1,'MONTO TOTAL FINAL: $ '.number_format($cotizacion->valor_total,0,",","."));
	
		$this->SetFont('Arial','B',8);
		$this->Ln(25);
		$this->Write(1,'Vendedor: ');
		$this->Write(1,$cotizacion->ventasuser->name);
		$this->Ln(8);
		$this->Write(1,'Despacho: ');
		if($cotizacion->despacho) $this->Write(1,'Si');
		else  $this->Write(1,'');
		$this->Ln(8);
		$this->Write(1,'Montaje: ');
		if($cotizacion->montaje) $this->Write(1,'Si');
		else  $this->Write(1,'');
		$this->Ln(8);
		$this->Write(1,'Diseno: ');
		if($cotizacion->diseno) $this->Write(1,'Si');
		else $this->Write(1,'');
		$this->Ln(13);
		$this->Write(1,'Observaciones: ');
		$this->Write(6,$cotizacion->descripcion);
		$modo="I"; 
	    $nombre_archivo="Cotizacion ".$cotizacion->id." ".Carbon::now()->format('Y-m-d H:m').".pdf";
	    $this->Output($nombre_archivo,$modo);
	}
}

<?php

class Factura1 {
    private $energia;
    private $potencia;
    private $dias;
    private $importe_potencia = 0.130601;
    private $importe_energia = 0.149749;
    private $peaje_potencia = 38.043426;
    private $peaje_energia = 0.044027;
    private $descuento = 0.05;
    private $impuesto_electricidad = 5.11269632;
    private $alquiler_equipos = 0.026666;
    
    function __construct($energia, $potencia, $dias) {
        $this->setEnergia($energia);
        $this->setPotencia($potencia);
        $this->setDias($dias);
    }
    
    function getEnergia() {
        return $this->energia;
    }

    function getPotencia() {
        return $this->potencia;
    }

    function getDias() {
        return $this->dias;
    }

    function getImporte_potencia() {
        return $this->importe_potencia;
    }

    function getImporte_energia() {
        return $this->importe_energia;
    }

    function getPeaje_potencia() {
        return $this->peaje_potencia;
    }

    function getPeaje_energia() {
        return $this->peaje_energia;
    }

    /*function getDescuento() {
        return $this->descuento;
    }*/

    function getImpuesto_electricidad() {
        return $this->impuesto_electricidad;
    }

    function getAlquiler_equipos() {
        return $this->alquiler_equipos;
    }

    function setEnergia($energia) {
        $this->energia = $energia;
    }

    function setPotencia($potencia) {
        $this->potencia = $potencia;
    }

    function setDias($dias) {
        $this->dias = $dias;
    }

    function setImporte_potencia($importe_potencia) {
        $this->importe_potencia = $importe_potencia;
    }

    function setImporte_energia($importe_energia) {
        $this->importe_energia = $importe_energia;
    }

    function setPeaje_potencia($peaje_potencia) {
        $this->peaje_potencia = $peaje_potencia;
    }

    function setPeaje_energia($peaje_energia) {
        $this->peaje_energia = $peaje_energia;
    }

    /*function setDescuento($descuento) {
        $this->descuento = $descuento;
    }*/

    function setImpuesto_electricidad($impuesto_electricidad) {
        $this->impuesto_electricidad = $impuesto_electricidad;
    }

    function setAlquiler_equipos($alquiler_equipos) {
        $this->alquiler_equipos = $alquiler_equipos;
    }
    
    // Métodos
    
    function calcular_importe_potencia() {
        return $this->getPotencia()*$this->getImporte_potencia()*
                $this->getDias();
    }
    
    function calcular_importe_peaje_potencia() {
        return $this->getPotencia()*$this->getPeaje_potencia()*
                ($this->getDias()/365);
    }
    
    function calcular_importe_energia() {
        return $this->getEnergia()*$this->getImporte_energia();
    }
    
    function calcular_importe_peaje_energia() {
        return $this->getEnergia()*$this->getImporte_energia();
    }
    
    function calcular_IVA ($subtotal, $IVA) {
        return $subtotal*($IVA/100);
    }
    
    function calcular_subtotal1 ($importe_energia, $importe_potencia) {
        return $importe_energia+$importe_potencia;
    }
    function calcular_total ($subtotal, $IVA) {
        return $subtotal*(1+$IVA/100);
    }
    
    function calcular_descuento($importe_subtotal, $descuento) {
        return (-abs($descuento/100))*$importe_subtotal;
    }
    
    function calcular_importe_impuesto_electricidad($importe) {
        return $importe*($this->getImpuesto_electricidad()/100);
    }
    
    function calcular_importe_alquiler_equipos() {
        return $this->getDias()*$this->getAlquiler_equipos();
    }
    
    function coste_kilovatio($subtotal, $IVA) {
        return $this->calcular_total($subtotal, $IVA)/($this->getDias()*24);
    }
    
    function calcular_factura() {
        echo "Factura 1 <br>";
        $factura = array();
        $IVA = 21;
        $tanto_descuento = 5;
        $potencia = $this->calcular_importe_potencia();
        $energia = $this->calcular_importe_energia();
        $subtotal = $this->calcular_subtotal1($energia, $potencia);
        $descuento = $this->calcular_descuento($subtotal, $tanto_descuento);
        $impuesto = $this->calcular_importe_impuesto_electricidad($subtotal+$descuento);
        $alquiler = $this->calcular_importe_alquiler_equipos();
        $subtotal_altres_conceptes = $descuento+$impuesto+$alquiler;
        $total = $subtotal + $subtotal_altres_conceptes;
        $kilovatio_hora = $this->coste_kilovatio($subtotal, $IVA);
        
        array_push($factura,$potencia, $energia, $subtotal, $descuento, $impuesto,
                $alquiler, $subtotal_altres_conceptes, $total, $kilovatio_hora);
        $this->mostrar_factura($factura);
    }
    
    function mostrar_factura($factura) {
        foreach ($factura as $parte_factura) {
            echo round($parte_factura,2) . "<br>";
        }
    }
}
?>


<?php

class Factura2 {
    private $energia;
    private $potencia;
    private $dias;
    private $importe_peaje_potencia = 38.043426;
    private $importe_comercializacion_potencia = 3.113;
    private $importe_peaje_energia = 0.044027;
    private $importe_coste_energia = 0.082539;
    private $impuesto_electricidad_tipo = 5.11269632;
    private $alquiler_equipos = 0.044666;
    
    
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

    function getImporte_peaje_potencia() {
        return $this->importe_peaje_potencia;
    }

    function getImporte_comercializacion_potencia() {
        return $this->importe_comercializacion_potencia;
    }

    function getImporte_peaje_energia() {
        return $this->importe_peaje_energia;
    }

    function getImporte_coste_energia() {
        return $this->importe_coste_energia;
    }

    function getImpuesto_electricidad_tipo() {
        return $this->impuesto_electricidad_tipo;
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

    function setImporte_peaje_potencia($importe_peaje_potencia) {
        $this->importe_peaje_potencia = $importe_peaje_potencia;
    }

    function setImporte_comercializacion_potencia($importe_comercializacion_potencia) {
        $this->importe_comercializacion_potencia = $importe_comercializacion_potencia;
    }

    function setImporte_peaje_energia($importe_peaje_energia) {
        $this->importe_peaje_energia = $importe_peaje_energia;
    }

    function setImporte_coste_energia($importe_coste_energia) {
        $this->importe_coste_energia = $importe_coste_energia;
    }

    function setImpuesto_electricidad_tipo($impuesto_electricidad_tipo) {
        $this->impuesto_electricidad_tipo = $impuesto_electricidad_tipo;
    }

    function setAlquiler_equipos($alquiler_equipos) {
        $this->alquiler_equipos = $alquiler_equipos;
    }

    // Métodos
    
    function calcular_importe_potencia_peaje_acceso() {
        return $this->getPotencia()*$this->getImporte_peaje_potencia()*
                ($this->getDias()/365);
    }
    
    function calcular_importe_costes_fijos_comercializacion_potencia() {
        return $this->getPotencia()*
                $this->getImporte_comercializacion_potencia()*
                ($this->getDias()/365);
    }
    
    function calcular_importe_potencia() {
        return $this->calcular_importe_potencia_peaje_acceso() + 
               $this->calcular_importe_costes_fijos_comercializacion_potencia();
    }
    
    function calcular_importe_peaje_acceso_energia() {
        return $this->getEnergia()*$this->getImporte_peaje_energia();
    }
    
    function calcular_importe_coste_energia() {
        return $this->getEnergia()*$this->getImporte_coste_energia();
    }
    
    function calcular_importe_energia() {
        return $this->calcular_importe_peaje_acceso_energia() + 
               $this->calcular_importe_coste_energia();
    }
    
    function calcular_subtotal() {
        return $this->calcular_importe_potencia() + 
                $this->calcular_importe_energia();
    }
    
    function calcular_impuesto_electricidad() {
        return $this->calcular_subtotal()*
                $this->getImpuesto_electricidad_tipo()/100;
    }
    
    function calcular_alquiler_equipos() {
        return $this->getDias()*$this->getAlquiler_equipos();
    }
    
    function calcular_subtotal_otros_conceptos() {
        return $this->calcular_impuesto_electricidad() + 
                $this->calcular_alquiler_equipos();
    }
    
    function calcular_total() {
        return $this->calcular_subtotal()+
                $this->calcular_subtotal_otros_conceptos();
    }
    
    function calcular_IVA () {
        return $this->calcular_total()*(21/100);
    }
    
    function calcular_total_factura() {
        return $this->calcular_total()+$this->calcular_IVA();
    }
    
    function coste_kilovatio() {
        return $this->calcular_total_factura()/($this->getDias()*24);
    }
    
    
    function calcular_factura() {
        echo "Factura 2 <br>";
        $factura = array();
        $potencia = $this->getPotencia();
        $energia = $this->getEnergia();
        $peaje_acceso_potencia = $this->calcular_importe_potencia_peaje_acceso();
        $termino_fijo_costes_comercializacion = $this->calcular_importe_costes_fijos_comercializacion_potencia();
        $peaje_acceso_energia = $this->calcular_importe_peaje_acceso_energia();
        $coste_energia = $this->calcular_importe_coste_energia();
        $subtotal = $this->calcular_subtotal();
        $impuesto_electricidad = $this->calcular_impuesto_electricidad();
        $alquiler_equipos = $this->calcular_alquiler_equipos();
        $subtotal_otros = $this->calcular_subtotal_otros_conceptos();
        $total = $this->calcular_total();
        $iva = $this->calcular_IVA();
        $total_factura = $this->calcular_total_factura();
        $kilovatio_hora = $this->coste_kilovatio();
        
        
        array_push($factura, $peaje_acceso_potencia, 
                $termino_fijo_costes_comercializacion, $peaje_acceso_energia, $coste_energia,
                $subtotal, $impuesto_electricidad, $alquiler_equipos, $subtotal_otros,
                $total, $iva, $total_factura, $kilovatio_hora);
        $this->mostrar_factura($factura);
    }
    
    function mostrar_factura($factura) {
        foreach ($factura as $parte_factura) {
            echo round($parte_factura,2) . "<br>";
        }
    }
}
?>
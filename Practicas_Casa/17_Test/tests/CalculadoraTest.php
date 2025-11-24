<?php

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraTest extends TestCase{
    public function testSumar(){
        $calc = new Calculadora();
        $this->assertEquals(5, $calc->sumar(2,3));
    }

    public function testRestar(){
        $calc = new Calculadora();
        $this->assertEquals(-1, $calc->restar(2,3));
    }

    public function testMultiplicar(){
        $calc = new Calculadora();
        $this->assertEquals(6, $calc->multiplicar(2,3));
    }

    public function testDividir(){
        $calc = new Calculadora();
        $this->assertEquals(2, $calc->dividir(4,2));
    }

    public function testDividirPorCero(){
        $calc = new Calculadora();
        $this->expectException(InvalidArgumentException::class);
        $calc->dividir(2,0);
    }

}

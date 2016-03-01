<?php
    namespace Masterkey\Cep;

    use PHPUnit_Framework_TestCase;

    class BuscaCepTest extends PHPUnit_Framework_TestCase
    {
        public function testConsultar()
        {
            $endereco = BuscaCep::consultar('39403-077');

            $this->assertEquals('Rua do Am&eacute;rica', $endereco['logradouro']);
            $this->assertEquals('Maracan&atilde;', $endereco['bairro']);
            $this->assertEquals('Montes Claros', $endereco['cidade']);
            $this->assertEquals('39403-077', $endereco['cep']);
            $this->assertEquals('MG', $endereco['uf']);

            $endereco = BuscaCep::consultar('39401-065');

            $this->assertEquals('Rua Tapaj&oacute;s', $endereco['logradouro']);
            $this->assertEquals('Melo', $endereco['bairro']);
            $this->assertEquals('Montes Claros', $endereco['cidade']);
            $this->assertEquals('39401-065', $endereco['cep']);
            $this->assertEquals('MG', $endereco['uf']);
        }
    }

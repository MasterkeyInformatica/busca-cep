<?php
    namespace Masterkey\Cep;
    /*
     *              ________________________________________
     *     ________|                                        |_______
     *     \       |    Busca de CEP - Site dos Correios    |      /
     *      \      | Copyright © 2016 Masterkey Informática |     /
     *      /      |________________________________________|     \
     *     /__________)                                 (__________\
     *
     * Os direitos acima e esta permissão informam que devem ser incluídas
     * em todas as cópias ou substanciais porções do software
     * =======================================================================
     * O SOFTWARE É FORNECIDO "COMO ESTÁ". TODAS AS MODIFICAÇÕES, SEJAM ELAS
     * INCLUSÕES, EXCLUSÕES OU CORREÇÕES DEVEM SER FEITAS EM CONFORMIDADE E COM
     * A PERMISSÃO DO AUTOR DO SOFTWARE. CASO HAJA QUALQUER ALTERAÇÃO NÃO
     * AUTORIZADA PELO O AUTOR, O MESMO NÃO SE RESPONSABILIZA POR QUALQUER FALHA
     * OU PERDA DE DADOS, DECORRENTE DE ERROS DE SOFTWARE
     * =======================================================================
     * original filename  : BuscaCep.php
     * author             : Matheus Lopes Santos (@devMatheusLopes)
     * email              : fale_com_lopez@hotmail.com
     * =======================================================================
     */

    use Exception;
    use Goutte\Client;

    /**
     * BuscaCep
     *
     * Classe desenvolvida para gerenciamento de requisições para busca de
     * endereços no site dos correios
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   01/03/2016
     */
    class BuscaCep
    {
        /**
         * Realiza a consulta de CEPs no site dos correios
         *
         * @since   1.0.0 - 01/03/2016
         * @param   string  $cep a ser buscado
         * @return  array   O Endereço completo relacionado ao cep
         */
        public static function consultar($cep)
        {
            // O padrão dos CEPs brasileiros é de 8 números, ou 9 dígitos, caso
            // o CEP passado tiver o dígito separador
            if( strlen($cep) < 8)
                throw new Exception("O CEP informado não é válido");

            // Realiza a instanciação da Classe Goutte e realiza a requisição ao
            // site dos correios
            $cliente = new Client();
            $crawler = $cliente->request('POST', 'http://www.buscacep.correios.com.br/sistemas/buscacep/resultadoBuscaCepEndereco.cfm', [
                'relaxation' => str_replace(['-', '/', '.'], '', $cep),
                'tipoCEP'    => 'ALL',
                'semelhante' => 'N'
            ]);

            // Realiza a filtragem do elemento DOM recebido na requisição, em busca
            // da linha onde se encontra os dados do endereço
            $tr         = $crawler->filter(".tmptabela > tr:nth-child(2)");
            $endereco   = [
            	'logradouro'	=> $tr->filter("td:nth-child(1)")->html(),
            	'bairro'		=> $tr->filter('td:nth-child(2)')->html(),
            	'cidade'		=> $tr->filter('td:nth-child(3)')->html(),
            	'cep'			=> $tr->filter('td:nth-child(4)')->html()
            ];

            // Remove do logradouro, possíveis endereços duplos, pois é muito comum
            // um CEP para dois ou mais logradouros
            $aux = explode(" - ", $endereco['logradouro']);
            $endereco['logradouro'] = (count($aux) == 2) ? $aux[0] : $endereco['logradouro'];

            // Separa a cidade do estado, pois o mesmo, em outras versões do
            // site dos correios era apresentado de forma separada. Na última versão
            // cidade e estado são apresentados na mesma linha
            $separado = explode('/', $endereco['cidade']);
            $endereco['cidade'] = $separado[0];
            $endereco['uf']     = $separado[1];

            // Retorna o array com o endereço para o usuário. Ainda é possível
            // notar que, são removidos os caracteres especiais como &nbsp;, e
            // espaços, além de converter a resposta para htmlentities
            return str_replace('&nbsp;', '', array_map('htmlentities', array_map('trim', $endereco)));
        }
    }

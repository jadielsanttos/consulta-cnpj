<?php

namespace App\WebService;

class Speedio {

    /**
     * URL base da api
     * @var string
     */
    const BASE_URL = 'https://api-publica.speedio.com.br';

    /**
     * Método responsável por fazer a consulta
     * @param string
     * @return array
     */
    public static function consultarCnpj($cnpj) {

        // Remove os caracteres especiais
        $cnpj = preg_replace('/\D/', '', $cnpj);

        $endPoint = self::BASE_URL.'/buscarcnpj?cnpj='.$cnpj;
        return self::get($endPoint);
    }

    /**
     * Método responsável por executar a consulta na API da Speedio
     * @param string
     * @return array
     */
    public static function get($endPoint) {
        // inicia o curl
        $request = curl_init();

        // configura o curl
        curl_setopt_array($request, [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // executa o curl
        $response = curl_exec($request);

        // fecha o recurso
        curl_close($request);

        // transforma o retorno json em array
        $array = json_decode($response, true);

        // retorna o array preenchido ou vazio
        return is_array($array) ? $array : [];
    }

}
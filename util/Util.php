<?php

/**
 * Description of Util
 *
 * @author Lucas Gonçalves Silva - Desenvolvedor de Software
 */

namespace Sisfin;

class Util {

    // Formata Data a ser salva no Banco de Dados
    public static function FormataDataBanco($data) {
        $arrayData = explode('/', $data);
        return $arrayData[2] . '-' . $arrayData[1] . '-' . $arrayData[0];
    }

    // Formata Data vinda do Banco de Dados
    public static function FormataBancoData($data) {
        $arrayData = explode('-', $data);
        return $arrayData[2] . '/' . $arrayData[1] . '/' . $arrayData[0];
    }

    public static function inverteData(&$data) {
        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }

    public static function converterNumeroMes($mes) {
        switch ($mes) {
            case 1:
                return 'Janeiro';
                break;
            case 2:
                return 'Fevereiro';
                break;
            case 3:
                return 'Março';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Maio';
                break;
            case 6:
                return 'Junho';
                break;
            case 7:
                return 'Julho';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Setembro';
                break;
            case 10:
                return 'Outubro';
                break;
            case 11:
                return 'Novembro';
                break;
            case 12:
                return 'Dezembro';
                break;

            default:
                break;
        }
    }

    public static function converterArrayNumeroMes($array) {
        foreach ($array as $value) {
            $newArray[$value] = Util::converterNumeroMes($value);
        }
        return $newArray;
    }

    public static function converterArrayNumeroMesAno($array) {
        foreach ($array as $value) {
            $data = explode('/', $value);
            $newArray[$value] = Util::converterNumeroMes($value) . '/' . $data[1];
        }
        return $newArray;
    }

    public static function converterArrayIndice($data, $id, $descricao) {
        foreach ($data as $value) {
            $newArray[$value[$id]] = $value[$descricao];
        }
        return $newArray;
    }

    public static function converteMoedaBanco(&$valor) {
        $valor = str_replace(',', '.', str_replace('.', '', $valor));
    }

    // Formata string de acordo com o tipo de dado
    public static function formatarMascara($tipo = "", $string, $size = 10) {
        $string = preg_replace("[^0-9]", "", $string);

        switch ($tipo) {
            case 'fone':
                if ($size === 10) {
                    $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4)
                            . '-' . substr($string, 6);
                } else
                if ($size === 11) {
                    $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 5)
                            . '-' . substr($string, 7);
                }
                break;
            case 'cep':
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                        '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3) . '/' .
                        substr($string, 8, 4) . '-' . substr($string, 12, 2);
                break;
            case 'rg':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3);
                break;
            case 'placa':
                $string = strtoupper(substr($string, 0, 3) . '-' . substr($string, 3, 4));
                break;
            default:
                $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
                break;
        }
        return $string;
    }

    public static function limpaMascara(&$valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace("'", "", $valor);
        $valor = str_replace('"', "", $valor);
        return $valor;
    }

    public static function getTipoLancamento() {
        return array(
            1 => "FundoDinheiro",
            2 => "FundoCartao",
            3 => "Dinheiro",
            4 => "Cartao",
            5 => "VendaLiquida",
        );
    }

    public function upload(array $params) {

        $nomeArquivos = array();
        if (is_array($params['arquivos'])) {

            foreach ($params['arquivos'] as $nome => $arquivo) {

                if ($arquivo['size'] > 50217316)
                    throw new Exception("Arquivo muito grande para ser enviado, tamanho maximo 50mb.", 1);

                $ext = strrchr($arquivo['name'], ".");
                $nomeDir = $params['dir'];
                $nomeNovo = $nome . '-' . date("Y-m-d-H-i-s") . $ext;
                $nomeTemp = $arquivo["tmp_name"];

                try {
                    if (is_uploaded_file($nomeTemp)) {
                        if (move_uploaded_file($nomeTemp, $nomeDir . $nomeNovo)) {
                            $nomeArquivos[$nome] = $nomeNovo;
                        } else {
                            throw new Exception("Arquivo não pode ser enviado.", 1);
                        }
                    }
                } catch (Exception $e) {
                    throw new Exception($e->getMessage(), 2);
                }
            }


            return $nomeArquivos;
        } else {
            throw new Exception('Não existe arquivos para upload.');
        }
    }

}

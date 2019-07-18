<?php

/**
 * Description of Conexão
 *
 * @author Lucas Gonçalves Silva - Desenvolvedor de Software
 */
class Conexao extends PDO {

    public function __construct($file = 'my_setting.ini') {
        if (!$settings = parse_ini_file($file, TRUE))
            throw new exception('Unable to open ' . $file . '.');

        $dns = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['schema'] . ';charset=utf8';

        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }

}

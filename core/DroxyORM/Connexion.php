<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 04/02/16
 * Time: 15:40
 */

namespace Core\DroxyORM;


use Symfony\Component\Yaml\Yaml;

class Connexion
{
    private $_dbhost;
    private $_dbname;
    private $_dbuser;
    private $_dbpass;

    public function __construct(){

    }

    private function getConfigFile(){
        return Yaml::parse(APP_ROUTE."/config.yml");
    }
}
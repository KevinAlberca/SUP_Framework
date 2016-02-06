<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 04/02/16
 * Time: 17:50
 */
namespace Core\ORM;

use Core\Logs\Error;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Orm
{

    public static $em = null;

    public function __construct()
    {
        if(empty(self::$em)) {
            $paths = array(SRC_ROUTE."/Model");
            $isDevMode = true;

            if(file_exists(APP_ROUTE."/config.yml")){
                $userConfig = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(APP_ROUTE."/config.yml"));
            } else {
                return new Error("Any config file exist");
            }

            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => $userConfig["database_user"],
                'password' => $userConfig["database_password"],
                'dbname'   => $userConfig["database_name"],
            );

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            self::$em = EntityManager::create($dbParams, $config);

        }

    }

    public function getEntityManager(){
        return self::$em;
    }


}
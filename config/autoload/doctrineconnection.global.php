<?php
/**
 * Created by PhpStorm.
 * User: darksy
 * Date: 12/12/2015
 * Time: 14:17
 */

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'movieden',
                )
            )
        )
    ),
);
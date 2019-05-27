<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//database connection instantiation
$container['db']=function($cont)
{
    $db=$cont['settings']['db'];
    //sql server
    try
    {
        $conn = sqlsrv_connect($db['host'], $db['conn_string']);
        if($conn)
        {
            return $conn;
        }
        else {
            throw new Exception("Error unable to connect to SQLSRV database");
        }
    }
    catch (\Exception $e)
    {
            die("Exception while trying to connect to DB ".$e);
    }
    /*$pdo=new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//throw exception on error
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;*/
};

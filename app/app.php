<?php

require __DIR__ . '/../vendor/autoload.php';

use Http\Request;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$app2= new Model\JsonFinder();

// DB connections
$connection = new \Model\Connection("mysql", "uframework", "localhost", "uframework", "passw0rd");
$memoryFinder = new \Model\StatusQuery($connection->getConnection());

/**
 * Index
 */
$app->get('/', function (Request $request) use ($app) {
    return $app->redirect('/statuses');
});

$app->get('/statuses', function (Request  $request) use ($app,$memoryFinder) {
    $url = $_SERVER['QUERY_STRING'];
    if(empty($url)){
        $statuses = $memoryFinder->findAll();
    }
    else{
        $result = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($result, $criteria);

        $statuses = $memoryFinder->findCriteria($criteria);
    }
    if($request->guessBestFormat() == 'json'){
        return $statuses;
    }else{
        return $app->render('statusesList.php',["statuses" => $statuses]);
    }
});

$app->get('/statuses/(\d+)', function (Request  $request,$id) use ($app,$memoryFinder) {
    $statuses = $memoryFinder->findOneById($id);
    if($statuses === null)
        throw new \Exception\HttpException(404, "Object doesn't exist");
    if($request->guessBestFormat() == 'json'){
        return $statuses;
    }else{
        return $app->render('statuses.php',["statuses" => $statuses,
                                        'id' => $id]);
    }
});

$app->post('/statuses', function (Request  $request) use ($app,$memoryFinder) {
    session_start();
    $user = $_SESSION['username'];
    if(is_null($user))
        $user = 'anonymous';
    $memoryFinder->addStatus($request,$user);
    $app->redirect('/statuses');
});

$app->delete('/statuses/(\d+)', function (Request  $request,$id) use ($app,$memoryFinder) {
    session_start();
    $status = $memoryFinder->findOneById($id);
    $userStatus = $status->getUsername();
    if(isset($_SESSION['username']))
        if($_SESSION['username'] === $userStatus || $_SESSION['username'] === 'admin')
            $memoryFinder->RemoveOneById($id);
    $app->redirect('/');
});

$app->addListener('process.before', function(Request $req) use($app){
    session_start();

    $allowed = [
        '/login' => [ Request::GET, Request::POST ],
    ];
    if(isset($_SESSION['is_authentificated'])
        && true === $_SESSION['is_authentificated']){
        return;
    }

    foreach($allowed as $pattern => $methods){
        if(preg_match(sprintf('#s$#', $pattern), $req->getUri())
            && in_array($req->getMethod(), $methods)){
            return;
        }
    }

    switch($req->guessBestFormat()){
        case 'json' :
            throw new \Exception\HttpException(401);
    }

    return $app->redirect('/login');
});

$app->get('/login', function () use ($app){
    return $app->render('login.php');
});

$app->post('/login', function (Request $request) use ($app){
    session_start();
    $user = $request->getParameter('user');
    $pass = $request->getParameter('password');

    if('admin' === $user && 'admin' === $pass){
        $_SESSION['is_authenticated'] = true;
        $_SESSION['username'] = $user;
        return $app->redirect('/statuses');
    }

    if('alban' === $user && 'alban' === $pass){
        $_SESSION['is_authenticated'] = true;
        $_SESSION['username'] = $user;
        return $app->redirect('/statuses');
    }
    return $app->render('login.php',['user' => $user]);
});

$app->get('/logout', function (Request $request) use ($app){
    session_start();
    session_destroy();
    return $app->redirect('/');
});

$app->get('/AddStatuses', function(Request $request) use ($app){
    return $app->render('addStatuses.php');
});
return $app;

<?php
    require 'js/parse/autoload.php';
    require_once 'includes/Twig/Autoloader.php';
    use Parse\ParseException;
    use Parse\ParseUser;
    use Parse\ParseSessionStorage;
    use Parse\ParseClient;

    session_start();

    $app_id = '4IP9TbwR6X29Y6oO0fnLh2i2JjpTGqr89R9Ttt9N';
    $rest_key = 'guscdOR2euxdvyZg8909LtvXSJfKmC2xUdycHE2b';
    $master_key = 'QIJcNWZt5yClZa5QvigEwOid0beF83gWrbpBn55s';
    ParseClient::initialize( $app_id, $rest_key, $master_key );
    $storage = new ParseSessionStorage();
    ParseClient::setStorage($storage);
    
    $result =false;

    try {
        $user = ParseUser::logIn($_POST['name'], $_POST['password']);
        $user->save();
        $result = true;
    } catch (ParseException $error) {
        echo $error;
    }
    
    $user = ParseUser::getCurrentUser();
    $_SESSION['user'] = $user;

    if($result){
        Twig_Autoloader::register();
        //loader for template files
        $loader = new Twig_Loader_Filesystem('templates');
        //twig instance
        $twig = new Twig_Environment($loader, array(
            'cache' => 'cache',
        ));
        //load template file
        $twig->setCache(false);

        $template = $twig->loadTemplate('main.html');
        //$template = $twig->loadTemplate('my-things.html');
        echo $template->render(array('title' => 'Start', 'nav'=>1, 'user' => $user)); 
    }else{
        echo 0;
    }
    
?>
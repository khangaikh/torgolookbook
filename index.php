<?php
    require_once 'includes/Twig/Autoloader.php';
    require_once "config.php";
    use Parse\ParseObject;
    use Parse\ParseClient;
    use Parse\ParseQuery;
    use Parse\ParseUser;
    
    session_start();
    //register autoloader
    Twig_Autoloader::register();
    //loader for template files
    $loader = new Twig_Loader_Filesystem('templates');
    //twig instance
    $twig = new Twig_Environment($loader, array(
        'cache' => 'cache',
    ));
    //load template file
    $twig->setCache(false);

    if(isset($_GET['detail'])){
        $template = $twig->loadTemplate('detail.html');

        $query = new ParseQuery("Fashion");
        $query->equalTo("objectId",$_GET['detail']);
        $e = $query->first();
        echo $template->render(array('title' => 'Products', 'nav'=>2, 'item' =>$e));
        return;
    }
    if(isset($_GET['torgo'])){
        $template = $twig->loadTemplate('admin.html');
        echo $template->render(array('title' => 'Products', 'nav'=>1));
        return;
    }
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if(isset($_GET['logout'])){
            session_unset();
            session_destroy();
            $query = new ParseQuery("Fashion");
            $results = $query->find();
            $template = $twig->loadTemplate('main.html');
            //render a template
            echo $template->render(array('title' => 'See you agian', 'nav'=>1, 'fashions' => $results)); 
        }
        else if(isset($_GET['add'])){
            $template = $twig->loadTemplate('add.html');
            echo $template->render(array('title' => 'See you agian', 'nav'=>1, 'user'=>$user)); 
        }
        else if(isset($_GET['detail'])){
            $template = $twig->loadTemplate('detail.html');

            $query = new ParseQuery("Fashion");
            $query->equalTo("objectId",$_GET['detail']);
            $e = $query->first();
            echo $template->render(array('title' => 'Products', 'nav'=>2, 'item' =>$e));
        }
        else{
            $query = new ParseQuery("Fashion");
            $results = $query->find();
            $template = $twig->loadTemplate('main.html');
            echo $template->render(array('title' => 'Start','user'=>$user, 'nav'=>1, 'fashions' => $results)); 
        }
    }
    else{
        $template = $twig->loadTemplate('main.html');
        $query = new ParseQuery("Fashion");
        $results = $query->find();
        echo $template->render(array('title' => 'Start', 'nav'=>1, 'fashions' => $results)); 
    }
?>


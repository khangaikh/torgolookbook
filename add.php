<?php
    require 'js/parse/autoload.php';
    require_once 'includes/Twig/Autoloader.php';
    require_once "config.php";
    use Parse\ParseException;
    use Parse\ParseUser;
    use Parse\ParseSessionStorage;
    use Parse\ParseClient;
    use Parse\ParseObject;
    use Parse\ParseQuery;

    session_start();


    if (file_exists("img/items/" . $_FILES["cover"]["name"]))
    {
        echo $_FILES["cover"]["name"] . " already exists. ";
    }
    else
    {
        move_uploaded_file($_FILES["cover"]["tmp_name"],"img/items/" . $_FILES["cover"]["name"]);
    }

    $paths=array();

    $total = count($_FILES['files']['name']);

    for($i=0; $i<$total; $i++) {
      //Get the temp file path
      $tmpFilePath = $_FILES['files']['tmp_name'][$i];

      //Make sure we have a filepath
      if ($tmpFilePath != ""){
        //Setup our new file path
        $newFilePath = "img/items/" . $_FILES['files']['name'][$i];

        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

          array_push($paths, $newFilePath);

        }
      }
    }

    $result = false;
    
    $fashion = new ParseObject("Fashion");
    $fashion->set("code", $_POST['code']);
    $fashion->set("category", $_POST['category']);
    $fashion->set("cover", $_FILES["cover"]["name"]);
    $fashion->setArray('files',$paths);

    try {
        $fashion->save();
        $result = true;
    } catch (ParseException $ex) {  
        // Execute any logic that should take place if the save fails.
        // error is a ParseException object with an error code and message.
        echo 'Error: Failed to create new object, with error message: ' . $ex->getMessage();
        return;
    }

    if($result){
        $user = ParseUser::getCurrentUser();
        $_SESSION['user'] = $user;
        Twig_Autoloader::register();
        //loader for template files
        $loader = new Twig_Loader_Filesystem('templates');
        //twig instance
        $twig = new Twig_Environment($loader, array(
            'cache' => 'cache',
        ));
        //load template file
        $twig->setCache(false);

        $template = $twig->loadTemplate('add.html');
        //$template = $twig->loadTemplate('my-things.html');
        echo $template->render(array('title' => 'Start', 'nav'=>1, 'user' => $user));
    }else{
        echo "Error: User please select valid username";
    }
 
?>
     
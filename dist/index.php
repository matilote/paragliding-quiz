<?php
  session_start();

  include 'vendor/autoload.php';
  include 'core/router.php';
  
  $DIR = dirname(__FILE__) . "/";

  $pug = new Pug([
    'pretty' => true
  ]);

  if(isset($_POST['choice-submit'])) {
    $choiceSubmit = $_POST['choice-submit'];
    $_SESSION['choice-submit'] = $choiceSubmit;
    $url = "question.php";
    header('Location: ' . $url);
    exit();
  }

  $t_router = router($_GET, $DIR);

  echo $pug->render('templates/content/' . $t_router[0] . '.pug', $t_router[1]);

?>
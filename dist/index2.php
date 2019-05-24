<?php

  include 'vendor/autoload.php';
  include 'core/router.php';

  
  $pug = new Pug([
    'pretty' => true
  ]);
  

  $t_router = router($_GET);
  
  // print_r($t_router[1]);

  echo $pug->render('templates/content/' . $t_router[0] . '.pug', $t_router[1]);

?>
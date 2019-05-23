<?php

  include 'vendor/autoload.php';
  include 'core/router.php';

  
  $pug = new Pug([
    'pretty' => true
  ]);
  

  $t_router = router($_GET);
  
  echo $pug->render($t_router[0], $t_router[1]);

?>
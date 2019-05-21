<?php

  // include 'vendor/autoload.php';
  include 'core/router.php';

  /*
  $pug = new Pug([
    // here you can set options
  ]);
  */

  $t_router = router($_GET);

//   print_r($t_router)
  
  /*
  $output = $pug->render($t_router[0], $t_router[1]);

  echo $output
  */

?>
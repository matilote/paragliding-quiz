<?php

  function getTemplate($page) {

    $routes = ['index', 'pytanie', 'wynik'];

    if (!isset($page)) {
      return 'index';
    };

    if (in_array($page, $routes)) {
      return $page;
    };

    return '404';
  };

  function getGlobalVariables() {
    $categories = require('categories.php');
    return [
      'categories' => $categories
    ];
  };

  function getIndexVariables() {
    return [
      'title' => 'To jest index'
    ];
  };

  function getQuizVariables() {
    return [];
  };

  function getResultsVariables() {
    return [];
  };

  function get404Variables() {
    return [];
  };


  function getVariables($template, $params = []) {

    $category = $_GET['cat'];
    
    $question = $_GET['question'];

    switch ($template) {
      case 'index':
        $local = getIndexVariables();
        break;
      case 'pytanie':
        $local = getQuizVariables();
        break;
      case 'wynik':
        $local = getResultsVariables();
        break;
      default:
        $local = get404Variables();
    }

    $global = getGlobalVariables();

    return $global + $local; // Jak łączyc tablice w PHP (merge)
  };


  function router($params = []) {
    
    $t_router = [];
  
    $t_router[0] = getTemplate($_GET['page']);

    $t_router[1] = getVariables($t_router[0], $params);

    return $t_router;
  };

?>
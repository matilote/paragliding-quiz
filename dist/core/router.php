<?php

  require('data.php');

  function getTemplate($page, $DIR) {
    $routes = ['index', 'pytanie', 'wynik'];

    if (!isset($page)) {
      return 'index';
    };

    if (in_array($page, $routes)) {
      return $page;
    };

    return 'error';
  };

  function getGlobalVariables() {
    $categories = require('categories.php');
    return [
      'categories' => $categories
    ];
  };

  function getIndexVariables() {
    return [
      'headTitle' => 'Przygotuj się do egzaminu na Paralotniarza',
      'categoryTitle' => 'Kategorie pytań'
    ];
  };

  function getQuestionVariables($category, $questionId, $DIR) {
    $t_question = getQuestion($category, $questionId, $DIR);
    return [
      'question' => $t_question
    ];
  };

  function getResultsVariables() {
    return [];
  };

  function get404Variables() {
    return [];
  };


  function getVariables($template, $params = [], $DIR) {

    $category = $_GET['cat'];
    
    $question = $_GET['question'];

    switch ($template) {
      case 'index':
        $local = getIndexVariables();
        break;
      case 'pytanie':
        $local = getQuestionVariables($category, $question, $DIR);
        /*if (!isset($local['question'])) {
          // header("Location: /index2.php?page=error&e=missingCategory");
        }*/
        break;
      case 'wynik':
        $local = getResultsVariables();
        break;
      default:
        $local = get404Variables();
    }

    $global = getGlobalVariables();

    return $global + $local;
  };


  function router($params = [], $DIR) {
    
    $t_router = [];
  
    $t_router[0] = getTemplate($_GET['page'], $DIR);

    $t_router[1] = getVariables($t_router[0], $params, $DIR);

    return $t_router;
  };

?>
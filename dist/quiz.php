<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Quick Quiz - Play</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/quiz.css"/>
  </head>
  <body>
    <?php
      $category = 'human';
      $id = 1;
      $url = "http://localhost:81/paragliding-quiz/api/api.php?quiz=$category&id=$id";
    
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $curl_response = curl_exec($curl);
      if ($curl_response === false) {
          $info = curl_getinfo($curl);
          curl_close($curl);
          die('Error occured during curl exec. Additional info: ' . var_export($info));
      }
      curl_close($curl);
      $decoded = json_decode($curl_response);
      if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
          die('Error occured: ' . $decoded->response->errormessage);
      }

      $question = $decoded->content->question->content;
      $optionsArray = array();
      $contentArray = array();
      $answersArray = $decoded->content->answers;
      foreach($answersArray as $value) {
        $option = $value->option;
        $content = $value->content;
        array_push($optionsArray, $option);
        array_push($contentArray, $content);
      };

      echo  '<div class="container">
      <div id="quiz" class="justify-center flex-column">
        <h2 id="question">'.$question.'</h2>
        <div class="choice-container">
          <p class="prefix">'.$optionsArray[0].'</p>
          <p class="question-text" data-number="1">'.$contentArray[0].'</p>
        </div>
        <div class="choice-container">
          <p class="prefix">'.$optionsArray[1].'</p>
          <p class="question-text" data-number="2">'.$contentArray[1].'</p>
        </div>
        <div class="choice-container">
          <p class="prefix">'.$optionsArray[2].'</p>
          <p class="question-text" data-number="3">'.$contentArray[2].'</p>
        </div>
        <div class="choice-container">
          <p class="prefix">'.$optionsArray[3].'</p>
          <p class="question-text" data-number="4">'.$contentArray[3].'</p>
        </div>
        <div class="progress-container">
          <h2>Question</h2>
          <div class="progress" style="height: 3rem; border-radius: 1rem;">
            <div
              class="progress-bar"
              id="progress-bar"
              role="progressbar"
              style="width: 33.3%; font-size: 1.5rem; background-color: rgb(199, 90, 90);"
            >
            </div>
          </div>
        </div>
      </div>';
      ?>
    </div>
  </body>
</html>

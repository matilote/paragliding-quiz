<?php

function getQuestion($category, $questionId, $DIR)
{
	$path = $DIR . getCategoryDataFile($category);
	if ($path) {
		$data = file_get_contents($path);
		$t_category = json_decode($data, true);
    $question = $t_category['questions'][$questionId - 1];
		return $question;
	} else {
		return null;
	};
}


function getCategoryDataFile($category) {
	switch ($category) {
		case "human":
			$path = 'data/' . $category . ".json";
			return $path;
		default:
			return null;
	};
}
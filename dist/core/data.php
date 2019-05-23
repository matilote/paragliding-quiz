<?php

function get_questions($quiz, $id)
{
	$url = '../data/human.json';
	$data = file_get_contents($url);
	$quizArray = json_decode($data);
	$item = NULL;
	
	foreach ($quizArray as $key=>$content) {
		if($key == $quiz && $quiz == $content->quiz)
		{
			$obj = $content->questions;
			if($id == $obj[$id - 1]->id) {
				$item = $obj;
				return $item[$id - 1];
				break;
			}
			break;
		} else {
			print('ERROR');
		}
	}
}
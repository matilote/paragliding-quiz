<?php
header("Content-Type:application/json");
require "data.php";

if(!empty($_GET['quiz'] && $_GET['id']))
{
	$quiz=$_GET['quiz'];
	$id=$_GET['id'];
	$question = get_questions($quiz, $id);
	
	if(empty($question))
	{
		response(200,"Questions Not Found",NULL);
	}
	else
	{
		response(200,"Questions for category $quiz have been found",$question);
	}
	
}
else
{
	response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$content)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['content']=$content;
	
	$json_response = json_encode($response);
	echo $json_response;
}
<?php 
function public_url($url ='')
{
	return base_url('public/'.$url);
}


function upload_url($url ='')
{
	return base_url('upload/'.$url);
}

function pre($list, $exit = true)
 {
 	echo "<pre>";
	print_r($list);
	if($exit)
	{
	 	die();
	}
 }

 

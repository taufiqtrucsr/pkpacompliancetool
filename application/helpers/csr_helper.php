<?php

function generateUniqueID($length ,$type='') {
	
	if($type=='Numeric')
	{
		$characters = '0123456789';
	}else if($type=='Alphabetic'){
		   $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}else{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
    
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function shortContent($content,$length)
{
	//return character_limiter(strip_tags($content), $length);
	$content=strip_tags($content);
	$short_content='';
	if (strlen($content) >= $length) {
		$short_content = substr($content, 0, strrpos(substr($content, 0, $length), ' '));	
	}
	return $short_content;
}


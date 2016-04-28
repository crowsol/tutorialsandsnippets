<?php
/*
By: Scott Waldron
TheWayOfCoding.com

- All resources retain copyright (bitmaps, etc).
- You are not allowed to use these projects 
as tutorials or samples distributed with your own branding.
Basically, any use with the same theme as they were 
intended for with TheWayOfCoding.com is not allowed.

The MIT License (MIT)

Copyright (c) 2016 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

header('Content-type: text/xml; charset=utf-8');

$constructedResponse = '<?xml version="1.0" encoding="utf-8"?><result>';

if (!empty($_POST) && !empty($_POST["action"])) {
	//perform an action based on the request
	switch($_POST['action']) {
		case 'get-timestamp':
			$date = new DateTime();
			$constructedResponse .= '<responsedata>' . $date->getTimestamp() . '</responsedata>';
			break;
			
		case 'get-random-int':
			if(!empty($_POST["range-bottom"]) && !empty($_POST["range-top"])) {
				if(is_numeric($_POST["range-bottom"]) && is_numeric($_POST["range-top"])) {
					$constructedResponse .= '<responsedata>' 
						. rand($_POST["range-bottom"], $_POST["range-top"]) 
						. '</responsedata>';
				}
			} else {
				$constructedResponse += '<responsedata>Request Error</responsedata>';
			}
			break;
	}
} else {
	$constructedResponse .= '<responsedata></responsedata>';
}

$constructedResponse .= '</result>';

//for testing on a local server have a delay
sleep(1);

echo $constructedResponse;
?>

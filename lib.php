<?php
/**
 * File: lib.php 
 *
 * contains function to log errors or date format etc.
 *
 * @author       Celine Chan 
 * @created      Oct 12, 2010
 * @copyright    2007-2017 Interdisciplinary Earth Data Alliance, Columbia University. All Rights Reserved.
 *               Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0
 *
 *               Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
*/

	function log_error($message, $die)
	{
		error_log($message);
		die($die);
	}

	function log_debug($message)
	{
		error_log($message);
		return $message;
	}
	
	function format_date($date, $format)
	{
		// 1 - Release Date
		// 2 - 1/1/2001 1:30 PM format
		// 3 - 2001
		// 4 - 2001-01-23
		
		if($format == 1)
		{
			if($date == '0000-00-00') 
			{
				return "None";
			}
			else
			{
				return date("m/d/Y", strtotime($date));
			}
		}
		elseif($format == 2)
		{
			return date("m/d/Y g:i A", strtotime($date));
		}
		elseif($format == 3)
		{
			return date("Y", strtotime($date));
		}
		elseif($format == 4)
		{
			return date("Y-m-d", strtotime($date));
		}
	}
	
	function splitSearch($keywords, $modifier)
	{
		$return = null;
		
		$keywords = str_replace(",", " ", $keywords);
		$keywords = str_replace("\"", " ", $keywords);
		$keywords = trim($keywords);
		
		if(strlen($keywords) == 0)
		{
			return $return;
		}
		
		$keys = explode(" ", $keywords);

		for($x=0;$x<count($keys);$x++)
		{
			$return .= $modifier.trim($keys[$x])." ";
		}
		
		return $return;
	}
	
	function getRefPage()
	{
		$url = $_SERVER['HTTP_REFERER'];
		
		if( $url )
		{
			//check if ? exists
			$param = strpos($url,'?');
			
			if($param)
			{
				$url = strrev($url); //reverse string 
				$last_q = strlen($url) - strpos($url,'?') - 1;
				$url = strrev($url); //reverse string
	
				if( $last_q )
				{
					$url = substr($url, 0, $last_q);
				}
			}

			$url = strrev($url); //reverse string 
			$last_slash = strlen($url) - strpos($url,'/') - 1;
			$url = strrev($url); //reverse string

			if( $last_slash )
			{
				$url = substr($url,$last_slash+1);
			}

		}
			
		return $url;
	}




?>

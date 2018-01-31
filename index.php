<?php

/**
 * File: DBConnection.php
 *
 *   php module that takes a usag dataset, queries the usap-dc database
 *   to get DataCite XML, transforms it to ISO19139 xml and puts in 
 *   get.iedatadata.org/metadata/iso/usap
 *

 * @author     2018-01-30 Stephen Richard
 * @copyright    2007-2018 Interdisciplinary Earth Data Alliance, Columbia University. All Rights Reserved.
 *               Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0
 *
 *               Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

	require_once "DBConnection.php";
	// require_once "lib.php";
	
	$option = 'sync1';
	

	$dataset_id=$_GET['id'];
	
    //$dataset_id='601026';
	
	if (endsWith($dataset_id,'iso.xml')) {
	    $dataset_id = substr($dataset_id,0,6);
	    $option='isoxml';
	} elseif(endswith($dataset_id,'.xml')){
	    $dataset_id = substr($dataset_id,0,6);
	    $option='datacitexml';
	} elseif ($dataset_id=='sync') {
	    $option = 'all';
	    $dataset_id='';
	}
	
	if($dataset_id==''){
	    $sql=" SELECT id, status_id, datacitexml dcxml  from generate_datacite_xml";
	    $option = 'all';
	}  else {	
	$sql=" SELECT id, status_id, datacitexml dcxml  from generate_datacite_xml
	where id='{$dataset_id}';";
	}
    //echo '<p>' . $sql . ' option: ' . $option;
    //echo '</p>';

    $xslfile = "DataciteToISO19139v3.2.xslt";
    $xslt = new XSLTProcessor();
    $xslt->importStylesheet(new SimpleXMLElement(file_get_contents($xslfile)));
    
$dbconnect_main = DBConnection::doUSAPDBConnect();
	$rs = pg_query($dbconnect_main, $sql) or log_error("USAPDataCiteTransform.php: ".pg_result_error($dbconnect_main), "Error occured executing the select query.");

    $counter = 0;	
	while ($row = pg_fetch_object($rs)) {	 

	    $content = $row->dcxml;
	    $newxml = $xslt->transformToXml(new SimpleXMLElement($content));
	    
	    if ($option=='all' or $option=='sync1'){
	    //echo 'all or sync1' . "\n";
	    $my_file = 'metadata/iso/usap/usap_iso_' . $row->id . '.xml';
	    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
	    fwrite($handle, $newxml);
	    $counter=$counter+1;
	    fclose($handle);
	    } elseif ($option=='isoxml'){
	        //echo "\n" . 'echo iso xml' . "\n";
	        echo $newxml;
	    } elseif ($option=='datacitexml'){
	        //echo "\n" . 'echo datacite xml' . "\n";
	        echo $row->dcxml;
	    } else {
	        echo 'option fail';
	        echo '<p>';
	    }
	}
	DBConnection::doDBClose($dbconnect_main);
	if ($option=='all' or $option=='sync1'){
	    echo "\n" . $counter . ' records written to metadata/iso/usap/';
	}
	
	// from  https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
	function endsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    //echo 'endswith ' . $haystack . ' ' .$needle;
	    return $length === 0 ||
	    (substr($haystack, -$length) === $needle);
	}
	
?>
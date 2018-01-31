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
	require_once "lib.php";

//	$dataset_id=$_GET['id'];
	$dataset_id='601026';
	
	if($dataset_id==""){
		$dataset_id="nonegiven";
	};

	$sql=" SELECT id, status_id, datacitexml dcxml  from generate_dc_xmlastext
	where id='{$dataset_id}';";
    echo $sql;
//    echo "\n";

    $xslfile = "DataciteToISO19139v3.2.xslt";
    $xslt = new XSLTProcessor();
    $xslt->importStylesheet(new SimpleXMLElement(file_get_contents($xslfile)));
    
$dbconnect_main = DBConnection::doUSAPDBConnect();
	$rs = pg_query($dbconnect_main, $sql) or log_error("USAPDataCiteTransform.php: ".pg_result_error($dbconnect_main), "Error occured executing the select query.");
	while ($row = pg_fetch_object($rs)) {
			 
	    
	    echo $row->id;
	    echo "\n";
	    echo $row->status_id;
/* 	    echo "<p> <textarea rows='100' cols='100'>";
	    echo $row->dcxml;
	    echo "</textarea></p>"; */
	    

	    $content = $row->dcxml;
	    $newxml = $xslt->transformToXml(new SimpleXMLElement($content));
/* 	    echo "<p> <textarea rows='200' cols='100'>";
	    echo $newxml;
	    echo "</textarea></p>"; */
	    
	    $my_file = 'metadata/iso/usap/usap_iso_' . $row->id . '.xml';
	    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
	    fwrite($handle, $newxml);
	    fclose($handle);
	}
	DBConnection::doDBClose($dbconnect_main);
	

	

?>
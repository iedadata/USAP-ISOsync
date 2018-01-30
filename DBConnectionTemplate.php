<?php
/**
 * File: DBConnection.php 
 *
 * Contains database connection functions. 
 *
 * @author       Samantha Chan 
 * @created      May 1, 2014
 * @modified     Dec 7,2017 (Lulin Song) 
 * @copyright    2007-2017 Interdisciplinary Earth Data Alliance, Columbia University. All Rights Reserved.
 *               Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0
 *
 *               Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
*/
$programRoot = $_SERVER['DOCUMENT_ROOT'];
if(!isset($programRoot) || strlen($programRoot) == 0 )
    $programRoot = dirname(__FILE__).'/../../';
include_once ($programRoot.'/includes/php/DB/db_in.php');
include_once ($programRoot.'/includes/php/lib.php');

class DBConnection {

	static function doAdminDBConnect() {
		$connection_string = "host=" .SERVERNAME1. " port=" .PORT1. " dbname=".DBNAME2. " user=" .DBLOGIN3. " password=" .DBPASSWORD3. " connect_timeout=20";
		
		if(!$admin_dbconnect_main = pg_connect($connection_string)) {
				echo "Database Connection admin failed to the host. ";
				exit;
			}
		return $admin_dbconnect_main;
	}
	
	static function doPublicDBConnect() {
		$connection_string = "host=" .SERVERNAME1. " port=" .PORT1. " dbname=".DBNAME2. " user=" .DBLOGIN2. " password=" .DBPASSWORD2. " connect_timeout=8";

		if(!$dbconnect_main = pg_connect($connection_string)) {
			echo "Database Connection public failed to the host. ";
			exit;
		}
		return $dbconnect_main;
	}
	
        /* Get IEDA database admin connection */
	static function doIEDADBAdminConnect() {
		$connection_string = "host=" .IEDASERVERNAME. " port=" .IEDAPORT. " dbname=".IEDADBNAME. " user=" .IEDADBLOGIN. " password=" .IEDADBPASSWORD. " connect_timeout=8";

		if(!$dbconnect_main = pg_connect($connection_string)) {
			echo "Database Database connection failed to the host. ";
			exit;
		}
		return $dbconnect_main;
        }

        /* Get Award Tracker database admin connection */
        static function doAwardTrackerDBConnect() {
                $connection_string = "host=" .SERVERNAME3. " port=" .PORT3. " dbname=".DBNAME1. " user=" .DBLOGIN1. " password=" .DBPASSWORD1. " connect_timeout=6";
 
                if(!$admin_dbconnect_main = pg_connect($connection_string)) {
                                echo "Database Connection admin failed to the host. ";
                                exit;
                        }
                return $admin_dbconnect_main;
        }

        /* Close database connection */
	static function doDBClose($dbConnection) {
		pg_close($dbConnection);
	}
}
?>

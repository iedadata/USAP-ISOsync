<?php
# these connection strings and locations will need to be 
#  updated to work in your local environment...
 
if(!defined('SERVERNAME1'))
  define("SERVERNAME1","server1");
# For Fastlane Search
if(!defined('SERVERNAME2'))
  define("SERVERNAME2","server2");
# For Award Tracker
if(!defined('SERVERNAME3'))
  define("SERVERNAME3","server3");

if(!defined('PORT1'))
  define("PORT1","80");
if(!defined('PORT2'))
  define("PORT2","80");
if(!defined('PORT3'))
  define("PORT3","80");

if(!defined('DBNAME1'))
  define("DBNAME1","db1");
if(!defined('DBNAME2'))
  define("DBNAME2","db2");
if(!defined('DBNAME3'))
  define("DBNAME3","db3");

if(!defined('DBLOGIN1'))
  define("DBLOGIN1","login1");
if(!defined('DBLOGIN2'))
  define("DBLOGIN2","login2");
if(!defined('DBLOGIN3'))
  define("DBLOGIN3","login3");
if(!defined('DBLOGIN4'))
  define("DBLOGIN4","anonymous");

if(!defined('DBPASSWORD1'))
  define("DBPASSWORD1","pwd1");
if(!defined('DBPASSWORD2'))
  define("DBPASSWORD2","pwd2");
if(!defined('DBPASSWORD3'))
  define("DBPASSWORD3","pwd3");
if(!defined('DBPASSWORD4'))
  define("DBPASSWORD4","anonpwd");

if(!defined("GEOSERVER_URL"))
  define("GEOSERVER_URL","http://some.geoserver.org");

if(!defined("GEOSERVER_LAYER"))
  define("GEOSERVER_LAYER","Geoserver:layername");

?>

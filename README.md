# USAP-ISOsync
PHP module to sync ISO metadata watch directory with USAP-DC database


The index.php implements functionality.
DBConnection.php creates the database connection using parameters set in the db_in.php file.  Copy the template files, remove the 'Template' string and adjust the connection information as ncessary for the deployment environment. 

Code reads from the usap-dc database, accessing the 'generate_datacite_xml' query to get the DataCite xml records. Query returns 
id, which is the usap-dc dataset id
status_id, indicates 'complete' 'in progress', etc., allows filtering for records in a particular status. The database queries are constructed in the index.php page. 

index.php takes one parameter: 'id', which is the 6 character dataset identifier used in the in the USAP database. The following read only operations are supported:
{host name}/usapmetadata/?id=600452 : updates a single record to the target iso/usap watch directory.
{host name}/usapmetadata : generates ISO xml for  all records in usap-dc database, replacing all in the iso/usap folder. 
{host name}/usapmetadata/?id=600452.xml : returns DataCite XML for the provided dataset id
{host name}/usapmetadata/?id=600452iso.xml : returns ISO 19139 xml for the provided dataset id
{host name}/usapmetadata/?id=sync :  generates ISO xml for  all records in usap-dc database, replacing all in the iso/usap folder. Equivalent to no parameter.

The php code requiers the php-xml and php-pgsql extensions to be enabled. It was generated using php v5.6.31, running with Apache. The USAP-DC data base is a Postgres database.

SMR 2018-01-31

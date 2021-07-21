<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificats in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/
$active_group = 'default';
$query_builder = TRUE;
/*
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.102.65',
	'username' => 'postgres',
	'password' => 'd@shb0@rd',
	'database' => 'dashboard',
	'dbdriver' => 'postgre',
	'schema'   => 'public',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
*/

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'postgres',
	'password' => 'd@shb0@rd',
	'database' => 'dashboard',
	'dbdriver' => 'postgre',
	'schema'   => 'public',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['rental'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'postgres',
	'password' => 'd@shb0@rd',
	'database' => 'rental',
	'dbdriver' => 'postgre',
	'schema'   => 'rental',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['dms'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.89.82',
	'username' => 'postgres',
	'password' => 'etaximenyelam',
	'database' => 'etaxi',
	'dbdriver' => 'postgre',
	'schema'   => 'dms',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['fms'] = array(
	// 'dsn'	=> '',
	// 'hostname' => '10.1.89.82',
	// 'username' => 'postgres',
	// 'password' => 'etaximenyelam',
	// 'database' => 'etaxi',
	// 'dbdriver' => 'postgre',
	// 'schema'   => 'fms',
	// 'dbprefix' => '',
	// 'pconnect' => FALSE,
	// 'db_debug' => FALSE,
	// 'cache_on' => FALSE,
	// 'cachedir' => '',
	// 'char_set' => 'utf8',
	// 'dbcollat' => 'utf8_general_ci',
	// 'swap_pre' => '',
	// 'encrypt' => FALSE,
	// 'compress' => FALSE,
	// 'stricton' => FALSE,
	// 'failover' => array(),
	// 'save_queries' => TRUE
// );

$db['localdepok'] = array(
	'dsn'	=> '',
	'hostname' => '10.2.9.204',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_ekl_depok',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['local5433'] = array(
	'dsn'	=> '',
	'hostname' => '10.2.9.114',
	'username' => 'postgres',
	'password' => 'express',
	'database' => 'evoucher',
	'port' 	   => '5433',
	'dbdriver' => 'postgre',
	'schema'   => 'public',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_pusat'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.89.30',
	'username' => 'root',
	'password' => 'dbadmingo2beno1',
	'database' => 'simtax_v2',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bintaro'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.31.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'dba',
	'password' => 'getSmart2013',
	'database' => 'simtax2_etu_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_ciganjur'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.2.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_etu_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_jagakarsa'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.3.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_etu_c',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_joglo_baru'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.18.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_etu_d',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_star'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.4.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_tss_sa',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_joglo'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.5.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_sip_pa',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipondoh_a'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.6.200',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_wmk_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipondoh_b'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.7.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_wmk_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipondoh_c'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.8.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_wmk_c',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_tangsel'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.13.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_fmt_tangsel',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['simtax_bekasi_a'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.9.200',
	'username' => 'usersitu3',
	'password' => 'usersitu',
	'database' => 'simtax2_mep_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_b'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.10.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'xpressgroup',
	'database' => 'simtax2_mep_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_c'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.11.200',
	//'username' => 'usersitu2',
	//'password' => 'expresssimtax',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_map_c',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_d'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.14.200',
	'username' => 'usersitu2',
	'password' => 'usersitu',
	'database' => 'simtax2_mep_d',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipendawa'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.29.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_emk_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_pondok_bambu'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.27.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_etu_g',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['simtax_cipayung'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.19.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_etu_f',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_depok'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.16.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'getSmart2013',
	'database' => 'simtax2_ekl_depok',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['simtax_mustikasari'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '10.0.10.200',
// 	//'username' => 'usersitu2',
// 	//'password' => 'usersitu',
// 	'username' => 'root',
// 	'password' => 'xpressgroup',
// 	'database' => 'simtax2_esbc_esa',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

$db['simtax_pekapuran'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.26.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_ekl_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_semarang'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.25.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'dbadmingo2beno1',
	'database' => 'simtax2_sep',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_padang'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.32.200',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'root',
	'password' => 'expresssimtax',
	'database' => 'simtax2_esu',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['dice_eagle'] = array(
	'dsn'	=> '',
	'hostname' => 'dice.expressgroup.co.id',
	'username' => 'itexpress',
	'password' => 'dice-eagle-it',
	'database' => 'dice_db',
	'dbdriver' => 'postgre',
	'schema'   => 'dice',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['evs'] = array(
	'dsn'	=> '',
	'hostname' => 'nebula.expdds.com',
	'username' => 'evoucheruser',
	'password' => '17evoucher',
	'database' => 'evoucher',
	'dbdriver' => 'postgre',
	'schema'   => 'evoucher',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['dice_tiara'] = array(
	'dsn'	=> '',
	'hostname' => 'dicetiara.expressgroup.co.id',
	'username' => 'itexpress',
	'password' => 'dice-tiara-it',
	'database' => 'spider',
	'dbdriver' => 'postgre',
	'schema'   => 'dice_tiara',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['x_one'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.102.30',
	'username' => 'postgres',
	'password' => '10Nov1945',
	'database' => 'spider',
	'dbdriver' => 'postgre',
	'schema'   => 'tiara_x1',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['x_one_ice'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.102.30',
	'username' => 'spideruser',
	'password' => '10spider',
	'database' => 'spider',
	'dbdriver' => 'postgre',
	'schema'   => 'tiara_x1',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['x_one_tiara'] = array(
	'dsn'	=> '',
	'hostname' => 'tiara.expressgroup.co.id',
	'username' => 'express',
	'password' => 'express!1',
	'database' => 'spiderjakarta',
	'dbdriver' => 'postgre',
	'schema'   => 'tiara_x1',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['enigma'] = array(
	'dsn'	=> '',
	'hostname' => 'enigmadb.expressgroup.co.id',
	'username' => 'sebastian',
	'password' => 's3b4st14n',
	'database' => 'enicmacrm',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['moce'] = array(
	'dsn'	=> '',
	'hostname' => 'moce.expressgroup.co.id',
	'username' => 'moce_user',
	'password' => 'expressm0c3',
	'database' => 'moce_db',
	'dbdriver' => 'postgre',
	'schema'   => 'moce',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['rental'] = array(
	// 'dsn'	=> '',
	// 'hostname' => 'rental.expressgroup.co.id',
	// 'username' => 'postgres',
	// 'password' => 'dice-eagle-it',
	// 'database' => 'rental',
	// 'dbdriver' => 'postgre',
	// 'schema'   => 'express',
	// 'dbprefix' => '',
	// 'pconnect' => FALSE,
	// 'db_debug' => FALSE,
	// 'cache_on' => FALSE,
	// 'cachedir' => '',
	// 'char_set' => 'utf8',
	// 'dbcollat' => 'utf8_general_ci',
	// 'swap_pre' => '',
	// 'encrypt' => FALSE,
	// 'compress' => FALSE,
	// 'stricton' => FALSE,
	// 'failover' => array(),
	// 'save_queries' => TRUE
// );

$db['etaxi'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.102.10',
	'username' => 'etaxi',
	'password' => 'etaximenyelam',
	'database' => 'etaxi',
	'dbdriver' => 'postgre',
	'schema'   => 'etaxi',
	'port'	   => '5432',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['etaxi_ice'] = array(
	'dsn'	=> '',
	'hostname' => '10.1.102.10',
	'username' => 'etaxi',
	'password' => 'etaximenyelam',
	'database' => 'etaxi',
	'dbdriver' => 'postgre',
	'schema'   => 'etaxi',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_integration'] = array(
	'dsn'	=> '',
	'hostname' => '10.2.89.80',
	'username' => 'postgres',
	'password' => 'm1nd4p@ss',
	'database' => 'simtax_integration',
	'dbdriver' => 'postgre',
	//'schema'   => 'etaxi',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['simtax_cipondoh_a_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_wmk_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipondoh_b_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'Simtax2_wmk_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_cipondoh_c_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'Simtax2_wmk_c',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['simtax_jagakarsa_jupiter'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'jupiter.expressgroup.co.id',
// 	//'username' => 'usersitu2',
// 	//'password' => 'usersitu',
// 	'username' => 'nur',
// 	'password' => '1Oct1945',
// 	'database' => 'simtax2_etu_c',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

// $db['simtax_bintaro_jupiter'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'jupiter.expressgroup.co.id',
// 	//'username' => 'usersitu2',
// 	//'password' => 'usersitu',
// 	'username' => 'nur',
// 	'password' => '1Oct1945',
// 	'database' => 'simtax2_etu_a',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

$db['simtax_ciganjur_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_etu_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_a_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_mep_a',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_b_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_mep_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_c_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_map_c',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_star_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_tss_sa',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_joglo_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_sip_pa',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_bekasi_d_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_mep_d',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_depok_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_ekl_depok',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_joglo_baru_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_etu_d',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['simtax_cipayung_jupiter'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'jupiter.expressgroup.co.id',
// 	//'username' => 'usersitu2',
// 	//'password' => 'usersitu',
// 	'username' => 'nur',
// 	'password' => '1Oct1945',
// 	'database' => 'simtax2_etu_f',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

$db['simtax_pekapuran_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_ekl_b',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_pondok_bambu_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_etu_g',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $db['simtax_cipendawa_jupiter'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'jupiter.expressgroup.co.id',
// 	//'username' => 'usersitu2',
// 	//'password' => 'usersitu',
// 	'username' => 'nur',
// 	'password' => '1Oct1945',
// 	'database' => 'simtax2_emk_a',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

$db['simtax_mustikasari_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_esbc_esa',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['simtax_tangsel_jupiter'] = array(
	'dsn'	=> '',
	'hostname' => 'jupiter.expressgroup.co.id',
	//'username' => 'usersitu2',
	//'password' => 'usersitu',
	'username' => 'nur',
	'password' => '1Oct1945',
	'database' => 'simtax2_fmt_tangsel',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
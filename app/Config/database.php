<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'admindQsZPph',
		'password' => '5gegcG2aRYNZ',
		'database' => 'php',
		'prefix' => '',
		'encoding' => 'utf8',
		
	);
	
	public function __construct() {
               if (getenv("OPENSHIFT_MYSQL_DB_HOST")):
	           $this->default['host']       = getenv("OPENSHIFT_MYSQL_DB_HOST");
	           $this->default['port']       = getenv("OPENSHIFT_MYSQL_DB_PORT");
	           $this->default['login']      = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
	           $this->default['password']   = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
	           $this->default['database']   = getenv("OPENSHIFT_APP_NAME");
	           $this->default['datasource'] = 'Database/Mysql';
	           $this->test['datasource']    = 'Database/Mysql';
	       else:
	           $this->default['host']       = getenv("OPENSHIFT_POSTGRESQL_DB_HOST");
	           $this->default['port']       = getenv("OPENSHIFT_POSTGRESQL_DB_PORT");
	           $this->default['login']      = getenv("OPENSHIFT_POSTGRESQL_DB_USERNAME");
	           $this->default['password']   = getenv("OPENSHIFT_POSTGRESQL_DB_PASSWORD");
	           $this->default['database']   = getenv("OPENSHIFT_APP_NAME");
	           $this->default['datasource'] = 'Database/Postgres';
	           $this->test['datasource']    = 'Database/Postgres';
	       endif;
	}
	
}

CompareTables
===========

This is a script that allow to compare different table columns from different mysql 
connections and return the correct ALTER MySQL's querys. Also this script can be 
used to return the correct jUpgradePro method to migrate your 3rd extensions.

## Introduction
To compare the tables we must to have 2 different Joomla! installations and the 
correct MySQL credentials to access.

You can to rename the configuration.php.dist file and set there your options and
the MySQL credentials.

Any and all feedback is welcome. Please send your comments to maguirre@matware.com.ar
 Pull requests also welcome of course. Thanks!

## Prerequisites
You must have an already installed joomla-platform.

## Installation

Clone the Joomla! Platform github project (Joomla! Framework soon!).

```
git clone git@github.com:joomla/joomla-platform.git
```

Grab the code from GitHub: 

```
git clone git@github.com:fastslack/joomla-cli-tools.git
```

## Configuration

Script usage parameters:

	/**
	* Show the table differences
	*/
	public $show_tables_diff = false;
	/**
	* Allow to compare the empty tables
	*/
	public $allow_tables_empty = false;
	/**
	* Create the ALTER sql query
	*/
	public $create_alter_query = true;
	/**
	* Create the jUpgradePro function
	*/
	public $create_jupgradepro_function = true;

Database of the first connection parameters:

	public $dbtype = 'mysqli';
	public $host = 'localhost';
	public $user = '';
	public $password = '';
	public $db = '';
	public $dbprefix = 'jos_';
	// (string) Pattern matching using SQL simple regular expression comparison.
	public $pattern = '%';

The second database connection:

	public $new_dbtype = 'mysqli';
	public $new_hostname = 'localhost';
	public $new_username = '';
	public $new_password = '';
	public $new_db = '';
	public $new_dbprefix = 'jos_';
	// (string) Pattern matching using SQL simple regular expression comparison.
	public $new_pattern = '%';


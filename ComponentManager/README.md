CompareValues
===========

This is a script that allow to compare different tables values to found differences and
make the migration process a little less hard.

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

	public $old_dbtype = 'mysqli';
	public $old_hostname = 'localhost';
	public $old_username = '';
	public $old_password = '';
	public $old_db = '';
	public $old_dbprefix = 'jos_';


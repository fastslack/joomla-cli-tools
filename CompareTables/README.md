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


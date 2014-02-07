JoomlaCliTools
===========

This is a collect of Joomla! CLI scripts that helps in differents tasks.

## AssetFix

If you have problems with your Joomla! #__assets table this script rewrite it from 
scratch using your existing content by reference.

## CompareTables

This is a script that allow to compare different table columns from different mysql 
connections and return the correct ALTER MySQL's querys. Also this script can be 
used to return the correct jUpgradePro method to migrate your 3rd extensions.

## CompareValues

This is a script that allow to compare different tables values to found differences 
and make the migration process a little less hard.

## ContentCleanup

This script is used to cleanup spam or junk content on your Joomla! site.

## CreateJoomlaView

This script allow us to create a Joomla! view (controllers, models, tables, views) 
using only a Joomla! form by reference. Its useful to create faster views to be modified
by the developer.

## CreateQuery

This simple script is used to create the INSERT values query using the table columns
by reference.

## CreateTableClass

This script create a Joomla! table class using the table that you setted in the
configuration before.

## GetImagesFromVideo

GetImagesFromVideo extract two images from one video to create trumbnails. It paste
the two images and insert a watermark. Then save the result in one jpg image.

## MigrateCSV2MySQL

Create a MySQL file dump using a separated comma file (CSV) by reference.

## OAuth2Tester

This script is useful to test the Joomla! OAuth2 library and the Joomla! Webservices API.

## RestfulTester

This script is useful to test RESTful connections.

## SimulateLogin

Simulate login and request one URI resource.

Installation
------------

Get the source code from GIT:

    git clone git@github.com:fastslack/joomla-cli-tools.git


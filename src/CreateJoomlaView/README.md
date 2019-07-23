CreateJoomlaView
===========

This script allow us to create a Joomla! view (controllers, models, tables, views) 
using only a Joomla! form by reference. Its useful to create faster views to be modified
by the developer.

## Installation
```
$ git clone git@github.com:fastslack/joomla-cli-tools.git
$ cd joomla-cli-tools
$ composer update
```

## Creating the Joomla! form

To use this script you must to create a Joomla! form using the default way to do this:

https://docs.joomla.org/Creating_a_custom_form_field_type

Then you should put it into the correct component directory:

`JOOMLA_PATH/administrator/components/com_example/models/forms`

## Executing the script

```
$ cd joomla-cli-tools/
$ ./bin/CreateJoomlaView --xml JOOMLA_PATH/administrator/components/com_example/models/forms/form_name.xml
```

CivUser - Authentication Module
===============================

Introduction
------------

CivUser is a ZF2 module for simple authentication. It can authenticate against
a database table or an LDAP directory, such as Microsoft Active Directory.


Installation
------------

Install via composer. Just add this module to your composer.json file. Then run
composer install.


Post Installation
-----------------

Copy the local.php.dist file into your applications configuration directory and
rename it to civuser.local.php

Change the setting to suit. Use either the dbtable config or the ldap config
(not both).


Documentation
-------------

Four routes are configured;

* /login
* /logout
* /profile
* /change-password


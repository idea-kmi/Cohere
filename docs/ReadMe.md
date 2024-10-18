
# Cohere

> [!IMPORTANT]  
> This code base was developed as part of research conducted at the Knowledge Media Institute at the Open University. Because it was research it may contain bespoke, or now redundant sections of code. This code base is no longer in active development. The majority of the code was originally developed between 2007 and 2010 with various updates and tweaks over the following years. So, a lot of the code is old in style and development practises.

> [!WARNING]  
> Some of this documentation may be out-of-date.


## Contents

*   [Overview](#overview)
*   [License](#license)
*   [System Requirements](#system-requirements)
*   [Folders](#folders)
*   [Setting up a Cohere Instance](#setting-up-a-cohere-instance)
*   [Sites Config Settings](#sites-config-settings)
*   [Language](#language)
*   [Additional Developer Notes](#additional-developer-notes)

*   [Introduction to using an Evidence Hub](#introduction-to-using-an-Evidence-Hub)


## Overview

We experience the information ocean as streams of media fragments, flowing past us in every modality... To make sense of these, learners, researchers and analysts must organise them into coherent patterns... Cohere was an idea management tool for people to weave meaningful connections between ideas, for personal, team or social use...  

Cohere was part of an emerging vision of sensemaking infrastructure for crafting, sharing and disputing ideas. We hoped it would contribute to effective online deliberation and debate in fields such as open, participatory learning, e-democracy, scholarly research, and knowledge management. 

## License

The Cohere code base is released under the LGPL license: [http://www.fsf.org/licensing/licenses/lgpl.html](http://www.fsf.org/licensing/licenses/lgpl.html).  
It includes third party code which should all have licenses which are compatible with LGPL (see **/core/lib** and **/ui/lib** folders to view third party libraries used)

**NOTE:** While the Cohere code base is released under the LGPL license: http://www.fsf.org/licensing/licenses/lgpl.html, developers should be aware that the **admin** and the **timeline\_2.3.0** folder contains third party code that is under the GPL license: http://www.fsf.org/licensing/licenses/gpl-3.0.html


## System Requirements

The Cohere code was most recently tested on a Red Hat Enterprise Linux Server release 8.10 (Ootpa) using:  

### Apache 2.4.37.

Please add the following in your Apache config:  
  
`Options All -Indexes -MultiViews   RewriteEngine on   AllowOverride FileInfo AuthConfig`  
  
If you have .htaccess files disabled (AllowOverride none), it will not affect the running of the site.  
Our .htaccess file has the following:  
  
```
<IfModule mod\_deflate.c>
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE text/javascript
AddOutputFilterByType DEFLATE text/x-js
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
AddOutputFilterByType DEFLATE application/json
AddOutputFilterByType DEFLATE application/ld+json
AddOutputFilterByType DEFLATE image/svg+xml
AddOutputFilterByType DEFLATE font/truetype
AddOutputFilterByType DEFLATE font/opentype
AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
</IfModule>

#RewriteEngine on
#RewriteCond %{REQUEST\_URI} !/index-maintenance.php$
#RewriteRule $ /index-maintenance.php \[R=302,L\]

ErrorDocument 404 /404-error-page.php
ErrorDocument 403 /403-error-page.php
```

So we use it to compress files to speed up the website and for having site specific 404 and 403 pages.  
We also uncomment the commented out lines if we want to put Cohere into maintenace mode and display a holding page to the user (index-maintenace.php)  
  

### PHP version 7.4.33

Modules installed:  
`bcmath,bz2,calendar,Core,ctype,curl,date,dba,dom,enchant,ereg,exif,fileinfo,filter,ftp, gd,gettext,gmp,hash,iconv,imap,intl,json,ldap,libxml,mbstring,mcrypt,memcache,mysql,mysqli,odbc,openssl,pcntl,pcre,PDO,pdo_mysql,PDO_ODBC,pdo_pgsql,pdo_sqlite,pgsql,Phar,phpcups,posix, pspell,readline,recode,Reflection,rrdtool,session,shmop,SimpleXML,snmp,soap,sockets,SPL,sqlite3,standard, sysvmsg,sysvsem,sysvshm,tidy,tokenizer,uuid,wddx,xml,xmlreader,xmlrpc,xmlwriter,xsl,zip,zlib`  
  
Cohere is not necessarily dependent on all these modules. These are just the modules installed on the server Cohere was mostl recently on. 
I am unsure at this stage if any of them are non standard, or if Cohere code in anyway replies on them. So, just in case, I am listing them.  
  
NOTE: In your php.ini make sure set allow-url-fopen = on.  

### MySQL

Cohere uses MySQL/MariaDB as the database at present. So you will need to install MySQL on your server. We have most recently tested on mysql Ver 15.1 Distrib 10.3.39-MariaDB. The database layer of the code has been abstracted out somewhat to make it eaiser for a developer to extend Cohere code base to use a different database.  

### Email

Cohere uses emails to tell users their registration is successful etc. and send out email digests of items or people they are following. 
So your server should be able to do emailing if you want these to be sent. You can switch off emailing with a setting in the config file if required (see [Setup the Config File](#setup-the-config-file), below), but then all user accounts would need to be setup and validated by hand.  


## Folders

The top level has the config.php file, (see [Setup the Config File](#setup-the-config-file), below)

The top level has the main primary php files for the main pages of the site: the index file, and the main context pages, like user, search, groups, the login, logout and reset pages and the fav icon etc..

**The Folders:**

*   **\_util** \- This is the code used to create the api apilib comments. You will need PHPDocumentor installed and you will need to edit the batch files in this folder as appropriate if you want to use this on your version of the Cohere code.
*   **admin** \- This folder has various files that produce and display various statistics about the activity on the site. If you are a user who has the ‘IsAdministrator’ field set to ‘Y’, you will see an extra menu item when logged in at the top of the screen called admin, for accessing these stats reports.
*   **api** \- This folder holds the Cohere services file that processes incoming service request, (see core/apilib.php for the actual guts).
*   **Auth** \- This is the OpenID library.
*   **docs** \- This is where the developer docs are.
*   **help** \- This is where the help pages are.
*   **images** \- This is where all the graphics for the site are. It has various subfolders.
*   **io** \- This folder holds the php files that handle the various import options in Cohere like rss, rdf and compendium.
*   **language** - This folder holds some language files used by Hub\_Error and also email templates. Retro-fitted from Evidence Hub. Needs completing at some point.
    *   **en/mailtemplates** - This folder holds text files templates for the various emails Cohere can send.
*   **ui** - This folder has ui files that are included in many other places e.g. header, footer, sidebar etc.
    *   **screencasts** - This folder holds some screencasts that show how to used areas of the site.
    *   **visualize** - This folder holds the java script files that are responsible for handling the display of the various data visualisations offered on the Cohere website, like the network or timeline views etc.
        *   **connectionnetjars** - This folder holds the jar files for the connection net.
        *   **timeline\_2.3.0** - This folder holds the MIT library for drawing the timeline. It is under MIT and GPL licenses
*   **install** - This folder has the sql files needed to create a Cohere database and install the default data. See [Setting up a Cohere Server](#setup) below
*   **jetpack** - This folder and its subfolders hold all code, image etc. related to our Firefox Jetpack. This is a new and currently experimental possible future replacement for the our main Firefox extension.
*   **ontology** - This folder holds pdf and cohere.owl schema for the Cohere RDF import.
*   **core** - This folder holds all the main libraries of php methods used by the site. It also holds all the main php class files for the primary object of the site, like user, node, linktype etc..
    *   **formats** - This folder has the php files that format the Cohere service reply text into the request format, like XML or json etc. There is one file per supported format.
    *   **lib/jdp-twitterlibphp** - This is the library use for Tweeting.
    *   **lib/recaptcha-php-1.10** - This is the recaptcha library.
    *   **lib/rss** - This is the library used for processing rss<./li>
*   **plugin** - This folder's subfolders have files related to the FireFox plugin and files shared by the website and the plugin.
    *   **ui** - This folder has php files for various popup pages used by the website and the FireFox plugin, like create an idea and create a connection popups.
    *   **download** - This folder has the FireFox plugin related files for downloading and auto-updating the plugin.
*   **snippet** - This folder has the pages that are used when embedding a Cohere snippet in another site. Each type of embed has its own page and there are also special header and footer files for these pages.
*   **uploads** - This folder holds user profile pictures. Each user will have a folder in here labelled uniquely. This folder also holds the default user and group images to use when no image has been uploaded.

  

## Setting up a Cohere Instance

### Creating the Database 

You can find the schema for the database here: [/install/db.sql](/install/db.sql). The sql in this file will create a database called `cohere` and all the tables and relationships cohere requires. If you want to change the name of the database, edit the `CREATE DATABASE..` line and rename. Note, given the original age of this system, the character set it uses is latin1. You may want to edit the table creation statments to use UTF8 these days.


### Adding the Default Data

To add all the default data that the website will need to have in the database to get started with, you need to edit and then run the sql in the file [/install/default-data.sql](../install/default-data.sql) into the 'cohere' database you created in step 1, (more details below):

We have setup some default data for Cohere.  `default-data.sql` contains default node types a.k.a. roles, and link types, and a default user who owns them.  You may want to modify these to be different default data. If you do, make sure you adjust the  `$CFG->defaultRoleGroupID` in the config.php file accordingly. Make sure you edit the user entry and add your email address and password for you defualt user.

**Note:** It is these default role and link types that are copied to new users as their starting pot of types to select from.
  

### Setup the Config File

To setup the config file you will first need to copy `/config-sample.php` file to `/config.php`. there are addigional comments explaining config properties inside the `config-sample.php` file. Some setting you will not need to change as they are simply default or static data for the site.  

The following parameters are ones you really DO need to change for your site to work:  

`$CFG->homeAddress = "http://web/path/to/website/";`
( home address is the base url for the website and must end with trailing '/' )  
    
`$CFG->dirAddress = "/file/path/to/website/";`  
(dir address is the base file path for the website)  
    
`$CFG->databaseaddress = "localhost";` 
(the database address, e.g. localhost or a url etc.)  
    
`$CFG->databaseuser`
(the database username that Cohere uses to login to the database)  
    
`$CFG->databasepass`
(the database password to go with the above username)  
    
`$CFG->databasename`  
(the database name for the database Cohere is to use)  
    
`$CFG->workdir = "/tmp/"`
(the path to a temp directory that Cohere can use)  
    
`$CFG->RECAPTCHA_PUBLIC = "<add recaptcha public key here>"; `
`$CFG->RECAPTCHA_PRIVATE = "<add recaptcha private key here>";`
(recaptcha public/private keys - you will need to get new keys for your website)  
    
`$CFG->RECAPTCHA_PUBLIC = "6Lf9oggAAAAAAAkA3Ip9bnqAItDucHKCNGjtfQSq";`
`$CFG->RECAPTCHA_PRIVATE = "6Lf9oggAAAAAAG4gi5xOhqqs0D1RE\_hN5ZHPnL3c";`
(for working on locahost these should just work so you can replace above with these and test first, then get new keys for your live site or if these don't work)  
      
`$CFG->BINGMAPS\_KEY = "<add Bing key here for geo code look ups>";`
(Google maps: You will need to go and get a Google maps key for your site)  
    
`$CFG->GOOGLE\_ANALYTICS\_KEY = "";`
(Bing map key: You will need to go and get a Bing key for your site) [https://www.bingmapsportal.com/](https://www.bingmapsportal.com/)  
Used in code for long/lat from address: [https://docs.microsoft.com/en-us/bingmaps/rest-services/locations/find-a-location-by-query](https://docs.microsoft.com/en-us/bingmaps/rest-services/locations/find-a-location-by-query)  
      

## Language

This code base only currently supplies English language files. Which interface language Cohere uses is controlled by the config setting:

**`$CFG->language = 'en';`**  

(The name must correspond to a folder in the 'language' folder where the translated texts should exist.)  
  
**`$CFG->defaultcountry = "United Kingdom";`**  
(Country name as it appears in the language/<your language as above>/countries.php list to used as the default selection in Countries menus. If you change the language used you must also change this text.)  
  
> [!NOTE]  
> We started retro-fitting a language file system to Cohere to match that used in the Evidehce Hub and later tools. But it is not necessarily complete and Enlish language text may still be found in places in the code. This needs finishing.

For more information on setting up a new language, see the README.txt file in the `/language` folder.

## Additional Developer Notes
 
### Path Changes for cohere.owl

![](images/url-ontology.png)

Although we have tried to use the config setting where possible, for the above references you will need to replace these urls with urls to your hosted cohere owl ontology file.

### GeoCoding

In `core/utillib.php` there is a function called `geoCode` that currently has a hardcoded url to a Bing service for geo coding and it will probably no longer work and will need replacing with another service.

### Other Changes

It is important that you rewrite and make your own the following pages/files:

`privacy.php`
`conditionsofuse.php`
`cookies.php`
`about.php`

Note: `about.php` will contain links that will not work anymore.

We would also recommend you rewrite / adjust to your needs:

`index.php`

and the headers and footers, e.g.:
`ui/header.php`
`ui/helpheader.php`
`ui/dialogheader.php`
`ui/dialogheader2.php`
`ui/footer.php`
`ui/dialogfooter.php`
`admin/footer.php`

and the footer parts of:
`admin/groupContextStats.php`
`admin/groupContextStats2.php`
`admin/userContextStats.php`
`admin/generalStats.php`

The Google Anlytics bit in all the footers (search the code for 1<!-- Google analytics -->`) is the old style for Universal Analytics, so those will all need replacing/updating.


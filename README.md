Api Key Authentication for Zf-MVC-Auth
======================================


work in progress


Installation

enable the module - copy api-key.local.php.dist to config/autoload/api-key.local.php



Put the API Credentials in the config file. 



API Requests

curl --header "X-API-KEY: <API-KEY>" --header "X-API-USER:<API-USER>" --cookie "XDEBUG_SESSION=PHPSTORM"  http://apigility/rest/
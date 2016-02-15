Rock Events
===========

## Information

This project created by students from <a href="http://xpk.km.ua">Khmelnytskyi Polytechnic College</a> during their practice
at <a href="http://stfalcon.com/en/">Studio Stfalcon.com</a>.
[![Stfalcon.com Logo](./web/images/stfalcon-logo.png)](http://stfalcon.com/en/)

### Requirements
* PHP 5.4 and later
* Symfony 2.7 and later
* Doctrine 2.4 and later
* Facebook application
* Google application
* VKontakte application

## Installation

1. Using composer
  ```
  $ composer require stfalcon-studio/rock_events
  ```
  This command requires you to have Composer installed globally, as explained
  in the [Composer documentation](https://getcomposer.org/doc/00-intro.md).

2. Using Git
```
$ git clone https://github.com/stfalcon-studio/rock-events.git
```

## Configuring

1. Make sure that your local system is properly configured for Symfony2. To do this, execute the following:
  ```
  $ php app/check.php
  ```
  If you got any warnings or recommendations, fix them before moving on.

2. Setting up permissions for directories app/cache/ and app/logs
  ```
  $ HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
  $ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
  $ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
  ```

3. Change DBAL settings, create DB, update it and load fixtures
  
  Change DBAL setting if your need in `app/config/config.yml`, `app/config/config_dev.yml` or `app/config/config_test.yml`. After that execute the following:
  ```
  $ php app/console doctrine:database:create
  $ php app/console doctrine:migrations:migrate
  $ php app/console doctrine:fixtures:load
  ```
  You can set test environment for command if you add --env=test to it.

4. Create Facebook application *(optional)*
  
  * Register as [Developer](https://developers.facebook.com/)
  * Press *Add a new App*
  * Choose *Web* platform
  * Type the name of your application, e.g. *Rock Events. Localhost*
  * Press *Create New Facebook App ID*
  * Choose category *Music* and press *Create App ID*
  * Set your site URL. If it is on localhost, then something like this `http://rock-events.localhost/app_dev.php/` and press *Next*
  * Use the newly generated `App ID` and `App Secret` parameters for your application, update parameters
  `facebook_app_id` and `facebook_app_secret` in *parameters.yml* file

5. Create VKontakte application *(optional)*
  
  * Go to [developer](https://vk.com/dev) page
  * Press *Create an Application*
  * Type the name of your application, e.g. *Rock Events. Localhost*
  * Choose category *Website*
  * Set your site URL and base domain. If it is on localhost, then URL be something like this `http://rock-events.localhost/app_dev.php/` and base domain like this `rock-events.localhost`
  * Press *Create Site*
  * Go to settings and use the newly generated `App ID` and `App Secret` parameters for your application, update parameters
  `vk_app_id` and `vk_app_secret` in *parameters.yml* file
  
  ## License
  This software is published under the [MIT License](./LICENSE.md)

DuOauth Sample App
=======================

A simple usage sample of [DuOauth zf2 module](https://github.com/simukti/DuOauth).

Installation
------------

    cd my/project/dir
    git clone https://github.com/simukti/DuOauthSample.git
    cd DuOauthSample
    php composer.phar self-update
    php composer.phar install

Requirements
------------
    1. Twitter API (ConsumerKey, SecretKey).
    2. DuoSecurity WebSDK Integration (Ikey, Skey, Akey)
    3. DuoSecurity user setup.
    4. Device setup for DuoSecurity user on step 2.

Setup
------------

- copy `./module/DuOauth/config/duoauth.config.php.dist` to `./module/DuOauth/config/duoauth.config.php`
- fill `duo` and `twitter` keys.

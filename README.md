Behat Local Webserver Extension
===============================

A trivial extension for people who forget to start their webserver

[![Build Status](https://travis-ci.org/ciaranmcnulty/behat-localwebserverextension.svg?branch=master)](https://travis-ci.org/ciaranmcnulty/behat-localwebserverextension)

Installation
------------

Require in composer

```
composer require ciaranmcnulty/behat-localwebserverextension --dev
```

Usage
-----

Add to your `behat.yml`:

```yml
default:
  extensions:
    Cjm\Behat\LocalWebserverExtension: ~
```

Run your suite, and your web examples should pass - the internal PHP webserver is started at suite start and exited at suite end.

Advanced Configuration
----------------------

Available configuration options:

```yml
default:
  extensions:
    Cjm\Behat\LocalWebserverExtension:
        host : 192.168.1.1   # defaults to 'localhost'
        port : 80            # defaults to '8000'
        docroot: /wwroot     # defaults to '%paths.base%/web'
        suites: [ web, ui ]  # defaults to (all suites)
```

If your behat config is elsewhere than in your root directory (for example `app/behat.yml` you need to customize the docroot to the right path. In our example it would be ` docroot: '%paths.base%/../web'`


Usage with MinkExtension
------------------------

When MinkExtension is used, default host and port will be read from Mink's `base_url` setting , but you can still override
if required.

```yml
default:
  extensions:
    Behat\MinkExtension:
      base_url:  'http://dev.local:9001'
      sessions:
        default:
          goutte: ~
    Cjm\Behat\LocalWebserverExtension: ~
```

Limitations
-----------

To do:

 - [ ] Only turn webserver on for certain contexts
 - [ ] Support symfony app console
 - [ ] Support custom server startup / stop commands

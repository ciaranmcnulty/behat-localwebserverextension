Behat Local Webserver Extension
===============================

A trivial extension for people who forget to start their webserver

Installation
------------

Require in composer

```
composer require ciaranmcnulty/behat-localwebserverextension
```

Usage
-----

Add to your `behat.yml`:

```yml
default:
  extensions:
    Cjm\Behat\LocalWebserverExtension: ~
```

Advanced Configuration
----------------------

Available configuration options:

```yml
default:
  extensions:
    Cjm\Behat\LocalWebserverExtension:
        host : 192.168.1.1   # defaults to 'localhost'
        port : 80            # defaults to '8000'
```

Limitations
-----------

Currently:

 * Only works on OSX or BSD (needs testing on Linux)
 * Always uses php internal webserver

To do:

 - [x] Support linux
 - [x] Add config for host / port
 - [ ] Read host/port settings from MinkExtension
 - [ ] Only turn webserver on for certain contexts
 - [ ] Support symfony app console
 - [ ] Support custom commands

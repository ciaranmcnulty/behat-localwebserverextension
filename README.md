Behat Local Webserver Extension
===============================

A trivial extension for people who forget to start their webserver

Usage
-----

Add to your `behat.yml`:

```yml
default:
  extensions:
    Cjm\Behat\LocalWebserverExtension : ~
```

Limitations
-----------

Currently:

 * Only works on OSX or BSD
 * Always uses php internal webserver
 * Only works on localhost:8000

To do:

 - [ ] Support linux
 - [ ] Add config for host / port
 - [ ] Integrate with Mink
 - [ ] Support symfony app console

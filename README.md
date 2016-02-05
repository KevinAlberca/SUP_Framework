# SUP_Framework

## Framework folders :
* app
    * `log` : Contains all your logs ( access & errors )
    * `config.yml.example` : Must be copy/paste and implemented with your database logs to the same folder without `.example` extension
    * `routing.yml` : Contains all your route

* core : This folder contains all framework code

* public
    * `dev.php` : This is your Front Controller
    * `Contains` all your public / static files, like *.css*, *.js*, *img* etc.

* ressources
    * `Model` : Contain your Model of your database
    * `Views` : Contain your Views with Twig
    * `Controller` : Contain your Controller
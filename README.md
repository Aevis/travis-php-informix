Travis-CI & PHP & Informix & Docker
============================================
A Travis-CI build script to run an Informix server on Docker and test the database connection with the PHP pdo_informix 
extension.

[![Build Status](https://travis-ci.org/Aevis/travis-php-informix.svg?branch=master)](https://travis-ci.org/Aevis/travis-php-informix)

Background
----------
In the past, the free editions of Informix server (Developers Edition, Innovator-C) and the Client SDK required for the 
PHP PDO extension were only available through their web portal. It requires a (free) account to login, which is why 
older scripts relied on either manually downloading the files or JavaScript trickery. IBM now provides the last and 
current major version on Docker Hub, which makes the setup a lot easier.

Findings
--------
* First run of the Informix server takes around 1 min to finish, inlcuding downloads and disk initialization. Instead of
letting Travis sleep for an arbitary number, use [giorgos/takis](https://hub.docker.com/r/giorgos/takis). Put it in the
same network as the Informix server and have it listen on either the mongo (27017) or mqtt (27833) port. Don't use the
TCP (9088), because unlike the mongo/mqtt listener it starts before the disk initialization.

* Because the docker interactive mode doesn't work in Travis, the only way to execute Informix commands once the server
runs is the bash -c option. However, that leaves you without the Informix environment variables. You can either prepend
every command with ```source /opt/ibm/scripts/informix_inf.env``` or put everything in a bash script and use that 
(see post-install.sh example).

* Instead of manually downloading and installing the Client SDK on the host for the PHP pdo_informix extension, simply 
copy the ```/opt/ibm/informix``` folder from the Informix server container into the host and set the INFORMIXDIR environment
variable.

* The Developers Edition with default configuration fails during the disk initialization with a fatal error in 
shared memory creation.
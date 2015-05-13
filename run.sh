#!/bin/bash

VOLUME_HOME="/var/lib/mysql"

# Possibly invoke inherited scripts to install MySQL and create the admin user.
if [[ ! -d $VOLUME_HOME/mysql ]]; then
    echo "=> An empty or uninitialized MySQL volume is detected in $VOLUME_HOME"
    echo "=> Installing MySQL ..."
    mysql_install_db > /dev/null 2>&1
    echo "=> Done!"
    /create_mysql_admin_user.sh
else
    echo "=> Using an existing volume of MySQL"
fi

# Create the ideagen database if it doesn't exist. 
if [[ ! -d $VOLUME_HOME/csc_lrv3_1 ]]; then

    # Start MySQL
    /usr/bin/mysqld_safe > /dev/null 2>&1 &

    RET=1
    while [[ RET -ne 0 ]]; do
        echo "=> Waiting for confirmation of MySQL service startup"
        sleep 5
        mysql -uroot -e "status" > /dev/null 2>&1
        RET=$?
    done

    # Generate a random password for the ideagen MySQL user.
    IDEAGEN_PASSWORD=`pwgen -c -n -1 12`

    echo "========================================================================"
    echo
    echo "MySQL ideagen user password:" $IDEAGEN_PASSWORD
    echo
    echo "========================================================================"

    # Create the database
    mysql -uroot -e \
        "CREATE DATABASE csc_lrv3_1; \
         GRANT ALL PRIVILEGES ON csc_lrv3_1.* TO 'ideagen'@'localhost' \
         IDENTIFIED BY '$IDEAGEN_PASSWORD'; \
         FLUSH PRIVILEGES;"

    mysqladmin -uroot shutdown
    sleep 5
fi

# If the application directory is empty, copy the site.
APPLICATION_HOME="/var/www/html"

if [ ! "$(ls -A $APPLICATION_HOME)" ]; then
    # Copy the application folder.
    cp -r /app/* $APPLICATION_HOME
fi

exec supervisord -n

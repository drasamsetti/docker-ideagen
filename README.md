## Components
The stack comprises the following components:

Name       | Version                   | Description
-----------|---------------------------|------------------------------
Magento    | 1.9.0.1 | E-commerce content management system
Ubuntu     | see [docker-lamp-base](https://github.com/drasamsetti/docker-lamp-base)                    | Operating system
MySQL      | see [docker-lamp-base](https://github.com/drasamsetti/docker-lamp-base)      | Database
Apache     | see [docker-lamp-base](https://github.com/drasamsetti/docker-lamp-base)      | Web server
PHP        | see [docker-lamp-base](https://github.com/drasamsetti/docker-lamp-base)      | Scripting language

#### A. Basic Usage
Start your container with:

 - Ports 80, 443 (Apache Web Server) and 3306 (MySQL) exposed.
 - A named container (**ideagen**).

As follows:

```no-highlight
sudo docker run -d -p 80:80 -p 443:443 -p 3306:3306 --name ideagen drasamsetti/ideagen
```

<a name="advanced-usage"></a>
#### B. Advanced Usage
Start your container with:

- Ports 80, 443 (Apache Web Server) and 3306 (MySQL) exposed.
- Two data volumes (which will survive a restart or recreation of the container). The MySQL data is available in **/data/mysql** on the host. The PHP application files are available in **/app** on the host.
- A named container (**ideagen**).

As follows:

```no-highlight
sudo docker run -d -p 80:80 -p 3306:3306 -p 443:443 -v /app:/var/www/html \
-v /data/mysql:/var/lib/mysql --name ideagen drasamsetti/ideagen
```

### 2. Check the Log Files

Check the logs for the randomly generated **admin** and **ideagen** MySQL passwords:

```no-highlight
sudo docker logs ideagen
```

Look for output similar to the following text:

```no-highlight
========================================================================
You can now connect to this MySQL Server using:

    mysql -uadmin -pMYHU4RejDh0q -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections
========================================================================
=> Waiting for confirmation of MySQL service startup
========================================================================

MySQL ideagen database user password: ooVoh7aedael

========================================================================
```

Make a secure note of:

* The admin user password (in this case **MYHU4RejDh0q**)
* The ideagen db user password (in this case **ooVoh7aedael**)

Next, test the **admin** user connection to MySQL:

```no-highlight
mysql -uadmin -pMYHU4RejDh0q -h127.0.0.1 -P3306
```

## Reference

### Image Details

Pre-built Image | [https://registry.hub.docker.com/u/drasamsetti/ideagen](https://registry.hub.docker.com/u/drasamsetti/ideagen) 

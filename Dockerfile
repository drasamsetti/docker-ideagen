FROM drasamsetti/lamp-base
MAINTAINER Durga Prasad R <durga0415@gmail.com>

# Do an update of the base packages.
RUN apt-get update --fix-missing

RUN DEBIAN_FRONTEND=noninteractive apt-get -y install php5-mcrypt
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install openssh-server
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install php5-curl
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install php5-gd
RUN php5enmod mcrypt

# Update Apache permissions.
RUN sed -i 's/AllowOverride Limit/AllowOverride All/g' \
    /etc/apache2/sites-available/000-default.conf

# Clean the application folder.
RUN rm -fr /var/www/html

# Configure /app folder with ideagen app
RUN git clone https://github.com/drasamsetti/Ideation-Portal.git /app

# Add scripts and make them executable.
ADD run.sh /run.sh
RUN chmod +x /*.sh

# Add volumes for MySQL and the application.
VOLUME ["/var/lib/mysql", "/var/www/html"]

EXPOSE 80 3306 443

CMD ["/run.sh"]

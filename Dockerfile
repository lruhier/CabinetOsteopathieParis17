FROM debian:latest

# Install dependencies
RUN apt-get update -y
RUN apt-get install -y git curl apache2 php5 libapache2-mod-php5 php5-mcrypt php5-mysql php5-curl nodejs npm 

# Install app
#RUN rm -rf /var/www
#ADD . /var/www
#RUN mkdir -p /var/www/logs
#RUN mkdir -p /var/www/cache
#RUN ln -s /var/www/web /var/www/html

# Install npm
RUN cd /var/www/app/Resources && npm install less uglify-js uglifycss

# Configure apache
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 80

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /var/www/composer.phar
RUN cd /var/www && php composer.phar install -o && php app/console assetic:dump && php app/console assets:install

CMD ["/usr/sbin/apache2", "-D",  "FOREGROUND"]

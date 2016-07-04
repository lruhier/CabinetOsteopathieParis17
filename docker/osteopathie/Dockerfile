FROM debian:latest

# Install dependencies
RUN echo "deb http://ftp.debian.org/debian sid main" >> /etc/apt/sources.list
RUN echo "deb-src http://ftp.debian.org/debian sid main" >> /etc/apt/sources.list
RUN apt-get update -y
RUN apt-get install -y git curl apache2 php5 libapache2-mod-php5 php5-mcrypt php5-mysql php5-curl nodejs npm libnghttp2-14 openssl libssl1.0.2 libssl-dev apache2-bin apache2-data

# Install app
#VOLUME ["/project/osteopathie"]
#RUN rm -rf /var/www
RUN git clone https://github.com/lruhier/CabinetOsteopathieParis17.git /project/osteopathie
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
#ADD . /var/www
#RUN mkdir -p /var/www/logs
RUN mkdir -p /project/osteopathie/logs
#RUN mkdir -p /var/www/cache
RUN mkdir -p /project/osteopathie/cache
#RUN ln -s /var/www/web /var/www/html

# Install npm
#RUN cd /var/www/app/Resources && npm install less uglify-js uglifycss
RUN cd /project/osteopathie/app/Resources && npm install less uglify-js uglifycss

# Configure apache
RUN a2enmod rewrite
RUN a2enmod http2
#RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /project/osteopathie
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 80

RUN curl -sS https://getcomposer.org/installer | php
#RUN mv composer.phar /var/www/composer.phar
RUN mv composer.phar /project/osteopathie/composer.phar
#RUN cd /var/www && php composer.phar install -o && php app/console assetic:dump && php app/console assets:install
RUN cd /project/osteopathie && php composer.phar install -o && php app/console assetic:dump && php app/console assets:install

CMD ["/usr/sbin/apache2", "-D",  "FOREGROUND"]

FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    git 

# Add composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer

RUN useradd -p $(openssl passwd -1 docker) -ms /bin/bash docker
RUN usermod -a -G sudo docker

USER docker

WORKDIR /app

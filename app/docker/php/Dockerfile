FROM php:8.4-apache

RUN apt-get update && apt-get install -y libonig-dev default-mysql-client vim && \
    docker-php-ext-install pdo_mysql mysqli
RUN apt-get install -y locales \
&& apt-get clean -y && rm -rf /var/lib/apt/lists/* \
&& sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
&& locale-gen \
&& update-locale LANG=ja_JP.UTF-8 && export LANG=ja_JP.UTF-8
RUN echo export LANG=ja_JP.UTF-8 >> .bashrc
ENV LANG=ja_JP.UTF-8
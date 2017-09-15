FROM php:7.1-cli

RUN \
	apt-get update && \
	# for intl
	apt-get install -y libicu-dev && \
	docker-php-ext-install -j$(nproc) intl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer


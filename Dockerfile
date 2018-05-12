FROM php:7.2.5-cli

MAINTAINER Andrey Vorobyev <avorobyev@codenetix.com>

#####################################
# Non-Root User Codenetix:
#####################################
RUN groupadd -g 1000 codenetix && \
    useradd -u 1000 -g codenetix -m codenetix

#####################################
# APT-GET:
#####################################
RUN apt-get update \
        && apt-get install --no-install-recommends --no-install-suggests -y \
        ca-certificates \
        git \
        ssh \
        libjpeg-dev \
        libfreetype6-dev \
        nano

RUN apt-get clean

RUN docker-php-ext-install -j$(nproc) iconv zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN curl https://getcomposer.org/composer.phar > /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && composer global require phpunit/phpunit

ENV PATH="/root/.composer/vendor/bin:${PATH}"

#####################################
# xDebug:
#####################################
ARG INSTALL_XDEBUG=true
ENV INSTALL_XDEBUG ${INSTALL_XDEBUG}
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi

ARG XDEBUG_REMOTE_HOST=""
ENV XDEBUG_REMOTE_HOST ${XDEBUG_REMOTE_HOST}

###################################
# App files:
#####################################
WORKDIR /src/
ADD . /src/

#####################################
# App files permissions & Clean up and ready to go:
#####################################
RUN find ./ -type d -exec chmod 755 {} + && \
    find ./ -type f -exec chmod 644 {} + && \
    chown -R codenetix:codenetix /src/

ENTRYPOINT ["/bin/bash"]

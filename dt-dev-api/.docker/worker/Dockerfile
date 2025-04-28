# Sử dụng image PHP 8.2 CLI Alpine làm base image
FROM php:8.2-cli

LABEL maintainer="mdthao1998@gmail.com"

RUN DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    software-properties-common locales

ENV TZ=Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Cài đặt các dependencies cần thiết
RUN apt-get update && apt-get install -y \
    curl \
    openssl \
    bash \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6 \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev

# Cấu hình extensions và PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure intl && docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis

# Install supervisor
RUN apt-get update && apt-get install -y supervisor

# Xóa rác
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Thiết lập thư mục làm việc
WORKDIR /var/www/html/

# Php config
ADD ./.docker/php-fpm/conf.ini /usr/local/etc/php/conf.d

# Add worker config
COPY ./.docker/worker/worker.conf /etc/supervisor/conf.d/worker.conf

# Khởi động worker
COPY ./.docker/worker/start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container
ENTRYPOINT ["start-container"]

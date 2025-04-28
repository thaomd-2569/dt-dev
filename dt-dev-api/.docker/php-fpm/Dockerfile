FROM php:8.2-fpm-alpine3.19

LABEL maintainer="mdthao1998@gmail.com"

# Cài đặt các dependencies cần thiết
RUN apk --no-cache add \
    curl \
    openssl \
    bash \
    icu-dev \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-dev \
    $PHPIZE_DEPS \
    linux-headers

# Cài đặt composer
ENV COMPOSER_MEMORY_LIMIT='-1'
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cấu hình extensions và PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure intl && docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Php config
ADD ./.docker/php-fpm/conf.ini /usr/local/etc/php/conf.d

# Thay đổi UID của người dùng www-data thành 1000
RUN sed -i 's/www-data:x:82:82:/www-data:x:1000:82:/' /etc/passwd

# Thiết lập thư mục làm việc
WORKDIR /var/www/html/

# Khởi động app
COPY ./.docker/php-fpm/start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container
ENTRYPOINT ["start-container"]

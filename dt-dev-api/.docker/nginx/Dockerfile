FROM nginx:stable-alpine-slim

LABEL maintainer="mdthao1998@gmail.com"

ENV TERM xterm

RUN apk --no-cache add shadow
ADD ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./.docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
ADD ./.docker/nginx/conf.d/upstream.conf /etc/nginx/conf.d/upstream.conf

# RUN usermod -u 1000 www-data
RUN adduser -D -H -u 1000 -s /bin/bash -Gwww-data www-data
RUN mkdir -p /var/www/html/public/ \
    && touch /var/www/html/public/index.php

CMD ["nginx"]

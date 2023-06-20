#!/usr/bin/env bash
# docker exec oauth-sso bash -c 'composer install && chmod +x bin/console && mkdir var/keys && openssl genrsa -out var/keys/private.key 2048 && openssl rsa -in var/keys/private.key -pubout -out var/keys/public.key && chmod -R 777 var/ && chmod -R 644 var/keys/*'
docker exec oauth-sso bash -c 'composer install && chmod +x bin/console && mkdir var/keys && openssl genrsa -out var/keys/private.key 2048 && openssl rsa -in var/keys/private.key -pubout -out var/keys/public.key && chmod -R 777 var/ && chmod -R 644 var/keys/*'

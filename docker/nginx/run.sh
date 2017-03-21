#!/bin/bash

envsubst '$PHP_CONTAINER_NAME' < /etc/nginx/conf.d/website.template > /etc/nginx/conf.d/website.conf
rm /etc/nginx/conf.d/default.conf
nginx -g 'daemon off;'

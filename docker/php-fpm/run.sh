#!/bin/bash

export DOCKER_BRIDGE_IP=$(ip ro | grep default | cut -d' ' -f 3)
php-fpm

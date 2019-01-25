#!/usr/bin/env bash
php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev
chmod -R 777 var/

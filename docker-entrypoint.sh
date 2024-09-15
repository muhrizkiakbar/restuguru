
#!/bin/bash
set -e

# Start PHP-FPM
php-fpm &

# Start Nginx
nginx &

# Start Supervisor to manage services
exec /usr/bin/supervisord -c /etc/supervisord.conf

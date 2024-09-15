#!/bin/bash
set -e

# Start Supervisor
exec supervisord -c /etc/supervisord.conf

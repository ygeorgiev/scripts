#!/bin/bash
apt-get update
apt-get install -y cron-apt
echo "dist-upgrade -y -o APT::Get::Show-Upgraded=true" > /etc/cron-apt/action.d/5-upgrade

#!/usr/bin/env bash
# GNU shell script to start phpdac7 srv in a screen (detached)
# --------------------------------------------------------------------
# Copyleft 2018 stereobit.com Alexiou Vassilis <https://www.stereobit.com/>
# This script is released under GNU GPL 2+ licence
# --------------------------------------------------------------------
#
screen -S DAC7SRV -d -m /var/www/phpdac7/start.sh

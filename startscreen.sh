#!/usr/bin/env bash
# GNU shell script to start phpdac7 srv in a screen (detached)
# --------------------------------------------------------------------
#
# This file is part of phpdac7.
#
# Licensed under The MIT License
# For full copyright and license information, please see the MIT-LICENSE.txt
# Redistributions of files must retain the above copyright notice.
#
# @author    balexiou<balexiou@stereobit.com>
# @copyright balexiou<balexiou@stereobit.com>
# @link      http://www.stereobit.com/php-dac7.php
# @license   http://www.opensource.org/licenses/mit-license.php MIT License
# --------------------------------------------------------------------
#
screen -S DAC7SRV -d -m /var/www/phpdac7/start.sh

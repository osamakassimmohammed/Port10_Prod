#!/usr/bin/env sh
#
# -*- tab-width: 2; encoding: utf-8; mode: sh; -*-
#
# Copyright (c) 2023 Xeriab Nabil <xeriab@tuta.io>
#
# SPDX-License-Identifier: MIT
#
# shellcheck disable=SC3043,SC2059,SC2154,SC1090,SC1091,SC2034,SC2086,SC2039
#

set -e

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS testing;
    GRANT ALL PRIVILEGES ON \`testing%\`.* TO '$MYSQL_USER'@'%';
EOSQL

# vim: set ts=2 sw=2 tw=80 noet :

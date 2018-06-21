#!/usr/bin/env bash
touch database.db
chmod 777 ../sql
chmod 777 database.db
sqlite3 database.db < destroy_bd.sql
sqlite3 database.db < create_bd.sql

#!/bin/bash
source /opt/ibm/scripts/informix_inf.env
echo "Creating sbspace"
touch "${INFORMIX_DATA_DIR}"/spaces/sbspace
chmod 660 "${INFORMIX_DATA_DIR}"/spaces/sbspace
onspaces -c -S sbspace -p "${INFORMIX_DATA_DIR}"/spaces/sbspace -o 0 -s 20000
echo "Creating test database"
echo "CREATE DATABASE test WITH BUFFERED LOG" | dbaccess
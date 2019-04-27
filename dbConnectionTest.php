<?php
try {
    $db = new PDO('informix:host=localhost;service=9088;database=test;server=informix;protocol=olsoctcp;CLIENT_LOCALE=en_us.utf8;DB_LOCALE=en_us.utf8;EnableScrollableCursors=1', 'informix', 'in4mix');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result=$db->query('select name from sysmaster:sysdatabases;');
    $row=$result->fetch(PDO::FETCH_ASSOC);
    echo 'DB Connection successfull:';
    print_r($row);
    exit(0);
} catch (PDOException $e) {
    print $e->getMessage().PHP_EOL;
    exit(1);
}
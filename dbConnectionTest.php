<?php
try {
    $db = new PDO('informix:host=localhost;service=9088;database=systables;server=awifxsvr;protocol=olsoctcp;CLIENT_LOCALE=en_us.utf8;DB_LOCALE=en_us.utf8;EnableScrollableCursors=1', 'informix', 'in4mix');
    $result=$db->query("select tabname from systables;");
    $row=$result->fetch(PDO::FETCH_NUM);
    print_r($row);

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}

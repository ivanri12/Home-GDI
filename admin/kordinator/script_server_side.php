<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = '
    kordinator,
    majelis, 
    jemaat, 
    rayon';

$primaryKey = 'id_kordinator';


$columns = array(
    array('db' => 'rayon', 'dt' => 0),
    array('db' => 'nama', 'dt' => 1),
    array('db' => 'alamat', 'dt' => 2),
    array('db' => 'nama_kordinator', 'dt' => 3),
    array('db' => 'status', 'dt' => 4),
    array('db' => 'telepon', 'dt' => 5),
    array('db' => 'id_kordinator', 'dt' => 6),
);

// SQL server connection information
include_once '../_config/conn.php';

// Sertakan kelas SSP
require('../assets/libs/ssp.class.php');

// Join query
$joinQuery = "FROM kordinator LEFT JOIN majelis ON kordinator.id_majelis = majelis.id_majelis LEFT JOIN jemaat ON majelis.id_jemaat = jemaat.id_jemaat LEFT JOIN rayon ON kordinator.id_rayon = rayon.id_rayon";

// Bagian where condition bisa di tambahkan jika ada filter tertentu
$extraWhere = "";

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
);

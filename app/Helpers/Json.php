<?php

function get_local_db_json($file)
{
    $destination = $destination = base_path('local_db/' . $file);

    // Mendapatkan file json
    $get_file = file_get_contents($destination);

    // Mendecode file json
    $data = json_decode($get_file, true);

    return $data;
}

function get_where_local_db_json($file, $where_key, $where)
{
    $destination = $destination = base_path('local_db/' . $file);
    $fetch_data = NULL;

    // Mendapatkan file json
    $get_file = file_get_contents($destination);

    // Mendecode file json
    $data = json_decode($get_file, true);

    foreach ($data as $row => $key) {
        if ($key[$where_key] == $where) {
            $fetch_data = $key;
        }
    }

    return $fetch_data;
}

function update_local_db_json($file, $where_key, $where, $update_data)
{
    // File json yang akan dibaca
    $destination = $destination = base_path('local_db/' . $file);

    // Mendapatkan file json
    $get_file = file_get_contents($destination);

    // Mendecode 
    $data = json_decode($get_file, true);

    // Membaca data array menggunakan foreach
    foreach ($data as $row => $key) {
        // Perbarui data kedua
        if ($key[$where_key] == $where) {
            $data[$row] = $update_data;
        }
    }

    // Mengencode data menjadi json
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

    // Menyimpan data ke dalam anggota.json
    file_put_contents($destination, $jsonfile);
}

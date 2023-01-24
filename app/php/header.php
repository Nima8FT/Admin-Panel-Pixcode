<?php

if (isset($_POST['action'])) {

    $action = explode('/', $_POST['action']);
    $ac = $action[0];
    $id = $action[1];
    $table = $action[2];
    unset($_POST['action']);

    if (isset($_POST["id"])) {
        $ID = $_POST["id"];
        unset($_POST['id']);
    }

    if ($ac == "insert") {
        insert_table($table, $_POST);
    } else if ($ac == "update") {
        update_table($table, $_POST, $ID);
    } else if ($ac == "delete") {
        delete_table($table, $id);
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/apps.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/_Normalize.css">

    <title>Finacial Management Pixcode</title>
</head>

<body>
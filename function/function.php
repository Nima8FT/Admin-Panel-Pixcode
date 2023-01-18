<?php

session_start();

function ReqAPI($url, $data)
{
    $opts = array(
        'http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);

    return json_decode($result, true); 
}

function aside_menu()
{
    $name_page = explode('/', $_SERVER['REQUEST_URI'])[3];
    $name_page = explode('.', $name_page)[0];
    $html =
        '<a href="expense.php">
        <img src="../assets/img/expense.png" alt="Expense">
        Expense
    </a>

    <a href="income.php">
        <img src="../assets/img/income.png" alt="Income">
        Income
    </a>

    <a href="stock.php">
        <img src="../assets/img/stock.png" alt="Stock">
        Stock
    </a>

    <a href="skills.php">
        <img src="../assets/img/skills.png" alt="Skills">
        Skills
    </a>

    <a href="activites.php">
        <img src="../assets/img/activites.png" alt="Activities">
        Activities
    </a>

    <a href="users.php">
        <img src="../assets/img/users.png" alt="Activities">
        Users
    </a>';

    switch ($name_page) {
        case 'expense':
            $html = str_replace('<a href="expense.php">', '<a href="expense.php" class="active_main_aside_menu">', $html);
            break;

        case 'income':
            $html = str_replace('<a href="income.php">', '<a href="income.php" class="active_main_aside_menu">', $html);
            break;

        case 'stock':
            $html = str_replace('<a href="stock.php">', '<a href="stock.php" class="active_main_aside_menu">', $html);
            break;

        case 'skills':
            $html = str_replace('<a href="skills.php">', '<a href="skills.php" class="active_main_aside_menu">', $html);
            break;

        case 'activites':
            $html = str_replace('<a href="activites.php">', '<a href="activites.php" class="active_main_aside_menu">', $html);
            break;

        case 'users':
            $html = str_replace('<a href="users.php">', '<a href="users.php" class="active_main_aside_menu">', $html);
            break;
    }

    echo $html;
}

function header_name()
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => "SELECT `nickname` FROM `users`"
        )
    );

    $html = '<article class="header_menu_main">';

    for ($i=0; $i < count($response); $i++) { 
        foreach ($response[$i] as $key => $value) {
            $html .= '<button>'.$value.'</button>';
        }
    }

    $html .= '<button>All</button></article>';
    echo $html;

}
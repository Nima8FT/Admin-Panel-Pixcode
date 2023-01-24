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


function header_name($is_search, $table)
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT ' . $is_search . ' FROM ' . $table . ''
        )
    );

    $html = '<article class="header_menu_main">';

    for ($i = 0; $i < count($response); $i++) {
        foreach ($response[$i] as $key => $value) {
            $html .= '<button class="header_name">' . $value . '</button>';
        }
    }

    $html .= '<button class="header_name all_header_name">All</button></article>';
    echo $html;

}


function header_table($table, $exc)
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'DESCRIBE ' . $table
        )
    );

    $html = '<thead><tr class="thead_Item">';

    for ($i = 0; $i < count($response); $i++) {
        foreach ($response[$i] as $key => $value) {
            if ($key == "Field") {
                $is_exc = false;

                if ($exc !== "") {
                    for ($j = 0; $j < count($exc); $j++) {
                        if ($exc[$j] == $value) {
                            $is_exc = true;
                            $html .= '<th style="display:none;">' . $value . '</th>';
                        }
                    }
                }

                if ($is_exc == false) {
                    $is_exc = false;
                    $html .= '<th>' . ucfirst($value) . '</th>';
                }
            }
        }
    }

    $html .= '<th>Actions</th></tr></thead>';

    echo $html;

}


function info_table($table, $exc, $table_join_main)
{

    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT * FROM ' . $table
        )
    );

    $res = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT ' . $table_join_main . '.nickname FROM ' . $table . ' INNER JOIN ' . $table_join_main . ' ON ' . $table . '.id_user = ' . $table_join_main . '.id'
        )
    );

    $html = '<tbody>';

    if ($response[0] !== NULL) {

        for ($i = 0; $i < count($response); $i++) {

            $html .= '<tr class="main_detail row'.$i.'">';

            foreach ($response[$i] as $key => $value) {

                $is_exc = false;

                if ($exc !== "") {
                    for ($j = 0; $j < count($exc); $j++) {
                        if ($exc[$j] == $key) {
                            $is_exc = true;
                            $html .= '<td style="display:none;"><div>' . $value . '</div></td>';
                        }
                    }
                }

                if ($is_exc == false) {
                    $is_exc = false;

                    if ($key == 'id_user') {
                        foreach ($res[$i] as $key => $value) {
                            $html .= '<td><div class="id_user">' . $value . '</div></td>';
                        }
                    } else if ($key == 'paid' || $key == 'isAdmin') {
                        if ($value == 1) {
                            $html .= '<td><div>true</div></td>';
                        } else if ($value == 0) {
                            $html .= '<td><div>false</div></td>';
                        }
                    } else {
                        $html .= '<td><div>' . $value . '</div></td>';
                    }
                }
            }
            $html .= '<td class="delete_row_table"><div><button type="submit" name="action" value="delete/' . $response[$i]["id"] . '/' . $table . '"><img class="delete_row" src="../assets/img/delete.png" alt="delete"></button></div></td>';
            $html .= '</tr>';
        }
    } else if ($response[0] == NULL) {
        $html .= '<tr class="main_detail">';

        foreach ($response as $key => $value) {

            $is_exc = false;

            if ($exc !== "") {
                for ($j = 0; $j < count($exc); $j++) {
                    if ($exc[$j] == $key) {
                        $is_exc = true;
                        $html .= '<td style="display:none;"><div>' . $value . '</div></td>';
                    }
                }
            }

            if ($is_exc == false) {
                $is_exc = false;

                if ($key == 'id_user') {
                    foreach ($res as $key => $value) {
                        $html .= '<td><div>' . $value . '</div></td>';
                    }
                } else if ($key == 'paid' || $key == 'isAdmin') {
                    if ($value == 1) {
                        $html .= '<td><div>true</div></td>';
                    } else if ($value == 0) {
                        $html .= '<td><div>false</div></td>';
                    }
                } else {
                    $html .= '<td><div>' . $value . '</div></td>';
                }
            }
        }
        $html .= '<td class="delete_row_table"><div><button type="submit" name="action" value="delete/' . $response["id"] . '/' . $table . '"><img class="delete_row" src="../assets/img/delete.png" alt="delete"></button></div></td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    echo $html;
}


function selectbox_form($table, $name)
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT `id`,`nickname` FROM ' . $table
        )
    );

    $html = '<div class="select_form"><label for="' . $name . '">' . $name . '</label><select name="' . $name . '" id="box_selected">';

    for ($i = 0; $i < count($response); $i++) {
        $html .= '<option class="box_' . $response[$i]["nickname"] . '" value="' . $response[$i]["id"] . '">' . $response[$i]['nickname'] . '</option>';
    }

    $html .= '</select></div> ';

    return $html;
}


function html_form($table)
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'DESCRIBE ' . $table
        )
    );

    $html = "";

    for ($i = 0; $i < count($response); $i++) {
        $type = $response[$i]["Type"];
        $field = $response[$i]["Field"];
        $key = $response[$i]["Key"];

        if ($type == "mediumtext") {
            $html .=
                '<div class="txt_des textarea">' .
                '<label for="' . $field . '">' . $field . '</label>' .
                '<textarea id="des_edit" class="' . $field . '" name="' . $field . '" type="text"></textarea>' .
                '</div>';
        } else if ($type == "date") {
            $html .=
                '<div class="txt_date">' .
                '<label for="' . $field . '">' . $field . '</label>' .
                '<input id="input_date" class="' . $field . '" name="' . $field . '" type="date">' .
                '</div>';
        } else if ($type == "varchar(250)" || $type == "varchar(11)") {
            if ($field == "money") {
                $html .=
                    '<div class="txt_form">' .
                    '<label for="' . $field . '">' . $field . '</label>' .
                    '<input type="text" class="' . $field . '" name="' . $field . '" id="' . $field . '_edit">' .
                    '</div>';
            } else {
                $html .=
                    '<div class="txt_form">' .
                    '<label for="' . $field . '">' . $field . '</label>' .
                    '<input type="text" name="' . $field . '" class="' . $field . '" id="name_edit">' .
                    '</div>';
            }
        } else if ($type == "int(11)" && $key == "MUL") {
            $html .= selectbox_form('users', $field);
        } else if ($type == "tinyint(4)") {
            $html .=
                '<div class="btn_bool_form">' .
                '<a>' . $field . '</a>' .
                '<input style="display:none;" name="' . $field . '">' .
                '</div>';
        } else if ($type == "int(11)" && $key !== "PRI") {
            $html .=
                '<div class="txt_form">' .
                '<label for="' . $field . '">' . $field . '</label>' .
                '<input type="text" class="' . $field . '" name="' . $field . '" id="' . $field . '_edit">' .
                '</div>';
        } else if ($type == "int(11)" && $key == "PRI") {
            $html .=
                '<div class="txt_form" style="display:none;">' .
                '<label for="' . $field . '">' . $field . '</label>' .
                '<input type="text" class="' . $field . '" name="' . $field . '" id="' . $field . '_edit">' .
                '</div>';
        }
    }

    $html .=
        '<div class="btn_form">' .
        '<button name="action" value="insert/1/' . $table . '" class="add_form_btn">Add</button>' .
        '<button name="action" value="update/1/' . $table . '" class="edit_form_btn">Edit</button>' .
        '</div>';

    echo $html;

}


function info_iduser($table,$table_join_main)
{

    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "QUERY",
            "Query" => 'SELECT ' . $table_join_main . '.nickname FROM ' . $table . ' INNER JOIN ' . $table_join_main . ' ON ' . $table . '.id_user = ' . $table_join_main . '.id'
        )
    );

    $arr = [];

    for ($i=0; $i < count($response); $i++) { 
        foreach ($response[$i] as $key => $value) {
            array_push($arr, $value);
        }
    }

    return json_encode($arr);
}


function insert_table($table, $post)
{

    $fields = "";
    $values = "";
    $i = 1;

    foreach ($post as $key => $value) {
        if ($value == "") {
            unset($post[$key]);
        }
    }

    foreach ($post as $key => $value) {
        if (count($post) == $i) {
            $fields .= $key;
            $values .= $value;
        } else {
            $fields .= $key . '<#>';
            $values .= $value . '<#>';
        }
        $i++;
    }

    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "INSERT",
            "Table" => $table,
            "Fields" => $fields,
            "Values" => $values
        )
    );

    echo $response;
}


function update_table($table, $post, $id)
{
    unset($post['id']);
    $Fields = "";
    $Values = "";
    $i = 1;

    $post = $_POST;

    foreach ($post as $key => $val) {
        if ($val == "")
            unset($post[$key]);
    }

    foreach ($post as $key => $val) {
        if (count($post) == $i) {
            $Fields .= $key;
            $Values .= $val;
        } else {
            $Fields .= $key . '<#>';
            $Values .= $val . '<#>';
        }
        $i++;
    }

    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "UPDATE",
            "Table" => $table,
            "ID" => $id,
            "Fields" => $Fields,
            "Values" => $Values
        )
    );
    echo $response;
}


function delete_table($table, $id)
{
    $response = ReqAPI(
        'http://localhost/Admin-Panel-Pixcode/api/index.php',
        array(
            "Mode" => "DELETE",
            "Table" => $table,
            "ID" => $id
        )
    );
    echo $response;
}
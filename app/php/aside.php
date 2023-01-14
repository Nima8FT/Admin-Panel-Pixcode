<?php
require_once('../function/function.php');
require_once('header.php');
?>

<aside class="aside">

<article class="header_aside">
    <img src="../assets/img/logo.png" alt="Pixcode">
    <h1>Welcome Nima</h1>
</article>

<article class="main_aside">

    <div class="main_aside_menu">

        <a href="expense.php">
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

        <a href="activites.php" class="active_main_aside_menu">
            <img src="../assets/img/activites.png" alt="Activities">
            Activities
        </a>

        <a href="users.php">
            <img src="../assets/img/users.png" alt="Activities">
            Users
        </a>

    </div>

    <div class="main_aside_logout">
        <a href="#">
            <img src="../assets/img/logout.png" alt="">
            Log Out
        </a>
    </div>

</article>

</aside>

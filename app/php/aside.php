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
            <?php aside_menu(); ?>
        </div>

        <div class="main_aside_logout">
            <a href="#">
                <img src="../assets/img/logout.png" alt="">
                Log Out
            </a>
        </div>

    </article>

</aside>
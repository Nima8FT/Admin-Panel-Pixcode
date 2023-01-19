<?php
include('php/aside.php');
$table = 'users';
$exc = array('finishAt', 'startAt','id','email','familly');
?>

<main class="main">

    <article class="header_menu_main">
        <h1>Employe in Pixcode</h1>
    </article>

    <table class="main__table">

        <?php header_table($table,$exc) ?>

        <?php info_table($table, $exc) ?>

        <div class="btn_main">
            <img src="../assets/img/4315609.png" alt="">
        </div>

    </table>

</main>

<?php
require_once('php/footer.php');
?>
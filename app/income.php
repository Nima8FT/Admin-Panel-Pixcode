<?php
include('php/aside.php');
$table = 'income';
$exc = array('id');
?>

<main class="main">

    <?php header_name('nickname', 'users') ?>

    <table class="main__table">
        <form action="income.php" method="POST">

            <?php header_table($table, $exc) ?>

            <?php info_table($table, $exc,'users') ?>

            <div class="btn_main">
                <img src="../assets/img/4315609.png" alt="">
            </div>

        </form>
    </table>

</main>

<?php
require_once('php/footer.php');
?>
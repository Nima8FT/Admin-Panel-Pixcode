<?php
include('php/aside.php');
$table = 'stock';
$exc = array('id');
$arr = info_iduser($table, 'users');
?>

<script>
    const array_iduser =  <?= $arr ?>;
</script>

<main class="main">

    <?php header_name('nickname', 'users') ?>

    <table class="main__table">

        <form action="stock.php" method="POST">

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
<article class="edit_form">

    <img class="exit_form_edit" src="../assets/img/exit.png" alt="Exit">

    <form action="" method="POST">

        <div class="txt_form">
            <label for="">ID</label>
            <input type="text" name="id" id="id_edit">
        </div>

        <div class="select_form">
            <label for="name_user">Name User</label>
            <?php selectbox_form('users') ?> 
        </div>

        <div class="txt_form">
            <label for="">Name</label>
            <input type="text" name="name" id="name_edit">
        </div>

        <div class="txt_date">
            <label for="date">Date Start</label>
            <input id="input_date" name="date_start" type="date" value="2022-01-01">
        </div>

        <div class="txt_date">
            <label for="date">Date End</label>
            <input id="input_date" name="date_end" type="date" value="2022-01-01">
        </div>

        <div class="txt_des textarea">
            <label for="story">Description</label>
            <textarea id="des_edit" name="des" type="text"></textarea>
        </div>

        <div class="btn_form">
            <button name="action" value="insert" class="add_form_btn">Add</button>
            <button name="action" value="update" class="edit_form_btn">Edit</button>
        </div>

    </form>

</article>

</body>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/main.js"></script>

</html>
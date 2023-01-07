var counter = 0;

$(document).ready(function () {

    $(".header_menu_main > button").click(function (e) {
        $(".header_menu_main > button").removeClass("active_header_menu_main");
        $(e.currentTarget).addClass("active_header_menu_main");
    });

    $(".btn_main").click(function (e) {
        $(".edit_form").css("display", "flex");
        $(".btn_form > button").html("Add");
        $(".aside").css("opacity", ".5");
        $(".main").css("opacity", ".5");
    });

    $(".exit_form_edit").click(function (e) {
        $(".edit_form").css("display", "none");
        $(".aside").css("opacity", "1");
        $(".main").css("opacity", "1");
    });

    $(".btn_form > button").click(function (e) {
        $(".edit_form").css("display", "none");
        $(".aside").css("opacity", "1");
        $(".main").css("opacity", "1");
    });

    $(".main_detail > td").click(function (e) {
        var deleted = $(e.currentTarget).find(".delete_row").html();
        if (deleted === undefined) {
            $(".edit_form").css("display", "flex");
            $(".btn_form > button").html("Edit");
            $(".aside").css("opacity", ".5");
            $(".main").css("opacity", ".5");
        }
        else {
            $(e.currentTarget).parent().css("display", "none");
        }
    });

    $(".btn_bool_form").click(function (e) {
        counter++;
        if (counter % 2 == 0) {
            $(".btn_bool_form > a").css("background", "none");
        }
        else {
            $(".btn_bool_form > a").css("background", "var(--blue-beauty)");
        }
    });

    $("#money_edit").keyup(function (e) {
        var html = $("#money_edit").val();
        var num = html.replaceAll(',', '')
        if (num.length % 3 == 0 && num.length !== 0 && num.length !== 1) {
            $("#money_edit").val(html + ',');
        }
    });

});

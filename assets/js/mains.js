var counter = 0;

$(document).ready(function () {
  $(".header_menu_main > button").click(function (e) {
    $(".header_menu_main > button").removeClass("active_header_menu_main");
    $(e.currentTarget).addClass("active_header_menu_main");
  });

  $(".btn_main").click(function (e) {
    $(".edit_form").css("display", "flex");
    $(".add_form_btn").css("display", "block");
    $(".edit_form_btn").css("display", "none");
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
      $(".add_form_btn").css("display", "none");
      $(".edit_form_btn").css("display", "block");
      $(".aside").css("opacity", ".5");
      $(".main").css("opacity", ".5");
    }
  });

  $(".main_detail").click(function (e) {
    var child = $(e.currentTarget).children();
    var html = [];

    for (let i = 0; i < child.length; i++) {
      var xx = child[i].innerText;
      if (xx.trim().length > 0) {
        html.push(xx);
      }
    }

    var table = $(".active_main_aside_menu").html();
    table = table.split(">");
    table[1] = table[1].trim(" ");

    if (table[1] == "Users") {
      $(".id").val(html[0]);
      $(".name").val(html[1]);
      $(".familly").val(html[2]);
      $(".nickname").val(html[3]);
      $(".username").val(html[4]);
      $(".password").val(html[5]);
      $(".email").val(html[6]);
      $(".phone").val(html[7]);
      $(".startAt").val(html[8]);
      if (html[10] == undefined) {
        if (html[9] == "true") {
          $(".btn_bool_form > a").css("background", "var(--blue-beauty)");
          $(".btn_bool_form > input").val("1");
        } else if (html[9] == "false") {
          $(".btn_bool_form > a").css("background", "none");
          $(".btn_bool_form > input").val("0");
        }
      } else {
        $(".finishAt").val(html[9]);
        if (html[10] == "true") {
          $(".btn_bool_form > a").css("background", "var(--blue-beauty)");
          $(".btn_bool_form > input").val("1");
        } else if (html[10] == "false") {
          $(".btn_bool_form > a").css("background", "none");
          $(".btn_bool_form > input").val("0");
        }
      }
    } else if (table[1] == "Expense" || table[1] == "Stock") {
      $(".id").val(html[0]);
      $("#box_selected option").removeAttr("selected");
      $("#box_selected")
        .find(".box_" + html[1])
        .attr("selected", "selected");
      $(".name").val(html[2]);
      $(".money").val(html[3]);
      $(".date").val(html[4]);
      if (html[5] == "false") {
        $(".btn_bool_form > a").css("background", "none");
        $(".btn_bool_form > input").val("0");
      } else if (html[5] == "true") {
        $(".btn_bool_form > a").css("background", "var(--blue-beauty)");
        $(".btn_bool_form > input").val("1");
      }
      $(".des").val(html[6]);
    } else if (table[1] == "Income") {
      $(".id").val(html[0]);
      $("#box_selected option").removeAttr("selected");
      $("#box_selected")
        .find(".box_" + html[1])
        .attr("selected", "selected");
      $(".name").val(html[2]);
      $(".money").val(html[3]);
      $(".date").val(html[4]);
      $(".des").val(html[5]);
    } else if (table[1] == "Activities") {
      $(".id").val(html[0]);
      $("#box_selected option").removeAttr("selected");
      $("#box_selected")
        .find(".box_" + html[1])
        .attr("selected", "selected");
      $(".name").val(html[2]);
      $(".dateStart").val(html[3]);
      $(".dateEnd").val(html[4]);
      $(".des").val(html[5]);
    } else if (table[1] == "Skills") {
      $(".id").val(html[0]);
      $("#box_selected option").removeAttr("selected");
      $("#box_selected")
        .find(".box_" + html[1])
        .attr("selected", "selected");
      $(".name").val(html[2]);
      $(".persent").val(html[3]);
      jqattr;
    }
  });

  $(".btn_bool_form").click(function (e) {
    counter++;
    if (counter % 2 == 0) {
      $(".btn_bool_form > a").css("background", "none");
      $(".btn_bool_form > input").val("0");
    } else {
      $(".btn_bool_form > a").css("background", "var(--blue-beauty)");
      $(".btn_bool_form > input").val("1");
    }
  });

  $("#money_edit").change(function (e) {
    var html = $("#money_edit").val();
    var money = input_Seperate(html);
    $("#money_edit").val(money);
  });
});

function input_Seperate(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

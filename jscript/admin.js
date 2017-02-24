$(document).ready(function () {

    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled", 1000);
    });


    $("h4").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("minus");
        if ($(this).attr("class") != "minus") {
            $(this).next().fadeOut(500).slideUp(800);
        } else {
            $(this).next().fadeIn(500).slideDown(800);
        }


    });


    $(".fa-thumb-tack").click(function (e) {

        e.preventDefault();

        var xmlhttp = new XMLHttpRequest();

        $(this).toggleClass("thumb-selected");

        id = $(this).attr("id");

        xmlhttp.open("GET", "index_admin.php?action=front_page&new_id=" + id, true);
        xmlhttp.send();

    });


    $(".rmv-comment").click(function (e) {

        e.preventDefault();




        var result = confirm("Do you want to delete this comment?\nPress OK to delete it, or CANCEL to go back.");

        if (result == true) {

            var xmlhttp = new XMLHttpRequest();

            commentId = $(this).attr('id');

            if (commentId.substring(0, 1) == 'C') {
                commentId = commentId.substring(1);
            }




            xmlhttp.open("GET", "index_admin.php?action=delete_comment&comment_id=" + commentId, true);
            xmlhttp.send();

            $(this).parents('tr').hide();


        }



    });

    $(".rmv").click(function (e) {

        e.preventDefault();


        var result = confirm("Do you want to delete this article?\nPress OK to delete it, or CANCEL to go back.");

        if (result == true) {

            var xmlhttp = new XMLHttpRequest();

            new_id = $(this).attr('id');



            xmlhttp.open("GET", "index_admin.php?action=delete_article&new_id=" + new_id, true);
            xmlhttp.send();

            $(this).parents('tr').hide();


        }



    });

    $(".fa-user-times").click(function (e) {

        e.preventDefault();

        var user = $(this).attr('id');

        var result = confirm("Do you want to delete this user? \nPress OK to delete it, or CANCEL to go back.");

        if (result == true) {

            var xmlhttp = new XMLHttpRequest();


            xmlhttp.open("GET", "index_admin.php?action=delete_user&username=" + user, true);
            xmlhttp.send();

            $(this).parents('tr').hide();


        }



    });


});
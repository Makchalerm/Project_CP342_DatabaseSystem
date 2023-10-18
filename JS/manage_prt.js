$(document).ready(function () {
    $(document).on('click', '#show_prt', function () {
        var id = $(this).data('id');
        $.ajax({
            url: "fetch_update_printery.php",
            type: 'POST',
            data: { printery_id: id },
            success: function (response) {
                var prt = JSON.parse(response);
                $("#pname").val(prt['pname']);
                $("#paddress").val(prt['paddress']);
                $("#ptel").val(prt['ptel']);
                $("#update_prt").data('id', id);
                $("#edit_prt").modal('show');
            }
        })
    })

    $(document).on('click', '#update_prt', function () {
        var printery_id = parseInt($(this).data('id'));
        var pname = $("#pname").val();
        var paddress = $("#paddress").val();
        var ptel = $("#ptel").val();

        var phonePatt = /[0-9]{9}/i;

        if (pname == "" || paddress == "" || ptel == "") {
            alert("** Please fill out completely in the form.  **");
        } else if (!phonePatt.test(ptel)) {
            alert("** Phone Pattern Incorrect **");
        } else {
            $.ajax({
                url: "update_prt.php",
                type: "POST",
                data: { printery_id: printery_id, pname: pname, paddress: paddress, ptel: ptel },
                success: function (response) {
                    if (response == 1) {
                        alert("** Success update **");
                        window.location.href = "printery.php";
                    }
                    if (response == -1) {
                        alert("** Unsuccess update **");
                    }
                }
            })
        }
    })

    $(document).on('click', '#cancel', function () {
        $("#edit_prt").modal('hide');
    })
})
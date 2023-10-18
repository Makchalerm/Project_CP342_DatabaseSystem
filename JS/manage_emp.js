$(document).ready(function () {
    $(document).on('click', ".edit", function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'fetch_update_employee.php',
            type: 'POST',
            data: { emp_id: id },
            success: function (response) {
                var emp = JSON.parse(response)
                $('#efirstname').val(emp['efirstname']);
                $('#elastname').val(emp['elastname']);
                $('#eaddress').val(emp['eaddress']);
                $('#ecard_id').val(emp['ecard_id']);
                $('#egender').val(emp['egender']);
                $('#etel').val(emp['etel']);
                $('#update').data('id', id);
                $('#edit').modal('show');
            }
        })
    })

    $(document).on('click', "#update", function () {
        var emp_id = parseInt($(this).data('id'));
        var firstname = $('#efirstname').val().trim();
        var lastname = $('#elastname').val().trim();
        var card_id = $('#ecard_id').val().trim();
        var address = $('#eaddress').val().trim();
        var tel = $('#etel').val().trim();
        var gender = $('#egender').val().trim();

        if (firstname == "" || lastname == "" || card_id == "" || address == "" || tel == "" || gender == "") {
            alert("** Please fill out completely in the form. **");
        } else {
            card_id = parseInt($('#ecard_id').val().trim());
            $.ajax({
                url: 'update_emp.php',
                type: 'POST',
                data: { emp_id: emp_id, efirstname: firstname, elastname: lastname, ecard_id: card_id, eaddress: address, etel: tel, egender: gender },
                success: function (response) {
                    if (response == 1) {
                        alert("** Success to update employee **");
                        window.location.href = "employee.php";
                    }
                    if (response == -1) {
                        alert("** Unsuccess to update employee **");
                    }
                }
            })
        }


    })

    $(document).on('click', "#close", function () {
        $('#edit').modal('hide');
    })

    $(document).on('click', ".resign", function () {
        var confirmDelete = confirm("** Are you sure to resign employee. **");
        var id = $(this).data('id');
        if (confirmDelete) {
            $.ajax({
                url: 'resign.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    if (response == -1) {
                        alert("** You can not resign yourself. **");
                    }
                    if (response == 1) {
                        alert("** Employee " + id + "are resigned. **")
                        window.location.href = "employee.php";
                    }
                }
            })
        }
    })
})
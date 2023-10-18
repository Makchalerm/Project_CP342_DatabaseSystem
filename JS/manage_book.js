$(document).ready(function () {
    $(document).on('click', ".show_modal", function () {
        var id = $(this).data('id');
        $('#update_qty').data('id', id);
        $("#qty_modal").modal("show");
    })

    $(document).on("click", '.delete', function () {
        var id = $(this).data('id');
        var confirmDelete = confirm("** Are you sure to remove book in store **");
        if (confirmDelete) {
            $.ajax({
                url: 'delete_book.php',
                type: 'POST',
                data: { book_id: id },
                success: function (response) {
                    if (response == 1) {
                        window.location.href = "out_of_stock.php";
                    } else {
                        alert("** Failed to remove book **")
                    }
                }
            })
        }
    })

    $(document).on("click", '.edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'fetch_update_book.php',
            type: 'POST',
            data: { book_id: id },
            success: function (response) {
                var book = JSON.parse(response)
                $("#bname").val(book["bname"]);
                $("#bprice").val(book["bprice"]);
                $("#category option[value='" + book['category_id'] + "']").attr('selected', 'selected');
                $("#series option[value='" + book['series_id'] + "']").attr('selected', 'selected');
                $("#update_book").data("id", id);
                $("#edit_book").modal('show');
            }
        })
    })

    $(document).on("click", '#update_book', function () {
        var id = $(this).data('id');
        var bname = $("#bname").val();
        var bprice = $("#bprice").val();
        var category = $("#category").val();
        var series = $("#series").val();
        if (bname == "" || bprice == 0) {
            alert("** Please fill out completely in the form. **");
        } else {
            window.location.href = "update_book.php?book_id=" + id + "&bname=" + bname + "&bprice=" + bprice + "&category_id=" + category + "&series_id=" + series;
        }

    })

    $(document).on('click', "#close", function () {
        $('#qty_modal').modal('hide');
        $('#edit_book').modal('hide');
    })

    $('#update_qty').click(function () {
        var id = $(this).data('id');
        var qty = $('#bquantity').val();
        if (qty != 0) {
            window.location.href = "update_book_qty.php?bquantity=" + qty + "&book_id=" + id;
        } else {
            alert("** Please enter the required amount. **")
        }

    })
})

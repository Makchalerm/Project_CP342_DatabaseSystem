$(document).ready(function(){

    var idInCart = [];

    $('#data_table').DataTable({
        ordering: false
    });

    $(document).on('click',".deleteCart", function() {
        var id = $(this).data('id');
        var confirmDelete = confirm("** Are you sure to remove book **");
        if(confirmDelete) {
            $(this).closest('tr').css('background', 'tomato');
            $(this).closest('tr').fadeOut(800, function(){
                $(this).remove();
            });
            var oldTotal = parseInt($("#total").text().split(" ")[0]);
            var priceDelete = parseInt($(this).parent().parent().children("td:nth-child(3)").text());
            var newTotal = oldTotal - priceDelete;
            $("#total").text(newTotal + " ฿");
        }
        
    })

    $(document).on('click',".addCart", function() {
        var id = $(this).data('id');
        var name = document.getElementById(id).getElementsByTagName('td')[1].innerText;
        var qtyTxt = document.getElementById(id).getElementsByTagName('td')[2].getElementsByTagName('input')[0].value;
        var qty = parseInt(qtyTxt);
        var priceTxt = document.getElementById(id).getElementsByTagName('td')[3].innerText;
        var price = parseInt(priceTxt.split(" ")[0]) * qty;
        var add = $('#book');
        if(!isInCart(id)) {
            add.append("<tr data-id='" + id + "'>" +
            "<td> <p class='w3-margin'>" + name + "</p> </td>" +
            "<td> <p class='w3-margin'>" + qty + "</p> </td>" +
            "<td> <p class='w3-margin'>" + price + "</p> </td>" +
            '<td><button data-id="' + id + '" type="button" class="w3-margin btn btn-outline-danger waves-effect px-3 btn-sm deleteCart"><i class="fa fa-trash" aria-hidden="true"></i></button></td>' +
            '</tr>')
            idInCart.push(id);
        }else {
            var productQtyTxt = $('tr[data-id="' + id + '"] td:nth-child(2)').text();
            var productPriceTxt = $('tr[data-id="' + id + '"] td:nth-child(3)').text();
            var productQty = parseInt(productQtyTxt);
            var productPrice = parseInt(productPriceTxt);
            updateCart(id, qty, price, productQty, productPrice);
        }
        
        updateTotal();

    })

    $('#pay').click(function() {
        // Sale
        var total = parseInt($("#total").text().split(" ")[0]);
        
        // check cash
        var cash = $("#cash").val();

        // Check
        var bookId = [];
        var bookQty = [];
        var bookPrice = [];

        var qty = document.getElementById("book").getElementsByTagName("tr").length

        if(qty == 0) {
            alert("** Please add book in bill **");
        }else if(cash == 0) {
            alert("** Please add cash in bill **");
        }else if(cash < total) {
            var left = total - cash;
            alert("** Cash is not enough " + left + " ฿ **");
        }else {
            for (var i = 0; i < qty; i++) {
                bookId[i] = document.getElementById("book").getElementsByTagName("tr")[i].getAttribute("data-id");
                bookQty[i] = document.getElementById("book").getElementsByTagName("tr")[i].getElementsByTagName("td")[1].innerText;
                bookPrice[i] = document.getElementById("book").getElementsByTagName("tr")[i].getElementsByTagName("td")[2].innerText;
            }
            
            // Send to receipt.php
            $.ajax({
                url:'receipt.php',
                type:'GET',
                data:{bookId:bookId, bookQty:bookQty, bPrice:bookPrice, btotal:total, bcash:cash},
                success: function(response) {
                    window.location.href = "bill.php?id=" + response;
                }
            })
        }
    })

    $('#cash').keyup(function() {
        var cash = $(this).val();
        var total = parseInt($("#total").text().split(" ")[0]);
        var change = 0;
        if(cash == '' || cash <= total) {
            $('#change').text("0 ฿");
        }else {
            if(cash > total) {
                change = cash-total;
                $('#change').text(change + " ฿");
            }
        }
        
    })

    function isInCart(id) {
        for(var i=0; i < idInCart.length; i++) {
            if(id == idInCart[i]) {
                return true
            }
        }
        return false
    }

    function updateCart(id, oldQty, oldPrice, newQty, newPrice) {
        $('tr[data-id="' + id + '"] td:nth-child(2)').text(oldQty + newQty);
        $('tr[data-id="' + id + '"] td:nth-child(3)').text(oldPrice + newPrice);
    }

    function updateTotal() {
        var qty = document.getElementById("book").getElementsByTagName("tr").length;
        var sum = 0;
        for(var i=0; i<qty; i++) {
            sum += parseInt(document.getElementById("book").getElementsByTagName("tr")[i].getElementsByTagName("td")[2].innerText);
        }
        $("#total").text(sum + " ฿");
    }

})
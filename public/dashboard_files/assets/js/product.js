$(document).ready(function () {

    checkStock();

    //Add Product To Order
    $('.btn-add-product').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            name = $(this).data('name'),
            price = $(this).data('price'),
            qty = $(this).data('qty'),
            tr = '<tr class="row-' + id + '"><td>' + name + '</td><td><input type="number" name="products[' + id + '][quantity]" class="form-control form-control-alternative input-sm input-qty" min="1" value="1" data-price="' + price + '" data-id="' + id + '" data-qty="' + qty + '"/></td><td class="price">' + price + '</td><td><a href="" class="btn btn-danger btn-sm btn-remove-product fa fa-trash rounded-circle" id="' + id + '" data-qty="' + qty + '"></a></td></tr>';
        quantity(qty, id);
        $('.body-list').append(tr);
        $(this).removeClass('btn-success').addClass('disabled').addClass('btn-white');
        totalPrice();
        checkStock();
    });

    // Remove Product From Order
    $('body').on('click', '.btn-remove-product', function (e) {
        e.preventDefault();
        var id = $(this).attr('id'),
            stock = $(this).data('qty');
        $(this).closest('tr').remove();
        $('.product-list .stock-' + id).html(stock);
        $('#product-' + id).removeClass('btn-white disabled').addClass('btn-success');
        totalPrice();
        checkStock();
    });

    // Disabled btn
    $('body').on('click', '.disabled', function (e) {
        e.preventDefault();
    });

    // Calculate The Price OF Product
    $('body').on('keyup change', '.input-qty', function () {
        var id = $(this).data('id'),
            stock = $(this).data('qty'),
            qty = $(this).val(),
            unitPrice = $(this).data('price');
        $(this).closest('tr').find('.price').html(Number(qty * unitPrice));
        totalPrice();
        quantity(stock, id, qty);
        checkStock();
    });

    //Show Order By Ajax
    $('.btn-show-order').on('click', function () {
        var method = $(this).data('method'),
            url = $(this).data('url');
        $.ajax({
            url: url,
            method: method,
            success: function (data) {
                $('#show-product .table-responsive').remove();
                $('#show-product').append(data);
            }
        })
    });

});

// Calculate The Total Price Of Order
function totalPrice() {
    var totalPrice = 0;
    $('.body-list .price').each(function () {
        totalPrice += Number($(this).html());
    });

    $('.total-price').html(totalPrice);

    if (totalPrice > 0) {
        $('.btn-form-product').removeClass('disabled');
    } else {
        $('.btn-form-product').addClass('disabled');
    }
}

// calcuate The QTY Of Product In Stock
function quantity(q, id, v = 1) {
    var stock = q - v;
    $('.product-list .stock-' + id).html(stock);
    if (stock < 0) {
        $('.btn-form-product').addClass('disabled');
        $('.alert-custom').removeClass('d-none');
        $('.btn-add-product').addClass('disabled');
        $('.btn-remove-product').addClass('disabled');
    } else {
        $('.btn-form-product').removeClass('disabled');
        $('.alert-custom').addClass('d-none');
        $('.btn-add-product.btn-success').removeClass('disabled');
        $('.btn-remove-product').removeClass('disabled');
    }
}

// Check The Quantity Of Stock
function checkStock() {
    $('.product-list .qty').each(function (index) {
        var qty = $(this).html();
        if (qty == 0) {
            $(this).closest('tr').find('.btn-add-product').addClass('disabled');
        }
    });
}

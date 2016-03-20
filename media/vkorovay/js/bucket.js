/**
 * Created by opsat73 on 20.03.16.
 */
document.addEventListener("DOMContentLoaded", function(event) {
    var input = $('.product_count');
    input.focusout(function(event) {
        value = event.target.value;
        if (value < 1) {
            event.target.value = 1
        }

        var product_id = event.target.id.substr(14);
        var count = event.target.value;
        var data = 'count=' + count + '&' + 'product_id=' + product_id + '&mode=set';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = JSON.parse(xmlhttp.responseText);
                    $('.item_count')[0].innerHTML = resp.count + ' items';
                    $('.total_price')[0].innerHTML = resp.total_price + ' $';
                    $('#summary_price_'+product_id)[0].innerHTML = (count * $('#product_price_'+product_id)[0].innerHTML) + ' $';
                    $('#info_message')[0].innerHTML = 'Success!. Product was addet to bucket';
                    $('#info_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#info_message').addClass('hidden');
                    }, 3000);
                } else {
                    $('#error_message')[0].innerHTML = 'Sorry. Product was not addet to bucket';
                    $('#error_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#error_message').addClass('hidden');
                    }, 3000);
                }

            }
        }
        xmlhttp.open('POST', '/add');
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    });

    $('.product_delete').click(function(event) {
        var product_id = event.target.id.substr(15);
        var data = 'product_id=' + product_id + '&mode=delete';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = JSON.parse(xmlhttp.responseText);
                    if (resp.count == undefined) {
                        $('.item_count_menu').addClass('hidden');
                        $('.total_price_menu').addClass('hidden');
                        $('.bucket_products').addClass('hidden');
                        $('#bucket_empty_info').removeClass('hidden');
                    }
                    $('.item_count')[0].innerHTML = resp.count + ' items';
                    $('.total_price')[0].innerHTML = resp.total_price + ' $';
                    $('#row_'+product_id)[0].parentNode.removeChild($('#row_'+product_id)[0]);
                    $('#info_message')[0].innerHTML = 'Product was removed from bucket';
                    $('#info_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#info_message').addClass('hidden');
                    }, 3000);
                } else {
                    $('#error_message')[0].innerHTML = 'Product was not removed from bucket';
                    $('#error_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#error_message').addClass('hidden');
                    }, 3000);
                }

            }
        }

        xmlhttp.open('POST', '/add');
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

    });

    var forValidation = $('.validate');
    forValidation.each(function(id, it) {
        var item = $(it);
        item.focus(function(event) {
            $(event.target.parentNode).removeClass('has-error');
        })
    })

    $('#send_order').click(function(event) {
        var forValidation = $('.validate');
        var formCorrect = true;
        forValidation.each(function(id, it) {
            var item = $(it);
            if (item.hasClass('empty')) {
                if (item[0].value == undefined || item[0].value == '') {
                    item.parent().addClass('has-error');
                    item.parent().removeClass('has-success');
                    formCorrect = false;
                } else {
                    item.parent().removeClass('has-error');
                    item.parent().addClass('has-success');
                }
            }
            if (item.hasClass('email')) {
                var regexp = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
                if (!regexp.test(item[0].value)) {
                    item.parent().addClass('has-error');
                    item.parent().removeClass('has-success');
                    formCorrect = false;
                } else {
                    item.parent().removeClass('has-error');
                    item.parent().addClass('has-success');
                }
            }
            if (item.hasClass('phone')) {
                var regexp = new RegExp(/^[+]{0,1}\d{0,15}$/g);
                if (item[0].value != undefined && item[0].value != '') {
                    if (!regexp.test(item[0].value)) {
                        item.parent().addClass('has-error');
                        item.parent().removeClass('has-success');
                        formCorrect = false;
                    } else {
                        item.parent().removeClass('has-error');
                        item.parent().addClass('has-success');
                    }
                } else {
                    item.parent().removeClass('has-error');
                    item.parent().addClass('has-success');
                }
            }
        });
        if (formCorrect) {
            $('#order')[0].submit();
        }
    });
});


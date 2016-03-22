/**
 * Created by opsat73 on 20.03.16.
 */
var initProduct = function(event) {
    var input = $('#product_count');
    input.focusout(function(event) {
        value = event.target.value;
        if (value < 1) {
            event.target.value = 1
        }
    });

    var button = $('#send');
    button.click(function(event) {
        var count = input = $('#product_count')[0].value;
        var product_id = input = $('#product_id')[0].value;
        var data = 'count=' + count + '&' + 'product_id=' + product_id + '&mode=add';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = JSON.parse(xmlhttp.responseText);
                    $('.item_count')[0].innerHTML = resp.count + ' items';
                    $('.item_count_menu').removeClass('hidden');
                    $('.total_price')[0].innerHTML = resp.total_price + ' $';
                    $('.total_price_menu').removeClass('hidden');
                    $('#info_message')[0].innerHTML = 'Success!. Product count was updated';
                    $('#info_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#info_message').addClass('hidden');
                    }, 3000);
                } else {
                    $('#error_message')[0].innerHTML = 'Sorry. Product count was not updated';
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

};

init = function(event) {

    var pagination_button = $('.pagination_button');
    pagination_button.click(function(event) {
        var target = event.currentTarget;
        var page = target.getAttribute('shop_path');
        var path = '/'+$('#category')[0].value+'/'+$('#sort')[0].value+'/'+page;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = xmlhttp.responseText;
                    $('.content')[0].innerHTML = resp;
                    init();
                } else {
                    $('#error_message')[0].innerHTML = 'Sorry. Something wrong. please Reboot bage';
                    $('#error_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#error_message').addClass('hidden');
                    }, 3000);
                }
            }
        }
        xmlhttp.open('GET', path);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    });

    var product_link = $('.product_link');
    product_link.click(function(event) {
        var target = event.currentTarget;
        var page = target.getAttribute('shop_path');
        var path = '/product/'+page;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = xmlhttp.responseText;
                    $('.content')[0].innerHTML = resp;
                    $('.categories').removeClass('active');
                    $('#sort-controll').addClass('hidden');
                    init();
                    initProduct();
                } else {
                    $('#error_message')[0].innerHTML = 'Sorry. Something wrong. please Reboot bage';
                    $('#error_message').removeClass('hidden');
                    setTimeout(function() {
                        $('#error_message').addClass('hidden');
                    }, 3000);
                }
            }
        }
        xmlhttp.open('GET', path);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    });
}

document.addEventListener("DOMContentLoaded", init);


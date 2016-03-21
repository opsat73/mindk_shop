/**
 * Created by opsat73 on 20.03.16.
 */
document.addEventListener("DOMContentLoaded", function(event) {

    var categories = $('.navigation');
    categories.click(function(event) {
        var target = event.target;
        var category = target.getAttribute('shop_path');
        var path = '/'+category+'/ASC/1';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = xmlhttp.responseText;
                    $('#category')[0].value = category;
                    $('.content')[0].innerHTML = resp;
                    $('.categories.active').removeClass('active');
                    $(target).addClass('active');
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
});


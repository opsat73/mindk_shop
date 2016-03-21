/**
 * Created by opsat73 on 20.03.16.
 */
document.addEventListener("DOMContentLoaded", function(event) {

    var menu_bar_sort = $('.menu_bar_sort');
    menu_bar_sort.click(function(event) {
        var target = event.target;
        var sort = target.getAttribute('shop_path');
        var path = '/'+$('#category')[0].value+'/'+sort+'/1';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    var resp = xmlhttp.responseText;
                    $('#sort')[0].value = sort;
                    $('.content')[0].innerHTML = resp;
                    $('.menu_bar_sort_drop_down')[0].innerHTML = ((sort == 'ASC')?'Cheaper first':'Expensive first')+'<span class="caret"\>\<\/span>';
                    init();
                    initProduct();
                } else {
                    $('#error_message')[0].innerHTML = 'Sorry. Something wrong. please Reboot bage';
                    $('#error_message').removeClass('hisortdden');
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


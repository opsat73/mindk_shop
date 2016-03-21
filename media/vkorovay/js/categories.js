/**
 * Created by opsat73 on 20.03.16.
 */
initNavigation = function(event) {

    var categories = $('.navigation');
    categories.unbind();
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
}

initParentNavigation = function(event) {

    var navigation_parent = $('.navigation-parent');
    navigation_parent.unbind();
    navigation_parent.click(function(event) {
        var target = event.currentTarget;
        var category = target.getAttribute('shop_path');
        state = target.getAttribute('category_status');
        if (state == 'closed') {
            var path = '/category/' + category;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText;
                        $('#category')[0].value = category;
                        $('.category_content_' + category)[0].innerHTML = resp;
                        $('.categories.active').removeClass('active');
                        $('.three-content-row_' + category).removeClass('hidden');
                        $('#category_glyph_' + category).removeClass('glyphicon-plus');
                        $('#category_glyph_' + category).addClass('glyphicon-minus');
                        target.setAttribute('category_status', 'open');
                        init();
                        initProduct();
                        initNavigation();
                        initParentNavigation();
                    } else {
                        $('#error_message')[0].innerHTML = 'Sorry. Something wrong. please Reboot bage';
                        $('#error_message').removeClass('hidden');
                        setTimeout(function () {
                            $('#error_message').addClass('hidden');
                        }, 3000);
                    }
                }
            }
            xmlhttp.open('GET', path);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();
        } else {
            $('.three-content-row_' + category).addClass('hidden');
            $('#category_glyph_' + category).addClass('glyphicon-plus');
            $('#category_glyph_' + category).removeClass('glyphicon-minus');
            target.setAttribute('category_status', 'closed');
        }
    })};



document.addEventListener("DOMContentLoaded", function(event) {
    initNavigation();
    initParentNavigation();
});


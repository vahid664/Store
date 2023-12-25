$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });

    //Init the carousel
    $("#suggestion-slider").owlCarousel({
        rtl: true,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        dots: false,
        onInitialized: startProgressBar,
        onTranslate: resetProgressBar,
        onTranslated: startProgressBar
    });

    function startProgressBar() {
      // apply keyframe animation
      $(".slide-progress").css({
        width: "100%",
        transition: "width 5000ms"
      });
    }

    function resetProgressBar() {
      $(".slide-progress").css({
        width: 0,
        transition: "width 0s"
      });
    }




    // **************  product slider
    $(".porfrosh").owlCarousel({
        rtl: true,
        margin: 10,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 4,
                slideBy: 2
            },
            1400: {
                items: 6,
                slideBy: 3
            }
        }
    });

    $(".offer").owlCarousel({
        rtl: true,
        margin: 10,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 6,
                slideBy: 2
            },
            1400: {
                items: 8,
                slideBy: 3
            }
        }
    });

    $(".brand-owl").owlCarousel({
        rtl: true,
        margin: 10,
        lazy: true,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 7,
                slideBy: 2
            },
            1400: {
                items: 10,
                slideBy: 3
            }
        }
    });

    $(".shane").owlCarousel({
        rtl: true,
        margin: 10,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 7,
                slideBy: 2
            },
            1400: {
                items: 7,
                slideBy: 3
            }
        }
    });

    $(".gift").owlCarousel({
        rtl: true,
        margin: 10,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 4,
                slideBy: 2
            },
            1400: {
                items: 4,
                slideBy: 3
            }
        }
    });

    $('.brand-slider .owl-carousel').owlCarousel({
        rtl: true,
        margin: 10,
        lazyLoad: true,
        items: 5,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 4
            },
            768: {
                items: 5
            },
            992: {
                items: 5
            }
        }
    });

    $('.similar-product').owlCarousel({
        rtl: true,
        margin: 10,
        autoplay:true,
        autoplayHoverPause:true,
        nav: true,
        navText: ['<i class="now-ui-icons arrows-1_minimal-right"></i>', '<i class="now-ui-icons arrows-1_minimal-left"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 1
            },
            576: {
                items: 2,
                slideBy: 1
            },
            768: {
                items: 3,
                slideBy: 2
            },
            992: {
                items: 6,
                slideBy: 2
            },
            1400: {
                items: 8,
                slideBy: 3
            }
        }
    });

    $('.back-to-top').click(function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 800, 'easeInExpo');
    });

    $("#img-product-zoom").ezPlus({
        zoomType: "inner",
        containLensZoom: true,
        gallery: 'gallery_01f',
        cursor: "crosshair",
        galleryActiveClass: "active",
        responsive: true,
        imageCrossfade: true,
        zoomWindowFadeIn: 2000,
        zoomWindowFadeOut: 2000
    });

   /* if ($("#img-product-zoom").length) {
        if($(window).width()>768) {
            $("#img-product-zoom").ezPlus({
                zoomType: "inner",
                containLensZoom: true,
                gallery: 'gallery_01f',
                cursor: "crosshair",
                galleryActiveClass: "active",
                responsive: true,
                imageCrossfade: true,
                zoomWindowFadeIn: 2000,
                zoomWindowFadeOut: 2000
            });
        }
        else
        {
            $("#img-product-zoom").ezPlus();
        }
    }*/

    $(".sum-more").click(function () {
        var sumaryBox = $(this).parents('.parent-expert');
        sumaryBox.find('.content-expert').toggleClass('active');
        sumaryBox.find('.shadow-box').fadeToggle();

        $(this).find('i').toggleClass('active');

        $(this).find('.show-more').fadeToggle(0);
        $(this).find('.show-less').fadeToggle(0);
    });

    $('nav.header-responsive li.active').addClass('open').children('ul').show();

    $("nav.header-responsive li.sub-menu> a").on('click', function () {
        $(this).removeAttr('href');
        var e = $(this).parent('li');
        if (e.hasClass('open')) {
            e.removeClass('open');
            e.find('li').removeClass('open');
            e.find('ul').slideUp(400);

        } else {
            e.addClass('open');
            e.children('ul').slideDown(400);
            e.siblings('li').children('ul').slideUp(400);
            e.siblings('li').removeClass('open');
        }
    });

    // Start scroll

    $(window).scroll(function () {
        if ($(this).scrollTop() > 60) {
            $("nav.header-responsive").css({ height: '60px' });
            $("nav.header-responsive .search-nav").css({ opacity: '0', visibility: 'hidden' });
        } else {
            $("nav.header-responsive").css({ height: '110px' });
            $("nav.header-responsive .search-nav").css({ opacity: '1', visibility: 'visible' });
        }
    });

    // End scroll

    // favorites product

    $("ul.gallery-options button.add-favorites").on("click",function () {
        //$(this).toggleClass("favorites");
        url=$(this).attr('data-url');
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                $("ul.gallery-options button.add-favorites").toggleClass("favorites");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status==401)
                {
                    //window.location = get_site_url() + '/login';
                    $('#Modal_login').modal('show');
                }
            }
        });
    });

    $("#Login").on('submit',(function(e) {
        $('body').css({"opacity": "0.5"});
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'), // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                $('#Modal_login').modal('hide');
                $('body').css({"opacity": "1"});
                window.location.href=window.location.href;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('body').css({"opacity": "1"});
            }
        });
    }));


    $("#NewsForm").on('submit',(function(e) {
        $('body').css({"opacity": "0.5"});
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'), // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                show_alert_message("", data);
                $('body').css({"opacity": "1"});
            },
            error: function (xhr, ajaxOptions, thrownError) {
                show_alert_message('Error','مشکلی پیش آمده لطفا بعدا دوباره امتحان کنید');
                $('body').css({"opacity": "1"});
            }
        });
    }));


    // favorites product

});



(function slide(){
    $('#clientsSlider').animate({backgroundPosition : '-=2px'}, 20, 'linear', slide);
})();
$(document).ready(function() {
    $('.js-brand').select2({
        placeholder: "برند خود را انتخاب کنید",
    });
});

function commentID(id) {
    $('#answer #parent_id').val(id);
}

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}
function removeFilterUrl(name) {
    var url = window.location.href;
    url=removeParam(''+name+'',url);
    window.location.href = url;
}
function qwe() {
    var checks = $('#collapseExample3 input[type="checkbox"]:checked').map(function() {
        return parseInt($(this).val());
    }).get()
    var url = window.location.href;
    if (url.indexOf('?') > -1){
        if (url.indexOf('brand') > -1){
            url=removeParam('brand',url);
            if (url.indexOf('?') > -1){
                url += '&brand='+ checks;
            }else{
                url += '?brand='+ checks;
            }
        }
        else{
            url += '&brand='+ checks;
        }
    }else{
        url += '?brand='+ checks;
    }
    window.location.href = url;
}
function colorp() {
    var checks = $('#collapseExample5 input[type="checkbox"]:checked').map(function() {
        return $(this).val();
    }).get()
    var url = window.location.href;
    if (url.indexOf('?') > -1){
        if (url.indexOf('color') > -1){
            url=removeParam('color',url);
            if (url.indexOf('?') > -1){
                url += '&color='+ checks;
            }else{
                url += '?color='+ checks;
            }
        }
        else{
            url += '&color='+ checks;
        }
    }else{
        url += '?color='+ checks;
    }
    window.location.href = url;
}
function sizep() {
    var checks = $('#collapseExample4 input[type="checkbox"]:checked').map(function() {
        return $(this).val();
    }).get()
    var url = window.location.href;
    if (url.indexOf('?') > -1){
        if (url.indexOf('size') > -1){
            url=removeParam('size',url);
            if (url.indexOf('?') > -1){
                url += '&size='+ checks;
            }else{
                url += '?size='+ checks;
            }
        }
        else{
            url += '&size='+ checks;
        }
    }else{
        url += '?size='+ checks;
    }
    window.location.href = url;
}
function entity(val) {
    var url = window.location.href;
    if (url.indexOf('?') > -1){
        if (url.indexOf('&entity') > -1){
            url=removeParam('entity',url);
        }
        else{
            url += '&entity='+val;
        }
    }else{
        url += '?entity='+val;
    }
    window.location.href = url;
}

function toEnglishNumber(strNum,name) {
    var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

    var cache = strNum;
    for (var i = 0; i < 10; i++) {
        var regex_fa = new RegExp(pn[i], 'g');
        cache = cache.replace(regex_fa, en[i]);
    }
    $('#'+name).val(cache);
}

function ShowMore() {
    $('.content-expert').removeClass('size-show');
    $('#more').removeClass('d-inline').addClass('d-none');
    $('#less').addClass('d-inline').removeClass('d-none');
    $('.shadow-box').addClass('d-none');
}
function ShowLess() {
    $('.content-expert').addClass('size-show');
    $('#more').addClass('d-inline').removeClass('d-none');
    $('#less').removeClass('d-inline').addClass('d-none');
    $('.shadow-box').removeClass('d-none');
}

function show_alert_message(header_message, message) {
    var html = '<div class="modal-dialog modal-dialog-centered modal-md" role="document">' +
        '<div class="modal-content ">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title" id="exampleModalLabel2">' + header_message + '</h5>' +
        '<button type="button" class="close ml-0" data-dismiss="modal">&times;</button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row" >' +
        '<div class="col-12 text-right mt-3 mb-5 container mt-0">' +
        '<p> ' + message + '</p>' +
        '</div> ' +
        '</div> ' +
        '</div>' +
        '</div>' +
        '</div>';
    $('#alert_message').html(html).modal('toggle');
}

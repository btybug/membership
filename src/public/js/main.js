$(function () {
    if (jQuery('.selectpicker').length > 0) {
        $('.selectpicker').selectpicker();
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            $('.selectpicker').selectpicker('mobile');
        }
    }
    if (jQuery('.customselect').length > 0) {
        $('.customselect').selectpicker();
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            $('.customselect').selectpicker('mobile');
        }
    }

    function setheader() {
        if ($('.menuBuilderHeader').attr('class')) {
            var topHeigsubh = $('.menuBuilderHeader').innerHeight();
            $('#builderContain').find('.formoptions').css('top', topHeigsubh);

        }

        var topHeigh = $('#menuBuilderHeader').innerHeight();
        $('#builderContain').css('top', topHeigh);


    }

    setheader()

    $(window).resize(setheader);

    if ($('.formoptions').length > 0) {

        $(window).load(function () {
            // $(".formoptions").mCustomScrollbar();
        });

    }


    function getstodio(studio) {

        $.ajax({
            type: "post",
            url: "/admin/products/change-type",
            cache: false,
            datatype: "json",
            data: {name: studio},
            headers: {
                'X-CSRF-TOKEN': $("#token").val()
            },
            success: function (result) {

                $('.studio-body').html(result.view);
                setheader()

                if (jQuery('.selectpicker').length > 0) {
                    $('.selectpicker').selectpicker();
                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                        $('.selectpicker').selectpicker('mobile');
                    }
                }
                if (jQuery('.customselect').length > 0) {
                    $('.customselect').selectpicker();
                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                        $('.customselect').selectpicker('mobile');
                    }
                }

            }
        });
    }


    $("body").on("change", "#builderStudio", function () {
        var getvalue = $(this).val();
        var url = '/studios/bbeditor/classes/' + getvalue;
        window.location = url;

        //getstodio(getvalue)
    })


    $('[data-createModle="newclass"]').click(function () {
        getstodio('menubuilder')
    })

    $('#studio-builder').on('shown.bs.modal', function () {
        setheader()
    })

    $('[data-tabnav] a').click(function () {

        $(this).closest('[data-tabnav]').children('li').removeClass('active')
        $(this).closest('li').addClass('active')
    })

    $('body').on('click', '[data-save="class"]', function () {
        var exportjson = $('[data-export="json"]').val();
        if (typeof exportjson === "object") {
            exportjson = JSON.stringify(exportjson);
        }

        var data = {
            "json": exportjson,
            "css": $('[data-export="css"]').val(),
            "name": $('[data-role="classname"]').val(),
            "type": $('#builderStudio').val()
        };

        var url = $('#classes_links').val();
        var afterajax = function (result) {
            if (result.result) {
                $("#studio-success .studio-no-btn").attr('href', result.user_sub);
                $("#studio-success").modal();
                //window.location.href = '/admin/themes/classes/variation-class/'+result.id;
            } else {
                var message = '';
                $.each(result.message, function (k, v) {
                    message += v;
                });
                alert(message);
            }
        }

        postAjax('/create-user-class', data, afterajax);
    })


    $('body').on('click', '[data-openmenu]', function (e) {
        e.preventDefault();
        var targetpopup = $(this).data('openmenu')

        if ($('[data-menucontainer="mainmenu"]').hasClass('active')) {
            $('[data-menucontainer="' + targetpopup + '"]').addClass('bounceOutLeft');
            setTimeout(function () {
                $('[data-menucontainer="' + targetpopup + '"]').removeClass('active bounceInLeft');
            }, 1000);
            $(this).removeClass('active')
            $('[data-sitecontainer]:visible').addClass('hide')
            $('[data-sitecontainer]:visible').removeClass('active flipInY')

        } else {
            $('[data-submenucontainer]').removeClass('active');
            $('[data-submenucontainer="' + targetpopup + '"]').addClass('active');
            $('[data-menucontainer="' + targetpopup + '"]').addClass('active bounceInLeft').removeClass('bounceOutLeft');

            $(this).addClass('active');
        }
    });

    $('body').on('click', '[data-opensubmenu]', function (e) {
        e.preventDefault();
        var $thistarget = $(this);
        var targetpopup = $thistarget.data('opensubmenu')
        $('[data-submenucontainer]').removeClass('active');
        $('[data-opensubmenu]').removeClass('active')
        setTimeout(function () {
            $('[data-submenucontainer="' + targetpopup + '"]').addClass('active')
            $thistarget.addClass('active')
        }, 250);

    });

    $('body').click(function (e) {
        if (!$(e.target).is('[data-openmenu], [data-openmenu] *, [data-menucontainer], [data-menucontainer] *, .templateSize, .templateSize *')) {
            if ($('[data-menucontainer]').hasClass('active')) {
                $('[data-menucontainer]').addClass('bounceOutLeft')
                $('[data-openmenu]').removeClass('active')
                $('[data-sitecontainer]:visible').addClass('hide')
                $('[data-sitecontainer]:visible').removeClass('active flipInY')
                setTimeout(function () {
                    $('[data-menucontainer]').removeClass('active bounceInLeft');
                    $('[data-sitecontainer]:visible').removeClass('active flipInY')


                }, 1000);
            }
        }
    });

    $('body').on('click', '[data-viewtoolbar]', function () {
        var viewtarget = $(this).data('viewtoolbar');
        $('[data-targetviewtool="' + viewtarget + '"]').removeClass('animate-delay2');
        if ($(this).hasClass('active')) {
            $('[data-targetviewtool="' + viewtarget + '"]').addClass('hide');
            $(this).removeClass('active')

            $(this).children('i').removeClass('iconViewEyeNa').addClass('iconViewEyeWhite')
        } else {

            $('[data-targetviewtool="' + viewtarget + '"]').removeClass('hide');
            $(this).children('i').removeClass('iconViewEyeWhite').addClass('iconViewEyeNa')
            $(this).addClass('active')
        }
    })

    function openTemplate(target, thistarget) {
        var visibalnew = $('[data-sitecontainer]').not('[data-sitecontainer="' + target + '"]');
        var loadtime = 0;
        $('[data-openproject]').removeClass('active')
        if (visibalnew.is(':visible')) {
            visibalnew.addClass('hide').removeClass('active flipInY')

        }
        setTimeout(function () {
            visibalnew.addClass('hide')
            thistarget.addClass('active')
            $('[data-sitecontainer="' + target + '"]').removeClass('flipOutY').addClass('active flipInY').removeClass('hide')
        }, loadtime);
    }

    $('body').on('click', '[data-openproject]', function () {
        var targetbval = $(this).data('openproject')
        if (targetbval) {
            openTemplate(targetbval, $(this));
        }
    });

    var myproject = $('[data-mytemplate="saved"]').val()
    if (myproject) {
        if (typeof myproject != "object") {
            myproject = JSON.parse(myproject);
            var projecthtml = ''
            $.each(myproject, function (k, v) {

                projecthtml += '<li><a href="#" data-getitem="' + v + '"><img src="/appdata/app/Modules/Studio/Resources/Views/classes/site-builder/img/template-img.jpg" alt=""></a></li>';
            });

            $('[data-myprojectlist="myproject"]').html(projecthtml)
        }

        var selecttypr = $('[data-role="selectStudio"]').val()
        if (selecttypr != 'site-builder') {
            $('[data-myprojectlist="tab"]').hide()
        }

    }
    $('body').on('click', '[data-getitem]', function () {
        var type = $('[data-role="selectStudio"]').val()
        var name = $(this).data('getitem');
        var data = {
            "type": type,
            "name": name
        }
        var afterajax = function (d) {
            if (d.error == false) {
                alert('Getjson: ' + d.json)
            }
        }

        postAjax('/get-studio-saved', data, afterajax);

    });

});

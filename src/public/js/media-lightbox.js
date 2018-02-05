$.fn.media = function (options) {
    var defaults = {
        action: $(this),
        value: '.filevalue',
        htmltarget: '.filehtml',
        fileParth: '.fileParth',
        val: true,
        html: true,
        type: 'images',
        fileurl: '/media',
        filelength: 1
    };

    var settings = $.extend(true, {}, defaults, options);

    return this.each(function () {
        settings.action.on("click", openpopup);

        function openpopup() {

            if (settings.htmltarget.toLowerCase().indexOf("data") >= 0) {
                settings.htmltarget = $(this).attr(settings.htmltarget);
            }

            if (settings.fileParth.toLowerCase().indexOf("data") >= 0) {
                settings.fileParth = '[name="' + $(this).attr(settings.fileParth) + '"]';
            }

            bootbox.dialog({
                message: '<div id="mediagallery"><div class="loadingimg"></div></div>',
                size: 'large',
                title: "Media Gallery",
                className: "medialarge",
                buttons: {
                    main: {
                        label: "Cancel",
                        className: "btn-default"
                    },
                    success: {
                        label: "Insert",
                        className: "btn-success btn-submit",
                        callback: function () {
                            //alert(settings.filelength)
                            Getfile = $("#content").val().split(",");
                            GetfileParth = $("#imageparth").val().split(",");

                            if (Getfile != '') {
                                if (settings.val) {
                                    $(settings.value).val('');
                                    $(settings.fileParth).val('');
                                }
                                if (settings.html) {
                                    $(settings.htmltarget).html('');
                                }

                                for (i = 0; i < settings.filelength; i++) {
                                    if (settings.val) {
                                        $(settings.value).val($(settings.value).val() + Getfile[i]);
                                        $(settings.fileParth).val($(settings.fileParth).val() + $(Getfile[i]).attr('src'));
                                    }
                                    if (settings.html) {
                                        if ($(settings.htmltarget).is('img')) {
                                            $(settings.htmltarget).attr('src', $(Getfile[i]).attr('src'));
                                        } else {
                                            $(settings.htmltarget).html($(settings.htmltarget).html() + Getfile[i]);
                                        }

                                    }

                                    if (i === Getfile.length) {
                                        i = settings.filelength;
                                    }
                                }

                            }
                            //alert(Getfile.length);
                            //alert($("#imageparth").val());
                        }
                    }


                }
            });

            $('#mediagallery').load(settings.fileurl, function () {
                $('[data-role="mediatype"]').val(settings.type).addClass('hide');
                $('#filelength').val(settings.filelength);
                if (settings.type == "all") {
                    $('[data-role="mediatype"]').removeClass('hide');
                }


            });


        }
    });

}

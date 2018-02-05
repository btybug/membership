/*------------------------------------------------*/
$.fn.icon = function (options) {
    var defaults = {
        action: $(this),
        type: "popup",
        container: ".iconContainerPopup",
        setbutton: 'geticon',
        iconView: '.iconView',
        geticonplas: '#geticonPlacement',
        iconval: '.geticonseting',
        iconselector: "#icons",
        callback: function () {
        }
    };
    var settings = $.extend(true, {}, defaults, options);
    return this.each(function () {
        $this = $(this);
        tabs = '';
        content = '';
        loadaryy = [];
        datahtml = {}
        loadicontab = [];
        iconSeting = '';
        activetabs = "";
        $.get("http://edo.bootydev.co.uk/admin/assets/core_assest/fonts-list", function (data) {

            content += '<div class="tab-content iconmoduls">';
            tabs += '<ul class="nav icontabss nav-tabs" role="tablist">';
            index = 0;
            $.each(data, function (i, item) {
                if (index == 0) {
                    al = "active";
                } else {
                    al = "";
                }
                tabs += '<li role="presentation" class="loadtabdata ' + al + '"><a href="#icontab' + i + '" aria-controls="icontab' + i + '" data-folder="' + item.folder + '" data-path="' + i + '" role="tab" title="' + item.title + '" data-toggle="tab">' + item.title + '</a></li>';
                var ifolder = item.folder;
                datahtml[ifolder] = '';
                loadicontab.push(item.title);
                $.get('http://edo.bootydev.co.uk/admin/assets/core_assest/font-icons/' + item.folder, function (hd) {
                    icondata = '<div class="form-group">';

                    icondata += '<div class="col-sm-12"><ul class="icons">';
                    $.each(hd.list, function (key, val) {
                        icondata += ' <li><a href="#" class="selectIcons" data-csspr="icon" data-csspro="icon" data-val="' + hd.config.prefix + ' ' + key + '"><i class="' + hd.config.prefix + ' ' + key + '"></i></a></li>';
                    });
                    icondata += "</ul></div>"
                    icondata += "</div>"
                    datahtml[ifolder] = '<div class="form-horizontal">' + icondata + '</div>';
                    loadaryy.push('<div class="form-horizontal">' + icondata + '</div>');
                });
                index++;
            });
            tabs += '</ul>';
            content += '<div role="tabpanel" class="tab-pane p-10 active" id="icontabLoad">';
            content += '</div>';
            content += "</div>";
            content += '<input type="text" id="selectedicon" hidden="hidden">'
            content += '<div class="p-l-10 iconbuttonRow"><button type="button" id="' + settings.setbutton + '" class="btn btn-default">Apply</button> ';
            if (settings.type != "inline") {
                content += '<button type="button" id="cancelicon" class="btn btn-default">Cancel</button>';
            }
            content += '</div>';


        }, "json");
        $this.click(function (e) {
            e.preventDefault();
            openpopup()
        })


        function openpopup() {
            getbackVal = $(settings.iconval).val();
            bodycon = tabs + content;
            if (settings.type == "inline") {
                $(settings.container).html(bodycon);
            } else {
                bootbox.dialog({
                    message: bodycon,
                    title: "Icon "
                });
            }

            var activefold = $('.loadtabdata.active a').data('folder');
            $('#icontabLoad').html(datahtml[activefold]);
            $('.selectIcons[data-val="' + getbackVal + '"]').addClass('iconselected')
            $('#selectedicon').val(getbackVal);

            $('.loadtabdata a').on('click', function () {
                getpath = $(this).data('path');
                getfolder = $(this).data('folder');
                activetabs = loadicontab[Number(getpath)];
                if (!datahtml[getfolder]) {
                    $('#icontabLoad').html('Sorry No have ' + $(this).attr('title') + ' at this time');
                } else {
                    $('#icontabLoad').html(datahtml[getfolder]);
                }
            });
            $('#cancelicon').click(function () {
                if (settings.type != "inline") {
                    bootbox.hideAll();
                }
            });
            $('#' + settings.setbutton).on("click", savedata);

            $('body').on("click", '.selectIcons', function () {
                $('.selectIcons').removeClass('iconselected');
                $(this).addClass('iconselected');
                var selectedicon = $(this).data('val')
                $('#selectedicon').val(selectedicon);


            })

            $('body').on("dblclick", '.selectIcons', function () {
                savedata()
            })


        }


        function savedata() {
            //$(settings.iconView).data('iconSeting', iconSeting);
            activeicon = $('#selectedicon').val()
            $(settings.iconView).html('<i class="' + activeicon + '"></i>')
            $(settings.iconval).val(activeicon);
            settings.callback();
            if (settings.type != "inline") {
                bootbox.hideAll();
            }
        }
    });
};
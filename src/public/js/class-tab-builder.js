$(function () {
    $('[data-role="selectStudio"]').val('tab').selectpicker('refresh');
    var classb = {
        sl: {
            cssview: $('[data-role="classview"]'),
            cssstyle: $('[data-role="savedcss"]'),
            exportjson: $('[data-export="json"]'),
            exportcss: $('[data-export="css"]'),
            save: $('[data-save="class"]')
        },
        less: "",
        generalSetting: {
            csssetting: {
                css: {},
                tabindex: 0,
                htmloption: {
                    setting: {}
                }
            }
        },
        runcss: function () {
            var data = classb.generalSetting.csssetting.classname + '{'
            $.each(classb.generalSetting.csssetting.css, function (io, iv) {
                if (io == 'containerclass' || io == 'animationclass' || io == 'textclass' || io == 'iconclass') {
                    data += iv + '; ';
                } else {
                    data += io + ":" + iv + '; ';
                }

            });


            data += '}';
            classb.generalSetting.csssetting.savedcss = data;
            classb.sl.exportcss.val(classb.generalSetting.csssetting.savedcss)
            classb.compile()
            classb.runhtml()

        },
        runhtml: function () {
            var htmloptiondata = classb.generalSetting.csssetting.htmloption;
            $.each(htmloptiondata, function (key, val) {
                var mainkey = key;
                var contenttype = val['content'];

                $.each(val, function (k, v) {
                    if (k == "class") {
                        var classes = '';
                        $.each(v, function (type, cls) {
                            classes += cls + ' '

                            if (type == "positions") {
                                if (cls == "tabs-below") {
                                    $('[data-tabs="demo"] > .nav-tabs').insertAfter($('[data-tabs="demo"] > .tab-content'))
                                } else {
                                    $('[data-tabs="demo"] > .nav-tabs').insertBefore($('[data-tabs="demo"] > .tab-content'))
                                }
                            }
                        })

                        if (key == "setting") {
                            classes += 'tabs-x tabs-krajee';
                        }
                        $('[data-print="demehtml"] [data-class="' + key + '"]').attr('class', classes);
                    }
                    if (k == "conclass") {
                        var contentclass = 'tab-content';
                        $.each(v, function (type, cls) {
                            contentclass += ' ' + cls;
                        })
                        $('[data-print="demehtml"] [data-conclass="' + key + '"]').attr('class', contentclass);
                    }
                    if (k == "navclass") {
                        var navclass = '';
                        $.each(v, function (type, cls) {
                            navclass += ' ' + cls;
                        })
                        $('[data-print="demehtml"] [data-navclass="' + key + '"]').attr('class', navclass);
                    }


                    if (k == "enableIcon") {
                        iconclass = " ";
                        if (v) {
                            $.each(v, function (type, cls) {
                                iconclass += ' ' + cls;
                            })
                        }
                        $('[data-print="demehtml"] a[data-class="' + key + '"] [data-tabicon="enableIcon"]').attr('class', iconclass);
                    }

                    if (k == "enabletext") {
                        var tabtext = " ";
                        if (v) {
                            tabtext = v
                        }
                        $('[data-print="demehtml"] a[data-class="' + key + '"] [data-tabtext="enabletext"]').html(tabtext);
                    }

                    if (contenttype) {
                        if (contenttype['contentType']) {
                            if (contenttype['contentType'] == "text" && k == "middletext") {
                                var tabtext = " ";
                                if (v) {
                                    tabtext = v
                                }
                                $('[data-print="demehtml"] [data-tabs="tab-content"] [data-removetab="' + key + '"]').html(tabtext);
                            }

                            if (contenttype['contentType'] == "othercontent" && k == "othercontent") {
                                var tabtext = " ";
                                if (v) {
                                    tabtext = v
                                }
                                $('[data-print="demehtml"] [data-tabs="tab-content"] [data-removetab="' + key + '"]').html(tabtext);
                            }
                        }
                    }

                    if (k == "dropdownmenu") {
                        var tabtext = " ";
                        if (v) {
                            $.each(v, function (type, cls) {
                                if (type == "dropdownmenu") {
                                    if (cls) {
                                        var submenuitem = '<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop-' + key + '">';
                                        for (i = 0; i < cls.length; i++) {
                                            submenuitem += '<li><a href="#tabsprevew' + cls[i] + '" tabindex="" role="tab" data-toggle="tab">' + cls[i] + '</a></li>'
                                        }
                                        submenuitem += '</ul>';
                                        $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').closest('li').find('.dropdown-menu').remove();
                                        $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').attr('data-toggle', 'dropdown').attr('id', 'myTabDrop-' + key).attr('href', '#').addClass('dropdown-toggle')
                                        $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').closest('li').addClass('dropdown').append(submenuitem)
                                    } else {
                                        var havedropdown = $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').closest('li').find('.dropdown-menu').attr('class');
                                        if (havedropdown) {
                                            $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').closest('li').find('.dropdown-menu').remove();
                                            $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').closest('li').removeClass('dropdown');
                                            $('[data-print="demehtml"] [role="tablist"] a[data-class="' + key + '"]').removeAttr('data-toggle', 'tab').removeAttr('id').attr('href', '#tabsprevew' + key).removeClass('dropdown-toggle')
                                        }
                                    }
                                }
                            })
                        }

                    }


                })
            })

            $('[data-tabs="demo"]').tabsX({
                enableCache: true,
                maxTitleLength: 10
            });

        },
        compile: function () {
            less.render([classb.less.replace("{{{lesscss}}}", classb.generalSetting.csssetting.savedcss)].join("\n\n")).then(
                function (output) {
                    // alert(output.css);
                    console.log(output);

                    classb.sl.cssstyle.html(output.css)

                }, function (error) {
                    //bootstrap.response("Error", error);
                    alert(error);
                });


        },
        updatecss: function () {
            classb.runcss()
            classb.sl.exportjson.val(JSON.stringify(classb.generalSetting.csssetting))
            classb.sl.cssview.attr('class', classb.generalSetting.csssetting.class)

        },
        editReload: function () {
            var getjsonvale = classb.sl.exportjson.val()
            if (getjsonvale) {
                classb.generalSetting.csssetting = JSON.parse(getjsonvale);
                var saveddata = JSON.parse(getjsonvale);
                $.each(saveddata.css, function (io, iv) {
                    iv = iv.replace('px', '');
                    $('[data-css="' + io + '"][data-selector]').not('[data-tagtype]').val(iv)
                    if ($('[data-css="' + io + '"]').is('.settingSlider')) {
                        $('[data-css="' + io + '"].settingSlider').not('[data-tagtype]').slider('value', iv);
                    }
                    if ($('[data-textcolor="' + io + '"]').is('[data-textcolor]')) {
                        $('[data-css="' + io + '"]').not('[data-tagtype]').val(iv)
                    }
                });

                $('[type="checkbox"][data-cssenable]').prop("checked", false);

                if (saveddata.htmloption) {
                    var option = ''


                    $.each(saveddata.htmloption, function (key, val) {
                        if (key != "setting") {
                            var getindex = key
                            var ide = getindex;
                            getindex = getindex.replace(/_/g, ' ')
                            var getnav = $('[data-tabs="nav"]').html()
                            var getContent = $('[data-tabs="tabcontent"]').html()
                            var templatenav = $('[data-tabsappend="nav"]').html()
                            var templContent = $('[data-tabsappend="tabcontent"]').html()

                            getnav = getnav.replace(/{index}/g, ide)
                            getnav = getnav.replace(/{title}/g, getindex)
                            getContent = getContent.replace(/{index}/g, ide)

                            templatenav = templatenav.replace(/{index}/g, ide)
                            templatenav = templatenav.replace(/{title}/g, getindex)
                            templContent = templContent.replace(/{index}/g, ide)

                            $('[data-insetadd="addnav"]').before(getnav);
                            $('[data-inset="content"]').append(getContent)

                            $('[data-print="demehtml"] [role="tablist"]').append(templatenav)
                            $('[data-print="demehtml"] [data-tabs="tab-content"]').append(templContent);

                            option += '<option value="' + ide + '">' + getindex + '</option>';


                        }

                        $.each(val, function (k, v) {
                            if (k == "class" || k == "content") {
                                $.each(v, function (t, cs) {
                                    $('[role="tabpanel"]#' + key + ' [data-htmlclass="' + k + '"][data-selector="' + t + '"]').val(cs)
                                })
                            } else if (k == "dropdownmenu") {
                                if (v) {
                                    $.each(v, function (t, cs) {
                                        if (t == "dropdownmenu") {
                                            if (cs) {

                                                $('[role="tabpanel"]#' + key + ' [data-htmlclass="dropdownmenu"][data-selector="dropdownmenu"]').val(cs)
                                                $('[role="tabpanel"]#' + key + ' [type="radio"][value="dropdownmenu"]').prop("checked", true);
                                                $('[role="tabpanel"]#' + key + ' [data-showcontainer="dropdownenable"]').collapse('show');
                                            }

                                        }

                                    })

                                }

                            } else {

                                if (saveddata.htmloption[key][k]) {
                                    $('[role="tabpanel"]#' + key + ' [type="checkbox"][data-cssenable="' + k + '"]').prop("checked", true);
                                }

                                if (v['icon']) {
                                    $('[role="tabpanel"]#' + key + ' [data-iconview="' + k + '"]').html('<i class="' + v['icon'] + '"></i>');
                                    $('[role="tabpanel"]#' + key + '  [data-html="' + k + '"][data-htmltype="icon"]').val(v['icon'])
                                }
                                if (v['class']) {
                                    $('[role="tabpanel"]#' + key + '  [data-htmlclass="' + k + '" ]').val(v['class']);
                                }
                                if (!v['icon']) {
                                    $('[role="tabpanel"]#' + key + ' [data-html="' + k + '"]').val(v);
                                }
                            }
                        })
                    })


                    $('[data-htmlclass="dropdownmenu"][data-selector="dropdownmenu"]').html(option)
                    $('[data-tabsappend="dropmenu"]').html(option)
                    $('.customselect').selectpicker('refresh');
                }


                classb.updatecss()
                enablepanelSection()
                $('.customselect').selectpicker('refresh');
            }
        },
        csspropa: {
            boxshadow: function () {

            }
        },
        addpopup: function (target) {
            var type = target.data('addpopup');
            if (!type) {
                var type = target.data('editpopup');
            }
            var html = '<iframe data-viewiframe="iframe" src="' + type + '-studio.html"></iframe>'
            bootbox.dialog({
                message: html,
                title: type + " Studio",
                className: "bigpopup"
            })

            $('[data-viewiframe="iframe"]').load();

        }
    }
    classb.generalSetting.csssetting.class = 'classname';
    classb.generalSetting.csssetting.savedcss = '';
    classb.generalSetting.csssetting.classname = '.' + classb.generalSetting.csssetting.class;
    classb.generalSetting.csssetting.css = {};

    $.get("/appdata/app/Modules/Studio/Resources/Views/public/css/generatedcss.less", function (data) {
        classb.less = data;

        classb.editReload();

    });


    $('.settingSlider').each(function () {
        var smin = $(this).data('slide-min');
        var smax = $(this).data('slide-max');
        var sval = $(this).data('slide-val');
        var step = $(this).data('slide-step');
        var effet = $(this).data('adjust');
        $(this).empty().slider({
            range: "min",
            value: sval,
            min: smin,
            max: smax,
            step: step,
            animate: true,
            slide: function (event, ui) {
                var thisval = ui.value;
                var thiscsspro = $(this).attr('data-css');
                var thiscssafte = $(this).attr('data-css-after');
                classb.generalSetting.csssetting.css[thiscsspro] = thisval + thiscssafte;
                classb.updatecss()
            }
        });
    });

    $('.color-picker').colorpicker().on('changeColor', function (e) {
        e.preventDefault();
        var color = e.color.toHex();
        var stype = $(this).data('textcolor');
        classb.generalSetting.csssetting.css[stype] = color;
        classb.updatecss()
    });
    $('body').on('change', 'select[data-selector]', function () {
        var thiscsspro = $(this).attr('data-css');
        var tagtype = $(this).data('tagtype');
        var htmlclass = $(this).data('htmlclass');
        var thisval = $(this).val()
        if (tagtype) {
            classb.generalSetting.csssetting[tagtype][thiscsspro] = thisval;
        } else if (htmlclass) {
            var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
            if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
                classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
            }
            if (!classb.generalSetting.csssetting.htmloption[activehtmlRole][htmlclass]) {
                classb.generalSetting.csssetting.htmloption[activehtmlRole][htmlclass] = {}
            }
            classb.generalSetting.csssetting.htmloption[activehtmlRole][htmlclass][thiscsspro] = thisval;
        } else {
            classb.generalSetting.csssetting.css[thiscsspro] = thisval;
        }
        classb.updatecss()
    })

    $('body').on('keyup', '[data-role="classname"]', function () {
        var getname = $(this).val();
        var classnames = getname.replace(/ /g, "-");
        classb.generalSetting.csssetting.class = classnames;
        classb.generalSetting.csssetting.classname = '.' + classnames;
        classb.updatecss()
    })
    $('body').on('click', '[data-addpopup], [data-editpopup]', function () {
        classb.addpopup($(this))
    })

    $('body').on('keyup', '[data-html]', function () {
        var getval = $(this).val()
        var htmlselector = $(this).data('html');
        var htmltype = $(this).data('htmltype');
        var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
        if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
            classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
        }
        classb.generalSetting.csssetting.htmloption[activehtmlRole][htmlselector] = getval;


        classb.updatecss()
    })


    $('body').on('change', '[data-cssenable]', function () {
        var getistrue = $(this).is(':checked')
        var getenalbe = $(this).data('getcontainer');
        var cssenable = $(this).data('cssenable');
        var ifIcon = $(this).data('htmltype');
        var cluset = $(this).closest('.row.formrow');
        var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
        var animtion = false;
        if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
            classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
        }
        if (getistrue) {
            cluset.find('[data-enable="' + getenalbe + '"]').removeClass('hide');
            var gettext = cluset.find('[data-html="' + cssenable + '"]').val();
            if (!gettext) {
                gettext = true;
            }

            if (ifIcon) {
                var getclass = cluset.find('[data-htmlclass="' + cssenable + '"]').val();
                gettext = {"icon": gettext, "class": getclass}

            }
            animtion = true;

            classb.generalSetting.csssetting.htmloption[activehtmlRole][cssenable] = gettext;

        } else {

            cluset.find('[data-enable="' + getenalbe + '"]').addClass('hide');
            classb.generalSetting.csssetting.htmloption[activehtmlRole][cssenable] = false;


        }
        classb.updatecss()


    })


    function enablepanelSection() {
        $('[data-cssenable]').each(function (index, element) {
            var getistrue = $(this).is(':checked')
            var getenalbe = $(this).data('getcontainer');
            var cluset = $(this).closest('.row.formrow');
            if (getistrue) {
                cluset.find('[data-enable="' + getenalbe + '"]').removeClass('hide');
            } else {
                cluset.find('[data-enable="' + getenalbe + '"]').addClass('hide');
            }
        });

        $('[data-panel-showpositions]').addClass('hide')
        var tedt = $('[data-htmlclass="class"][data-css="positions"]').find('option:selected').data('show')
        if (tedt == "alignment") {
            $('[data-panel-showpositions="sideways"]').find('select').val('').change()
        } else {
            $('[data-panel-showpositions="alignment"]').find('select').val('').change()
        }
        $('[data-panel-showpositions="' + tedt + '"]').removeClass('hide');


        $('[data-htmlclass="content"][data-css="contentType"]').each(function (index, element) {
            var clusetconte = $(this).closest('.row.formrow');
            clusetconte.find('[data-panel-show]').addClass('hide')
            var contetshow = $(this).val()
            clusetconte.find('[data-panel-show="' + contetshow + '"]').removeClass('hide')
        });


        tinyMCE.init({
            selector: '[data-html="middletext"]',
            menubar: "false",
            allow_conditional_comments: false,
            setup: function (ed) {
                ed.on('keyup', function (e) {
                    tinyMCE.triggerSave();
                    var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
                    var getdata = $('[data-inset="content"]').find("#" + activehtmlRole).find('[data-html="middletext"]').val()
                    if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
                        classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
                    }
                    classb.generalSetting.csssetting.htmloption[activehtmlRole]['middletext'] = getdata;
                    classb.updatecss()
                });
            }
        });

        $('.file').fileinput();


    }

    $('body').on('change', '[data-htmlclass="class"][data-css="positions"]', function () {
        $('[data-panel-showpositions]').addClass('hide')
        var tedt = $('[data-htmlclass="class"][data-css="positions"]').find('option:selected').data('show')
        if (tedt == "alignment") {
            $('[data-panel-showpositions="sideways"]').find('select').val('').change()
        } else {
            $('[data-panel-showpositions="alignment"]').find('select').val('').change()
        }
        $('[data-panel-showpositions="' + tedt + '"]').removeClass('hide')
    })

    $('body').on('change', '[data-htmlclass="content"][data-css="contentType"]', function (e) {
        var cluset = $(this).closest('.row.formrow');
        cluset.find('[data-panel-show]').addClass('hide')
        var tedt = $(this).val()
        cluset.find('[data-panel-show="' + tedt + '"]').removeClass('hide')
    })

    $('body').on('click', '[data-icon="iconbutton"]', function (e) {
        e.preventDefault();
        $('[data-enable]').removeClass('selected');
        $(this).parent('[data-enable]').addClass('selected');
        $('#icons').click()
    })


    $('#icons').icon({
        iconval: '.selected .geticonseting', iconView: '.selected .iconView',
        callback: function () {
            var selectoricon = $('.selected .geticonseting');
            var iconvalue = selectoricon.val();
            var cssenable = selectoricon.data('html');
            var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
            if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
                classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
            }
            classb.generalSetting.csssetting.htmloption[activehtmlRole][cssenable]['icon'] = iconvalue;
            classb.updatecss()
        }
    });

    $('body').on('click', '[data-csstype]', function (e) {
        var csstype = $(this).data('csstype')
        var getcontainer = $(this).data('getcontainer')
        var getvalue = $(this).val()
        var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
        if (getvalue == "none") {
            if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
                classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
            }
            classb.generalSetting.csssetting.htmloption[activehtmlRole][csstype] = false;
        } else {
            $(this).closest('.formrow').find('[data-showcontainer="' + getcontainer + '"]').find('[data-htmlclass="' + csstype + '" ]').change()
        }


        $(this).closest('.formrow').find('[data-showcontainer]:visible').not('[data-showcontainer="' + getcontainer + '"]').collapse('hide');
        $(this).closest('.formrow').find('[data-showcontainer="' + getcontainer + '"]').collapse('show');

        setTimeout(function () {
            classb.updatecss()
        }, 300);
    })


    $('[data-tabsactions="add"]').click(function () {
        console.log(classb)
        classb.generalSetting.csssetting.tabindex = classb.generalSetting.csssetting.tabindex + 1;
        var getindex = classb.generalSetting.csssetting.tabindex;
        var ide = 'tabs_' + getindex;
        getindex = 'Tabs ' + getindex
        classb.generalSetting.csssetting.htmloption[ide] = {}

        var option = '<option value="' + ide + '">' + getindex + '</option>';
        $('[data-htmlclass="dropdownmenu"][data-selector="dropdownmenu"]').append(option)
        $('[data-tabsappend="dropmenu"]').append(option)

        var getnav = $('[data-tabs="nav"]').html()
        var getContent = $('[data-tabs="tabcontent"]').html()
        var getdropdownmenu = $('[data-tabsappend="dropmenu"]').html()
        var templatenav = $('[data-tabsappend="nav"]').html()
        var templContent = $('[data-tabsappend="tabcontent"]').html()


        getnav = getnav.replace(/{index}/g, ide)
        getnav = getnav.replace(/{title}/g, getindex)
        getContent = getContent.replace(/{index}/g, ide)
        getContent = getContent.replace(/{dropdownmenu}/g, getdropdownmenu)

        templatenav = templatenav.replace(/{index}/g, ide)
        templatenav = templatenav.replace(/{title}/g, getindex)
        templContent = templContent.replace(/{index}/g, ide)

        $(this).closest('li').before(getnav);


        $('[data-inset="content"]').append(getContent)
        $('[data-print="demehtml"] [role="tablist"]').append(templatenav)
        $('[data-print="demehtml"] [data-tabs="tab-content"]').append(templContent);


        $('.customselect').selectpicker('refresh');
        $('.file').fileinput();

        tinymicId = "#middletext" + ide;

        tinyMCE.init({
            selector: tinymicId,
            menubar: "false",
            allow_conditional_comments: false,
            setup: function (ed) {
                ed.on('keyup', function (e) {
                    tinyMCE.triggerSave();
                    var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
                    var getdata = $('[data-inset="content"]').find("#" + activehtmlRole).find('[data-html="middletext"]').val()
                    if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
                        classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
                    }
                    classb.generalSetting.csssetting.htmloption[activehtmlRole]['middletext'] = getdata;
                    classb.updatecss()
                });
            }
        });

        classb.updatecss()


    })

    $('body').on('click', '[data-tabsactions="delele"]', function () {
        var deleteid = $(this).data('key');

        $('[data-inset="nav"]').find('[href="#' + deleteid + '"]').closest('li').remove();
        $('[data-inset="content"] #' + deleteid).remove();
        $('[data-htmlclass="dropdownmenu"][data-selector="dropdownmenu"] option[value="' + deleteid + '"]').remove();
        $('[data-print="demehtml"] [role="tablist"]').find('a[data-class="' + deleteid + '"]').closest('li').remove();
        $('[data-print="demehtml"] [data-tabs="tab-content"]').find('[data-removetab="' + deleteid + '"]').remove();

        if (classb.generalSetting.csssetting.htmloption[deleteid]) {
            delete  classb.generalSetting.csssetting.htmloption[deleteid];
        }
        $('.customselect').selectpicker('refresh');
        classb.updatecss()

    })

    $('body').on('click', '[data-inset="nav"] a[data-rolehtml]', function () {
        var gettarget = $(this).data('rolehtml');
        if (gettarget) {
            $('[data-print="demehtml"] [role="tablist"] a[data-class="' + gettarget + '"]').click();
        }
    })


    $('body').on('change', '.file', function (event) {
        var thisdata = $(this)
        var reader = new FileReader();
        reader.onload = onReaderLoad;
        reader.readAsText(event.target.files[0]);
    });


    function onReaderLoad(event) {
        var filedata = event.target.result
        var activehtmlRole = $('.active > [data-rolehtml]').data('rolehtml');
        if (!classb.generalSetting.csssetting.htmloption[activehtmlRole]) {
            classb.generalSetting.csssetting.htmloption[activehtmlRole] = {}
        }
        classb.generalSetting.csssetting.htmloption[activehtmlRole]['othercontent'] = filedata;
        classb.updatecss()


    }


})

function uniqueID() {
    return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
}

$(document).ready(function () {

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $("body")
    // Insert new tab
        .on("click", '.add-form-tab', function (e) {
            e.preventDefault();

            var formTabs = $('.form-builder-tabs'),
                hdFormTabs = $('.builder-tabs'),
                tabNav = $('#template-tab-nav').html(),
                hdTab = $('#template-tab-nav').html(),

                tabContent = $('#template-tab-content').html(),
                hdTabContent = $('#template-tab-content').html(),
                ID = uniqueID();

            // Tab id
            tabNav = tabNav.replace('{id}', ID);
            hdTab = hdTab.replace('{id}', ID + 'form');
            tabContent = tabContent.replace('{id}', ID);
            tabContent = tabContent.replace('{DROPABLE}', 'form-builder-area');
            hdTabContent = hdTabContent.replace('{id}', ID + 'form');
            hdTabContent = hdTabContent.replace('{DROPABLE}','form-fields-area');

            // Add nav list
            formTabs.find(".form-builder-tabs").append(tabNav);
            formTabs.find(".form-builder-tabs-content").append(tabContent);

            hdFormTabs.find(".builder-tabs").append(hdTab);
            hdFormTabs.find(".builder-tabs-content").append(hdTabContent);

            $('[href="#' + ID + '"]').trigger("click");
            $('[href="#' + ID + 'form"]').trigger("click");

            // Activate droppable
            activateDroppable();
        })
        // Edit tab nav
        .on('dblclick', '.form-builder-tabs>.nav-tabs>.active>a', function (e) {
            var $this = $(this);
            $this.attr("contenteditable", true);
        })
        .on('blur', '.form-builder-tabs>.nav-tabs>.active>a', function (e) {
            var $this = $(this);
            $this.removeAttr("contenteditable");
        })
        // Delete tab
        .on('click', '.remove-tab', function (e) {
            e.preventDefault();

            var activeTabNav = $('.form-builder-tabs>.nav-tabs>.active'),
                activeTabContent = $('.form-builder-tabs>.tab-content>.active');

            if ($('.form-builder-tabs>.nav-tabs>li').length === 1) return false;

            activeTabNav.remove();
            activeTabContent.remove();

            $('.form-builder-tabs>.nav-tabs>li:first-child>a').trigger("click");
        });


    // Draggable fields
    $('.draggable-element').draggable({
        helper: "clone"
    });

    // Droppable fields area
    function activateDroppable() {
        $('body').find('.form-builder-area').droppable({
            accept: ".draggable-element",
            classes: {
                "ui-droppable-active": "form-area-active",
                "ui-droppable-hover": "form-area-hover"
            },
            drop: function (event, ui) {
                // Insert template
                var elementHTML = $(ui.draggable).find(".html-element-item-sample").html(),
                    template = $(elementHTML),
                    target = $(event.target);
                template.attr('data-shortcode',$(ui.draggable).attr('data-shortcode'));
                target.append(template);
               rebulder();
            }
        }).sortable({
            update: function( event, ui ) {
                rebulder();
            }
        });
    }

    function rebulder() {
        var activeId=$('.form-builder-tabs-content').find('.active');
        var elements=activeId.find('div[data-shortcode]');
        var id=activeId.attr('id')+'form';
        $('#'+id).find('.form-fields-area').empty();
        $.each(elements,function (k,v) {
            var tpl=$('#field-html').html();
            var shortcode=$(v).attr('data-shortcode');
            tpl=tpl.replace('{field}',shortcode);
            $('#'+id).find('.form-fields-area').append(tpl);

        });
    }
    activateDroppable();
});
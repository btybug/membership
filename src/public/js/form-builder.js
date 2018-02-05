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
                tabNav = $('#template-tab-nav').html(),
                tabContent = $('#template-tab-content').html(),
                ID = uniqueID();

            // Tab id
            tabNav = tabNav.replace('{id}', ID);
            tabContent = tabContent.replace('{id}', ID);

            // Add nav list
            formTabs.find(".nav-tabs").append(tabNav);
            formTabs.find(".tab-content").append(tabContent);

            $('[href="#' + ID + '"]').trigger("click");

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
        $('.form-builder-area').droppable({
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


                target.append(template);
            }
        }).sortable();
    }

    activateDroppable();
});
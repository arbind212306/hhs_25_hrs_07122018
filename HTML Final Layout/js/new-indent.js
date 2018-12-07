
    $(".indent_modal_btn").on("click",function () {
        $("#indent_modal").modal("show");
    });

    $(".indent_table_modal_btn").on("click",function () {
        $("#indent_table_modal").modal("show");
    });

    $(".indent-card-new").on("click",function () {
        if($(this).attr("data-type") === "1") {
            $("#approve_indent_new").removeClass("hidden");
        } else {
            $("#approve_indent_new").addClass("hidden");
        }

        $("#indent_details_modal_new").modal("show");
    });

    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true,
        maxHeight: 400,
        enableFiltering : true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%',
        dropRight: true,
        templates: {
            filter: '<li class="multiselect-item filter"><div class="padding-sm"><input class="form-control multiselect-search" type="text"></div></li>',
            filterClearBtn: ''
        }
    });

    function approveIndentNew() {
        $("#indent_details_modal_new").modal("hide");
        $("#indent_approve_modal").modal("show");
    }

    $(".indent-card-search").on("keyup", function (e) {
        var searchText = new RegExp($(this).val(), "i");

        $(this).closest(".panel-body").find(".indent-card").each(function () {
            if(!($(this).text().search(searchText) >= 0)) {
                $(this).hide();
            }

            if(($(this).text().search(searchText) >= 0)) {
                $(this).show();
            }
        });
    });

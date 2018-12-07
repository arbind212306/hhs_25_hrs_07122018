   $(".indent_modal_btn").on("click",function () {
        $("#indent_modal").modal("show");
    });

    $(".indent_table_modal_btn_progress").on("click",function () {
        $("#indent_table_modal_progress").modal("show");
    });

    $(".indent-card-source").on("click",function () {
        if($(this).attr("data-type") === "7") {
            $("#approve_indent_btn_source").removeClass("hidden");
        } else {
            $("#approve_indent_btn_source").addClass("hidden");
        }

        $("#indent_details_modal_source").modal("show");
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

    function approveIndentSource() {
        $("#indent_details_modal_source").modal("hide");
        $("#indent_approve_modal_source").modal("show");
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
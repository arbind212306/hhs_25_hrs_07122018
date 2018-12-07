   $(".indent_modal_btn").on("click",function () {
        $("#indent_modal").modal("show");
    });

    $(".indent_table_modal_btn").on("click",function () {
        $("#indent_table_modal").modal("show");
    });

    $(".indent-card-calibration").on("click",function () {
        if($(this).attr("data-type") === "0") {
            $("#approve_indent_btn_calibration").removeClass("hidden");
        } else {
            $("#approve_indent_btn_calibration").addClass("hidden");
        }

        $("#indent_details_modal_calibration").modal("show");
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

    function approveIndent() {
        $("#indent_details_modal_calibration").modal("hide");
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
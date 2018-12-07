$(document).ready(function () {
    $('#example1').DataTable({
        "columnDefs":
                [{
                        "targets": 0,
                        "orderable": false
                    }]

    });
    $('#select-all').click(function () {
        if ($(this).prop('checked')) {
            $('.dataTable .emp-chk').prop('checked', true);
        } else {
            $('.dataTable .emp-chk').prop('checked', false);
        }
    });
    $('#genrate_eid').click(function () {
        var selIds = [];
        $('input[class=emp-chk]:checked').each(function (i, u) {
            selIds.push($(u).val());
        });
        if (selIds.length < 1) {
            alert('Please select users !');
            return false;
        }
//        var r = confirm("Generate employee ID ..?");
//        if (r != true) {
//            return false;
//        }
        $.ajax({
            url: webroot + 'recruitment/convert',
            data: {sel: selIds},
            method: 'POST',
            headers: {'X-CSRF-Token': csrfToken}
        }).done(function () {
            window.location.reload();
        });
    });

    $('#import_file_init').click(function () {
        $('#import_file').removeClass('toggle');
        $('#import_file').trigger('click');
    });
    $('#import_file').change(function () {
        $('#employee_sheet_form').submit();
    });

});
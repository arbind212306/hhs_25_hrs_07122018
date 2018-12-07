$(document).ready(function () {
    $('#example1').DataTable({
        "columnDefs": [{
                "targets": 0,
                "orderable": false
            }],
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pdf',
            'print'
        ]
    });
    $('#select-all').click(function () {
        if ($(this).prop('checked')) {
            $('.dataTable .emp-chk').prop('checked', true);
        } else {
            $('.dataTable .emp-chk').prop('checked', false);
        }
    });
});
$(document).ready(function () {
    $("#ckbCheckAll,#ckbCheckAll1").click(function () {
        $(".checkBoxClass,.checkBoxClass1").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass,.checkBoxClass1").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll,#ckbCheckAll1").prop("checked",false);
        }
    });
});
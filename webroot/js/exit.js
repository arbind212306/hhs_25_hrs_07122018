$(document).ready(function () {
    /* code for sending user to home when user click on NO button in warning section for exit module starts here*/
    $('#warning-btn-no').click(function () {
        window.location = webroot; //webroot is global varible declared in heder section for ajax request
    });
    /*NO button in warning section function ends here */

    /* code for alerting when user click on Yes button in warning section for exit module starts here*/
    $('#warning-btn-yes').click(function () {
        $('#warning-resignation').hide();
        $('#warning-alert-resignation').show();
    });
    /*Yes button in warning section function ends here */

    /* code for displaying discussion form for employee starts here */
    $('#deny-resignation').click(function () {
        window.location = webroot + 'exit/add-discussion';
    });
    /* code for dispalying discussion form for employee ends here */

    /* code for displaying resignation form for employee starts here */
    $('#confirm-resignation').click(function () {
        window.location = webroot + 'exit/apply-resignation';
    });
    /* code for dispalying resignation form for employee ends here */

    /* code for getting discuss text from employee and inserting it to database */
    $('#submit-discuss-text').click(function () {
        var discuss_txt = $('#get-discuss-txt').val();
        var employee_id = $('#hidden_employee_id').val();
        $.ajax({
            url: webroot + 'exit/exit-discussion',
            type: 'POST',
            data: 'discuss_txt=' + discuss_txt + '&employee_id=' + employee_id,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#add-discussion').hide();
                $('#show-msg-txt').text(data);
                $('#display-msg').show();
            },
            error: function (error) {
                alert(error);
            }
        });
    });
    /* code for getting discuss text from employee and inserting it to database ends here */
    
    /*code for inserting appraiser text discussed with employee*/
    $('#btn-approve-supervisor').click(function(){
        var hidden_id = $('#hidden_id').val();
        var hidden_emp_id = $('#hidden_employee_id').val();
        var appraiser_text = $('#get-discuss-appraiser-txt').val();
        $.ajax({
            url: webroot + 'exit/appraiser-disscussed-text',
            type: 'POST',
            data: 'hidden_id=' + hidden_id + '&hidden_emp_id=' + hidden_emp_id + '&appraiser_text='+appraiser_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#appraiser-discussion').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                alert(error);
            }
        });
    });
    /*code ends here for inserting appraiser discussed text*/
    
     /*code starts here for inserting reviewer comments for discussion between employee and supervisor*/
    $('#btn-approve-reviewer').click(function(){
        var hidden_id = $('#hidden_id').val();
        var hidden_emp_id = $('#hidden_employee_id').val();
        var reviewer_text = $('#reviewer-txt').val();
        $.ajax({
            url: webroot + 'exit/reviwer-discussed-text',
            type: 'POST',
            data: 'hidden_id=' + hidden_id + '&hidden_emp_id=' + hidden_emp_id + '&reviewer_text='+reviewer_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#appraiser-discussion').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                alert(error);
            }
        });
    });
    /*code ends here for handling reviewer comments againts discussion between employee and supervisor*/
    
    /*code starts here for inserting HR manager discussed/comments text*/
    $('#btn-approve-hr').click(function(){
        var hidden_id = $('#hidden_id').val();
        var hidden_emp_id = $('#hidden_employee_id').val();
        var hr_text = $('#hr-txt').val();
        $.ajax({
            url: webroot + 'exit/hr-disscussed-text',
            type: 'POST',
            data: 'hidden_id=' + hidden_id + '&hidden_emp_id=' + hidden_emp_id + '&hr_text='+hr_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#appraiser-discussion').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                alert(error);
            }
        });
    });
    /*code ends here HR discussed text*/

    /*code for getting resignation deatils from employee and inserting it to the database  starts here */
    $('#submit-resignation').click(function () {
        var emp_id = $('#hidden_employee_id').val();
        var resign_text = $('#get-discuss-txt').val();
        var exit_reson = $('#exit-reason').val();
        var serve_notice_period = $("input[name='serve_notice_period']:checked").val();
        var exit_datepicker = $('#exit-datepicker').val();
        var shortfall_day = $('#shortfall_day').val();
        var reason_for_lastworking_day = $('#reason_last_working_day').val();
        var last_working_day = $('#last_working_day').val();
        $.ajax({
            url: webroot + 'exit/exit-resignation',
            method: 'POST',
            data: 'emp_id=' + emp_id + '&resign_text=' + resign_text + '&exit_reson=' + exit_reson + '&serve_notice_period=' +
                    serve_notice_period + '&exit_datepicker=' + exit_datepicker + '&shortfall_day=' + shortfall_day +
                    '&reason_for_lastworking_day=' + reason_for_lastworking_day +'&last_working_day='+last_working_day,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#add-resignation').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                console.log(error);
            }
        });

    });
    /*code for handaling resignation details ends here */

    /*code starts here for inserting approved resignation by supervisor */
    $('#btn-approveResignSupervisior').click(function () {
        var hidden_employee_id = $('#hidden_employee_id').val();
        var id = $('#hidden_id').val();
        var retain_option = $("input[name='retain_option']:checked").val();
        var exit_reason = $('#exit-reason-supervisor').val();
        var hold_salry = $("input[name='hold_salary']:checked").val();
        var serve_notice_period = $("input[name='serve_notice']:checked").val();
        var last_working_day_appraiser = $('#last_working').val();
        var waiver_notice_pay = $("input[name='waiver_notice_pay']:checked").val();
        var appraiser_text = $('#get-appraiser-txt').val();
        $.ajax({
            url: webroot + 'exit/appraiser-approved-resignation',
            type: 'POST',
            data: 'id=' + id + '&emp_id=' + hidden_employee_id + '&retain_option=' + retain_option +
                    '&hold_salary=' + hold_salry + '&serve_notice_period=' + serve_notice_period +
                    '&last_working_day=' + last_working_day_appraiser + '&waiver_notice_pay=' + waiver_notice_pay +
                    '&retention_comments=' + appraiser_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#resignation-section').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    /*code ends here for handling supervisor approved text*/
    
    /*code starts here for inserting approved/retain resignation request by Reviewer*/
    $('#btn-reviewer').click(function(){
        var hidden_employee_id = $('#hidden_employee_id').val();
        var id = $('#hidden_id').val();
        var retain_option = $("input[name='retain_option_reviewer']:checked").val();
//        var exit_reason = $('#exit-reason-by-hr').val();
        var hold_salry = $("input[name='hold_salary_by_reviewer']:checked").val();
        var serve_notice_period = $("input[name='serve_notice_by_reviewer']:checked").val();
        var last_working_day_hr = $('#last_working_by_reviewer').val();
        var waiver_notice_pay = $("input[name='waiver_notice_pay_by_reviewer']:checked").val();
        var reviewer_text = $('#get-reviewer-comment').val();
        $.ajax({
            url: webroot + 'exit/reviewer-approved-resignation',
            type: 'POST',
            data: 'id=' + id + '&emp_id=' + hidden_employee_id + '&retain_option=' + retain_option +
                    '&hold_salary=' + hold_salry + '&serve_notice_period=' + serve_notice_period +
                    '&last_working_day=' + last_working_day_hr + '&waiver_notice_pay=' + waiver_notice_pay +
                    '&reviewer_comments=' + reviewer_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#resignation-section').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    /*code ends here for handling approved/retain resignation request by reviewer*/
    
    /*code starts here for inserting approved resignation request of employee by HR Manager*/
    $('#btn-Hr-Manager').click(function(){
        var hidden_employee_id = $('#hidden_employee_id').val();
        var id = $('#hidden_id').val();
        var retain_option = $("input[name='retain_option_hr']:checked").val();
//        var exit_reason = $('#exit-reason-by-hr').val();
        var hold_salry = $("input[name='hold_salary_by_hr']:checked").val();
        var serve_notice_period = $("input[name='serve_notice_by_hr']:checked").val();
        var last_working_day_hr = $('#last_working_by_hr').val();
        var waiver_notice_pay = $("input[name='waiver_notice_pay_by_hr']:checked").val();
        var hrmanager_text = $('#get-hr-comment').val();
        $.ajax({
            url: webroot + 'exit/hr-approved-resignation',
            type: 'POST',
            data: 'id=' + id + '&emp_id=' + hidden_employee_id + '&retain_option=' + retain_option +
                    '&hold_salary=' + hold_salry + '&serve_notice_period=' + serve_notice_period +
                    '&last_working_day=' + last_working_day_hr + '&waiver_notice_pay=' + waiver_notice_pay +
                    '&retention_comments=' + hrmanager_text,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#resignation-section').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                console.log(error);
            }
        });
        
    });
    /*code ends here for inserting approval request for resignation by HR Manager*/

    /* code starts here for initiating resignation request by supervisor 
     * and inserting details to database
     */
    $('#btn-resignation').click(function () {
        var hidden_id = $('#hidden_id').val();
        var hidden_empid = $('#hidden_employee_id').val();
        var resignation_date = $('#exit-datepicker').val();
        var hold_salary = $("input[name='hold_salary']:checked").val();
        var separation_date = $('#last-working-day').val();
        var exit_reason = $('#exit-reason').val();
        var serve_notice_period = $("input[name='serve_notice_period']:checked").val();
        var waiver_notice_pay = $("input[name='waiver_notice_pay']:checked").val();
        var get_comments = $('#get-comments').val();

        $.ajax({
            url: webroot + 'exit/initiate-resignation-by-supervisior',
            type: 'POST',
            data: 'id=' + hidden_id + '&emp_id=' + hidden_empid + '&resignation_date=' + resignation_date +
                    '&hold_salary=' + hold_salary + '&separation_date=' + separation_date +
                    '&exit_reason=' + exit_reason + '&serve_notice_period=' + serve_notice_period +
                    '&waiver_notice_pay=' + waiver_notice_pay + '&get_comments=' + get_comments,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('#show-msg-txt').text(data);
                $('#initiate-section').hide();
                $('#display-msg').show();
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    /*code ends here for handling initiate resignation request*/

    /*code starts here for inserting absconding/termination process data to database */
    $('#btn-absconding').click(function(){
        var process = $("input[name='process']:checked").val();
        var terminate_reason = $('#absconding-reason').val();
        var separation_date = $('#last-working-day').val();
        var remark = $('#remark').val();
        var hidden_empid = $('#hidden_empid').val();
        $.ajax({
            url: webroot + 'exit/raise-absconding-termination-request',
            type: 'POST',
            data: 'process='+process+ '&terminate_reason='+terminate_reason+ '&separation_date='+separation_date+
                    '&remark='+remark+ '&hidden_empid='+hidden_empid,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data){
                $('#show-msg-txt').text(data);
                $('#initiate-absconding').hide();
                $('#display-msg').show();
            },
            error: function(error){
                $('#show-msg-txt').text('Duplicate entries are not allowed');
//                $('.alert alert-success').remove.addClass('..alert alert-warning');
                $('#show-msg-txt').removeClass(".alert alert-success").addClass(".alert alert-warning");
                $('#initiate-absconding').hide();
                $('#display-msg').show();
                console.log(error);
            }
        });
    });
    /*code ends here for handling absconding/termination process*/
    
    /*code starts here for handling absconding/termination process by reviewer*/
    $('#btn-absconding-reviewer').click(function(){
        var hidden_emp_id = $('#hidden_empid').val();
        var hidden_id = $('#hidden_id').val();
        var exit_reason_reviewer = $('#absconding-reason-reviewer').val();
        var reviewer_comment_abscond = $('#reviewer-comment-abscond').val();
        $.ajax({
            url: webroot + 'exit/approve-absconding-termination-reviewer',
            type: 'POST',
            data: 'hidden_emp_id='+hidden_emp_id+ '&hidden_id=' + hidden_id + 
                    '&exit_reason_reviewer=' + exit_reason_reviewer +
                    '&reviewer_comment_abscond=' + reviewer_comment_abscond,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data){
                $('#show-msg-txt').text(data);
                $('#initiate-absconding').hide();
                $('#display-msg').show();
            },
            error: function(error){
                $('#show-msg-txt').text('Duplicate entries are not allowed');
//                $('.alert alert-success').remove.addClass('..alert alert-warning');
                $('#show-msg-txt').removeClass(".alert alert-success").addClass(".alert alert-warning");
                $('#initiate-absconding').hide();
                $('#display-msg').show();
                console.log(error);
            }
        });
    });
    /*code ends here for handling absconding/termination process by reviewer*/
    
    /*code starts here for handling absconding/termination process by HR Manger*/
    $('#btn-absconding-hr').click(function(){
        var hidden_emp_id = $('#hidden_empid').val();
        var hidden_id = $('#hidden_id').val();
        var exit_reason_hr = $('#absconding-reason-hr').val();
        var hr_comment_abscond = $('#hr-comment-abscond').val();
        $.ajax({
            url: webroot + 'exit/approve-absconding-termination-HR',
            type: 'POST',
            data: 'hidden_emp_id='+hidden_emp_id+ '&hidden_id=' + hidden_id + 
                    '&exit_reason_hr=' + exit_reason_hr +
                    '&hr_comment_abscond=' + hr_comment_abscond,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data){
                $('#show-msg-txt').text(data);
                $('#initiate-absconding').hide();
                $('#display-msg').show();
            },
            error: function(error){
                $('#show-msg-txt').text('Duplicate entries are not allowed');
//                $('.alert alert-success').remove.addClass('..alert alert-warning');
                $('#show-msg-txt').removeClass(".alert alert-success").addClass(".alert alert-warning");
                $('#initiate-absconding').hide();
                $('#display-msg').show();
                console.log(error);
            }
        });
    });
    /*code ends here for handling absconding/termination process by HR Manager*/
    
    /*code starts here for canceling the terminated/absconded request*/
    $('#cancel_Request').click(function(){
        var arr = [];
        $.each($("input[name='cancelAbsconding']:checked"), function(){
            arr.push($(this).val());
        });
//        console.log(arr);
        $.ajax({
            url: webroot + 'exit/cancel-raised-absconding-termination-request',
            type: 'POST',
            data: 'cancelData='+arr,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('x-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data){
//                $('#show-msg-txt').text(data);
//                $('#initiate-absconding').hide();
//                $('#display-msg').show();
                    alert(data);
            },
            error: function(error){
//                $('#show-msg-txt').text('Duplicate entries are not allowed');
////                $('.alert alert-success').remove.addClass('..alert alert-warning');
//                $('#show-msg-txt').removeClass(".alert alert-success").addClass(".alert alert-warning");
//                $('#initiate-absconding').hide();
//                $('#display-msg').show();
                console.log(error);
            }
        });
    });
    
});

$(document).ready(function () {
    $(".net_profit_cal").change(function () {
        var net_worth = $("#net_worth").val();
        var turn_over = $("#turn_over").val();
        var net_profit = $("#net-profit-value").data('net');
       
        $("#cur_net_profit").val(net_profit);
        if (parseInt(net_worth) >= 5000000000 || parseInt(turn_over) >= 10000000000 || parseInt(net_profit) >= 50000000) {
            $("#applicability_status").text("Applicable");
        } else {
            $("#applicability_status").text("Not Applicable");
        }
        var applicable_csr = [];
        if (parseInt(net_worth) >= 5000000000) {
            applicable_csr.push("Net worth");
        }
        if (parseInt(turn_over) >= 10000000000) {
            applicable_csr.push("Turnover");
        }
        if (parseInt(net_profit) >= 50000000) {
            applicable_csr.push("Net Profit");
        }
        if(applicable_csr.length > 0)
            $("[name='is_CSR_policy_created']").prop('checked', false);
        $("#applicable_csr").val(applicable_csr.join(', '));
    });
    $(document).on('change','#net_worth',function(){
        $(document).find('[name="e_net_worth"]').val($(this).val());
    });
    $(document).on('change','#turn_over',function(){
        $(document).find('[name="e_turnover"]').val($(this).val());
    });
    $(".calculate_csr").click(function () {
        var active_cal = $(this).attr('data-id');
        $('.calculator-year').text($(this).data('year'));
        $('[name="fy_year"]').val($(this).data('year'));
        $('#active-calculate').val(active_cal);
        $(".csrcalculator").show();
        $("#Basic_Details").removeClass('active');
        calculatorValue($(this).data('key'));
    });
    $(".main-tab-control .nav-item").click(function () {
        $(".csrcalculator").hide();
        $("#Basic_Details").addClass('active');
    });
    $(".calculate_csr_back").click(function () {
        $(".csrcalculator").hide();
        $("#Basic_Details").addClass('active');
        clearCsrCalculator()
    });
    $(".annual-action-plan-edit-event").click(function () {
        $(this).hide();
        $(".annual-action-plan-view").hide();
        $(".annual-action-plan-edit").show();
        $(".annual-action-plan-btn").show();
    });
    $(".calculation-edit-event").click(function () {
        $('#calculator-form').find('input[type=number],input[type=text]').prop('disabled', false);
        $('#calculator-form').find('.saveBtn').css('display', 'block');
    });
});
$(document).ready(function () {
    $('input').on('keypress', function (e) {
        var inputValue = $(this).val();
        if (e.which === 45 || e.which === 189) {
            // Prevent entering minus sign (45 is keyCode for "-" in standard keyboards, 189 is keyCode for "-" in some extended keyboards)
            e.preventDefault();
        } else if (inputValue < 0) {
            // Prevent entering negative numbers
            e.preventDefault();
        }
    });

    $(".preceding_cal").on('change', function () {
        var fy_one_profit_before_tax = $("#fy_one_profit_before_tax").val();
        var fy_one_net_profit = $("#fy_one_net_profit").val();
        var fy_one_amt_adjusted = $("#fy_one_amt_adjusted").val();

        var fone_total = Number(fy_one_profit_before_tax) + Number(fy_one_net_profit) + Number(fy_one_amt_adjusted);
        console.log('fone_total: ', typeof fone_total);

        $(".fone_total_net_profit").val(fone_total);

        var fy_two_profit_before_tax = $("#fy_two_profit_before_tax").val();
        var fy_two_net_profit = $("#fy_two_net_profit").val();
        var fy_two_amt_adjusted = $("#fy_two_amt_adjusted").val();

        var ftwo_total = Number(fy_two_profit_before_tax) + Number(fy_two_net_profit) + Number(fy_two_amt_adjusted);
        $(".ftwo_total_net_profit").val(ftwo_total);

        var fy_three_profit_before_tax = $("#fy_three_profit_before_tax").val();
        var fy_three_net_profit = $("#fy_three_net_profit").val();
        var fy_three_amt_adjusted = $("#fy_three_amt_adjusted").val();

        var fthree_total = Number(fy_three_profit_before_tax) + Number(fy_three_net_profit) + Number(fy_three_amt_adjusted);
        $(".fthree_total_net_profit").val(fthree_total);

        var average = (fone_total + ftwo_total + fthree_total) / 2;
        $("#average_net_profit").val(average);

    });
    
    $(".available_amount_cal").on('change', function () {
        calculateSetOf();
    });

    function calculateSetOf(){
        var fyone_avaial_amount = $(".fyone_avaial_amount").val();
        var fyone_setoff_amount = $(".fyone_setoff_amount").val();
        var fy_one_balance = Number(fyone_avaial_amount) - Number(fyone_setoff_amount);
        $('.fyone_balance_amount').val(fy_one_balance);

        var fytwo_avaial_amount = $(".fytwo_avaial_amount").val();
        var fytwo_setoff_amount = $(".fytwo_setoff_amount").val();
        var fy_two_balance = Number(fytwo_avaial_amount) - Number(fytwo_setoff_amount);
        $('.fytwo_balance_amount').val(fy_two_balance);

        var fythree_avaial_amount = $(".fythree_avaial_amount").val();
        var fythree_setoff_amount = $(".fythree_setoff_amount").val();
        var fythree_balance_amount = Number(fythree_avaial_amount) - Number(fythree_setoff_amount);
        $('.fythree_balance_amount').val(fythree_balance_amount);

        var avg_net_profit = $(".avg_net_profit").val();

        var total_available = Number(fyone_avaial_amount)+Number(fytwo_avaial_amount)+Number(fythree_avaial_amount);
        var total_set = Number(fyone_setoff_amount)+Number(fytwo_setoff_amount)+Number(fythree_setoff_amount);
        var total_balance = Number(fy_one_balance)+Number(fy_two_balance)+Number(fythree_balance_amount);

        $("#text-amount-available").text(total_available);
        $("#text-amount-set-off").text(total_set);
        $("#text-amount-balance").text(total_balance);

        $("#text-amount-to-be-set-off").val(total_balance);
        if(total_balance > 0)
            $('.event-hide-box').show();
        else
            $('.event-hide-box').hide();

        if(total_balance > 0 && $('#upload-board-resolution').data('uploaded') != 1)
            $('#upload-board-resolution').prop('required',true);
        else
            $('#upload-board-resolution').prop('required',false);

        var surplus = $("#text-surplus-amount").val();
        let total = Number(avg_net_profit)+Number(surplus)-Number(total_balance);
        $("#text-csr-obligation").val(Math.round(total));
    }
    
    /*function domainValidator(ele){
        var regex =  /^((http|https):\/\/)?(www\.)?([a-zA-Z]{1,})+([a-zA-Z]{1,})+(.(com|in))$/;
        var value = $(ele).find('.domain-url').val();
        
        $(ele).find('.domain-url').parent().find('.error-span').remove();
        if(value == '' || regex.test(value) == true){ 
            return true;
        }else{
            $(ele).find('.domain-url').parent().append('<span class="error-span">Please Enter A Valid Url. Only .com |.in top-level domain supported.</span>');
            $(ele).find('.domain-url').focus();
            return false;
        }
    }*/
    $("[name='basicDetailsForm']").on('submit change', function () {
        if(domainValidator(this)== true)
            return true;
        else
            return false;
    });
    $(".csr-calculator").on('input', function () {
        calculateCsrProfit();
    });
    $(".save-calculate-csr").click(function () {
        var total_net_profit = $(".calculated_net_profit").text()
        var net_profit = $('#active-calculate').val()
        // console.log('net_profit: ', net_profit);
        $(net_profit).val(total_net_profit)
        $(".csrcalculator").hide();
        $("#Basic_Details").addClass('active');
        if (net_profit == '#net_profit') {
            $("#cur_net_profit").val(total_net_profit);
            $("#net_profit").attr('disabled',true);
        }
        clearCsrCalculator();
    });
    $(".check_is_committee_constituted").click(function () {
        var check = $('input[name="is_committee_constituted"]:checked').val();
        if (check == 1) {
            $('.doccsr,.event-no-of-director').css('display', 'block');
        } else {
            $('.doccsr,.event-no-of-director').css('display', 'none');
        }
    });
    $("[name='csr_set_off_amt_amount_avialable']").click(function () {
        var check = $('input[name="csr_set_off_amt_amount_avialable"]:checked').val();
        if (check == 1) {
            $('#preceding-year-end-after').css('display', 'block');
            $('#preceding-year-end-after').find('input').prop('required',true);
        } else {
            $('#preceding-year-end-after').css('display', 'none');
            $('#preceding-year-end-after').find('input').prop('required',false);
            $('#preceding-year-end-after input').val(0);
        }
        calculateSetOf();
    });
    $("[name='is_unspent_for_preceeding_3_years_after_22_Jan_21']").click(function () {
        var check = $('input[name="is_unspent_for_preceeding_3_years_after_22_Jan_21"]:checked').val();
        if (check == 1) {
            $('.preceding').css('display', 'block');
            $('.preceding').find('input').prop('required',true);
            $('.preceding').find('select').prop('required',true);
        } else {
            $('.preceding').css('display', 'none');
            $('.preceding').find('input').prop('required',false);
            $('.preceding').find('select').prop('required',false);
        }
    });
    $("[name='is_CSR_policy_displayed']").click(function () {
        var check = $('input[name="is_CSR_policy_displayed"]:checked').val();
        if (check == 1) {
            $('[name="csr_policy_link"]').closest('div').css('display', 'block');
            $('[name="csr_policy_link"]').prop('required',true);
        } else {
            $('[name="csr_policy_link"]').closest('div').css('display', 'none');
            $('[name="csr_policy_link"]').prop('required',false);
        }
    });
    $(".csr_commitee_compostion_directors_count").on('change', function () {
        var row_count = Number($('.csr_commitee_compostion_directors_count').val());
        console.log('row_count: ', row_count);

        if (row_count == 0) {
            $('tbody.csr_commitee_compostion_dir_row').empty();
        }

        var trcount = $('tbody.csr_commitee_compostion_dir_row tr').length
        console.log('trcount: ', trcount);

        if (trcount > row_count) {
            var delete_row = trcount - row_count;
            console.log('delete_row: ', delete_row);
            console.log("Greater than remove call here");
            for (let index = 0; index < delete_row; index++) {
                $('tbody.csr_commitee_compostion_dir_row tr:last').remove();
            }
            return true;
        }

        let date = $.datepicker.formatDate('yy-mm-dd', new Date());

        for (let index = trcount; index < row_count; index++) {

            var tr_length = $('.csr_commitee_compostion_dir_row').find('tr').length;
            var html = `<tr>
                <td> <input placeholder="Name of Director" type="text"
                         maxlength="100" class="form-control"
                        id="" name="csr_commitee_compostion[${tr_length}][name_of_director]" value="" required=""
                        aria-required="true"></td>
                <td> <select id="member" name="csr_commitee_compostion[${tr_length}][postion]"
                        class="form-control valid" required=""
                        aria-required="true" aria-invalid="false">
                        <option value="1" data-id="1">Member</option>
                        <option value="2" data-id="2">Chairperson</option>
                    </select>
                </td>
                <td>
                    <input placeholder="DIN" type="text" minlength="8"
                        class="form-control" id="din" name="csr_commitee_compostion[${tr_length}][DIN]" value=""
                        required="" aria-required="true">
                </td>
                <td>
                    <select id="nonexecutive" name="csr_commitee_compostion[${tr_length}][category]"
                        class="form-control valid" required=""
                        aria-required="true" aria-invalid="false">
                        <option value="1" data-id="">MD
                        </option>
                        <option value="2" data-id="">Executive
                        </option>
                        <option value="3" data-id="">
                            Non-Executive Non Independent
                        </option>
                        <option value="4">Non-Executive Independent
                        </option>
                    </select>
                </td>
                <td>
                    <input type="date" value="" class="form-control"
                        id="regDate" name="csr_commitee_compostion[${tr_length}][date_of_appointment]"  onkeydown="return false"  max="${date}" >
                </td>
            </tr>`;
            $(".csr_commitee_compostion_dir_row").append(html)
        }
    })
});
$(document).on('submit','[name="save_commitee_details"]',function(){
    var flag = false;
    $(this).find('[name="csr_commitee_compostion_din[]"]').each(function(){
        if(dinValidation($(this)) == false) flag = true;
    });
    if(flag == true) return false;
    return true;
});
function calculateCsrProfit() {
    let section_one_total = 0;
    let section_two_total = 0;
    let section_third_total = 0;
    let section_four_total = 0;
    let section_five_total = 0;
    let section_six_total = 0;
    let section_seven_total = 0;

    
    let section_3e_f_total = 0;

    $(".csr-calculator").each(function (i) {
        if (i == 0) {
            section_one_total = Number($(this).val());
            $(this).closest('tr').find('td:nth-child(4)').text(section_one_total);
        }
        if (i == 1) {
            section_two_total = Number($(this).val());
            $(this).closest('tr').find('td:nth-child(4)').text(section_two_total);
        }
        if (i >= 2 && i <= 5) { 
            section_third_total += Number($(this).val());
            if (i == 5) {
                $(this).closest('tr').find('td:nth-child(4)').text(section_third_total);
            }
        }
        if (i == 6 || i == 7) {
            section_3e_f_total += Number($(this).val());
            if (i == 7) {
                $(this).closest('tr').find('td:nth-child(4)').text(section_3e_f_total);
            }
        }
        if (i >= 8 && i <= 22) {
            section_four_total += Number($(this).val());
            if (i == 22) {
                $(this).closest('tr').find('td:nth-child(4)').text(section_four_total);
            }
        }
        if (i >= 23 && i <= 26) {
            section_five_total += Number($(this).val());
            if (i == 26) {
                $(this).closest('tr').find('td:nth-child(4)').text(section_five_total);
            }
        }
        if (i >= 27 && i <= 28) {
            section_seven_total += Number($(this).val());
            if (i == 28) {
                $(this).closest('tr').find('td:nth-child(4)').text(section_seven_total);
            }
        }
    });

    
    section_six_total = section_one_total 
                        + section_two_total 
                        - section_third_total 
                        - section_four_total 
                        + section_five_total 
                        + section_3e_f_total; 

    
    section_seven_total = section_six_total - section_seven_total;

    
    $('.section-six-total').text(section_six_total);
    $('.net-profit-total').text(section_seven_total);
}

function calculatorValue(key) {

    if(key == 1)
        calculation = current;
    if(key == 2)
        calculation = one_year;
    if(key == 3)
        calculation = two_year;
    if(calculation == null){
        $('#calculator-form').find('input[type=number],input[type=text]').prop('disabled', false);
        $('#calculator-form').find('input[type=number],input[type=text]').val('');
        $(".calculation-edit-event").css('display', 'none');
        $('#calculator-form').find('.saveBtn').css('display', 'block');
    }else{
        $('#calculator-form').find('input[type=number],input[type=text]').prop('disabled', true);
        $('#calculator-form').find('.saveBtn').css('display', 'none');
        $(".calculation-edit-event").css('display', 'block');
    }
    for (var key in calculation){
        $('[name="'+key+'"]').val(calculation[key]);
    }
    calculateCsrProfit();
}
function clearCsrCalculator() {
    $(".five_d").val(0)
    $(".three_e").val(0)
    $('#profit_and_loss').val(0)
    $("#bounties").val(0)
    $("#four").val(0)
}

$(".addMore").click(function () {

    let date = $.datepicker.formatDate('yy-mm-dd', new Date());
    let count = Number($(".ongoing_projects_preceeding_row").length);
    var html = `<tr class="ongoing_projects_preceeding_row">
    <th>${count + 1}</th>
    <td><input placeholder="" type="text" class="form-control" id=""
            required=""
            name="project_id[]" value=""
            aria-required="true" /></td>
    <td><input placeholder="" type="text" class="form-control" id=""
            required=""
            name="project_name[]" value=""
            aria-required="true" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
    <td><input placeholder="" type="date" class="form-control" id=""
            required=""
            name="FY_year_project_commenced[]"
            value="" aria-required="true"  onkeydown="return false" max="${date}"/></td>
    <td><input placeholder="" type="number" class="form-control commutative-calculation-event" id=""
            required=""
            name="amt_spent_start_of_year[]"
            value="" aria-required="true" /></td>
    <td><input placeholder="" type="number" class="form-control commutative-calculation-event" id=""
            required=""
            name="amt_spent_in_year[]"
            value="" aria-required="true" /></td>
    <td><input placeholder="" type="number" class="form-control commutative-calculation-text" id=""
    required=""
    name="commutative_amt_spent[]"
    value="" readonly /></td>
    <td><select class="form-control" name="project_status[]" required>
					<option value="">Select</option>
					<option value="Completed">Completed</option>
					<option value="Ongoing">Ongoing</option>
				</select>
    </td>
    <td  class="table-delete-icon">
        <a href="javascript:void(0)" class="event-delete-row-project">  
            <img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
        </a> 
    </td
</tr>`;
$(".ongoing_project_body").append(html);
countProject();
});
countProject();
function countProject(){
    var count = Number($(".ongoing_projects_preceeding_row").length);
    $('.no-ongoing-project').text(count);
}
$(document).on('click','.event-delete-row-project',function () {
    $(this).closest('tr').remove();
    countProject();
});
countDirector();
function countDirector(){
    var count = Number($(".csr_commitee_compostion_dir_row tr").length);
    $(document).find('.csr_commitee_compostion_directors_count').val(count);
}
$(document).on('click','.event-delete-row-committee',function () {
    $(this).closest('tr').remove();
    countDirector();
});
$(document).on('change mouseover','input[type="text"],input[type="number"],input[type="date"]',function () {
    $(this).attr("title",$(this).val());   
});
$(document).on('change mouseover','select',function () {
    $(this).attr("title",$(this).find(":selected").val());   
});
$(".add-another-member").click(function () {
    let date = $.datepicker.formatDate('yy-mm-dd', new Date());
    var html = `<tr>
                    <td> 
                        <input placeholder="Name of Director" type="text" maxlength="100" class="form-control"   onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)"  name="csr_commitee_compostion_name_of_director[]"  required="">
                    </td>
                    <td> 
                        <select name="csr_commitee_compostion_postion[]" class="form-control chairperson-event" required="">
                            <option value="">Select Position</option>
                            <option value="1">Member</option>
                            <option value="2">Chairperson</option>
                        </select>
                    </td>
                    <td>
                        <input placeholder="DIN" type="number"  class="form-control" name="csr_commitee_compostion_din[]" required="">
                    </td>
                    <td>
                        <select  name="csr_commitee_compostion_category[]" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="1">MD</option>
                            <option value="2">Executive</option>
                            <option value="3">Non-Executive Non Independent</option>
                            <option value="4">Non-Executive Independent</option>
                        </select>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="csr_commitee_compostion_date_of_appointment[]"   onkeydown="return false" max="${date}" required>
                    </td>
                    <td class="table-delete-icon">
                        <a href="javascript:void(0)" class="event-delete-row-committee"><img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""></a>
                    </td>
                </tr>`;
    $(".csr_commitee_compostion_dir_row").append(html);
    countDirector();
});
$(document).on('change','.commutative-calculation-event',function(){
    let start_year =  Number($(this).closest('tr').find('[name="amt_spent_start_of_year[]"]').val());
    let spent =  Number($(this).closest('tr').find('[name="amt_spent_in_year[]"]').val());

    $(this).closest('tr').find('[name="commutative_amt_spent[]"]').val(start_year+spent);
});
//Krishna web-2
$(document).ready(function () {
    $("#fychange").change(function () {
        let cFy = $(this).val();
        window.location.href = "?fy=" + cFy;
    });
    $(".fyreport").change(function () {
        var cFy = $(this).val();
        var sub = $('.sub-menu-list').find('.active').data('name');
        window.location.href = "?fy=" + cFy+"&tab=report-tab&sub="+sub;
    });
});

//Krishna web-2

$(".add-more-projects").click(function () {
    var trcount = $('tbody.ongoing_porjects_row tr').length
    var html = `<tr>
        <th scope="row">${trcount + 1}</th>
        <td> <input type="text" name="ongoing_porject[${trcount}][project_id]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][activities]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][project_name]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][local_area]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][state]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][district]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][months]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][amt_spent]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][dir_implementation]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][reg_no]" class="form-control"> </td>
        <td> <input type="text" name="ongoing_porject[${trcount}][agency_name]" class="form-control"> </td>
    </tr>`
    $(".ongoing_porjects_row").append(html);
});

$(".add-more-new-csr-project").click(function () {

    var trcount = $('tbody.new-csr-project tr').length
    var html = `<tr>
        <td> ${trcount + 1} </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][project_id]" required> </td>
        <td> {2021-2022}</td>
        <td> </td>
        <td> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][lcoal_area]" required> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][state]" required> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][district]" required> </td>
        <td> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][amt_spent]" required> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][direct]" required> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][csr_reg]" required> </td>
        <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][name]" required> </td>
    </tr>`;
    $(".new-csr-project").append(html);
});

$(".add-more-other-than-csr-project").click(function () {
    var trcount = $('tbody.other-than-csr-project tr').length
    var html = ` <tr>
            <td> ${trcount + 1} </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][fy]" value="${getCurrentFinancialYear()}" class="form-control" readonly></td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][activities_list]" class="form-control" required> </td>
            <td><input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][project]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][lcoal_area]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][state]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][district]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][amt_spent]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][direct]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][csr_reg]" class="form-control" required> </td>
            <td> <input type="text" name="detail_amt_ongoing_csr_fy[${trcount}][name]" class="form-control" required> </td>
        </tr>`;
    $(".other-than-csr-project").append(html);
})

function getCurrentFinancialYear() {
    const today = new Date();
    const currentYear = today.getFullYear();
    const startYear = (today.getMonth() >= 3) ? currentYear : currentYear - 1;
    const endYear = startYear + 1;
    return `${startYear}-${endYear}`;
}

$(".add-more-against-csr-project").click(function () {
    var trcount = $('tbody.against-csr-project tr').length
    var html = `  <tr>
        <td> ${trcount} </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][fy]"
                value="" class="form-control">
        </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][activities_list]"
                class="form-control" required> </td>
        <td><input type="text" name="detail_amt_spent_against_csr[${trcount}][project]" class="form-control"
                required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][lcoal_area]"
                class="form-control" required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][state]" class="form-control"
                required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][district]"
                class="form-control" required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][amt_spent]"
                class="form-control" required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][direct]" class="form-control"
                required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][csr_reg]"
                class="form-control" required> </td>
        <td> <input type="text" name="detail_amt_spent_against_csr[${trcount}][name]" class="form-control"
                required> </td>
    </tr>`;
    $(".against-csr-project").append(html);

});

$(".add-more-capital_asset-csr-project").click(function () {
    var trcount = $('tbody.capital_asset-csr-project tr').length
    var html = `<tr>
        <th>${trcount + 1}</th>
        <th> <input type="text" name="capital_asset[${trcount}][shorts]" class="form-control" required> </th>
        <th> <input type="text" name="capital_asset[${trcount}][pincode]" class="form-control" required> </th>
        <th> <input type="date" name="capital_asset[${trcount}][creation_date]" class="form-control" required> </th>
        <th> <input type="text" name="capital_asset[${trcount}][csr_spent]" class="form-control" required> </th>
        <th> <input type="text" name="capital_asset[${trcount}][csr_reg]" class="form-control" required> </th>
        <th> <input type="text" name="capital_asset[${trcount}][name]" class="form-control" required> </th>
        <th> <input type="text" name="capital_asset[${trcount}][address]" class="form-control" required> </th>
    </tr>`;
    $(".capital_asset-csr-project").append(html);
});
$(".addmoretestimonials").click(function () {
    var flag = false;
    $('[name="person_name[]"]').each(function(){
            var name = $(this).val();
            var org = $(this).parent().find('[name="person_organisation[]"]').val();
            var desi = $(this).parent().find('[name="person_designation[]"]').val();
            var des = $(this).parent().find('[name="testimonial_description[]"]').val();
            if(name.length==0||org.length==0||desi.length==0||des.length==0){
                flag = true;
            }
    });
    if(flag==true){
        $('.testimonial-error').css('display','block');
        return false;
    }else{
        $('.testimonial-error').css('display','none');
    }
    var count = $('.testimonails-count').length;

    var html = `<div class="row testimonails-count">
            <div class="col-md-2 image-container">
                <p>Images (optional)</p>
                <div class="upload_imgs">
					<input type="file" name="person_image[]" accept="" class="upload __upload file-api">
					<img src="${SKIN_URL}/images/add_more.png">
				</div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <p>Name, Organisation & Designation</p>
                    <input placeholder="Name" type="text" class="form-control"name="person_name[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
                    <input placeholder="Organisation" type="text" class="form-control" name="person_organisation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
                    <input placeholder="Designation" type="text" class="form-control" name="person_designation[]"  onpaste="return false;" onkeypress="return /[a-zA-Z ]/i.test(event.key)">
                    <a href="javascript:void(0)" class="event-delete-testimonial">  
						<img src="${SKIN_URL}images/deleteIconsline.svg" alt=""/>
					</a>
                    <div class="conclussion">
                        <p><label>Description (Minimum 10, Maximum 300 Characters) </label></p>
                        <textarea name="testimonial_description[]"  onkeyup="countChar(this)" data-pointer="charac" data-maximum="300"></textarea>
                        <p class="charac"></p>
                    </div>
                </div>
            </div>
        </div>`
    $(".additional_information-testimonials").append(html)

})
function comulativeCalculation(){
	var i =j=total_budget=direct_expenditure=total_overheads=total_commutative=amount=0;

	$('[name="direct_expenditure[]"]').each(function(){
		i = Number($(this).val());
		j = Number($(this).closest('tr').find('[name="overheads[]"]').val());
		j = (j)?j:0;
		$(this).closest('tr').find('.total').val(i+j);
		total_budget+=Number($(this).closest('tr').find('[name="project_outlay_amt[]"]').val());
		direct_expenditure+=i;
		total_overheads+=j;
		total_commutative+=Number($(this).closest('tr').find('[name="cumulative_expense[]"]').val());
	});
	amount = Number($('[name="CSR_obligation_current_FY"]').val())-total_commutative;
	$('[name="total_budget"]').val(total_budget);
	$('.budget-text-display').text(total_budget);
	$('.expenditure-text-display').text(total_commutative);
	$('[name="total_expenditure"]').val(direct_expenditure);
	$('[name="total_overheads"]').val(total_overheads);
	$('[name="total_commutative"]').val(total_commutative);
	$('[name="amt_unspent_for_FY"]').val(amount);
}

function sdgs(){

	$('.sector-img-sec-sdgs :input').removeAttr('checked');
	$('.sector-img-sec-sdgs :input').parent('div').find('img').removeClass("active");
	$('.sector-img-sec-sdgs :input').parent('div').find('img').css("filter",'grayscale(1)');

	$('select[name="sector[]"]').each(function(){
		var sdgs = $(this).find(":selected").data('sdgs').toString().split(",");
		sdgsActive(sdgs);
	});
	$('input[name="sector[]"]').each(function(){
		var sdgs = $(this).data('sdgs').toString().split(",");
		sdgsActive(sdgs);
	});
}
function sdgsActive(sdgs){
	$(sdgs).each(function(k,v){
		$('.sector-img-sec-sdgs :input').filter(function(){return this.value== v}).attr('checked','checked');
		$('.sector-img-sec-sdgs :input').filter(function(){return this.value== v}).parent('div').find('img').addClass("active");
		$('.sector-img-sec-sdgs :input').filter(function(){return this.value== v}).parent('div').find('img').css("filter",'none');
	});
}
document.querySelector("#files").addEventListener("change", (e) => { //CHANGE EVENT FOR UPLOADING PHOTOS
    if (window.File && window.FileReader && window.FileList && window.Blob) { //CHECK IF FILE API IS SUPPORTED
        const files = e.target.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
        const output = document.querySelector("#result");
        output.innerHTML = "";
        let i = 0;
        let clearTime = setInterval(() => {
            const picReader = new FileReader(); // RETRIEVE DATA URI 
            picReader.addEventListener("load", function (event) { // LOAD EVENT FOR DISPLAYING PHOTOS
                const picFile = event.target;
                const img = document.createElement("img");
                img.className = "thumbnail";
                img.src = picFile.result;
                img.classList.add("animated", "zoomIn");
                output.appendChild(img);
            });
            picReader.readAsDataURL(files[i]); //READ THE IMAGE  
            i++;
            i == files.length ? clearInterval(clearTime) : undefined;
        }, 200)
    } else {
        alert("Your browser does not support File API");
    }
});
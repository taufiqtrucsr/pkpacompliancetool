//isha validation for din to be only 8 digit
$(document).on('input', '[name="csr_commitee_compostion_din[]"]', function() {
    if (this.value.length > 8) {
        this.value = this.value.slice(0, 8); 
    }
});

function dinValidation(ele) {
    $(ele).parent().find('span').remove();
    if($(ele).val().length !== 8) { // Changed condition to check for exactly 8 digits
        $(ele).parent().append('<span style="color:red;font-size:10px">Please enter a valid 8-digit DIN.</span>');
        return false;
    }
    return true;
}
//isha code ends
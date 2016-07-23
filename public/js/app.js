$(function(){ //when the DOM is ready

    $('.btn-credit').click(function() { 
    	if($('#debitDialog').is(':visible')) {
    		$('#debitDialog').toggle(); 
    	}

        if($('#payUserForm').is(':visible')) {
            $('#payUserForm').toggle();
        }

        if($('#payBankForm').is(':visible')) {
            $('#payBankForm').toggle();
        }

        $('#creditForm ').toggle();  
    });

    $('.btn-debit').click(function() { 
        if($('#creditForm').is(':visible')) {
            $('#creditForm ').toggle(); 
        }

        if($('#payUserForm').is(':visible')) {
            $('#payUserForm').toggle();
        }

        if($('#payBankForm').is(':visible')) {
            $('#payBankForm').toggle();
        }

        $('#debitDialog ').toggle(); 
    });

    $('.btn-user').click(function() { 
        if($('#creditForm').is(':visible')) {
            $('#creditForm ').toggle(); 
        } 

        if ($('#debitDialog').is(':visible')) {
            $('#debitDialog ').toggle(); 
        }

        $('#payUserForm ').toggle(); 
    });

    $('.btn-account').click(function() { 
        if($('#creditForm').is(':visible')) {
            $('#creditForm ').toggle(); 
        } 

        if ($('#debitDialog').is(':visible')) {
            $('#debitDialog ').toggle(); 
        }

        if($('#payUserForm').is(':visible')) {
            $('#payUserForm').toggle();
        }

        $('#payBankForm ').toggle(); 
    });

    $('.btn-create-bank').click(function() { 
        $('#createBankForm ').toggle(); 
    });

    $('#createBankForm').submit(function(e) {
        if ($.trim($(".bank-name").val()) === "" || $.trim($('.acc-type').val()) === "") {
            alert('You did not fill at least one of the fields.');
            return false;
        }
    });

    $('#payUserForm').submit(function() {

        if ($.trim($(".user-email, .usercredit").val()) === "") {
            alert('You did not fill at least one of the fields.');
            return false;
        }
    });    

    $('#payBankForm').submit(function() {
        if ($.trim($("#credit-input").val()) === "") {
            alert('You did not fill the credit field.');
            return false;
        }
    });  

    $('#creditForm').submit(function(e) {
        // e.preventDefault();

        if ($.trim($(".credit-input").val()) === "") {
            alert('You did not fill the credit field.');
            return false;
        }
    });  
});
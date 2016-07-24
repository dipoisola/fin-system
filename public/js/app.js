$(function() { //when the DOM is ready

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

    $('.btn-payUser').on('click', payUser);  
    $('.btn-payBank').on('click', payMyBank); 
    $('.btn-transact').on('click', creditMyWallet); 
    $('.btn-createBank').on('click', createBankAccount); 
});

var payUser = function(e) {
    e.preventDefault();

    var userEmail = $('.user-email').val(),
        creditAmount = $('.usercredit').val();
        _token = $('input[name=_token]').val();
        form = $('#payUserForm');


    if ($.trim(userEmail) === "" || $.trim(creditAmount) === "") {
        $('#info-platform').css("color", "red").html('The field(s) should not be blank');
        return false;
    } else if(isNaN($.trim(creditAmount))) {
        $('#info-platform').css("color", "red").html('Credit amount must be a number');
    } else {
        $.post(form.attr('action'), {'email': userEmail, 'credit_amount': creditAmount, '_token': _token})
            .success(function(response) {
                if(response.error) {
                    $('#info-platform').css("color", "red").html(response.error);
                    return false;
                }

                form.find(".user-email, .usercredit").val('');
                $('#info-platform').css("color", "green").html('Success!');
                $('#mybalance').html( '$' + response.balance.toLocaleString());
            })
    }
}

var payMyBank = function(e) {
    e.preventDefault();

    var bankId = $('.bank-name').val(),
        creditAmount = $('#credit-input').val();
        _token = $('input[name=_token]').val();
        form = $('#payBankForm');


    if ( !bankId || $.trim(creditAmount) === "") {
        $('#info-platform1').css("color", "red").html('The field(s) should not be blank');
        return false;
    } else if(isNaN($.trim(creditAmount))) {
        $('#info-platform1').css("color", "red").html('Credit amount must be a number');
    } else {
        $.post(form.attr('action'), {'bankid': bankId, 'credit_amount': creditAmount, '_token': _token})
            .success(function(response) {
                if(response.error) {
                    $('#info-platform1').css("color", "red").html(response.error);
                    return false;
                }

                form.find("#credit-input").val('');
                $('#info-platform1').css("color", "green").html('Success!');
                $('#mybalance').html( '$' + response.balance.toLocaleString());
            })
    }
}

var creditMyWallet = function(e) {
    e.preventDefault();

    var creditAmount = $('.credit-input').val();
        _token = $('input[name=_token]').val();
        form = $('#creditForm');    

    if ($.trim(creditAmount) === "") {
        $('#info-platform2').css("color", "red").html('Field should not be blank');
        return false;
    } else if(isNaN($.trim(creditAmount))) {
        $('#info-platform2').css("color", "red").html('Credit amount must be a number');
    } else {
        $.post(form.attr('action'), {'credit_amount': creditAmount, '_token': _token})
            .success(function(response) {
                if(response.error) {
                    $('#info-platform1').css("color", "red").html(response.error);
                    return false;
                }

                form.find(".credit-input").val('');
                $('#info-platform2').css("color", "green").html('Wallet credited successfully!');
                $('#mybalance').html( '$' + response.balance.toLocaleString());
            })
    }
}

var createBankAccount = function(e) {
    e.preventDefault();

    var bankName = $('.bank-name').val(),
        accType = $('.acc-type').val(),
        _token = $('input[name=_token]').val(),
        form = $('#createBankForm');

    if (!bankName || !accType) {
        $('#info-platform3').css("color", "red").html('Please select both fields');
        return false;
    } else {
        $.post(form.attr('action'), {'bank_name': bankName, 'account_type': accType, '_token': _token})
            .success(function(response) {
                if(response.error) {
                    $('#info-platform3').css("color", "red").html(response.error);
                    return false;
                }

                var $newBank = '<div class="dipo" style=" border-bottom: 1px #5D97C7 solid; padding: 6px;">';
                    $newBank += '<div class="dipo1" style="font-size: 15px; font-weight: 900; margin: 3px;">';
                    $newBank += '<div id="bankname" style="color: #35495E;">Bank Name: <span style="color: black; font-size: 18px;">';
                    $newBank += response.bank.name + '</span></div><div id="acc_no" style="color: #35495E;">';
                    $newBank += "Acc. No.: " + '<span style="color: black; font-size: 18px;">';
                    $newBank += response.bank.account_no + '</span></div><div id="account" style="color: #35495E;">';
                    $newBank += "Acc. Type: " + '<span id="type" style="color: black; font-size: 18px;">';
                    $newBank += response.bank.account_type + '</span><span id="balance" style="font-size: 19px; margin-top: -7px; float: right; color: black;">';
                    $newBank += "Balance: " + "$0" + '</span></div></div></div>';

                var div = document.getElementById('main');

                form.find(".bank-name").val('');
                form.find(".acc-type").val('');

                div.innerHTML = div.innerHTML + $newBank;

                if ($('.acc-message').is(':visible')) {
                    $('.acc-message').toggle(); 
                }

                $('#info-platform3').css("color", "green").html('Account created successfully!');
            })
    }
}
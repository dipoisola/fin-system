@extends('layouts.master')
@section('title', 'My banks')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<div class="" style="border: 1px black solid;">
				<div style="font-weight: 800; font-size: 40px; text-align: center;">My Bank Accounts</div>
				<div id="main" style="border-top: 1px black solid; border-bottom: 1px black ;">
					@if(count($user->banks) > 0)
						@foreach($user->banks as $bank)
								<div class="dipo" style=" border-bottom: 1px #5D97C7 solid; padding: 6px;">
								    <div class="dipo1" style="font-size: 15px; font-weight: 900; margin: 3px;">
								    	<div id="bankname" style="color: #35495E;">
								    		Bank Name: <span style="color: black; font-size: 18px;">{{ $bank->name }}</span>
								    	</div>
								    	<div id="acc_no" style="color: #35495E;">
								    		Acc. No.: <span style="color: black; font-size: 18px;">{{ $bank->account_no }}</span>
								    	</div>
								    	<div id="account" style="color: #35495E;">
								    		Acc. Type: <span id="type" style="color: black; font-size: 18px;">{{ $bank->account_type }}</span>

								    		<span id="balance" style="font-size: 19px; margin-top: -7px; float: right; color: black;">Balance: ${{ number_format($bank->balance) }}</span>
								    	</div>
								    </div>
								</div>
						@endforeach
					@else
						<div class="acc-message">You currently have no account opened.</div>
					@endif
				</div>
				<div style="text-align: center;">
					<button type="submit" class="btn-create-bank" role="button">
						Open New Account
					</button>
				</div>

				<form id="createBankForm" action="/mybanks/create" method="POST" style="margin-top: 15px;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div id="info-platform3" style="font-size: 12px; text-align: center;"></div>
					<div style="text-align: center">
						<select name='bank_name' class="bank-name" required>
							<option value="">Select a bank</option>
							<option value="Barclays">Barclays</option>
							<option value="Credit-Suisse">Credit-Suisse</option>
							<option value="Spring">Spring</option>
							<option value="Skye">Skye</option>
						</select>
						<select name='account_type' class="acc-type" required>
							<option value="">Select account type</option>
							<option value="Savings">Savings</option>
							<option value="Current">Current</option>
						</select>
					</div>
					<div style="text-align: center;">
						<button type="submit" class="btn-createBank" role="button" name="enter">Create</button>
					<div>	
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection
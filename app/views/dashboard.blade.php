@extends('layout.master')
@section('title', 'Landing page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
			<div class="" style="border: 1px black solid; height: 400px; text-align: center;">
				<span style="font-weight: 800; font-size: 45px;">My wallet</span>
				<div style="border: 1px black dashed; margin-bottom: 5px;"></div>
				<div>Balance</div>
				<div style="font-weight: 900; font-size: 45px; "><strong>${{ number_format($user->wallet_balance) }}</strong></div>
				<button type="submit" class="btn-debit" role="button" name="enter">Debit this wallet</button>
				<button type="submit" class="btn-credit" role="button" name="enter">Credit this wallet</button>

				<form id="creditForm" action="/self/credit" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div style="margin-top: 20px;">
						<span style="font-size: 15px;">Enter credit value</span>
						<input type="text" name="credit_amount" class="credit-input" required>
					</div>
					<button type="submit" class="btn-transact" role="button" name="enter">Transact</button>
				</form>	

				<form id="payUserForm" action="/pay/user" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div style="margin-top: 30px;">
						<input type="text" name="email" class="user-email" placeholder="User email" required>
						<input type="text" name="credit_amount" class="usercredit" placeholder="Credit (in numbers)" required>
					</div>
					<button type="submit" class="btn-payUser" role="button" name="enter">Pay User</button>
				</form>

				<form id="payBankForm" action="/pay/bank" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div style="margin-top: 30px;">
						<select type="text" name="bankid" class="user-email" required>
						@if(count($user->banks) > 0)
							@foreach($user->banks as $bank)
								<option value={{ $bank->id }}>{{ $bank->name }} [{{ $bank->account_no }}]</option>
							@endforeach
						@else	
							<option value="">You have no bank account</option>
						@endif	
						</select>
						<input type="text" name="credit_amount" id="credit-input" class="credit-input" placeholder="Credit (in numbers)" required>
					</div>
					<button type="submit" class="btn-payBank" role="button" name="enter">Pay</button>
				</form>			

				<div id="debitDialog" style="margin-top: 30px;">
					<div><span>What do you want to do?</span></div>
					<!-- <input type="text" name="debit_amount" class="credit-input"> -->
					<button type="submit" class="btn-user" role="button" name="enter">Pay another user</button>
					<button type="submit" class="btn-account" role="button" name="enter">Credit my account</button>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection
@extends('layouts.master')
@section('title', 'Landing page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
			<div class="dashboard-border">
				<span class="b--dashboard-font">My wallet</span>
				<div class="dashboard-partition"></div>
				<div>Balance</div>
				<div id="mybalance" class="b--balance-font">
					<strong>${{ number_format($user->wallet_balance) }}</strong>
				</div>
				<button type="submit" class="btn-debit" role="button" name="enter">Debit this wallet</button>
				<button type="submit" class="btn-credit" role="button" name="enter">Credit this wallet</button>

				<form id="creditForm" action="/pay/me" method="POST" style="margin-top: 20px;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div style="">
						<span class="enter-value">Enter credit value</span>
						<div id="info-platform2" style="font-size: 12px;"></div>
						<input type="text" name="credit_amount" class="credit-input" required>
					</div>
					<button type="submit" class="btn-transact" role="button" name="enter">Transact</button>
				</form>

				<form id="payUserForm" action="/pay/user" method="POST" style="margin-top: 15px;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div id="info-platform" style="font-size: 12px;"></div>
					<div>
						<input type="text" name="email" class="user-email" placeholder="User email" required>
						<input type="text" name="credit_amount" class="usercredit" placeholder="Credit (in numbers)" required>
					</div>
					<button type="submit" class="btn-payUser" role="button" name="enter">Pay User</button>
				</form>

				<form id="payBankForm" action="/pay/bank" method="POST" style="margin-top: 15px;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div id="info-platform1" style="font-size: 12px;"></div>
					<div style="">
						<select type="text" name="bankid" class="bank-name" required>
						@if(count($user->banks) > 0)
							@foreach($user->banks as $bank)
								<option value={{ $bank->id }}>{{ $bank->name }} [{{ $bank->account_no }}]</option>
							@endforeach
						@else
							<option value="">You have no bank account</option>
						@endif
						</select>
						<input type="text" name="credit_amount" id="credit-input" class="credit-input" placeholder="Credit (in digits)" required>
					</div>
					<button type="submit" class="btn-payBank" role="button" name="enter">Pay</button>
				</form>

				<div id="debitDialog" class="margintop-30">
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
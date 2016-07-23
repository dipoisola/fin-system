@extends('layout.master')
@section('title', 'Landing page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<div class="" style="border: 1px black solid;">
				<div style="font-weight: 700; font-size: 40px; line-height: 55px; text-align: center;">My transactions</div>
				<div style="border-top: 1px black solid; border-bottom: 1px black; text-align: left;">
					@if(count($transactions) > 0 )
						@foreach($transactions as $transaction)
							@if($transaction->transaction_type == 1)
								<div style="font-size: 14px; line-height: 40px; margin-left: 5px;">
									- You <span style="color: green;">credited</span> ${{$transaction->amount}} into your wallet.
								</div>
							@endif
							@if($transaction->transaction_type == 2)
								@if($transaction->user_id === Auth::user()->id)
									<div style="font-size: 14px; line-height: 40px; margin-left: 5px;">
										- You <span style="color: red;">debited</span> ${{$transaction->amount}} from your wallet to {{$transaction->receiver_name}}'s wallet.
									</div>
								@else
								<div style="font-size: 14px; line-height: 40px; margin-left: 5px;">
									- Your wallet was <span style="color: green;">credited</span> with ${{$transaction->amount}} from {{$transaction->sender}}.
								</div>
								@endif
							@endif
							@if($transaction->transaction_type == 3)
								<div style="font-size: 14px; line-height: 40px; margin-left: 5px;">
									- You <span style="color: green;">credited</span> ${{$transaction->amount}} into your {{$transaction->bank_name}}{{$transaction->acc_no}} bank account.
								</div>
							@endif
							<div style="border-top: 1px black solid; border-bottom: 1px black ;">
						@endforeach
					@else
						<div style="font-size: 20px; line-height: 80px; text-align: center;">
							You have made no transactions.
						</div>
					@endif
				</div>
			</div>	
		</div>
	</div>	
</div>
@endsection
 <!-- <form action="https://secure.paypal.com/cgi-bin/webscr" method="post" id="myform"> -->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="myform"> 
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="business" value="{{$account}}" />
<input type="hidden" name="cbt" value="Test" />
<input type="hidden" name="currency_code" value="USD" />
<input type="hidden" name="quantity" value="1" />
<input type="hidden" name="item_name" value="Purchase Ad Quote" />
<input type="hidden" name="custom" value="{{$track}}" />
<input type="hidden" name="amount"  value="{{$amount}}" />
<input type="hidden" name="return" value="{{url('/')}}"/>
<input type="hidden" name="cancel_return" value="{{url('/')}}" />
<input type="hidden" name="notify_url" value="{{route('ipn.paypal')}}" />
</div>
</form>
<script>
	document.getElementById("myform").submit();
</script>



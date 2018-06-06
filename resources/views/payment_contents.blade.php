<style type="text/css">
	.payContents{ position: absolute; top: 80px; margin-left: 100px; padding: 30px; color: black; font-size: 15px; width: calc( 100% - 100px); height: calc(100% - 80px); overflow: auto; }
	.payDetails img{ width: 100px; border-radius: 100%; margin-bottom: 50px; }
	.payDetails h2, .payMethod h2, .payMethod h2, .billHistory h2{ margin-bottom: 50px; }
	.payContents label{ margin-top: 20px; color: #989898; }
	.payContents input[type='text']{ border: none; border-bottom: 1px solid #989898; width: 80%; padding-left: 10px; }
	.payContents input[type='submit'], .btnEdit, .btnDelCard{ margin-top: 20px; background-color: #4da2ff; border: none; border-radius: 5px; padding: 10px 20px 10px 20px; color: white; height: calc(100% - 80px); overflow: auto; }
	input:focus{ outline: none; }
	.promoCode, .billHistory{ border-top: 1px solid #989898; margin-top: 30px; color: #989898; }
	.DelAcount input{ background-color: #f3f7fa !important; color: black!important; }
	.HideItem { display: none; }
	.payMethod i{ margin-right: 10px; }
	.payMethod table td{ padding: 10px; color: #989898; }
	.fa-check-circle-o{ color: green; }
	.billHistory table{ width: 100%; }
	.btnEdit{ margin-left: 15px; margin-right: 20px; background-color: #bec3c7!important; width: 5em; float: left; cursor: pointer; }
	.btnDelCard{ background-color: #f75c4a!important; width: 10em; cursor: pointer;}
	input[name="submitApply"]{ background-color: #e6eaed!important; color: #b7bbbe!important; }
</style>
<div class="payContents row">
	<form class="payDetails col-xs-12" method="post" id="payDetails">
		{{ csrf_field() }}
		<div class="payLeft col-xs-5">
			<h2>Billing Details</h2>
			<div class="col-xs-12 row">
				<div class="col-xs-6 row">
					<label>First Name</label><br/>
					<input type="text" name="firstName" value="@php echo App\Http\Controllers\UserInfoController::getUserFirstName($email);@endphp"><br/>
				</div>
				<div class="col-xs-6 row">
					<label>Last Name</label><br/>
					<input type="text" name="lastName" value="@php echo App\Http\Controllers\UserInfoController::getUserLastName($email);@endphp"><br/>
				</div>
			</div>
			<label>Email</label><br/>
			<input type="text" name="eMail" value="@php	echo $email;@endphp" readonly><br/>
			<label>Company Name</label><br/>
			<input type="text" name="companyName" value="@php echo $billData->CompanyName;@endphp"><br/>
			<label>Tax / Vat ID</label><br/>
			<input type="text" name="taxVatID" value="@php echo $billData->TaxVatId;@endphp"><br/>
			<div class="row col-xs-12">
				<div class="col-xs-6 row">
					<label>Country</label><br/>
					<input type="text" name="country" value="@php echo $billData->Country;@endphp">
				</div>
				<div class="col-xs-6 row">
					<label>Zip / Postal Code</label><br/>
					<input type="text" name="zipCode" value="@php echo $billData->ZipCode;@endphp">
				</div>
				<div class="col-xs-6 row">
					<label>City</label><br/>
					<input type="text" name="city" value="@php echo $billData->City;@endphp">
				</div>
				<div class="col-xs-6 row">
					<label>State</label><br/>
					<input type="text" name="state" value="@php echo $billData->State;@endphp">
				</div>
			</div>
		</div>
		<div class="payRight col-xs-6">
			<h2>Payment Method</h2>
			<div class="col-xs-12 row">
				<div class="col-xs-8">
					<label>Card Number</label><br/>
					<input type="text" id="payCode" readonly onkeyup="payCodeEditing()" data-inputmask="'mask': '9999 9999 9999 9999'">
					<input type="text" name="payCode" style="display: none;" value="@php echo $billData->StripeCardNumber;@endphp">
				</div>
				<div class="col-xs-4">
					<label>Expiration</label><br/>
					<input type="text" name="expDate" readonly value="@php echo $billData->ExpirationDate;@endphp">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="btnEdit" onclick="btnEditClicked()">EDIT</div>
				<div class="btnDelCard" onclick="btnDelCardClicked()">DELETE CARD</div>
			</div>
		</div>
		<div class="col-xs-12">
			<input type="submit" value="SAVE">
		</div>
	</form>
	<div class="col-xs-11 promoCode">
		<h2>Promo Code</h2>
		<p>If you have a promo code, please enter it below to receive your credit</p>
		<form class="col-xs-7" method="post" action="/savePromoCode">
			{{ csrf_field() }}
			<div class="col-xs-7" style="top: 40px;">
				<input type="text" name="promoCode" placeholder="Promo Code" value="@php echo $billData->PromoCode;@endphp">
			</div>
			<div class="col-xs-5">
				<input type="submit" name="submitApply" value="APPLY CODE">
			</div>
		</form>
	</div>
	<div class="col-xs-11 billHistory">
		<h2>Billing History</h2>
		<table>
			<thead>
				<tr>
					<td>Date</td>
					<td>Description</td>
					<td>Amount</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				@php
				for( $i = 0; $i < count($billHistory); $i++){
					$oneBill = $billHistory[$i];
				@endphp
				<tr>
					<td>@php echo $oneBill->BillDate;@endphp</td>
					<td>@php echo $oneBill->Description;@endphp</td>
					<td>@php echo $oneBill->Amount;@endphp USD</td>
				</tr>
				@php
				}
				@endphp
			</tbody>
		</table>
	</div>
</div>
<script src='js/jquery.inputmask.bundle.js'></script>

<script type="text/javascript">
	function CardNumber2Code(){
		var strCardNumber = $("input[name='payCode']").val();
		if(strCardNumber.length == 16){
			var strLast4Digit = strCardNumber.substr(strCardNumber.length - 4);
			var strCode = 'XXXX XXXX XXXX ' + strLast4Digit;
			$("#payCode").val(strCode);
		}
	}
	CardNumber2Code();
	function btnEditClicked() {
		$("#payCode").attr('readonly', false);
		$("#payCode").val($("input[name='payCode']").val());
		$(":input").inputmask();
	}
	function payCodeEditing() {
		$("input[name='payCode']").val($("#payCode").val().replace(/ /g, ''));
	}
	function btnDelCardClicked(){
		$("#payCode").val("");
		$("input[name='payCode']").val("");
		// $("#payDetails").submit();
		document.getElementById("payDetails").submit();
	}
</script>
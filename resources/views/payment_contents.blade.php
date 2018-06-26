
<div class="payContents">
	<form class="payDetails col-xs-12" method="post" id="payDetails">
		{{ csrf_field() }}
		<div class="payLeft col-xs-12 col-md-6 col-lg-6">
			<h2>Billing Details</h2>
			<div class="row">
				<div class="col-xs-6">
					<label>First Name</label><br/>
					<input type="text" name="firstName" value="@php echo App\Http\Controllers\UserInfoController::getUserFirstName($email);@endphp"><br/>
				</div>
				<div class="col-xs-6">
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
			<div class="row">
				<div class="col-xs-6">
					<label>Country</label><br/>
					<input type="text" name="country" value="@php echo $billData->Country;@endphp">
				</div>
				<div class="col-xs-6">
					<label>Zip / Postal Code</label><br/>
					<input type="text" name="zipCode" value="@php echo $billData->ZipCode;@endphp">
				</div>
				<div class="col-xs-6">
					<label>City</label><br/>
					<input type="text" name="city" value="@php echo $billData->City;@endphp">
				</div>
				<div class="col-xs-6">
					<label>State</label><br/>
					<input type="text" name="state" value="@php echo $billData->State;@endphp">
				</div>
			</div>
		</div>
		<div class="payRight col-xs-12 col-md-6 col-lg-6">
			<h2>Payment Method</h2>
			<div class="row">
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
			<div class="row">
				<div class="btnEdit" onclick="btnEditClicked()">EDIT</div>
				<div class="btnDelCard" onclick="btnDelCardClicked()">DELETE CARD</div>
			</div>
		</div>
		<div class="col-xs-12">
			<input type="submit" value="SAVE">
		</div>
	</form>
	<div class="col-xs-11 promoCode" style="display: none;">
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
<script src='js/jquery.min.js'></script>
<script src='js/jquery.inputmask.bundle.js'></script>
<script src='js/all.js'></script>


<div class="payContents row">
	<form class="payDetails payLeft col-xs-12 col-md-6 col-lg-6" method="post" id="payDetails">
		{{ csrf_field() }}
		<div class="row">
			<h3 class="col-xs-12">Billing Details</h3>
			<div class="col-xs-6">
				<label>First Name</label><br/>
				<input type="text" name="firstName" value="@php echo App\Http\Controllers\UserInfoController::getUserFirstName($email);@endphp"><br/>
			</div>
			<div class="col-xs-6">
				<label>Last Name</label><br/>
				<input type="text" name="lastName" value="@php echo App\Http\Controllers\UserInfoController::getUserLastName($email);@endphp"><br/>
			</div>
			<div class="col-xs-12">
				<label>Email</label><br/>
				<input type="text" name="eMail" value="@php	echo $email;@endphp" readonly><br/>
				<label>Company Name</label><br/>
				<input type="text" name="companyName" value="@php echo $billData->CompanyName;@endphp"><br/>
				<label>Tax / Vat ID</label><br/>
				<input type="text" name="taxVatID" value="@php echo $billData->TaxVatId;@endphp"><br/>
			</div>
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
		<div class="row">
			<div class="col-xs-12">
				<input type="submit" class="hoverBtn" value="SAVE">
			</div>
		</div>
	</form>
	<form class="payDetails payRight col-xs-12 col-md-6 col-lg-6" method="post" id="payMethod" action="/payMethod">
		{{ csrf_field() }}
		<h3>Payment Method</h3>
		<div class="row">
			<div class="col-xs-8">
				<label>Card Number</label><br/>
				<input type="text" id="payCode" readonly data-inputmask="'mask': '9999 9999 9999 9999'">
				<input type="text" name="payCode" style="display: none;" value="@php echo $billData->StripeCardNumber;@endphp">
			</div>
			<div class="col-xs-4">
				<label>Expiration Date</label><br/>
				<input type="text" name="expDate" readonly value="@php echo $billData->ExpirationDate;@endphp">
			</div>
			<div class="col-xs-12" style="display: none;">
				<div class="btn btnEdit hoverBtn" onclick="btnEditClicked()">EDIT</div>
				<div class="btn btnDelCard 	" onclick="btnDelCardClicked()">DELETE CARD</div>
			</div>
			<div class="col-xs-12" style="display: none;">
				<div class="btn btnCardNumSave hoverBtn" style="display: none;" onclick="btnCardNumSaveClicked()">SAVE</div>
				<div class="btn btnCardNumCancel hoverBtn" style="display: none;" onclick="btnCardNumCancelClicked()">CANCEL</div>
			</div>
		</div>
	</form>

	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12 billHistory">
				<div style="width: 100%; border-top: 1px solid #989898;"></div>
				<h3>Billing History</h3>
				<table class="billTable">
					<thead>
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Amount</td>
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
	</div>
</div>
<script src='js/jquery.min.js'></script>
<script src='js/jquery.inputmask.bundle.js'></script>
<script src='js/all.js'></script>

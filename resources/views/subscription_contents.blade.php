<div class="subContents">
	<h2>Plans</h2>
	<div class="subMain">
		<p @php echo $errMsg==''? 'style="display: none;"' : 'style="color:red;"';@endphp>@php echo $errMsg;@endphp</p>
		<div class="planOption">
			<!-- {{ csrf_field() }} -->
			<p  style="display: none;">
				<span>Monthly</span>
				<span class="planRadio"></span>
				<span>
					<label class="label-switch switch-warning btnSwitch">
						<input type="checkbox" class="switch switch-bootstrap status" name="status" id="status" value="1" checked>
						<span class="lable"></span>
					</label>
					<strong>Yearly</strong>
					<span class="HighLight">(Best Value)</span>
				</span>
			</p>
			<div class="planPans">
				<div class="col-lg-3 col-md-1"></div>
				<div class="col-lg-6 col-md-10">
					<div class="basicPan col-xs-6">
						<h3>Basic</h3>
						<p class="IsActive @php if($isActive == 1) echo 'NonVis';@endphp">is Active</p>
						<div class="Amount">Free</div>
						<p>Lorem ipsum dolor sit amet edipiscing elit</p>
						<p>sed do eiusmod elpors labore et dolore</p>
						<p>magna siad enim aliqua</p>
					</div>
					<div class="proPan col-xs-6">
						<h3>Professional</h3>
						<p class="IsActive @php if($isActive == 0) echo 'NonVis';@endphp">is Active</p>
						<div class="Amount">$29</div>
						<p>Lorem ipsum dolor sit amet edipiscing elit</p>
						<p>sed do eiusmod elpors labore et dolore</p>
						<p>magna siad enim aliqua</p>
						<div class="btn btnPurchase" data-toggle="modal" data-target="#purchaseModal">PURCHASE
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-1"></div>
			</div>
		</div>
	</div>
</div>


<div id="purchaseModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog purchaseModal">
		<div class="modal-content">
			<form method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title">Stripe</h3>
				</div>
				<div class="modal-body" style="background-color: #eff2f5;">
					<table style="width: 100%;">
						<tr>
							<td><label for="cardNumber">Card number : </label></td>
							<td><label for="expDate">Expires : </label></td>
						</tr>
						<tr>
							<td>
								<input type="text" name="cardNumber" data-inputmask-mask="9999 9999 9999 9999" value="@php echo $cardNumber;@endphp;">
							</td>
							<td>
								<input type="text" name="expDate" data-inputmask-alias="mm/yyyy" data-inputmask="'yearrange': { 'minyear': '@php echo date('Y');@endphp'}">
							</td>
						</tr>
						<tr>
							<td>
								<label>Card code : </label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="cardCode" placeholder="CVC" data-inputmask-mask="999">
							</td>
							
						</tr>
					</table>
				</div>
				<div class="modal-footer" style="background-color: #eff2f5;">
					<button class="btn btn-primary" style="width: 100%;">CONFIRM</button>
				</div>
			</form>
		</div>
	</div>
</div>
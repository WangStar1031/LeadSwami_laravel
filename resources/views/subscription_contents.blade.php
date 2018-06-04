<style type="text/css">
	.subContents{
		position: absolute;
		top: 80px;
		margin-left: 100px;
		padding: 30px;
		color: black;
		font-size: 15px;
		width: calc( 100% - 100px);
	}
	.subMain{
		margin: auto;
		text-align: center;
	}
	.planOption p{
		margin-bottom: 30px;
	}
	.HighLight{
		color: #7291ff;
	}
	.basicPan{
		background-color: white;
		color: #989898;
		margin-top: 30px;
		padding-top: 30px;
		box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.16);
	}
	.basicPan .Amount, .proPan .Amount{
		font-size: 2em;
		padding: 15px;
		border-radius: 3px;
		margin: auto;
		margin-top: 40px;
		margin-bottom: 40px;
		width: 5em;
	}
	.basicPan .Amount{
		background-color: #f8f9fb;
	}
	.proPan .Amount{
		background-color: #756ecd;
	}
	.proPan{
		background-color: #716aca;
		color: white;
		padding-top: 60px;
	}
	.IsActive{
		font-size: 0.8em;
	}
	.Amount{
		margin: 30px;
	}
	.NonVis{
		visibility: hidden;
	}
	.proPan{
		padding-bottom: 90px;
	}
	.basicPan{
		padding-bottom: 100px;
	}
	.btnPurchase{
		margin: auto;
		margin-top: 30px;
		background-color: white;
		color: #7ab9fe;
		border-radius: 5px;
		width: 10em;
		padding: 10px;
		cursor: pointer;
	}
	.btnSwitch{
		position: relative;
		top: 5px;
		margin-left: 20px;
		margin-right: 20px;
	}
</style>
<div class="subContents row">
	<h2>Plans</h2>
	<div class="subMain">
		<form class="planOption" method="post">
			{{ csrf_field() }}
			<p>
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
			<div class="planPans row col-xs-12">
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
						<input type="submit" class="btnPurchase" value="PURCHASE">
					</div>
				</div>
				<div class="col-lg-3 col-md-1"></div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
</script>
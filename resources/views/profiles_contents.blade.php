
<div class="profileContents">
	<h2>Profile</h2>
	<form method="post" id="proForm">
		{{ csrf_field() }}
		<div class="col-xs-12" style="border: 1px solid #ddd; padding: 5px;">
			<div class="col-xs-12 col-md-8 col-lg-9">
				<input type="checkbox" name="allCheck" onchange="allCheckClicked()" id="allChk">
				<div class="btn" style="border: 1px solid #ddd;" onclick="btnDeleteClicked()"><i class="fa fa-trash-o"></i></div>
			</div>
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="input-group custom-search-form" style="border: 1px solid #ddd;">
					<input type="text" class="form-control" name="proSearch" placeholder="Search..." id="proSearch" style="border: none;">
					<span class="input-group-btn" onclick="btnSearchClicked()">
						<div class="btn btn-default-sm" style="border: 1px solid #ddd;">
							<i class="fa fa-search"></i>
						</div>
					</span>
				</div>
			</div>
			<input type="text" name="proIDs" style="display: none;" id="proIDs">
			<input type="text" name="proCat" style="display: none;" id="proCat">
		</div>
		<table class="proTable col-xs-12">
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Name</th>
					<th>LastName</th>
					<th>Headline</th>
					<th>Location</th>
					<th>Profile URL</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Last Job</th>
					<th>Twitter</th>
					<th>Site</th>
					<th>Tag</th>
				</tr>
			</thead>
			<tbody>
				@php
				for( $i = 0; $i < count($profiles); $i ++){
					$oneProfile = $profiles[$i];
				@endphp
				<tr>
					<td style="display: none;" class="proId">@php echo $oneProfile->Id;@endphp</td>
					<td><input type="checkbox" onclick="profileChecked(@php echo $i;@endphp)"></td>
					<td><img src="@php echo $oneProfile->ImgUrl;@endphp"  data-toggle="modal" data-target="#myModal" onclick="ImgOnClick(this)"></td>
					<td><input type="text" value="@php echo $oneProfile->Name;@endphp" title="@php echo $oneProfile->Name;@endphp"/></td>
					<td><input type="text" value="@php echo $oneProfile->LastName;@endphp" title="@php echo $oneProfile->LastName;@endphp"/></td>
					<td><input type="text" value="@php echo $oneProfile->Headline;@endphp" title="@php echo $oneProfile->Headline;@endphp"/></td>
					<td><input type="text" value="@php echo $oneProfile->Location;@endphp" title="@php echo $oneProfile->Location;@endphp"/></td>
					<td><a href="@php echo $oneProfile->Url;@endphp" target="_blank"><input type="text" value="@php echo $oneProfile->Url;@endphp" title="@php echo $oneProfile->Url;@endphp"/></a></td>
					<td><a href="mailto:@php echo $oneProfile->Email;@endphp?Subject=@php echo 'Hi. ' . $oneProfile->Name . ' ' .$oneProfile->LastName@endphp"><input type="text" value="@php echo $oneProfile->Email;@endphp" title="@php echo $oneProfile->Email;@endphp"/></a></td>
					<td><input type="text" value="@php echo $oneProfile->PhoneNumber;@endphp" title="@php echo $oneProfile->PhoneNumber;@endphp" /></td>
					<td><input type="text" value="@php echo $oneProfile->LastJob;@endphp" title="@php echo $oneProfile->LastJob;@endphp"/></td>
					<td><a href="@php echo $oneProfile->Twitter;@endphp" target="_blank"><input type="text" value="@php echo $oneProfile->Twitter;@endphp" title="@php echo $oneProfile->Twitter;@endphp"/></a></td>
					<td><a href="@php echo $oneProfile->Site;@endphp" target="_blank"><input type="text" value="@php echo $oneProfile->Site;@endphp" title="@php echo $oneProfile->Site;@endphp"/></a></td>
					<td><input type="text" value="@php echo $oneProfile->Tag;@endphp" title="@php echo $oneProfile->Tag;@endphp"/></td>
				</tr>
				@php
				}
				@endphp
			</tbody>
		</table>
	</form>
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<img class="img-responsive">
				</div>
			</div>
		</div>
	</div>

</div>

<script src='js/jquery.min.js'></script>
<script src='js/jquery.inputmask.bundle.js'></script>
<script src='js/all.js'></script>
<script type="text/javascript">
	$('.proTable input').click(function(){
		var strContent = $(this).val();
		console.log(strContent);
	});
	$('.proTable input').hover(function(){
		var strContent = $(this).val();
		console.log(strContent);
	}, function(){

	});
</script>
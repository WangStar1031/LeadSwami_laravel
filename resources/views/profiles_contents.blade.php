
<div class="profileContents">
	<h2>Profile</h2>
	<table class="proTable col-xs-12">
		<thead>
			<tr>
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
				<td><img src="@php echo $oneProfile->ImgUrl;@endphp"  data-toggle="modal" data-target="#myModal" onclick="ImgOnClick(this)"></td>
				<td>@php echo $oneProfile->Name;@endphp</td>
				<td>@php echo $oneProfile->LastName;@endphp</td>
				<td>@php echo $oneProfile->Headline;@endphp</td>
				<td>@php echo $oneProfile->Location;@endphp</td>
				<td><a href="@php echo $oneProfile->Url;@endphp" target="_blank">@php echo $oneProfile->Url;@endphp</a></td>
				<td><a href="mailto:@php echo $oneProfile->Email;@endphp?Subject=@php echo 'Hi. ' . $oneProfile->Name . ' ' .$oneProfile->LastName@endphp">@php echo $oneProfile->Email;@endphp</a></td>
				<td>@php echo $oneProfile->PhoneNumber;@endphp</td>
				<td>@php echo $oneProfile->LastJob;@endphp</td>
				<td><a href="@php echo $oneProfile->Twitter;@endphp" target="_blank">@php echo $oneProfile->Twitter;@endphp</a></td>
				<td><a href="@php echo $oneProfile->Site;@endphp" target="_blank">@php echo $oneProfile->Site;@endphp</a></td>
				<td>@php echo $oneProfile->Tag;@endphp</td>
			</tr>
			@php
			}
			@endphp
		</tbody>
	</table>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<img class="img-responsive">
			</div>
		</div>
	</div>
</div>

<script src='js/all.js'></script>
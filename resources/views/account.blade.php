<div class="accContents row">
	<form class="accDetails col-xs-5" method="post" action="/dashboard">
		{{ csrf_field() }}
		<h3>Account Details</h3>
		<p>Avatar</p>
		<img src="@php echo (App\Http\Controllers\UserInfoController::getUserAvatar($email) == '' ? 'img/avatar.png' : App\Http\Controllers\UserInfoController::getUserAvatar($email));@endphp"><br/>
		<label>First Name</label><br/>
		<input type="text" name="firstName" value="@php echo App\Http\Controllers\UserInfoController::getUserFirstName($email);@endphp">
		<br/>
		<label>Last Name</label><br/>
		<input type="text" name="lastName" value="@php echo App\Http\Controllers\UserInfoController::getUserLastName($email);@endphp">
		<br/>
		<label>Email</label><br/>
		<input type="text" name="eMail" value="@php	echo $email;@endphp" readonly>
		<br/>
		<input type="submit" name="submit" class="hoverBtn" value="SAVE">
	</form>
	<form class="passInfo col-xs-6" method="post" action="/changePassword">
		{{ csrf_field() }}
		<h3>Change password</h3>

		<p class="sucessMsg @php echo ($matching == 'changed' ? '' : 'HideItem');@endphp">Successfully changed!</p>
		<p class="wrongMsg @php echo ($matching == 'curPass' ? '' : 'HideItem');@endphp">Wrong password!</p>
		<p class="noMatchingMsg @php echo ($matching == 'Not Matching' ? '' : 'HideItem');@endphp">Not matching password!</p>

		<label>Current password</label><br/>
		<input type="password" name="curPassword"><br/>
		<a href="/forgotPassword">forgotPassword</a><br/>
		<label>New password</label><br/>
		<input type="password" name="newPassword" onkeyup="NewPassChange()"><br/>
		<p>
			<table>
				<tr style="display: none;">
					<td class="LowerCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One lowercase charactor</td>
					<td class="SpecChrTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One special charactor</td>
				</tr>
				<tr>
					<td class="UpperCaseTd" style="display: none;"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One uppercase charactor</td>
					<td class="StrLenCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>8 charactors minimum</td>
				</tr>
				<tr style="display: none;">
					<td class="NumberCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One number</td>
				</tr>
			</table>
		</p>
		<label>Comfirm password</label><br/>
		<input type="password" name="confirmPassword"><br/>
		<input type="submit" name="submit" class="hoverBtn" value="UPDATE">
	</form>
	<div class="col-xs-11">
		<div class="noteContents">
			Please Note: If you delete your account all your information and subscription will be permanently deleted, and your data collected will no longer be available.
			<form class="DelAcount" method="post" action="/delaccount">
				{{ csrf_field() }}
				<input type="submit" name="submit" class="hoverBtn" value="Delete account">
			</form>
		</div>
	</div>
</div>
<script src='js/all.js'></script>
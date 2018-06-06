<style type="text/css">
	.accContents{
		position: absolute;
		top: 80px;
		margin-left: 100px;
		padding: 30px;
		color: black;
		font-size: 15px;
		width: calc( 100% - 100px);
	}
	.accDetails img{
		width: 100px;
		border-radius: 100%;
		margin-bottom: 50px;
	}
	.accDetails h2, .passInfo h2{
		margin-bottom: 50px
	}
	.accContents label{
		margin-top: 20px;
		color: #989898;
	}
	.accContents input[type='text'], .passInfo input[type='password']{
		border: none;
		border-bottom: 1px solid #989898;
		width: 80%;
		padding-left: 10px;
	}
	.accContents input[type='submit']{
		margin-top: 20px;
		background-color: #4da2ff;
		border: none;
		border-radius: 5px;
		padding: 10px 20px 10px 20px;
		color: white;
	}
	input:focus{
		outline: none;
	}
	.noteContents{
		border-top: 1px solid #989898;
		margin-top: 30px;
		padding-top: 20px;
		color: #989898;
	}
	.DelAcount input{
		background-color: #f3f7fa !important;
		color: black!important;
	}
	.HideItem {
		display: none;
	}
	.passInfo i{
		margin-right: 10px;
	}
	.passInfo table td{
		padding: 10px;
		color: #989898;
	}
	.fa-check-circle-o{
		color: green;
	}
</style>
<div class="accContents row">
	<form class="accDetails col-xs-5">
		<h2>Account Details</h2>
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
		<input type="submit" name="submit" value="SAVE">
	</form>
	<form class="passInfo col-xs-6">
		<h2>Change password</h2>
		<label>Current password</label><br/>
		<input type="password" name="curPassword"><br/>
		<label>New password</label><br/>
		<input type="password" name="newPassword" onkeyup="NewPassChange()"><br/>
		<p>
			<table>
				<tr>
					<td class="LowerCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One lowercase charactor</td>
					<td class="SpecChrTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One special charactor</td>
				</tr>
				<tr>
					<td class="UpperCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One uppercase charactor</td>
					<td class="StrLenCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>8 charactors minimum</td>
				</tr>
				<tr>
					<td class="NumberCaseTd"><i class="fa fa-check-circle-o HideItem"></i><i class="fa fa-dot-circle-o"></i>One number</td>
				</tr>
			</table>
		</p>
		<label>Comfirm password</label><br/>
		<input type="password" name="confirmPassword"><br/>
		<input type="submit" name="submit" value="UPDATE">
	</form>
	<div class="col-xs-11 noteContents">
		Please Note: If you delete your account all your information and subscription will be permanently deleted, and your data collected will no longer be available.
		<form class="DelAcount" method="post" action="/delaccount">
			{{ csrf_field() }}
			<input type="submit" name="submit" value="Delete account">
		</form>
	</div>
</div>
<script type="text/javascript">
	function hasLowerCase(str) {
		return (/[a-z]/.test(str));
	}
	function hasUpperCase(str) {
		return (/[A-Z]/.test(str));
	}
	function hasSpecialChr(str){
		return (/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(str));
	}
	function hasNumberChr(str){
		return (/[0-9]/.test(str));
	}
	function has8Chrs(str){
		return str.length >= 8;
	}
	function NewPassChange(){
		var strPass = $("input[name=newPassword]").val();
		if( hasLowerCase(strPass)){
			$(".LowerCaseTd .fa-check-circle-o").removeClass("HideItem");
			$(".LowerCaseTd .fa-dot-circle-o").addClass("HideItem");
		} else{
			$(".LowerCaseTd .fa-check-circle-o").addClass("HideItem");
			$(".LowerCaseTd .fa-dot-circle-o").removeClass("HideItem");
		}
		if( hasUpperCase(strPass)){
			$(".UpperCaseTd .fa-check-circle-o").removeClass("HideItem");
			$(".UpperCaseTd .fa-dot-circle-o").addClass("HideItem");
		} else{
			$(".UpperCaseTd .fa-check-circle-o").addClass("HideItem");
			$(".UpperCaseTd .fa-dot-circle-o").removeClass("HideItem");
		}
		if( hasSpecialChr(strPass)){
			$(".SpecChrTd .fa-check-circle-o").removeClass("HideItem");
			$(".SpecChrTd .fa-dot-circle-o").addClass("HideItem");
		} else{
			$(".SpecChrTd .fa-check-circle-o").addClass("HideItem");
			$(".SpecChrTd .fa-dot-circle-o").removeClass("HideItem");
		}
		if( hasNumberChr(strPass)){
			$(".NumberCaseTd .fa-check-circle-o").removeClass("HideItem");
			$(".NumberCaseTd .fa-dot-circle-o").addClass("HideItem");
		} else{
			$(".NumberCaseTd .fa-check-circle-o").addClass("HideItem");
			$(".NumberCaseTd .fa-dot-circle-o").removeClass("HideItem");
		}
		if( has8Chrs(strPass)){
			$(".StrLenCaseTd .fa-check-circle-o").removeClass("HideItem");
			$(".StrLenCaseTd .fa-dot-circle-o").addClass("HideItem");
		} else{
			$(".StrLenCaseTd .fa-check-circle-o").addClass("HideItem");
			$(".StrLenCaseTd .fa-dot-circle-o").removeClass("HideItem");
		}
	}
</script>

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

function CardNumber2Code(){
	console.log($("input[name='payCode']"));
	if( $("input[name='payCode']").length == 0 )
		return;
	var strCardNumber = $("input[name='payCode']").val();
	if(strCardNumber.length == 16){
		var strLast4Digit = strCardNumber.substr(strCardNumber.length - 4);
		var strCode = 'XXXX XXXX XXXX ' + strLast4Digit;
		$("#payCode").val(strCode);
	}
}
// data-inputmask="'mask': '9999 9999 9999 9999'"
CardNumber2Code();
function btnEditClicked() {
	$("#payCode").attr('readonly', false);
	$("#payCode").val($("input[name='payCode']").val());
	$("#payCode").inputmask();
	// $(":input").inputmask();
	$(".btnEdit").hide();
	$(".btnDelCard").hide();
	$(".btnCardNumSave").show();
	$(".btnCardNumCancel").show();
}
function btnDelCardClicked(){
	$("#payCode").val("");
	$("input[name='payCode']").val("");
	document.getElementById("payDetails").submit();
}
function btnCardNumSaveClicked(){
	var strCode = $("#payCode").val().replace(/ /g, '');
	strCode = strCode.replace(/_/g, '');
	// var strCardNumber = $("input[name='payCode']").val();
	if( strCode.length != 16){
		alert('Invalid card number!');
		return;
	}
	$("input[name='payCode']").val(strCode);
	$("#payCode").inputmask('remove');
	$("#payCode").attr('readonly', true);
	strCode = 'XXXX XXXX XXXX ' + strCode.substr(strCode.length - 4);
	$("#payCode").val(strCode);
	$(".btnEdit").show();
	$(".btnDelCard").show();
	$(".btnCardNumSave").hide();
	$(".btnCardNumCancel").hide();
	$("#payMethod").submit();
}
function btnCardNumCancelClicked() {
	$("#payCode").inputmask('remove');
	$("#payCode").attr('readonly', true);
	var strCardNumber = $("input[name='payCode']").val();
	strCode = 'XXXX XXXX XXXX ' + strCardNumber.substr(strCardNumber.length - 4);
	$("#payCode").val(strCode);
	$(".btnEdit").show();
	$(".btnDelCard").show();
	$(".btnCardNumSave").hide();
	$(".btnCardNumCancel").hide();
}

function ImgOnClick(_this){
	var strUrl = _this.getAttribute('src');
	$(".img-responsive").attr('src', strUrl);
}
function centerModal() {
	$(this).css('display', 'block');
	var $dialog = $(this).find(".modal-dialog");
	var offset = ($(window).height() - $dialog.height()) / 2;
	$dialog.css("margin-top", offset);
}

$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
	$('.modal:visible').each(centerModal);
});

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
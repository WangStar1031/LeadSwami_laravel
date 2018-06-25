
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
CardNumber2Code();
function btnEditClicked() {
	$("#payCode").attr('readonly', false);
	$("#payCode").val($("input[name='payCode']").val());
	$(":input").inputmask();
}
function payCodeEditing() {
	$("input[name='payCode']").val($("#payCode").val().replace(/ /g, ''));
}
function btnDelCardClicked(){
	$("#payCode").val("");
	$("input[name='payCode']").val("");
	document.getElementById("payDetails").submit();
}
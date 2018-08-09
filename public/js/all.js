function BtnLoginClicked(){
    $(".flex-center").hide();
    $(".loader").show();
}


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
function allCheckClicked(){
	var isChecked = $("#allChk").prop('checked');
	var arrTrs = $(".profileContents form .proTable tbody tr");
	for( var i = 0; i < arrTrs.length; i++){
		var curTr = arrTrs.eq(i);
		var chkBox = curTr.find("input");
		chkBox.prop('checked', isChecked);
	}
}
function profileChecked(_index){
	$("#allChk").prop('checked', true);
	var arrTrs = $(".profileContents form .proTable tbody tr");
	for( var i = 0; i < arrTrs.length; i++){
		var curChkBox = arrTrs.eq(i).find("input");
		if( curChkBox.prop('checked') == false){
			$("#allChk").prop('checked', false);
			break;
		}
	}
}
function btnDeleteClicked(){
	$("#proCat").val("delete");
	var arrTrs = $(".profileContents form .proTable tbody tr");
	var arrSelEmails = [];
	for( var i = 0; i < arrTrs.length; i++){
		var curChkBox = arrTrs.eq(i).find("input");
		if( curChkBox.prop('checked')){
			arrSelEmails.push( arrTrs.eq(i).find('.proId').html());
		}
	}
	if( arrSelEmails.length == 0)
		return;
	$("#proIDs").val(arrSelEmails.join(","));
	$("#proForm").submit();
}
function btnSearchClicked(){
	$("#proCat").val("search");
	if($("#proSearch").val() == ''){
		return;
	}
	$("#proForm").submit();
}
function proHeaderClicked(_index){
	var orderDir = "ASC";
	if( $(".orderDir").eq(_index).hasClass('proActive')){
		if( $(".orderDir").eq(_index).hasClass('proAsc')){
			orderDir = "DESC";
		}
	}
	$("#proCat").val("sort");
	$("#proIDs").val(_index + "," + orderDir);
	$("#proForm").submit();
}
$(document).ready(function(){
	$(":input[data-inputmask-mask]").inputmask();
	$(":input[data-inputmask-alias]").inputmask();

});

var form = document.getElementById('payment-form');
Stripe.setPublishableKey( stripeCode);
// Stripe.setPublishableKey('pk_test_9510pekGAiRdqBppmoFN6cR5');
function confirmClicked(){
	$("#payment-form").find(".payment-errors").hide();
	var expDate = $("input[name='expDate']").val();
	var arrDate = expDate.split("/");
	var exp_month = arrDate[0];
	var exp_year = arrDate[1];
	Stripe.card.createToken({
		number: $("input[name='cardNumber']").val(),
		cvc: $("input[name='cardCode']").val(),
		exp_month: exp_month,
		exp_year: exp_year
	}, stripeResponseHandler);	
}
function stripeResponseHandler(status, response){
	var $form = $("#payment-form");
	console.log( status);
	console.log( response);
	if( response.error){
		$form.find(".payment-errors").html(response.error.message);
		$form.find(".payment-errors").show();
	}else{
		var token = response.id;
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));
		$form.get(0).submit();
	}
}
function sideSettingClicked(){
	if(!$(".settingMenu").hasClass("subMenuOption")){
		$(".settingMenu").addClass("subMenuOption");
		$(".subMenu").removeClass("HideItem");
	}
}
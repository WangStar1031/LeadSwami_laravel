
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
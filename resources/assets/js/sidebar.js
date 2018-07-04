function sideSettingClicked(){
	if(!$(".settingMenu").hasClass("subMenuOption")){
		$(".settingMenu").addClass("subMenuOption");
		$(".subMenu").removeClass("HideItem");
	}
}
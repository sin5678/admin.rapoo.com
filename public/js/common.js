
$(function(){
	
	//信息框隐藏
	messageTimeOut('#rapoo-system-message');
	
	//菜单激活效果
	lightUpMenu('.lightup');
})




function messageTimeOut( ob , out = 3000 ){
	var tStop = '';
	tStop = setTimeout(function(){
		$(ob).fadeOut();
		clearTimeout(tStop);
	},out);
}

function lightUpMenu(o){
	$(o).parent().parent().addClass('active');
}
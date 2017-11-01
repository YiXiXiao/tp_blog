


$(function (){
	$("input[name='flag']").click(function (){
		if($(this).attr('checked')){
			$(".tables").attr('checked',true);
		}else{
			$(".tables").attr('checked',false);
		}
	});
});
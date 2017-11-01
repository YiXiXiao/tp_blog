function tog_table(index){
	for(var i=0;i<3;i++){
		$("#table_"+i).css({'display':'none'});
	}
	if(index==2){
		$("#table_"+index).parent().css({'display':'none'});
	}
	$("#table_"+index).css({'display':'block'});
}
$(function (){
	$("select[name='g_kind']").change(function (){
		var index=this.value;
		tog_table(index);
	});
});
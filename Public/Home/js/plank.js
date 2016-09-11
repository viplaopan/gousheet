$(function() {
	
	//材质
	$('#caizhi a').click(function() {
		$("input[name='caizhi']").val($(this).html());
		$idstr = $(this).parent().parent().attr('id');
		$(this).parent().parent().removeClass('show');

		$("#" + $idstr + "Li").removeClass('show')
	})

	//表面
	$('#biaomian a').click(function() {
		$("input[name='biaomian']").val($(this).html());
		$idstr = $(this).parent().parent().attr('id');
		$(this).parent().parent().removeClass('show');

		$("#" + $idstr + "Li").removeClass('show')
	})

	//表面
	$('#changjia a').click(function() {
		$("input[name='changjia']").val($(this).html());
		$idstr = $(this).parent().parent().attr('id');
		$(this).parent().parent().removeClass('show');

		$("#" + $idstr + "Li").removeClass('show')
	})

	//城市
	$('#chengshi a').click(function() {
		$("input[name='chengshi']").val($(this).html());
		$idstr = $(this).parent().parent().attr('id');
		$(this).parent().parent().removeClass('show');

		$("#" + $idstr + "Li").removeClass('show')
	})
})
$(function() {
	//品种
	$('#pinzhong a').click(function() {
		$("input[name='pinzhong']").val($(this).html());
		$idstr = $(this).parent().attr('id');
		$(this).parent().removeClass('show');
		$("#" + $idstr + "Li").removeClass('show')
	})

	//材质
	$('#caizhi a').click(function() {
		$("input[name='caizhi']").val($(this).html());
		$idstr = $(this).parent().parent().attr('id');
		$(this).parent().parent().removeClass('show');

		$("#" + $idstr + "Li").removeClass('show')
	})
})
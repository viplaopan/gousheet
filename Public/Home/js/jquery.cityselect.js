(function($){
	
	$.fn.citySelect=function(settings){		
		//if(this.length<1){return;};

		// 默认值
		settings=$.extend({
			city_json:null,
			area_json:null,
			prov_json:null
		},settings);
		var box_obj=this;
		//城市默认值
		var prov_obj=box_obj.find(".prov");
		var city_obj=box_obj.find(".city");
		var area_obj=box_obj.find(".area");
		
		
		//读取城市JSON
		var city_json = settings.city_json;
		var area_json = settings.area_json;
		var prov_json = settings.prov_json;
		
		//设置默认值
		var city_val = city_obj.attr('value');
		var area_val = area_obj.attr('value');
		var prov_val = prov_obj.attr('value');
		
		prov_obj.change(function(){
			prov_val = $(this).val();
			cityStart();
		})
		//给城市复制Click
		city_obj.find('.dropdown-menu').on("click","li", function() {
		    var self = $(this);
			var labelId = self.parent().attr('aria-labelledby');			
			var labelInfo = self.attr('label');
			var labelValue = self.attr('value');
			//更新 城市选择
			box_obj.find("input[name='city']").val(labelValue);
			city_val = labelValue;
			$('#' + labelId).html(labelInfo);
			//地区
			areaStart();
			
			//删除其他选中值
			area_obj.find("input[name='area']").val(0);
			area_obj.find("button[type='button']").html('区');
		});
		//给区复制Click
		area_obj.find('.dropdown-menu').on("click","li", function() {
		    var self = $(this);
			var labelId = self.parent().attr('aria-labelledby');			
			var labelInfo = self.attr('label');
			var labelValue = self.attr('value');
			//更新 城市选择
			box_obj.find("input[name='area']").val(labelValue);
			area_val = labelValue;
			$('#' + labelId).html(labelInfo);
			//城市
			tradingStart();
			
			
		});
		
		// 赋值省份函数
		var provStart=function(){
			//输出城市
			prov_obj.html('');
			prov_obj.append('<option value="">请选择</option>');
			var selectStr = ''
			$.each(prov_json,function(i,item){
				if(item.region_id == prov_val){
					selectStr = 'selected';
				}else{
					selectStr = '';
				}
				prov_obj.append('<option ' + selectStr + ' value="' + item.region_id + '">' + item.region_name + '</option>');					
			})
		};
		// 赋值市级函数
		var cityStart=function(){
			//输出城市
			city_obj.html('');
			city_obj.append('<option value="">请选择</option>')
			var selectStr = '';
			
			$.each(city_json,function(i,item){
				//设置默认值
				if(prov_val == item.parent_id){
					if(item.region_id == city_val){
						selectStr = 'selected';
					}else{
						selectStr = '';
					}
					city_obj.append('<option ' + selectStr + ' value="' + item.region_id + '">' + item.region_name + '</option>');				
				}
				
			})
		};
		// 赋值区级函数
		var areaStart=function(){
			
			area_obj.find('.dropdown-menu').html('')
			$.each(area_json,function(i,item){
				if(city_val == item.parent_id){
					//设置默认值
					if(area_val == item.region_id){
						var labelId = area_obj.find('.dropdown-menu').attr('aria-labelledby');			
						$('#' + labelId).html(item.region_name);
					}
					area_obj.find('.dropdown-menu').append('<li value="' + item.region_id + '" label="' + item.region_name + '">' + item.region_name + '</li>');			
				}
			})
		};
		

		
		var init=function(){

			provStart();
			cityStart();
			//默认载入城市
			//cityStart();	
			//设置默认值
			//if(city_val>0){
				//areaStart();
				//tradingStart();
			//}
		};
		//执行函数
		init();
	};
})(jQuery);
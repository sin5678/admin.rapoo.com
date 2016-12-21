
		$('#productCode').on('change',function(e){
			var model_PID = $(this).val();
			
			$.post(url, { id : model_PID , _token : token},function(data){
				 $('#showColors').html(data.colors);
			});
		});
		
		$('#areas input:radio').click(function(){
			if( $(this).attr('areaid') == 10 ){
				$('#countries input:checkbox').prop('checked',true);
			} else {
				var aid = 'area_'+$(this).attr('areaid');
				$('#countries input:checkbox').each(function(e){
					if($(this).attr(aid) == "true"){ $(this).prop('checked',true); } else { $(this).prop("checked", false); }
				});
			}
		});

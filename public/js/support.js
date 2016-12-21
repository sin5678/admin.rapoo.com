$(function(){
	
	$('#feedbackForm input').keyup(function(){
		checkFeedbackForm();
	});
	
	$('#feedbackSubmit').click(function(){
		if(checkFeedbackForm()){
			ajaxFeedback('#feedbackForm');
		}
	});
	
	$('.mapsearch').click(function(){
		mapSearcher($(this));
	});
		
})
	
	function ajaxFeedback(ob){

		$.post( $(ob).attr('action'), { 
			real_name	:$(':input[name=real_name]').val(),
			tel			:$(':input[name=tel]').val(),
			email		:$(':input[name=email]').val(),
			message		:$(':input[name=message]').val(),
			qq			:$(':input[name=qq]').val(),
			_token		:token
			},function(d){
				
			 if(d.status){

				$('#feedbackForm').hide();
				$('#feedbackForm input').val('');
				$('#feedbackOk').html( d.msg );
			 } else {
				 alert( d.msg );
			 }
		});
	}

	function mapSearcher(ob){
		var addr = ob.attr('mapsearch');
		$('#search-input').val(addr);
		$('#mapSearchSubmit').click();
		$('html,body').animate({scrollTop: $("#search-input").offset().top}, 300);
	}
	
	function checkFeedbackForm(){
		var real_name = $(':input[name=real_name]').val();
		var real_name_error = $(':input[name=real_name]').attr('msg');
		var telphone = $(':input[name=tel]').val();
		var telphone_error = $(':input[name=tel]').attr('msg');
		var email = $(':input[name=email]').val();
		var email_error = $(':input[name=email]').attr('msg');
		var qq = $(':input[name=qq]').val();
		var qq_error = $(':input[name=qq]').attr('msg');
		var message = $(':input[name=message]').val();
		var message_error = $(':input[name=message]').attr('msg');
		var error = '';

		if(real_name.length < 1 || real_name.length > 20 ){
			error += real_name_error+'<br />';
		}

		if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != 0){
			error += email_error+'<br />';
		}

		if(message.length < 6){
			error += message_error+'<br />';
		}
		
		$('#feedbackNotice').html(error); 
		if(error != ''){
			return false;
		} else {
			return true;
		}
		
	}
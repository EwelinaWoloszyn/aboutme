$(document).ready(function() {
	$(".default").each(function(){
		var defaultVal = $(this).attr('title');
		$(this).focus(function(){
			if ($(this).val() == defaultVal){
				$(this).removeClass('active').val('');
			}
		});
		$(this).blur(function() {
			if ($(this).val() == ''){
				$(this).addClass('active').val(defaultVal);
			}
		})
		.blur().addClass('active');
	});
	$('.submit-button').click(function(e){
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		defaulttextRemove();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		$('li',$formId).removeClass('contact-form-error');
		$('span.contact-form-error').remove();
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if(inputVal == ''){
				$parentTag.addClass('contact-form-error').append('<span class="contact-form-error">Required field</span>');
			}
			if($(this).hasClass('email') == true){
				if(!emailReg.test(inputVal)){
					$parentTag.addClass('contact-form-error').append('<span class="contact-form-error">Enter a valid email address.</span>');
				}
			}
		});
		if ($('span.contact-form-error').length == "0") {
			$formId.append($loading.clone());
			$('fieldset',$formId).hide();
			$.post(formAction, $formId.serialize(),function(data){
				$('.loading').remove();
               $formId.append(data).fadeIn();
        	});
		}
		e.preventDefault();
	});

function defaulttextRemove(){
	$('.default').each(function(){
		var defaultVal = $(this).attr('title');
		if ($(this).val() == defaultVal){
			$(this).val('');
		}
	});
}
});
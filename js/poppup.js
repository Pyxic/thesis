// открыть по кнопке
$('.js-button-campaign').click(function() {
	$('#addSub').attr('id','addTask'); 
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});
$('.js-button-part').click(function() { 
	$('.js-overlay-part').fadeIn();
	$('.js-overlay-part').addClass('disabled');
	$('body').addClass('stop-scrolling');
});
$(document).on('click','.addSubTask',function(){
	let number = $(this).parent().index();
	let indexTask=$(this).parent().attr('data-index');
	console.log(indexTask);
	$('#addTask').attr('id','addSub');
	$('#addSub').attr('data-ind',indexTask);
	console.log($('#addSub').attr('data-ind'));
	$('#addSub').attr('data-number',number);
	console.log($('#addSub').attr('data-number'));
	$('#taskName').val('');
	$('#taskStart').val('');
	$('#taskEnd').val('');
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});

// закрыть на крестик
$('.js-close-campaign').click(function() { 
	$('.js-overlay-campaign').fadeOut();
	
});
$('.js-close-part').click(function() { 
	$('.js-overlay-part').fadeOut();
	$('body').removeClass('stop-scrolling');
	
});

$('.js-close-leader').click(function() { 
	$('.js-overlay-leader').fadeOut();
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});

$('.js-button-leader').click(function(){
	$('.js-overlay-campaign').fadeOut();
	$('.js-overlay-leader').fadeIn();
	$('.js-overlay-leader').addClass('disabled');
});
// Модальное окно

// открыть по кнопке
$('.js-button-campaign').click(function() { 
	
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});

// закрыть на крестик
$('.js-close-campaign').click(function() { 
	$('.js-overlay-campaign').fadeOut();
	
});
$('.js-button-part').click(function() { 
	
	$('.js-overlay-part').fadeIn();
	$('.js-overlay-part').addClass('disabled');
	$('body').addClass('stop-scrolling');
});

// закрыть на крестик
$('.js-close-part').click(function() { 
	$('.js-overlay-part').fadeOut();
	$('body').removeClass('stop-scrolling');
	
});
$('.js-close-leader').click(function() { 
	$('.js-overlay-leader').fadeOut();
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});

// закрыть по клику вне окна
// $(document).mouseup(function (e) { 
// 	var popup = $('.js-popup-campaign');
// 	if (e.target!=popup[0]&&popup.has(e.target).length === 0){
// 		$('.js-overlay-campaign').fadeOut();
		
// 	}
// });
$('.js-button-leader').click(function(){
	$('.js-overlay-campaign').fadeOut();
	$('.js-overlay-leader').fadeIn();
	$('#result').slideDown(0);
	$('#result2').empty();
	$('.js-overlay-leader').addClass('disabled');
});

$('.btnAddUserDepart').on("click",function(){
	let Data = { "departId" :$(this).attr("data-departId")};
	$('#addPartic').empty();
	$('#addPartic').append("<span class='forDepart' data-departId="+$(this).attr("data-departId")+"></span>");
	$.ajax({
		url:"/diplom/index.php/participants/addToDepart",
		method:"POST",
		contentType:"application/x-www-form-urlencoded; charset=UTF-8",
		dataType: "json",
		data: Data,
		success:function(data){
			$.each(data, function(index,val){
				$('#addPartic').append(" <li class='nopart'> <a href='' style='pointer-events: none;'> <span class='fa fa-tasks nameEmploy' data-userId ='"+val['userID']+"'>"+ val['name']+" "+val['serName']+"</span></a></li>");
			});
		}

	});
	$('.js-overlay-partic').fadeIn();
	location.hash = "scrollPart";
	$('.js-overlay-partic').addClass('disabled');
});

$('.js-close-partic').click(function() { 
	$('.js-overlay-partic').fadeOut();	
});

$('.employ').on("click",function(){
	console.log('employ');
	let number = $(this).index();
	let name  = $(this).find('.nameEmploy').text();
	let initials = name.split(" ");
	let initial = initials[0].substr(0,1)+initials[1].substr(0,1);
	$('.photoEmployee').text(initial);
	let id = $(this).find('.nameEmploy').attr('data-userId');
	$('#nameHead').attr('data-userId',id);
	$('#nameHeadInput').val(name);
	$('#nameHead').html(name);
	$('.js-overlay-leader').fadeOut();
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
});
$('#result2').on('click','.search',function(){
	let name  = $(this).find('.nameEmploy').text();
	let initials = name.split(" ");
	let initial = initials[0].substr(0,1)+initials[1].substr(0,1);
	$('.photoEmployee').text(initial);
	let id = $(this).find('.nameEmploy').attr('data-userId');
	$('#nameHead').attr('data-userId',id);
	$('#nameHeadInput').val(name);
	$('#nameHead').html(name);
	$('.js-overlay-leader').fadeOut();
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
  });
$('#addPartic').on("click",".nopart",function(){
	let Data = { "id":$(this).find('.nameEmploy').attr('data-userId'),
				"departId":$('.forDepart').attr('data-departId')};
	$.ajax({
		url:"/diplom/index.php/participants/addInDepart",
		method:"POST",
		contentType:"application/x-www-form-urlencoded; charset=UTF-8",
		dataType: "json",
		data: Data,
		success: function(data){
			if(data['command']=="error"){
				let bool = confirm(data['error']);
				if(bool==true){
					document.location.href = "/diplom/index.php/participants/changeDepart/"+Data["id"]+"/"+Data['departId'];
				}
			}else{
				document.location.reload();
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); alert("Error: " + errorThrown);
		} 
	});
});
$('.part').on("click",function(){
	let name  = $(this).find('.nameEmploy').text();
	let id = $(this).find('.nameEmploy').attr('data-userId');
	let projectId = $(this).find('.nameEmploy').attr('data-projectId');
	$.ajax({  
		url:"/diplom/index.php/projects/addProjectPart", 
		method:"POST",  
		data:{Id : id,projectId : projectId},  
		dataType: "json",     
		success:function(data)  
		{ 
		  if(data['command']==1){
			 document.location.reload();
		  }else{
			  alert(data['error']);
		  }
		},
		error:function(){
			alert('error');
		}
	});  
});
// открыть по таймеру 
// $(window).on('load', function () { 
// 	setTimeout(function(){
// 		if($('.js-overlay-campaign').hasClass('disabled')) {
// 			return false;
// 		} else {
			
// 			$(".js-overlay-campaign").fadeIn();
// 		}
// 	}, 5000);
// });


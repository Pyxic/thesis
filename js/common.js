(function() {
  
	let app = {
		
		initialize : function () {			
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
            $('form').on('submit',app.submitForm);
            //$('form').on('keydown','input',app.removeError);
            $(document).on('click',app.removeError);
		},
 
		submitForm: function (e) {
            e.preventDefault();
            let form = $(this);
            if(app.validateForm(form) == false){
                return false;
            }
            let str = form.serialize();
            console.log(str);
            $.ajax({  
                url: $(form).attr('action'), 
                method:"POST",  
                contentType:"application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "text",
                data: str,    
                success:function(data2)  
                { 
                    let data = JSON.parse(data2);
                    console.log(data['command']);
                    if(data['command']==1){
                        document.location.href = data['location'];
                    }else if(data['command']=='reload'){
                        document.location.reload();
                    } 
                    else if(data['command']=='error'){
                        $('#datepickerStart').val('');
                        $('#datepickerEnd').val('');
                        if(data['alert']==true){
                            alert(data['error']);
                        }
                        $('.error').empty();
                        $('.error').append(data['error']);
                    }
                }
            });
			// some actions here
			// this === app ( $.proxy help with it)
        },
        validateForm: function(form){
            let inputs = form.find('input'),
                valid = true;
                inputs.tooltip('dispose');
                console.log(inputs);
            $.each(inputs,function(index,vals){
                let input = $(vals),
                    type = $(vals).attr('type'),
                    clas = $(vals).attr('class'),
                    val = input.val(),
                    formGroup = input.parents('.form-group'),
                    label = formGroup.find('label').text().toLowerCase(),
                    textError = 'Введите ' + label;
                console.log(clas);
                if(val == 0 && type!='radio' && type!="hidden" && clas!="form-control form-control-sm inputCreateDepart" &&clas!="form-control noImportant"){
                    formGroup.addClass('invalid').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: textError
                    }).tooltip('show');
                    valid = false
                }else{
                    formGroup.addClass('has-success').removeClass('invalid');
                }
            });
            return valid;
        },
        removeError: function(){
            $('form').find('input').tooltip('dispose');
        }	
    }
 
	app.initialize();
 
}());
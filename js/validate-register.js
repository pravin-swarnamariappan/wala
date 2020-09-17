// JavaScript Validation For Registration Page

$('document').ready(function()
{

		 // name validation
		 var nameregex = /^[a-zA-Z ]+$/;

		 $.validator.addMethod("validname", function( value, element ) {
		     return this.optional( element ) || nameregex.test( value );
		 });

		 // valid email pattern
		 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		 $.validator.addMethod("validemail", function( value, element ) {
		     return this.optional( element ) || eregex.test( value );
		 });

		 $("#register-form").validate({

		  rules:
		  {
				full_name: {
					required: true,
					validname: true,
					minlength: 2
				},
				phone: {
					required: true,
					number: true,
					minlength: 9
				},
				email : {
				required : true,
				validemail: true,
				remote: {
					url: "check-email.php",
					type: "post",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				}
				},
				password: {
					required: true,
					minlength: 6,
					maxlength: 15
				},
				cpassword: {
					required: true,
					equalTo: '#password'
				},
		   },
		   messages:
		   {
				full_name: {
					required: "First name is required",
					validname: "Name must contain only alphabets and space",
					minlength: "your name is too short"
					  },
				phone: {
					required: "Phone Number is required",
					number: "Name must contain only alphabets and space",
					minlength: "at least 9 digits"
					  },
				email : {
				required : "Email is required",
				validemail : "Please enter valid email address",
				remote : "Email already exists"
			},
				password:{
					required: "Password is required",
					minlength: "Password at least have 6 characters"
					},
				cpassword:{
					required: "Retype your password",
					equalTo: "Password did not match !"
					}
		   },
		   errorPlacement : function(error, element) {
			  $(element).closest('.form-group').find('.help-block').html(error.html());
		   },
		   highlight : function(element) {
			  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		   },
		   unhighlight: function(element, errorClass, validClass) {
			  $(element).closest('.form-group').removeClass('has-error');
			  $(element).closest('.form-group').find('.help-block').html('');
		   },
				submitHandler: submitForm
		   });


		   function submitForm(){

			   $.ajax({
			   		url: 'ajax-register.php',
			   		type: 'POST',
			   		data: $('#register-form').serialize(),
			   		dataType: 'json'
			   })
			   .done(function(data){

			   		$('#btn-signup').html('<img src="ajax-loader.gif" /> &nbsp; Registering...').prop('disabled', true);
			   		$('input[type=text],input[type=email],input[type=password]').prop('disabled', true);

			   		setTimeout(function(){

						if ( data.status==='success' ) {

							$('#errorDiv').slideDown('fast', function(){
								$('#errorDiv').html('<div class="alert alert-info">'+data.message+'</div>');
								$("#register-form").trigger('reset');
								$('input[type=text],input[type=email],input[type=password]').prop('disabled', false);
								$('#btn-signup').html(' Register').prop('disabled', false);
							}).delay(4000).slideUp('fast');


					    } else {

						    $('#errorDiv').slideDown('fast', function(){
						      	$('#errorDiv').html('<div class="alert alert-danger">'+data.message+'</div>');
							  	$("#register-form").trigger('reset');
							  	$('input[type=text],input[type=email],input[type=password]').prop('disabled', false);
							  	$('#btn-signup').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign Me Up').prop('disabled', false);
							}).delay(3000).slideUp('fast');
						}

					},3000);

			   })
			   .fail(function(){
			   		$("#register-form").trigger('reset');
			   		alert('An unknown error occoured, Please try again Later...');
			   });
		   }
});

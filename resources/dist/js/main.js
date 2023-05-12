(function($) {



    var form = $("#signup-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            email: {
                email: true
            }
        },
        onfocusout: function(element) {
            $(element).valid();
        },
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        titleTemplate: '<div class="title"><span class="step-number">#index#</span><span class="step-text">#title#</span></div>',
        labels: {
            previous: 'Previous',
            next: 'Next',
            finish: 'Finish',
            current: ''
        },
         
 
        onStepChanging: function(event, currentIndex, newIndex) {
            
            var currentStepForm = $(this).find("fieldset").eq(currentIndex);

            // Check if all required fields in the current step are filled in
            var isValid = true;
            // return true;
            currentStepForm.find('.required').each(function() {
                const rowAnswered = checkIfQuestionAnswered($(this).closest('.form-row'));
                if (!rowAnswered) {
                    isValid = false;
                    return isValid;
                }
                // console.log('s',$(this).closest('.form-row').find('input').val());
                // if($(this).closest('.form-row').find('input').val()=='')
                // //check all input widout radio and checkbox because had default value
                // {
                //        isValid = false;
                //        return false; // break out of each loop
                 
                // }
                // else if (
                //  $(this).closest('.form-row').find('input:checked').length === 0 
                // ) {
                //     isValid = false;
                //     return false; // break out of each loop
                // }
                // if ($(this).closest('.form-row').find('input[type="checkbox"]') &&
                //     $(this).closest('.form-row').find('input[type="checkbox"]:checked').length === 0
                // ) {
                //     isValid = false;
                //     return false; // break out of each loop
                // }
                // if ($(this).closest('.form-row').find('input[type="radio"]')!=undefined &&
                //     $(this).closest('.form-row').find('input[type="radio"]:checked').length === 0
                // ) {
                //     isValid = false;
                //     return false; // break out of each loop
                // }
                // if ($(this).closest('.form-row').find('input[type="number"]') !=undefined &&
                // $(this).closest('.form-row').find('input[type="number"]').val()==''
                // ) {
                //     isValid = false;
                //     return false; // break out of each loop
                // }
                // if (
                // $(this).closest('.form-row').find('input[type="text"]')!=undefined &&
                // $(this).closest('.form-row').find('input[type="text"]').val()==''
                // ) {
                //     isValid = false;
                //     return false; // break out of each loop
                // }
            });

            if (isValid) {
                // If all required fields are filled in, proceed to the next step
                return true;
            } else {
                // If any required fields are not filled in, prevent moving to the next step
                // alert('Please fill in all required fields.');
                Swal.fire({
                    title: 'Error!',
                    text: 'Please Answer all required Questions.',
                    icon: 'error',
                    confirmButtonText:'Ok',
                    customClass: "btn-sweet-alert",
                })
                return false;
            }
           
            // form.validate().settings.ignore = ":disabled,:hidden";
            // return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            // alert('Submited');
            Swal.fire({
                title: 'Success!',
                text: 'Success I contact with you',
                icon: 'success',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3085d6',
            }).then(() => {
                window.location.reload();
            })
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            if (currentIndex === 5) {
                Swal.fire({
                title: 'Ai Product Finder!',
                html: 'Finding Best Match <b></b> Please wait.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                    $("#servicex").removeClass("hidden");

                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                }
                })

                let timerInterval

            }
            else {
                $("#servicex").addClass("hidden");

            }
            return true;
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "required",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });

    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: '',
        monthDefault: '',
        yearDefault: '',
        minimumAge: 0,
        maximumAge: 120
    });
    var marginSlider = document.getElementById('slider-margin');
    if (marginSlider != undefined) {
        noUiSlider.create(marginSlider, {
              start: [5000],
              step: 100,
              connect: [true, false],
              tooltips: [true],
              range: {
                  'min': 100,
                  'max': 15000
              },
              pips: {
                    mode: 'values',
                    values: [100, 15000],
                    density: 4
                    },
                format: wNumb({
                    decimals: 0,
                    thousand: '',
                    prefix: '$ ',
                })
        });
        var marginMin = document.getElementById('value-lower'),
	    marginMax = document.getElementById('value-upper');

        marginSlider.noUiSlider.on('update', function ( values, handle ) {
            if ( handle ) {
                marginMax.innerHTML = values[handle];
            } else {
                marginMin.innerHTML = values[handle];
            }
        });
    }
})(jQuery);

function checkIfQuestionAnswered(row) {
    // Check for radio buttons
    const radios = row.find('input[type="radio"]');
    let radios_name='';
    let answered = false;
    for (let i = 0; i < radios.length; i++) {
        if(radios_name=='' || radios[i].name!=radios_name){
            if (radios[i].checked) {
                answered = true;
                radios_name=radios[i].name;
                break;
            }
        }
    }
   
    // Check for checkboxes
    const checkboxes = row.find('input[type="checkbox"]');
    let checkboxes_name='';
    for (let i = 0; i < checkboxes.length; i++) {
        if(checkboxes_name=='' || checkboxes[i].name!=checkboxes_name){
            if (checkboxes[i].checked) {
                answered = true;
                checkboxes_name=checkboxes[i].name;
                break;
            }
        }
        
    }
    // Check for input number
    const number_inputs = row.find('input[type="number"]');
    let number_input_name='';
    for (let i = 0; i < number_inputs.length; i++) {
        if(number_input_name=='' || number_inputs[i].name!=number_input_name){
            if (number_inputs[i].value!='') {
                answered = true;
                number_input_name=number_inputs[i].name;
                break;
            }
        }
    }
   
    return answered;
  }
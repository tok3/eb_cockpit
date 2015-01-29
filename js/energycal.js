$(function() {

    //aktionscode setzen
    if(aktionscode != '')
    {
	//aktionscode in input aktionskode formular energieausweis eintragen
	$('#aktionscode').val(aktionscode);

		$('.displAktionscode').html('<h4>Aktionscode:<strong> ' + aktionscode + '</strong></h4>');
	$('#contact_aktionscode').val(aktionscode);
	
    }


/**
* radio firefox bug     el_abnahmestellen
*/

    $( "#el_verbrauch" ).focus(function() {
	$( this ).val('100000');
});
    // --------------------------------------------------------------------
    /*


      console.log(sessionStorage['subAtt']);
    */
    $('form').find('input[type=submit]:first').val('Preis Berechnen').addClass('btn btn-success ');
    $('form').find('input[type=submit]:last').val('Daten Senden').addClass('btn btn-success ');
    
    $('.step2').addClass('hidden');
        $('#minVerbr').addClass('hidden');

    if(post['el_branche'] != '' && post['el_verbrauch'] < 100000)
    {
        $('#minVerbr').removeClass('hidden');

    }    
    if(post['el_branche'] != '' && post['el_verbrauch'] >= 100000)
    {
		    sessionStorage['subAtt'] = 0; //29.01
	$('.step1').hide();
	$('.step2').removeClass('hidden');

	
	$('form').find('input[type=submit]:last').addClass('yoyogo');
	$('.yoyogo').click(function(){

	    $('.error').show();
	    sessionStorage['subAtt'] = 1;
	});

	$('form').find('input[type=submit]:first').remove();
	
	$('#el_verbrauch').clone().prependTo('#paste_verbrauch'); // fehler für mindestverbrauchanzeigen
	$('.error').hide();

    }

    if(sessionStorage['subAtt'] == 1)
    {
    	$('.error').show();
    }
    if($('.step2').is(":visible") ) //29.01
    {
	sessionStorage['subAtt'] = 0;

    }

    // --------------------------------------------------------------------
    /**
     * css class setzen für alle inputs in stream entry form  
     * 
     */
    $('#formCalc INPUT, #formCalc SELECT, #formCalc TEXTAREA').each(function(){

	$(this).addClass('form-control');

    });

        $('.radio').each(function(){

	$(this).addClass('radio-inline');

    });

    $('#formCalc INPUT').each(function(){
	var $label = $("label[for='"+this.id+"']").html();
	$("label[for='"+this.id+"']").remove();
	$(this).attr("placeholder",$label); 
    });
    $('#el_verbrauch').addClass('form-control');


    //$('.crud_form input[type="submit"]').val('Lead \u00fcbernehmen');


    // --------------------------------------------------------------------
});

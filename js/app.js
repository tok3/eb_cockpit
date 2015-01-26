$(function() {

    var contact_id = ci_session.getSessionData('contact_id');
    var group_id = ci_session.getSessionData('group_id');
    /**
     * nach dem ersten anmelden 
     * 
     */
    sideNavState('.noauth','disabled');

    


    if(contact_id > 0)  // kontaktdaten wurden ausgefüllt
    {
	$('.notifications-menu').removeClass('hide');
    }
    else
    {
	sideNavState('.actLevel2','disabled');
	$('.small-box-footer').removeAttr("href");
    }

    if(group_id != 2)
    {
	$('#notify-top').remove();
    }
    if(group_id == 3)
    {

    }

    /**
     * item in sidenav deaktivieren oder entfernen
     * 
     */
    function sideNavState(sel,state)
    {

	if(state === 'disabled')
	{
	    $(sel+' a').removeAttr("href")
		.css("text-align", "left")
		.addClass('btn  disabledbtn  disabled');
	}
	if(state === 'remove')
	{
	    $(sel).remove();

	}
    }
    // --------------------------------------------------------------------
    
    /**
     * css class setzen für alle inputs in stream entry form  
     * 
     */
    $('.crud_form INPUT, .crud_form SELECT, .crud_form TEXTAREA').each(function(){


	$(this).addClass('form-control');


    });

    //$('.crud_form input[type="submit"]').val('Lead \u00fcbernehmen');

    // --------------------------------------------------------------------
});

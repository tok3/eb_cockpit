$(function() {


	var contact_id = ci_session.getSessionData('contact_id');
	var contact_id = ci_session.getSessionData('contact_complete');

	/**
	 * nach dem ersten anmelden 
	 * 
	 */
	sideNavState('.noauth','disabled');
	if(contact_id > 0) // kontaktdaten wurden ausgefüllt
	{
		$('.notifications-menu').removeClass('hide');
	}
	else
	{
		sideNavState('.actLevel2','disabled');
			$('.small-box-footer').removeAttr("href");
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
});

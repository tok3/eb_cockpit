<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$ci = &get_instance();
/**
* navi conf

$config = array(
            'nav_contact' = array
        (
            'item' =>  '<i class="fa  fa-check-square-o"></i> <span>Checklisten</span>',
            'target' => 'documents/index',
            'group' => 'user',
            'class' => 'noauth',
            )
        );

group bestimmt welche gruppen den menüpunkt angeeigt bekommen. meherer gruppen mit komma trennen
grop_id wie group nur grupeen id z.b. 1 oder 1,3 
*/
$config = array(
            'nav_contact'=>array(
                'item'=>'Kontaktdaten',
                'target'=>'contact_details/contact/' . $ci->uri->rsegment(3),
            ),
            'nav_energieausweis'=>array(
                'item'=>'Energieausweis',
                'target'=>'immobilie/details/' . $ci->uri->rsegment(3),
            ),
            'nav_bank'=>array(
                'item'=>'Bankdaten',
                'target'=>'bankaccounts/show/' . $ci->uri->rsegment(3),
            )


        );

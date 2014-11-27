<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$ci = &get_instance();

$config['start'] = array
        (
            'item' =>  '<i class="fa fa-dashboard"></i> <span>Nachrichtenzentrale</span>',
            'target' => 'index',
        );

$config['kontakte'] = array
        (
            'item' => '<i class="fa fa-user"></i><span>Alle Kontakte</span>',
            'target' => 'contacts/',
            'group' => 'admin',
            
        );

$config['ea'] = array
        (
            'item' => '<i class="fa fa-user"></i><span>Energieausweis</span>',
            'target' => 'contacts/index/3',
            'group' => 'admin',
            
        );

$config['eb'] = array 
        (
            'item' => '<i class="fa fa-user"></i><span>Energieberater</span>',
            'target' => 'contacts/index/4',
            'group' => 'admin',
            
        );

$config['im'] = array 
        (
            'item' => '<i class="fa fa-user"></i><span>Immobilien Makler</span>',
            'target' => 'contacts/index/5',
            'group' => 'admin',
            
        );
$config['ek'] = array 
        (
            'item' => '<i class="fa fa-user"></i><span>Energie Kunden</span>',
            'target' => 'contacts/index/2',
            'group' => 'admin',
            
        );


$config['aff'] = array 
        (
            'item' => '<i class="fa fa-user"></i><span>Affiliates</span>',
            'target' => 'contacts/index/100',
            'group' => 'admin',
            
        );


$config['kontakt'] = array
        (
            'item' => '<i class="fa fa-user"></i><span>Meine Daten</span>',
            'target' => 'contact_details/contact/%%contact_id%%',
            'group' => 'user,affiliate',
        );

$config['affcontacts'] = array
        (
            'item' => '<i class="fa fa-users"></i><span>Geworbene Kunden</span>',
            'target' => 'contacts/by_aff',
            'group' => 'affiliate',
        );
$config['banner'] = array 
        (
            'item' => '<i class="glyphicon glyphicon-tag"></i><span>Banner</span>',
            'target' => 'promo/banner',
            'group' => 'affiliate',
            
        );


$config['energieausweis'] = array
        (
            'item' => '<i class="glyphicon glyphicon-transfer"></i><span>Leads Energieausweis</span>',
            'target' => 'leads_energieausweis/index',
            'group_id' => '1',
        );

$config['dokumente'] = array
        (
            'item' => ' <i class="fa fa-exchange"></i><span>Dokumente</span>',
            'target' => 'documents/index',
            'group' => 'user, admin, affiliate',
        );

$config['versorger'] = array
        (
            'item' =>  '<i class="fa  fa-power-off"></i> <span>Energieversorger</span>',
            'target' => 'versorger',

        );

$config['strom'] = array
        (
            'item' =>  '<i class="fa  fa-lightbulb-o"></i> <span>Abnahmestellen Strom</span>',
            'target' => 'documents/index',
            'group_id' => '1',
                        'class' => 'noauth',
        );

$config['gas'] = array
        (
            'item' =>  '<i class="fa  fa-fire"></i> <span>Abnahmestellen Gas</span>',
            'target' => 'documents/index',
            'group_id' => '1',
                        'class' => 'noauth',
        );

$config['tools'] = array
        (
            'item' =>  '<i class="fa  fa-wrench"></i> <span>Tools</span>',
            'target' => 'documents/index',
                        'class' => 'noauth',
        );

$config['checklisten'] = array
        (
            'item' =>  '<i class="fa  fa-check-square-o"></i> <span>Checklisten</span>',
            'target' => 'documents/index',
            'group' => 'user',
            'class' => 'noauth',
        );

$config['statistiken'] = array
        (
            'item' =>  '<i class="fa  fa-bar-chart-o"></i> <span>Statistiken</span>',
            'target' => 'documents/index',
            'class' => 'noauth',
        );


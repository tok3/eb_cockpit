<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method($var = '')
    {
        return $var;
    }   



        }


if ( ! function_exists('check_active'))
{
    function check_active($target = '')
    {

        $CI =& get_instance();
        if(!is_array($target))
        {
            $target = array($target);
        } 

        foreach($target as $item)
        {
            if(uri_string() == $item)
            {
                return 'active';
            }
        }

    }   

        }


if ( ! function_exists('usr_contact_tabs'))
{
/**
* navigationspunkte entfernen wenn nicht in properties
* 
*/
    function usr_contact_tabs($_contacts_id)
    {

        $CI =& get_instance();

        $avail_contact_tabs = $CI->load->config('navigation/contact_tabs', true);        
        
        $propTable = 'default_eb_contact_properties';
        $CI->load->model('general_m');
        $props = $CI->general_m->set_table('eb_contact_properties');

       $usr_properties = $props->get_many_by('contacts_id', $_contacts_id);
       if(count($usr_properties) == 0)
       {
                       unset($avail_contact_tabs['nav_energieausweis']);
        return array_keys($avail_contact_tabs);

       }
        foreach($usr_properties as $key => $item)
        {
            $u_props[$key] =  $item->property;
        }

        if(!is_numeric(array_search('energieausweis',$u_props)))
        {
            unset($avail_contact_tabs['nav_energieausweis']);
        }

        return array_keys($avail_contact_tabs);
    }
        }
else
{
    echo "Function usr_contact_tabs() already exists in helpers/cp_helper.php ";
}



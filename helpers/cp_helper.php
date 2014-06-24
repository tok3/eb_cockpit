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
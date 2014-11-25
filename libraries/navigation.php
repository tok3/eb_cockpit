<?php
if (! defined('BASEPATH')) exit('No direct script access allowed'); 

class Navigation
{
    protected $ci;
    protected $module;
    protected $config_path = 'navigation/'; // relative to /config directore

    private $navConf;

    function __construct()
    {
        $this->ci = &get_instance();

        $this->module = $this->ci->router->fetch_module();

    }

    // --------------------------------------------------------------------
    /**
     * 
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    function wrap($_wrap)
    {
    
        echo $_ent;
        $_ent =  explode('></',$_wrap);
        echo "<pre><code>";
        print_r($_ent);
        echo "</code></pre>";
    
        $wrapped = $_ent[0] . $this->get_entries() . $_ent[1];

        return $wrapped;
    }


    // --------------------------------------------------------------------
    /**
     * navigationseintrag erzeugen
     * 
     * @access 	public	
     * @param 		
     * @return 	string	
     * 
     */

    public function get_entries()
    {
        
        $_entries = array();

        //$this->set_navigation();

        foreach($this->navConf as $key => $conf)
        {
			$active = '';
			$li_class = '';

			$targ = site_url($this->module . '/' . $conf['target']);

			if(current_url() == $targ)
            {
                $active = 'active ';
            }

            if(isset($conf['class']))
            {
                $li_class = $conf['class'];
            }
			$_entries[$key] =   '<li class=" '.$li_class.' ' . $active . ' "><a href="'. $targ .'" >' . $conf['item'] . '</a></li>';
        }

        return  implode("",$_entries	  );

    }
    // --------------------------------------------------------------------
    /**
     * Tab nav beziehen
     * 
     * @access 	public	
     * @param 	string	
     * @return 	string	
     * 
     */
    public function get_tabs()
    {

        $t_nav ='  <ul class="nav nav-tabs">';
        $t_nav .= $this->get_entries();
        $t_nav .= '</ul>';

        return $t_nav;
    }
// --------------------------------------------------------------------
/**
* navigationspunkte entfernen
* 
* @access 	public	
* @param 	mixed	string oder array
* @return 	void	
* 
*/
    public function remove($_entries = '')
    {
        if($_entries == '')
        {
            return $this;
        }
        
        if(is_array($_entries))
        {
            foreach($_entries as $key => $item)
            {
                $this->rm_nav_item($item);
            }
        }
        else
        {
            $this->rm_nav_item($_entries);
        }
        return $this;
    }

    private function rm_nav_item($_entry)
    {
        if(is_numeric($_entry))
        {
            $keys = array_keys($this->navConf);
            unset($this->navConf[$keys[$_entry]]);
        }
        else
        {
            unset($this->navConf[$_entry]);
        }
    
        return $this;
    }
    // --------------------------------------------------------------------
    /**
     * check active 
     * 
     * @access 	public	
     * @param 	string	
     * @return 	string	
     * 
     */

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

    // --------------------------------------------------------------------
    /**
     * @access 	private	
     * @param 	array	
     * 
     */
    private function set($_config)
    {
        $this->navConf = $this->prep_conf($_config);
        return $this;

    }
    // --------------------------------------------------------------------
    /**
     * load navigation with config from within this directory
     * 
     * @access 	public	
     * @param 	string	
     * @param 	array    wenn gegeben dann nur config items aus $_selective laden	
     * @return 		
     * 
     */
    public function load($_cfg, $_selective = array())
    {
        $_config =  $this->ci->load->config($this->config_path . $_cfg, true);
       
        if(count($_selective) > 0)
        {
            foreach($_selective as $key => $item)
                {
                    $cfgItems[$item] = $_config[$item] ;                    
                    }
        $this->navConf = $this->prep_conf($cfgItems);

        return $this;

        }
        
        $this->navConf = $this->prep_conf($_config);

        return $this;
    }


    // --------------------------------------------------------------------
    /**
     * prepare config, replacements and restrictions
     * 
     * @access 	private	
     * @param 	array
     * @return 	array	
     * 
     */
    private function prep_conf($_config)
    {

        foreach($_config as $key => $entry)
        {


            // replace contact id
            $search['%%contact_id%%'] = $this->ci->session->userdata('contact_id');
            $_config[$key]['target'] = str_replace(array_keys($search), $search, $entry['target']);


            // check if menu entry is restricted to grops by id
            if(isset($_config[$key]['group_id']))
            {

                $groupsArr = explode( ',',$_config[$key]['group_id']);
                $is_valid = array_search($this->ci->session->userdata('group_id'), preg_replace('/\s+/', '',$groupsArr));

                if(!is_numeric($is_valid))
                {
                    unset( $_config[$key]);
                }
            }

            // check if menu entry is restricted to grops by groupname
            if(isset($_config[$key]['group']))
            {
                $groupsArr = explode( ',',$_config[$key]['group']);
                $is_valid = array_search($this->ci->session->userdata('group'), preg_replace('/\s+/', '',$groupsArr));

                if(!is_numeric($is_valid))
                {
                    unset( $_config[$key]);
                }

            }
        }
        return $_config;
    }
    // --------------------------------------------------------------------
    /**
     * append to nav entry
     * 
     * @access 	public	
     * @param 	string	
     * @return 	void	
     * 
     */
    public function append($_key, $_value)
    {
        if($this->navConf == "" || !isset($this->navConf[$_key]))
        {
            return false;
        }

        $this->navConf[$_key]['item'] = $this->navConf[$_key]['item'] . $_value; 

        return $this;
    }

// --------------------------------------------------------------------
 
}

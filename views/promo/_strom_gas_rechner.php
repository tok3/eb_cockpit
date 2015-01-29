<?
setcookie('ihre_energieberater_af_id', '', time()-1000);
setcookie('ihre_energieberater_af_id', '', time()-1000, '/');

$this->cookie_liefetime = (3600*24) * 90; // 90 tagae 
setcookie ("ihre_energieberater_af_id",$affiliate_id,time() + $this->cookie_liefetime, '/' );
setcookie ("ihre_energieberater_af_id",$affiliate_id,time() + $this->cookie_liefetime,site_url('cockpit/calc'));
setcookie ("fuck",$affiliate_id,time() + $this->cookie_liefetime, '/' );
        
setcookie('ihre_energieberater_af_id', $affiliate_id, time()-1000);
setcookie('ihre_energieberater_af_id', $affiliate_id, time()-1000, '/');

?>
<p>



<pre class="prettyprint linenums">&lt;iframe frameborder="0" src="<?php echo site_url('cockpit/calc/strom?afid='. $affiliate_id);?>" scrolling="no" width="800px" height="1200px" name=""&gt;&lt;/iframe&gt; 
</pre>

<iframe frameborder="0" src="<?php echo site_url('cockpit/calc?afid='. $affiliate_id);?>" scrolling="yes" width="800px" height="600" name=""></iframe> 
</p>

<hr>

<pre class="prettyprint linenums">&lt;iframe frameborder="0" src="<?php echo site_url('cockpit/calc/gas?afid='. $affiliate_id);?>" scrolling="no" width="800px" height="1200px" name=""&gt;&lt;/iframe&gt; 
</pre>
<iframe frameborder="0" src="<?php echo site_url('cockpit/calc/gas?afid='. $affiliate_id);?>" scrolling="yes" width="800px" height="1200" name=""></iframe> 

<hr> 
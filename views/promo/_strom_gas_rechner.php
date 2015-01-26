<?
$this->cookie_liefetime = (3600*24) * 90; // 90 tagae 
setcookie ("ihre_energieberater_af_id",$affiliate_id,time() + $this->cookie_liefetime, '/' );

?>
<p>


     <pre class="prettyprint linenums">&lt;iframe frameborder="0" src="<?php echo site_url('cockpit/calc?afid='. $affiliate_id);?>" scrolling="no" width="800px" height="1200px" name=""&gt;&lt;/iframe&gt; 
</pre>
<a href="<?php echo site_url('energieausweis');?>">
<iframe frameborder="0" src="<?php echo site_url('cockpit/calc?afid=2323'. $affiliate_id);?>" scrolling="no" width="800px" height="1200" name=""></iframe> 
</p>

<hr> 
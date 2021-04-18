<?php

	function convdate($date)
	{		
		$date = date_create($date);
		return date_format($date,"dS F,Y h:i");
	}
?>
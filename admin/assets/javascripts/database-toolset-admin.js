(function($)
{
	'use strict';
	$(function()
	{
		if($('.input-status').length > 0)
		{
			$('.input-status').on('click',function()
			{
		    	if($(this).is(':checked'))
		    	{
		        	$("#handler-status").show(100)
		    	}
		    	else
		    	{
		    		$("#handler-status").hide(500)
		    	}
			});

			if($("#handler-status.show").length)
			{
			    $("#handler-status").show()
			}
		}

		if($('.input-notify').length > 0)
		{
			$('.input-notify').on('click',function()
			{
		    	if($(this).is(':checked'))
		    	{
		        	$("#handler-notify").show(100)
		    	}
		    	else
		    	{
		    		$("#handler-notify").hide(500)
		    	}
			});

			if($("#handler-notify.show").length)
			{
			    $("#handler-notify").show()
			}
		}

		$('#backups-table').dataTable(
		{
			"paging": true,
			"ordering": true,
			"info": false,
			"columns":
			[
    			{ "width": "55%" },
    			{ "width": "10%" },
    			{ "width": "10%" },
    			{ "width": "10%" },
    			{ "width": "15%" }
  			]
		});
	});
})(jQuery);
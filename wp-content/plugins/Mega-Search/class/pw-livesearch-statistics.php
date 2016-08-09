<?php
	global $wpdb;
	$table_name = $wpdb->prefix . "pw_livesearch_statistics";
	$data='';
	
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
		$allposts = $wpdb->get_results( "SELECT * FROM $table_name order by num DESC") ;
		foreach ($allposts as $singlepost) { 
			if($singlepost->num)
			{
				$data.='<tr>';
				$data.="<td>".$singlepost->keyword."</td><td>".$singlepost->num."</td>";
				$data.='</tr>';
			}
		}
	}	
	echo '
		<div class="wrap">
			<h2>'.__('Mega Search Statistics',__PW_LIVESEARCH_TEXTDOMAIN__).'</h2>
			<br />
		</div>		
		<div class="postbox hide" style="border-top: 4px solid #2CC185;">
		<div class="my-menu">
			<span class="showtable"><div class="fa fa-table fa-lg eleman actived" aria-hidden="true"></div></span>
			<span class="showpiechart"><div class="fa fa-pie-chart fa-lg eleman" aria-hidden="true"></div></span>	
			<span class="showbarchart"><div class="fa fa-bar-chart fa-lg eleman" aria-hidden="true"></div></span>
			<span class="showlinechart"><div class="fa fa-line-chart fa-lg eleman" aria-hidden="true"></div></span>						
		</div>
		<div class="inside">
			<div class="row report_table">
				<table class="display nodatatable" cellspacing="0" width="100%">
					<thead>
						<tr>			
							<th>'.__('Searched Keyword',__PW_LIVESEARCH_TEXTDOMAIN__).'</th>
							<th>'.__('Qty',__PW_LIVESEARCH_TEXTDOMAIN__).'</th>
						</tr>
					</thead>
					<tfoot>
						<tr>			
							<th>'.__('Searched Keyword',__PW_LIVESEARCH_TEXTDOMAIN__).'</th>
							<th>'.__('Qty',__PW_LIVESEARCH_TEXTDOMAIN__).'</th>
						</tr>
					</tfoot>
					<tbody id="rows">'.$data.' </tbody>
				</table>
			</div>	
			<div class="row report_chart hide">
				<div id="chart_topcats" class="chartlocation" style="height:400px;"></div>
			</div>		
		</div>	
	</div>';
?>
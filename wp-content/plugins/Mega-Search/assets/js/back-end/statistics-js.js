// JavaScript Document
// PREVENT FROM CONFLICT WITH ANY $S
//$.noConflict();
jQuery( document ).ready(function( $ ) {
	
	// ADDING DATE SORTING TO DATATABLES
	$.fn.dataTable.moment( 'MMMM - YYYY' );
	$.fn.dataTable.moment( 'MMMM-YYYY' );
	

	$('.npnsnodatatable').dataTable({
		paging: false,
		"searching": false,
		"ordering": false
	});
	$('.npnsdatatable').dataTable({
		paging: false,
		"searching": false
	});
	$('.npnodatatable').dataTable({
		paging: false,
		"ordering": false
	});
	$('.nodatatable').dataTable({
		"ordering": false
	});
	$('.ntdatatable').dataTable();
	
	// SHOWING HIDDEN DEFAULT POSTBOXES
	$(".postbox").removeClass("hide");
	
	
	
	// FETCHING DATA FROM TABLES TO GENERATE CHARTS
	var dataRenderer = function(tablecontin) {
		var myTableArray = [[]];
		tablecontin[0].find("table").children("tbody").children("tr").each(function() {
			var arrayOfThisRow = [];
			var tableData = $(this).find('td:first-of-type,td:last-of-type');
			if (tableData.length > 0) {
				tableData.each(function() {
					text = $(this).text();
					if($(this).is($("td:last-of-type"))){
						text = parseFloat(text.substr(1));
					}
					arrayOfThisRow.push(text);
				});
				myTableArray[0].push(arrayOfThisRow);
			}
			return myTableArray;
		});

		return myTableArray;
	};
	
	// CREATE CUSTOMIZED CHART
	function createchart(chartlocation,data,type){
		switch(type){
			case "barpref":
				var data1 = [
					['Heavy Industry', 12],['Retail', 9], ['Light Industry', 14], 
					['Out of home', 16],['Commuting', 7], ['Orientation', 9]
				  ]
				var plot1 = $.jqplot(chartlocation,[data],{    
					animate: true,
					animateReplot: true,
					series:[{renderer:$.jqplot.BarRenderer}],
					axesDefaults: {
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
							angle: -30,
						},
					},
					
					axes: {
						xaxis: {
							renderer: $.jqplot.CategoryAxisRenderer,
							tickOptions: {
								labelPosition: 'middle'
							}
						},
						/*x2axis: {
							renderer: $.jqplot.CategoryAxisRenderer
						  },*/
						yaxis: {
							autoscale:true,
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
							tickOptions: {
								labelPosition: 'start'
							},
							//pad: 1.2,
                			//tickOptions: {formatString: '%d'}
							/*min: 0,
							tickInterval: 5,
							max: 20*/
						},
						/*y2axis: {
							autoscale:true,
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
								tickOptions: {
									labelPosition: 'start'
								},
						  }*/
						
					},
					//dataRenderer: dataRenderer
				});
				break;
			
			case "barline":
				//var data = [14, 32, 41, 44, 40, 47, 53, 67];
				var plot1 = $.jqplot(chartlocation,[data],{
					animate: true,
					animateReplot: true,
					//title:'Data Point Highlighting',
					axesDefaults: {
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
							angle: -30,
						},
					},
					axes:{
						xaxis:{
							renderer: $.jqplot.CategoryAxisRenderer
						},
						yaxis:{
							tickOptions:{
								formatString:'%d'
							}
						}
					},
					highlighter: {
						show: true,
						sizeAdjust: 7.5
					},
					cursor: {
						show: false
					}
				});
				break;	
				
			case "piepref":
				
				
				/*var data1 = [
					['Heavy Industry', 12],['Retail', 9], ['Light Industry', 14], 
					['Out of home', 16],['Commuting', 7], ['Orientation', 9]
				  ];*/
				var plot1 = $.jqplot (chartlocation, [data],{ 
					seriesDefaults: {
						// Make this a pie chart.
						renderer: jQuery.jqplot.PieRenderer, 
						rendererOptions: {
							// Put data labels on the pie slices.
							// By default, labels show the percentage of the slice.
							showDataLabels: true
						}
					}, 
					legend: { show:true, location: 'e' }
				});
				
				/*var plot1 = $.jqplot(chartlocation,data,{    
					animate: true,
					animateReplot: true,
					seriesDefaults: {
						renderer: jQuery.jqplot.PieRenderer, 
						rendererOptions: {
							showDataLabels: true
						}
					}, 
					legend: { show:true, location: 'e' },
					dataRenderer: dataRenderer
				});*/
				break;
			case "scatterpref":
				var plot1 = $.jqplot(chartlocation,data, {          
					animate: true,
					animateReplot: true,
					axes:{
						xaxis: {
							renderer: $.jqplot.CategoryAxisRenderer,
							tickOptions: {
								labelPosition: 'middle'
							}
						},
						yaxis: {
							autoscale:true,
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
							tickOptions: {
								labelPosition: 'start'
							}
						}
					},
					dataRenderer: dataRenderer
				 });
				break;
			default:
				var plot1 = $.jqplot(chartlocation,[data],{    
					animate: true,
					animateReplot: true,
					series:[{renderer:$.jqplot.BarRenderer}],
					axesDefaults: {
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
							angle: -30
						}
					},
					axes: {
						xaxis: {
							renderer: $.jqplot.CategoryAxisRenderer,
							tickOptions: {
								labelPosition: 'middle'
							}
						},
						yaxis: {
							autoscale:true,
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
							tickOptions: {
								labelPosition: 'start'
							}
						}
					},
					dataRenderer: dataRenderer
				});
				break;
		}
	}
	
	// DEFAULT MULTICHART BOX STATE
	$(".multicharted").each(function() {	
		whichindex = 1;
		$contin = $(this).children(".inside");
		$contin.children(".row.report_table").addClass( "hide" );
		$contin.children(".row.report_chart").addClass( "hide" );
		$contin.children(".row.report_chart").removeClass( "hide" );
		chartlocation = $contin.children(".row.report_chart").children(".chartlocation").attr("id");
		if(typeof plot1  != 'undefined' ){plot1.redraw();plot1.destroy();}
		$('#'+chartlocation).html("");
		$source = $contin.children(".row.report_table:nth-of-type("+whichindex+")");
		data = [ $source , 1 ];
		createchart(chartlocation,data,$source.find("table").children("thead").attr("class"));
	});
	
	// MULTICHART SHOW CHARTS
	$(document).on('click', ".showchart", function() {
		$(this).parent().children(".showchart").children(".eleman").removeClass("actived");
		
		$(this).children(".eleman").addClass("actived");
		whichindex = $(this).index(".showchart")+1;
		$contin = $(this).parent().parent().children(".inside");
		$contin.children(".row.report_table").addClass( "hide" );
		$contin.children(".row.report_chart").addClass( "hide" );
		$contin.children(".row.report_chart").removeClass( "hide" );
		chartlocation = $contin.children(".row.report_chart").children(".chartlocation").attr("id");
		if(typeof plot1  != 'undefined' ){plot1.redraw();plot1.destroy();}
		$('#'+chartlocation).html("");
		$source = $contin.children(".row.report_table:nth-of-type("+whichindex+")");
		data = [ $source , 1 ];
		data = [ $contin.children(".row.report_table:nth-of-type("+whichindex+")") , 1 ];
		createchart(chartlocation,data,$source.find("table").children("thead").attr("class"));
	});
	
	// SINGLECHART SHOW CHARTS OR TABLE
	$(document).on('click', ".showbarchart", function() {
		$(this).parent().children(".showpiechart").children(".eleman").removeClass("actived");
		$(this).parent().children(".showtable").children(".eleman").removeClass("actived");
		$(this).parent().children(".showlinechart").children(".eleman").removeClass("actived");
		
		$(this).children(".eleman").addClass("actived");
		whichindex = $(this).index(".showbarchart")+1;
		whichindex = 1;
		$contin = $(this).parent().parent().children(".inside");
		$contin.children(".row.report_table").addClass( "hide" );
		$contin.children(".row.report_chart").addClass( "hide" );
		$contin.children(".row.report_chart").removeClass( "hide" );
		chartlocation = $contin.children(".row.report_chart").children(".chartlocation").attr("id");
		if(typeof plot1  != 'undefined' ){plot1.redraw();plot1.destroy();}
		$('#'+chartlocation).html("");
		$source = $contin.children(".row.report_table:nth-of-type("+whichindex+")");
		data = [ $source , 1 ];
		
		var tableInfo=[];

		$('#rows tr').each(function(){
			var $td=$(this).find('td');   
			tableInfo.push([$td.eq(0).text(), parseInt($td.eq(1).text())] );   
			//confirm($td.eq(0).text()+" - "+$td.eq(1).text());
		});
		
		createchart(chartlocation,tableInfo,"barpref");
	});
	$(document).on('click', ".showpiechart", function() {
		$(this).parent().children(".showbarchart").children(".eleman").removeClass("actived");
		$(this).parent().children(".showtable").children(".eleman").removeClass("actived");
		$(this).parent().children(".showlinechart").children(".eleman").removeClass("actived");
		
		$(this).children(".eleman").addClass("actived");
		whichindex = $(this).index(".showpiechart")+1;
		whichindex = 1;
		$contin = $(this).parent().parent().children(".inside");
		$contin.children(".row.report_table").addClass( "hide" );
		$contin.children(".row.report_chart").addClass( "hide" );
		$contin.children(".row.report_chart").removeClass( "hide" );
		chartlocation = $contin.children(".row.report_chart").children(".chartlocation").attr("id");
		if(typeof plot1  != 'undefined' ){plot1.redraw();plot1.destroy();}
		$('#'+chartlocation).html("");
		$source = $contin.children(".row.report_table:nth-of-type("+whichindex+")");
		
		var tableInfo=[];

		$('#rows tr').each(function(){
			var $td=$(this).find('td');   
			tableInfo.push([$td.eq(0).text(), parseInt($td.eq(1).text())] );   
			//confirm($td.eq(0).text()+" - "+$td.eq(1).text());
		});
		
		
		data = [ $source , 1 ];
		createchart(chartlocation,tableInfo,"piepref");
	});
	
	$(document).on('click', ".showlinechart", function() {
		$(this).parent().children(".showbarchart").children(".eleman").removeClass("actived");
		$(this).parent().children(".showtable").children(".eleman").removeClass("actived");
		$(this).parent().children(".showpiechart").children(".eleman").removeClass("actived");
		
		$(this).children(".eleman").addClass("actived");
		whichindex = $(this).index(".showlinechart")+1;
		whichindex = 1;
		$contin = $(this).parent().parent().children(".inside");
		$contin.children(".row.report_table").addClass( "hide" );
		$contin.children(".row.report_chart").addClass( "hide" );
		$contin.children(".row.report_chart").removeClass( "hide" );
		chartlocation = $contin.children(".row.report_chart").children(".chartlocation").attr("id");
		if(typeof plot1  != 'undefined' ){plot1.redraw();plot1.destroy();}
		$('#'+chartlocation).html("");
		$source = $contin.children(".row.report_table:nth-of-type("+whichindex+")");
		
		var tableInfo=[];

		$('#rows tr').each(function(){
			var $td=$(this).find('td');   
			tableInfo.push([$td.eq(0).text(), parseInt($td.eq(1).text())] );  
			//confirm($td.eq(0).text()+" - "+$td.eq(1).text());
		});
		
		
		data = [ $source , 1 ];
		createchart(chartlocation,tableInfo,"barline");
	});
	
	$(document).on('click', ".showtable", function() {
		$(this).parent().children(".showpiechart").children(".eleman").removeClass("actived");
		$(this).parent().children(".showbarchart").children(".eleman").removeClass("actived");
		$(this).parent().children(".showlinechart").children(".eleman").removeClass("actived");
		
		$(this).children(".eleman").addClass("actived");
		$(this).parent().parent().children(".inside").children(".row.report_table").removeClass( "hide" );
		$(this).parent().parent().children(".inside").children(".row.report_chart").addClass( "hide" );
	});
	
});
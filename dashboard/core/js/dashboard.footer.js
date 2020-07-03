

	var today = new Date();
	var tomorrow = new Date();
	tomorrow.setDate(tomorrow.getDate() - 6);

	var weekday=[];
	var tmweekday=[];
	var label=[];

	for(var j=0;j<=6;j++)
	{

	
		var temp=new Date();
		temp.setDate(temp.getDate() - j);

		var  formattedDate = temp.toLocaleDateString('en-GB', {
		  month: 'short', day: 'numeric'
		}).replace(/ /g, ' ');

		label.push(formattedDate);

	    temp=temp.toLocaleString();

		temp=temp.split(",");
		temp=temp[0];

		weekday.push(temp);

		temp=new Date(temp).getTime()/1000; 

		tmweekday.push(temp);

	}

	label=label.reverse();

	$.ajax({
		url: "ajaxchart.php",
		data: {
			today: tmweekday[0],
			tomorrow:tmweekday[6],
			refid: <?=$userID;?>,
		},
		success: function(result){

			var result=JSON.parse(result);
			
    		var data = {
			  
			  labels: label,
			  
			  series: [
			    result
			  ]
			};

			new Chartist.Bar('.ct-chart', data);

  		}});
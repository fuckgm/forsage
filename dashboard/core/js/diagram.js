
function initial()
{
	alert();
	treeData;
	margin = {top: 30, right: 100, bottom: 80, left: 200},
	width = 800 - margin.right - margin.left,
	height = 700 - margin.top - margin.bottom;
	
	i = 0;
	duration = 750;

	tree = d3.layout.tree()
		.size([height, width]);

	diagonal = d3.svg.diagonal()
		.projection(function(d) { return [d.y, d.x]; });

	svg = d3.select("#treechart").append("svg")
		.attr("width", width + margin.right + margin.left)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.select(self.frameElement).style("height", "800px");
	root = treeData[0];
	root.x0 = height / 2;
	root.y0 = 0;
	update(root);
}
     
window.addEventListener("load", function(){
   getData(document.getElementById('userid').innerHTML.trim(),0); 
});   

function getData(_id,onlyone)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
		{
			console.clear();
			console.log(this.responseText);
			treeData = JSON.parse(this.responseText);      	
    		var ele2 = document.getElementById('loader');
			ele2.style.display = "none";        
        	document.getElementById('treechart').innerHTML ="";
			var ele = document.getElementById('tooltip');
			ele.innerHTML = "";
			ele.style.display = "none";
			initial();
		}
	};
	xhttp.open("POST", <?php echo '"' . SITE_URL . 'dashboard/d3chart.php"'; ?>, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id=" + _id + "&onlyone="+onlyone);
}


function update(source) {
	
  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse(),
	  links = tree.links(nodes);
	  links = tree.links(nodes);

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 110; });

  // Update the nodes…
  var node = svg.selectAll("g.node")
	  .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("g")
	  .attr("class", "node")
	  .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
	  .on("click", click)
	  .on("mouseover", mouseover)
	  .on("mouseleave", mouseleave);

  nodeEnter.append("circle")
	  .attr("r", 1e-6)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; })


            nodeEnter.append('text').attr("dy", ".35em").attr("x", function(d) {
                return d.children || d._children ? -15 : -15;
            }).attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "end";
            }).text(function(d) {
                return "ID:" + d.name;
            });
            nodeEnter.append('text').attr("dy", ".35em").attr("x", function(d) {
                return -5;
            }).text(function(d) {
                return d.level;
            });



  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
	  .attr("r", 8)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
	  .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
	  .remove();

  nodeExit.select("circle")
	  .attr("r", 1e-6);

  nodeExit.select("text")
	  .style("fill-opacity", 1e-6);

  // Update the links…
  var link = svg.selectAll("path.link")
	  .data(links, function(d) { return d.target.id; });

  // Enter any new links at the parent's previous position.
  link.enter().insert("path", "g")
	  .attr("class", "link")
	  .attr("d", function(d) {
		var o = {x: source.x0, y: source.y0};
		return diagonal({source: o, target: o});
	  });

  // Transition links to their new position.
  link.transition()
	  .duration(duration)
	  .attr("d", diagonal);

  // Transition exiting nodes to the parent's new position.
  link.exit().transition()
	  .duration(duration)
	  .attr("d", function(d) {
		var o = {x: source.x, y: source.y};
		return diagonal({source: o, target: o});
	  })
	  .remove();

  // Stash the old positions for transition.
  nodes.forEach(function(d) {
	d.x0 = d.x;
	d.y0 = d.y;
  });

}

// Toggle children on click.
function click(d) {

	var usrid = document.getElementById('userid').innerHTML.trim();
  	if(((d.children == undefined && d._children == undefined) || treeData[0].name == d.name )  && d.name > usrid)
	{
    	if(treeData[0].name == d.name)
        {
			getData(usrid,0);        	
        }
    	else
        {
			getData(d.name,0);   
        }
    	showLoader(); 
    }
	else
	{
		if (d.children) {
			d._children = d.children;
			d.children = null;
		} else {
			d.children = d._children;
			d._children = null;
		}
		update(d);			
	}

}

    function showLoader()
    {
    	var ele2 = document.getElementById('loader')
		ele2.style.top =(event.pageY - 50)+"%"
		ele2.style.left =(event.pageX - 50)+"%"
		ele2.style.display = "block"
    }

  // Three function that change the tooltip when user hover / move / leave a cell
  function mouseover(d)  
  {
	var ele = document.getElementById('tooltip')
    var elem = document.getElementById('treechart')
    var rect = elem.getBoundingClientRect();
    var position = {
       top: rect.top + window.pageYOffset,
       left: rect.left + window.pageXOffset
    };    
	ele.innerHTML = levelTxt(d.detail,d.name)
	ele.style.top =(event.pageY - position.top + elem.offsetTop - 30)+"px"
	ele.style.left =(event.pageX - position.left + elem.offsetLeft + 30)+"px"
	ele.style.display = "block"

  }


  // Three function that change the tooltip when user hover / move / leave a cell
  function mouseleave(d) 
  {
	var ele = document.getElementById('tooltip')
	ele.innerHTML = ""
	ele.style.display = "None"
  }

	var process = new Array(5);
    
	function levelTxt(lvl,id)
	{
		var outTxt = '<div id="popupData" style="text-align:center;"> ID : ' + id + '</div>'
		outTxt += '<div style="text-align:center; margin-top:10px;"> <table>'
    	resetProcess()
		for(var j=lvl.length;j>0;j--)
		{
			var lvlNo = parseInt(lvl[j-1]['level']);
        	if(process[ lvlNo - 1 ] == 0)
            {
				var d = new Date();
        		var n = parseInt(lvl[j-1]['days']) + 15552000;
        		n = n -  ((d.getTime()/1000).toFixed(0));
				n =(n / 86400).toFixed(0);
				outTxt += '<tr><td>Lvl &nbsp; '+ lvlNo + '&nbsp; : &nbsp; </td><td>  ' + n + ' &nbsp; d</td></tr>'
            	process[ lvlNo - 1 ] = 1;
            }
		}
		return outTxt + '</table></div>'
	} 
    
    function resetProcess()
    {
    	for(i=0;i<10;i++)
        {
        	process[i] = 0;
        }
    }
    
   
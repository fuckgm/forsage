<?php
	require 'runquery.php';
	$depth=0;
	$tmpRecord = array();	
	$fromParent = $_POST['id']; // $_POST['parent'];
	if($_POST['onlyone'] == 1)
	{
		$p = runsql("select referrerID from event_reglevelev where userID = " . $fromParent." limit 1;");
		if(isset($p[0]))$q = runsql("select referrerID from event_reglevelev where userID = " . $p[0]['referrerID']." limit 1;");
		if(isset($q[0]))$r = runsql("select referrerID from event_reglevelev where userID = " . $q[0]['referrerID']." limit 1;");
		if(isset($r[0]))$fromParent = $r[0]['referrerID'];
		else $fromParent = 1;
	}
	
	$outData=array();
	array_push($outData,array("name"=> $fromParent, "children" =>array(), "level" => "", "detail" => array() ));
	$levelTime = runsql("select level as level, timestamp as days from event_levelbuyev where buyer in ( select userWallet from event_reglevelev where userID = " .$fromParent. " ) order by level DESC ;");
	if(count($levelTime) > 0) setLevel(0, $levelTime);
	setData($fromParent);
	function setData($pid)
	{
		global $depth;
		global $outData;
		global $tmpRecord;
		global $levelData;
		$depth++;
		$data = runsql("select userID as id, referrerID as parent from event_reglevelev where referrerID IN ( " .$pid. " ) order by referrerID;");
		$lst = "";
		for ($i=0; $i<count($data);$i++)
		{
			array_push($outData,array("name"=> $data[$i]['id'], "children" =>array(), "level" => "", "detail" => array() ));
			array_push($tmpRecord,$data[$i]);
			$lst = $lst . $data[$i]['id'] . ",";	
			$levelTime = runsql("select level as level, timestamp as days from event_levelbuyev where buyer in ( select userWallet from event_reglevelev where userID = " .$data[$i]['id']. " )  order by level DESC ;");			
			if(count($levelTime) > 0) setLevel(count($outData) - 1, $levelTime);
		}
		$lst = substr($lst,0,strlen($lst)-1);
		if($depth<5 && $lst != "")
		{
			setData($lst);
		}
		else
		{
			jsonTree();
		}
	}
	
	function setLevel($index, $ldata)
	{
		global $outData;
		$outData[$index]['level'] = $ldata[0]['level'];
		$outData[$index]['detail'] = $ldata;
	}

	function jsonTree()
	{
		global $outData;
		global $tmpRecord;
		for ($i=count($tmpRecord)-1; $i >= 0;$i--)
		{
			$id = $tmpRecord[$i]['id'];
			$parent = $tmpRecord[$i]['parent'];
			$idx = -1;
			$pdx = -1;
			for ($ii=count($outData)-1; $ii >= 0;$ii--)
			{
				if($outData[$ii]['name'] == $id)
				{
					$idx = $ii;
					break;
				}
			}
			for ($ii=count($outData)-1; $ii >= 0;$ii--)
			{
				if($outData[$ii]['name'] == $parent)
				{
					$pdx = $ii;
					break;
				}
			}			
			if($idx > -1 && $pdx > -1)
			{
				array_push($outData[$pdx]['children'],$outData[$idx]);
			}
		}			
	}
	echo "[" . json_encode($outData[0]). "]";
	unset($outData[0]);
	unset($tmpRecord[0]);

?>
<?php
class Enterprisesmodel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function init()
	{
		$dbHandle = $this->load->database('default', TRUE);
		if($dbHandle == ''){
			error_log('can not create db handle','qna');
			echo (print_r($dbHandle,true));
		}
		return $dbHandle;
	}

	public function insertData($file){
		$dbHandle = $this->init();
		$count = 0;
		if ($file["file"]["error"] > 0)
		{
			echo "Error: " . $file["file"]["error"] . "<br />";
		}
		if ($file["file"]["size"] > 0) {

    		//get the csv file
    		$filename = $file["file"]["tmp_name"];
    		$handle = fopen($filename,"r"); 
		$movie = fgetcsv($handle,1000,",","'");
		$movie = fgetcsv($handle,1000,",","'");
		do {
        		if ($movie[1]) {
	 			if($movie[0] == '')
				{
					$grpid = explode("-",$movie[1]);
					$movie[0] = $grpid[0];	
				}
				$query = "INSERT IGNORE INTO movie (groupid, productid, title, store, category, subcategory, price, shippingduration) VALUES 
				( 
				    '".addslashes($movie[0])."', 
				    '".addslashes($movie[1])."', 
				    '".addslashes($movie[2])."',
				    '".addslashes($movie[3])."',
				    '".addslashes($movie[4])."', 
				    '".addslashes($movie[5])."', 
				    '".addslashes($movie[6])."',
				    '".addslashes($movie[7])."'
				     
				) 
			    ";
				$result = $dbHandle->query($query);
				if($result)
				$count++;
			}
		} while ($movie = fgetcsv($handle,1000,",","'"));
		return $count;			
		}
	}
	
	public function getMovies($keywords){
		$dbHandle = $this->init();
		$qs=explode(" ",$keywords);
		$querystring1 ="";
		$querystring2 ="";
		for($a=0;$a<=count($qs);$a++)
		{
			if(isset($qs[$a]) && $qs[$a]!='')
			{
				if($a == 0)
				$querystring1 .= " title COLLATE UTF8_GENERAL_CI like '%".mysql_real_escape_string($qs[$a])."%' ";
				else
				$querystring1 .= " AND title COLLATE UTF8_GENERAL_CI like '%".mysql_real_escape_string($qs[$a])."%' ";
			}
		}

		$querystring1=trim($querystring1);
		for($a=0;$a<=count($qs);$a++)
		{
			if(isset($qs[$a]) && $qs[$a]!='')
			{
				if($a == 0)
				$querystring2 .= " title COLLATE UTF8_GENERAL_CI like '%".mysql_real_escape_string($qs[$a])."%' ";
				else
				$querystring2 .= " OR title COLLATE UTF8_GENERAL_CI like '%".mysql_real_escape_string($qs[$a])."%' ";
			}
		}

		$querystring2=trim($querystring2);
		$query = "select * from  movie  where ".$querystring1." group by groupid";
		$result = mysql_query($query) or die(mysql_error());	
		$movieDetailArray = array();
		$i=0;
		$count = 0;
		$groupids = "";
		while($row = mysql_fetch_assoc($result)){
				
			$movieDetailArray[$i] = $row;
			$groupids = "'".$row['groupid']."',";
			$i++;
		}
		$groupids = substr($groupids, 0, -1);
		if($groupids != '')
		$query2 = "select * from  movie  where (".$querystring2.") and groupid not in (".$groupids.") group by groupid";
		else
		$query2 = "select * from  movie  where (".$querystring2.") group by groupid";
		$result2 = mysql_query($query2) or die(mysql_error());
		while($row2 = mysql_fetch_assoc($result2)){
				
			$orderDetailArray[$i] = $row2;
			$i++;
		}
		//$orderDetailArray['0']['totalResults']=$totalResults;
		return $movieDetailArray;
	}
	public function getMoviesByGroupId($groupid){
		$dbHandle = $this->init();
		$query = "select * from  movie  where groupid like '".$groupid."'";
		$result = mysql_query($query) or die(mysql_error());	
		$movieDetailArray = array();
		$i=0;
		while($row = mysql_fetch_assoc($result)){
				
			$movieDetailArray[$i] = $row;
			$i++;
		}
		return $movieDetailArray;
	}	
	
	
}//EOF
?>

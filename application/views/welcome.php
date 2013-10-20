<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Movie Store</title>
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<style> 
#rounded-corner
{
margin:0px;
width:100%;
text-align: left;
border-collapse: collapse;
}
#rounded-corner thead th.rounded-company
{
width:26px;
background: #60c8f2 url('/public/images/left.jpg') left top no-repeat;
}
#rounded-corner thead th.rounded-q4
{
background: #60c8f2 url('/public/images/right.jpg') right top no-repeat;
}
#rounded-corner th
{
padding: 8px;
font-weight: normal;
font-size: 13px;
color: #039;
background: #60c8f2;
}
#rounded-corner td
{
padding: 8px;
background: #Efefef;
border-top: 1px solid #fff;
color: #669;
}
#rounded-corner tfoot td.rounded-foot-left
{
background: #ecf8fd url('/public/images/botleft.jpg') left bottom no-repeat;
}
#rounded-corner tfoot td.rounded-foot-right
{
background: #ecf8fd url('/public/images/botright.jpg') right bottom no-repeat;
}
#rounded-corner tbody tr:hover td
{
background: #d2e7f0;
}
</style>
<script type="text/javascript">
   window.onload = function(){
          document.getElementById('searchedKey').focus();  
   }
   
   function read_excel()
   {
	var url = "/insertMovies";
	var data;
	var userid;
	var userpass;	
	data = new FormData();
	document.getElementById('upload').disabled = 'disabled';
	data.append( 'file', $( '#file' )[0].files[0]  );
	
	
	xhr = new XMLHttpRequest();

	xhr.open( 'POST', url, true );
	xhr.onreadystatechange = function ( response ) {
	if (xhr.readyState==4 && xhr.status==200)
		{
			alert(xhr.responseText);
			document.getElementById('upload').disabled = false;
		}
	};
	xhr.send( data );
  }		
  function validateMovie(sMovie) {
	var filter = /^[^.!?\s][^.!?]*(?:[.!?](?!['"]?\s|$)[^.!?]*)*[.!?]?['"]?(?=\s|$)/;
	if (filter.test(sMovie)) {
		return true;
	} else {
		return false;
	}
} 	
  function validateSearch() {

	var movie = document.getElementById('searchedKey').value;
	var checkMovie = validateMovie(movie);
	if (!checkMovie && movie != '') {
		alert("Please Enter a valid Movie Title");
		document.getElementById('searchedKey').focus();
		document.getElementById('searchedKey').value = '';
		return false;

	}
	var formElem     = document.getElementById('searchForm');
    	formElem.action = "/searchMovies";
    	formElem.submit();;
	

}	

</script>
 <div class="main_content">
     <div class="center_content">  
        <div class="right_content">            
            
          <h2 style="font-size: 30px;font-weight: normal;text-align: center;">Movie Store</h2>  
          <br>     
        <form method="POST" name="searchForm" id="searchForm" >
            <span style="font-size:15px;float:left;">Search </span>
            <input type="text" name="searchedKey" id="searchedKey"  size="12" value="" style="margin-left:1%;" onKeypress="if(event.keyCode==13) {validateSearch('searchForm');}"/>
            <input type="button"  value="Search"  style="font-weight:bold;width: 100px;margin-left: 10px;" onClick="validateSearch('searchForm');"/>
        </form>
	<span><h2 style="padding-bottom: 0px; padding-top: 5px;">OR</h2></span>
        <form name="feed_form">
	<span style="font-size:15px;float:left;">Upload Products </span>
	<input type="file" name="file" id="file" size="12" value="" style="margin-left:1%;">	
        <input type=button name="read" id="upload" value=Upload onclick="this.disabled='disabled';read_excel();">
	</form>        


        <br>
<?php date_default_timezone_set('Asia/Calcutta');?>

        
        
        <?php  if($formStart=='No') {?>
            <?php 
                               
                  if(isset($message)){
                      echo '<b> '.$message.'<b>';
                }else
		{
			echo ' <b> Start Searching !! </b>';
                	exit;
		}
	}else{	 
	if(!isset($movieResult[0])){
                      echo "<b> No results found. Try again. <b>";
                }
	else
	{
       ?>
       <table id="rounded-corner" class="table-autosort"   > 
        <thead>  
                 <tr > <th scope="col" class="rounded table-sortable:alphanumeric" style="width: 250px;">Product Name</th>
                       <th scope="col" class="rounded table-sortable:alphanumeric" style="width: 80px;">Product ID</th>
                       <th scope="col" class="rounded table-sortable:alphanumeric" style="width: 150px;">Category</th>
                       <th scope="col" class="rounded table-sortable:alphanumeric" style="width: 100px;">Ships In</th>
                       
                </tr> 
         </thead>  
        <? foreach($movieResult as $data){?>
               <tr>
                   <td style="width:20px">
                       <a target="_blank" href="welcome/movieVersions/<?echo $data['groupid'] ?>/">
                           <?php echo $data['title'] ;?>
                       </a>
                   </td>
                   <td style="width:20px"><?php echo $data['productid'] ;?></td>
                   <td style="width:20px"><?php echo $data['category'] ;?></td>
                   <td style="width:20px"><?php echo $data['shippingduration'] ;?></td>

               </tr>
               <?php }?>
   </table>
   <?php }}?>
          
        </div>
    </div>
       
    </div> <!--end of main content-->
	
    
 
	

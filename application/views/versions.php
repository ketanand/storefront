<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
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

 <div class="main_content">
     <div class="center_content">  
        <div class="right_content">            
            
          <h2 style="font-size: 20px;font-weight: normal;text-align: center;"><?php echo $title;?></h2>  
          <br>      
        <br>
<?php date_default_timezone_set('Asia/Calcutta');?>

        
        
        <?php  if($formStart=='No') {?>
            <?php 
                               
                  if(isset($message)){
                	echo $message;
                	exit;
		}
	}else{	 
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
                   <td style="width:20px"><?php echo $data['title'] ;?><br><hr><font color='green'>Rs <?php echo $data['price'] ;?></font><hr></td>
                   <td style="width:20px"><?php echo $data['productid'] ;?></td>
                   <td style="width:20px"><?php echo $data['category'] ;?></td>
                   <td style="width:20px"><?php echo $data['shippingduration']." Days" ;?></td>
		   	

               </tr>
               <?php }?>
   </table>
   <?php }?>
          
        </div>
    </div>
       
    </div> <!--end of main content-->
	

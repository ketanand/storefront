<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->model('enterprisesmodel');
		$displayData['formStart'] = 'No';
		$this->load->view('welcome',$displayData);
	}

	
	
	public function insertMovies(){
		$this->load->model('enterprisesmodel');
		$insertResult=$this->enterprisesmodel->insertData($_FILES);
		if($insertResult)
		{
			echo "Data Successfully Added. Total Uploaded : ".$insertResult;
		}else{
			echo "There was some problem adding the data.";
		}
		
	}
	
	public function searchMovies(){
    	$this->load->model('enterprisesmodel');
    	if(isset($_POST['searchedKey']) && $_POST['searchedKey']!=''){
            $keywords = $_POST['searchedKey'];
            $displayData['movieResult'] = $this->enterprisesmodel->getMovies($keywords);
	    $displayData['formStart'] = 'Yes';	    
            $this->load->view('welcome',$displayData);
                
    	}else {
		$displayData['message'] = "Please enter keywords and try again !";	
    		$this->load->view('welcome',$displayData);
    	}    	
    }
	public function movieVersions($movieGroup){
	$this->load->model('enterprisesmodel');
	if(isset($movieGroup) && $movieGroup!=''){
            $displayData['movieResult'] = $this->enterprisesmodel->getMoviesByGroupId($movieGroup);
	    if(isset($displayData['movieResult'][0]['title']))
	    {	
	    	$displayData['title'] = $displayData['movieResult'][0]['title'];		
	    	$displayData['formStart'] = 'Yes';	    
            	$this->load->view('versions',$displayData);
            }
	    else
	    {
		$displayData['message'] = "No results available !";	
    		$this->load->view('versions',$displayData);
	    }			  
    	}else {
		$displayData['message'] = "No versions available !";	
    		$this->load->view('versions',$displayData);
    	}

	}



}//EOF


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

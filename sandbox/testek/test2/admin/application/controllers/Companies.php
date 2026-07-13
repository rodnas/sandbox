<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Companies extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
        $this->load->model('companies_model');
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function companiesListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->companies_model->companiesListingCount($searchText);

			$returns = $this->paginationCompress ( "companiesListing/", $count, 10 );
            
            $data['companiesRecords'] = $this->companies_model->companiesListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : Companies Listing';
            
            $this->loadViews("companies", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCompany()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('companies_model');
            $data['roles'] = $this->companies_model->getCategoriesRoles();

            $this->global['pageTitle'] = 'CodeInsect : Add New Company';

            $this->loadViews("addCompany", $this->global, $data, NULL);
        }
    }

    function addNewCompany()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[100]');
            $this->form_validation->set_rules('email','Email','trim|required|max_length[100]');
            $this->form_validation->set_rules('address','Address','trim|required|max_length[100]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addCompany();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $email = ucwords(strtolower($this->security->xss_clean($this->input->post('email'))));
                $address = ucwords(strtolower($this->security->xss_clean($this->input->post('address'))));
                $companyInfo = array('name'=> $name,'email'=>$email,'address'=>$address,'categoriesID'=>$categoriesID);
                $categoriesID = $this->input->post('categoriesID');
                
                $this->load->model('companies_model');
                $result = $this->companies_model->addNewCompany($companyInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Company created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Company creation failed');
                }
                
                redirect('addCompany');
            }
        }
    }
    
    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOldCompany($id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($id == null)
            {
                redirect('companiesListing');
            }
            
            $data['roles'] = $this->companies_model->getCategoriesRoles();
            $data['companyInfo'] = $this->companies_model->getCompanyInfo($id);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit Company';
            
            $this->loadViews("editOldCompany", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editCompany()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $id = $this->input->post('id');
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[100]');
            $this->form_validation->set_rules('email','Email','trim|required|max_length[100]');
            $this->form_validation->set_rules('address','Address','trim|required|max_length[100]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldCompany($id);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $address = ucwords(strtolower($this->security->xss_clean($this->input->post('address'))));
                $categoriesID = $this->input->post('categoriesID');
                
                $companyInfo = array();
                
                $companyInfo = array('name'=>$name, 'email'=>$email, 'address'=>$address,'categoriesID'=>$categoriesID);
                
                $result = $this->companies_model->editCompany($companyInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }
                
                redirect('companiesListing');
            }
        }
    }


    /**
     * This function is used to delete the user using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $id = $this->input->post('id');

            $result = $this->companies_model->deleteCompany($id);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

}

?>
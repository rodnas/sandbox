<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Categories extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
        $this->load->model('categories_model');
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
    function categoriesListing()
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
            
            $count = $this->categories_model->categoriesListingCount($searchText);

			$returns = $this->paginationCompress ( "categoriesListing/", $count, 10 );
            
            $data['categoriesRecords'] = $this->categories_model->categoriesListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : Categories Listing';
            
            $this->loadViews("categories", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('categories_model');
            $data['roles'] = $this->categories_model->getCategoriesRoles();
            
            $this->global['pageTitle'] = 'CodeInsect : Add New Category';

            $this->loadViews("addCategory", $this->global, $data, NULL);
        }
    }

    function addNewCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addCategory();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $categoryInfo = array('name'=> $name);
                
                $this->load->model('categories_model');
                $result = $this->categories_model->addNewCategory($categoryInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Category created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category creation failed');
                }
                
                redirect('addCategory');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOldCategory($id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($id == null)
            {
                redirect('categoriesListing');
            }
            
            $data['roles'] = $this->categories_model->getCategoriesRoles();
            $data['categoryInfo'] = $this->categories_model->getCategoryInfo($id);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit Category';
            
            $this->loadViews("editOldCategory", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $id = $this->input->post('id');
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldCategory($id);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                
                $categoryInfo = array();
                
                $categoryInfo = array('name'=>$name);
                
                $result = $this->categories_model->editCategory($categoryInfo, $id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Category updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category updation failed');
                }
                
                redirect('categoriesListing');
            }
        }
    }


    /**
     * This function is used to delete the user using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $id = $this->input->post('id');

            $result = $this->categories_model->deleteCategory($id);
            
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



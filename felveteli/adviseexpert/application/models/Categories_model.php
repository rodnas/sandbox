<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Categories_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function categoriesListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.name');
        $this->db->from('categories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function categoriesListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.name');
        $this->db->from('categories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getCategoriesRoles()
    {
        $this->db->select('id, name');
        $this->db->from('categories');
        $this->db->where('id !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCategory($categoryInfo)
    {
        $this->db->trans_start();
        $this->db->insert('categories', $categoryInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getCategoryInfo($id)
    {
        $this->db->select('id, name');
        $this->db->from('categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editCategory($categoryInfo, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $categoryInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCategory($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
echo $id;
die();        
        return TRUE;
    }


    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getCategoryInfoById($id)
    {
        $this->db->select('id, name');
        $this->db->from('categories');
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getCategoryInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.id, BaseTbl.name');
        $this->db->from('categories as BaseTbl');
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  
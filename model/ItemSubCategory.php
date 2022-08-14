<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author Nadeeshani
 */
class ItemSubCategory extends IdentifiedBaseModel
{
    //put your code here
    public $id;
    public $sub_category;

    public function loadSubCategory()
    {
        $result = mysqli_query($this->con, "SELECT id,sub_category FROM item_subcategory");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}

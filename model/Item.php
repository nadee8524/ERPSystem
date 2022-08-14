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
class Item extends IdentifiedBaseModel
{
    //put your code here
    public $id;
    public $item_code;
    public $item_category;
    public $item_subcategory;
    public $item_name;
    public $quantity;
    public $unit_price;

    public function deleteItem($id)
    {
        $invMaster = new Invoice_Master();
        $data = $invMaster->getDataById('item_id', $id);
        if (!$data) {
            $query =  "DELETE FROM item WHERE id='$id'";
            $res =  $this->con->query($query);
            echo json_encode($res);
            if (!$res) {
                $err =  $this->con->error_list;
            }
        }
        return $res;
    }
}

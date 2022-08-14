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

    public function loadItem()
    {
        $result = mysqli_query($this->con, "SELECT `item_name`,item_category.category,item_subcategory.sub_category,quantity FROM `item` INNER JOIN item_category ON item.item_category=item_category.id INNER JOIN item_subcategory ON item.item_subcategory=item_subcategory.id ");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author Nadeeshani
 */
class Customer extends IdentifiedBaseModel
{

    //put your code here
    public $id;
    public $title;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $contact_no;
    public $district;

    public function deleteCustomer($id)
    {
        $invoice = new Invoice();
        $data = $invoice->getDataById('customer', $id);
        if (!$data) {
            $query =  "DELETE FROM customer WHERE id='$id'";
            $res =  $this->con->query($query);
            echo json_encode($res);
            if (!$res) {
                $err =  $this->con->error_list;
            }
        }
        return $res;
    }
}

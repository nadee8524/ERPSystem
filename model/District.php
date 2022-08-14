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
class District extends IdentifiedBaseModel
{

    //put your code here
    public $id;
    public $district;
    public $active;

    public function loadDistrict()
    {
        $result = mysqli_query($this->con, "SELECT id,district FROM district WHERE active='yes'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerController
 *
 * @author Nadeeshani
 */
class CustomerController extends BaseController
{

    //put your code here
    public function newCustomer()
    {
        $this->loadView();
    }

    public function customerList()
    {
        $this->loadView();
    }

    public function loadCustomers()
    {
        $customer = new Customer();
        $res = $customer->findList();
    }

    public function loadByName()
    {
        $customer = new Customer();
        $name = $_POST['fname'];
        $customer->findByField('fname', $name);
    }

    function loadDistrict()
    {
        $dist = new District();
        $dist->loadDistrict();
    }

    public function addCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusData = $_POST["cusData"];

        $customer = new Customer();

        $customer->id = $cusData['cusId'];
        $customer->title = $cusData['title'];
        $customer->first_name = $cusData['fName'];
        $customer->middle_name = $cusData['mName'];
        $customer->last_name = $cusData['lName'];
        $customer->contact_to = $cusData['contact'];
        $customer->district = $cusData['district'];

        $res = $customer->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updateCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusData = $_POST["cusData"];

        $customer = new Customer();

        $customer->id = $cusData['id'];
        $customer->title = $cusData['title'];
        $customer->first_name = $cusData['fName'];
        $customer->middle_name = $cusData['mName'];
        $customer->last_name = $cusData['lName'];
        $customer->contact_no = $cusData['contact'];
        $customer->district = $cusData['district'];

        $res = $customer->update();

        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deleteCustomer()
    {
        $customer = new Customer();
        $customer->deleteCustomer($_POST['id']);
    }
}

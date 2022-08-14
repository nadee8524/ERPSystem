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
class Invoice extends IdentifiedBaseModel
{
    public $id;
    public $date;
    public $time;
    public $invoice_no;
    public $customer;
    public $item_count;
    public $amount;
}

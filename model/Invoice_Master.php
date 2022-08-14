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
class Invoice_Master extends IdentifiedBaseModel
{
    public $id;
    public $invoice_no;
    public $item_id;
    public $quantity;
    public $unit_price;
    public $amount;
}

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

    public function retrieveInvoice()
    {
        $invData = $_POST['sData'];
        $fromDate = $invData['fromDate'];
        $toDate = $invData['toDate'];
        $result = mysqli_query($this->con, "SELECT `invoice_no`,`date`,customer.first_name,customer.middle_name,customer.last_name,district.district,`item_count`,`amount` FROM `invoice` INNER JOIN customer ON invoice.customer = customer.id INNER JOIN district ON customer.district=district.id "
            . " WHERE invoice.date BETWEEN '" . $fromDate . "' AND '" . $toDate . "' ORDER BY invoice.invoice_no");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function retrieveInvoiceItem()
    {
        $invData = $_POST['sData'];
        $fromDate = $invData['fromDate'];
        $toDate = $invData['toDate'];
        $result = mysqli_query($this->con, "SELECT invoice.invoice_no,invoice.date,customer.first_name,customer.middle_name,customer.last_name, item.item_code,item.item_name, item_category.category,invoice_master.unit_price FROM `invoice_master` INNER JOIN invoice ON invoice_master.invoice_no=invoice.invoice_no INNER JOIN customer ON invoice.customer=customer.id INNER JOIN item ON invoice_master.item_id=item.id INNER JOIN item_category ON item.item_category=item_category.id "
            . " WHERE invoice.date BETWEEN '" . $fromDate . "' AND '" . $toDate . "' ORDER BY invoice.invoice_no");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}

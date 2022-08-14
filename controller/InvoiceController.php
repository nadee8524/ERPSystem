<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceController
 *
 * @author Nadeeshani
 */
class InvoiceController extends BaseController
{
    public function LoadInvNo()
    {
        $invoiceHeader = new Invoice();
        $invoiceHeader->loadID();
    }

    public function retrieveInvoice()
    {
        $invoiceHeader = new Invoice();
        $invoiceHeader->retrieveInvoice();
    }

    public function retrieveInvoiceItem()
    {
        $invoiceHeader = new Invoice();
        $invoiceHeader->retrieveInvoiceItem();
    }
}

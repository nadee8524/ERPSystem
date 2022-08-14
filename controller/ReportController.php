<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportController
 *
 * @author Nadeeshani
 */
class ReportController extends BaseController {

    //put your code here
    public function rawMaterialStock() {
        $this->loadView();
    }

    public function itemStock() {
        $this->loadView();
    }

    public function customerRegister() {
        $this->loadView();
    }

    public function InvoiceSummeryDateRange() {
        $this->loadView();
    }

    public function CustomerWiseInvoiceSummery() {
        $this->loadView();
    }

    public function Invoice() {
        $this->loadView();
    }

    public function SupplierRegister() {
        $this->loadView();
    }

    public function ItemWiseSalesSummery() {
        $this->loadView();
    }

    public function CustomerWisePayment() {
        $this->loadView();
    }

    public function CusDuePayament() {
        $this->loadView();
    }

    public function GRNSummeryDateRange() {
        $this->loadView();
    }

    public function SupplierWisePayment() {
        $this->loadView();
    }

    public function ManufactureDateRange(){
        $this->loadView();
    }

    function PurchaseOrder() {
        $this->loadView();
    }
    
    public function cusWiseInvoice() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->cusWiseInvoice();
    }

    public function itemWiseInvoice() {
        $invoiceDetails = new invoiceDetails();
        $invoiceDetails->itemWiseInvoice();
    }

    public function cusWisePayment() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->cusWisePayment();
    }

    public function GRNSummeryDate() {
        $grnHeader = new GRNHeader();
        $grnHeader->GRNSummeryDate();
    }

    public function supWisePayment() {
        $supplierPaymentHeader = new SupplierPayHeader();
        $supplierPaymentHeader->supWisePayment();
    }

    public function manufactureDate() {
        $manHeader = new ManHeader();
        $manHeader->manufactureDate();
    }

}

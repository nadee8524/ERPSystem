<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemController
 *
 * @author Nadeeshani
 */
class ItemController extends BaseController
{

    //put your code here
    public function newItem()
    {
        $this->loadView();
    }

    public function itemList()
    {
        $this->loadView();
    }

    public function itemStock()
    {
        $this->loadView();
    }

    public function loadItems()
    {
        $item = new Item();
        $item->findList();
    }

    public function loadItemID()
    {
        $item = new Item();
        $item->loadID();
    }

    public function loadCategory()
    {
        $category = new ItemCategory();
        $category->loadCategory();
    }

    public function loadSubCategory()
    {
        $category = new ItemSubCategory();
        $category->loadSubCategory();
    }

    public function addItem()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $itemData = $_POST['itemData'];

        $item = new Item();

        $item->item_code = $itemData['itemId'];
        $item->item_category = $itemData['category'];
        $item->item_subcategory = $itemData['subCat'];
        $item->item_name = $itemData['itemname'];
        $item->quantity = $itemData['qty'];
        $item->unit_price = $itemData['price'];

        $res = $item->save();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updateItem()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $itemData = $_POST['itemData'];

        $item = new Item();
        $item->id = $itemData['id'];
        $item->item_code = $itemData['itemId'];
        $item->item_category = $itemData['category'];
        $item->item_subcategory = $itemData['subCat'];
        $item->item_name = $itemData['itemname'];
        $item->quantity = $itemData['qty'];
        $item->unit_price = $itemData['price'];

        $res = $item->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function exists()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $rId = $_POST["itemid"];
        $item = new Item();
        $item->checkId($rId);
    }

    function deleteItem()
    {
        $item = new Item();
        $item->deleteItem($_POST['id']);
    }
}

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>ERP System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src="<?= RESOURCES ?>vendor/jquery.min.js"></script>
    <script src="<?= RESOURCES ?>vendor/pagination.min.js"></script>
    <!--         Bootstrap 3.3.2 -->
    <link href="<?= RESOURCES ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--Font Awesome Icons-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--Ionicons-->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!--Theme style-->
    <link href="<?= RESOURCES ?>dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?= RESOURCES ?>dist/css/tableprop.css" rel="stylesheet" type="text/css" />
    <!--         AdminLTE Skins. Choose a skin from the css/skins 
                     folder instead of downloading all of them to reduce the load. -->
    <link href="<?= RESOURCES ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= RESOURCES ?>dist/css/jquery-ui.css">
    <link href="<?= RESOURCES ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <script src="<?= RESOURCES ?>vendor/jquery.validate.min.js"></script>
    <script src="<?= RESOURCES ?>plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= RESOURCES ?>plugins/pdf/jspdf.min.js"></script>
    <!--<link href="../<?= RESOURCES ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- side bar -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->

            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview" id="item">
                        <a href="../Item/newItem">
                            <i class="fa fa-book"></i>
                            <span>New Item</span>
                        </a>
                        <a href="../Item/itemList">
                            <i class="fa fa-book"></i>
                            <span>Item List</span>
                        </a>
                    </li>
                    <li class="treeview" id="salesSli">
                        <a href="../Customer/newCustomer">
                            <i class="fa fa-shopping-cart"></i>
                            <span>New Customer</span>
                        </a>
                        <a href="../Customer/customerList">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Customer List</span>
                        </a>
                    </li>
                    <li class="header">REPORTS</li>

                    <li class="treeview" id="salesSli">
                        <a href="../Report/InvoiceSummeryDateRange">
                            <i class="fa fa-circle-o"></i>
                            <span>Invoice Summery - Date Range</span>
                        </a>
                    </li>
                    <li class="treeview" id="salesSli">
                        <a href="../Report/ItemWiseInvoiceSummeryDateRange">
                            <i class="fa fa-circle-o"></i>
                            <span>Item Wise Invoice Summery - Date Range</span>
                        </a>
                    </li>
                    <li class="treeview" id="salesSli">
                        <a href="../Report/ItemReport">
                            <i class="fa fa-circle-o"></i>
                            <span>Item Report</span>
                        </a>
                    </li>
                    <li class="treeview" id="rSales">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Sales</span>
                            <span class="label label-primary pull-right"></span>
                        </a>
                        <!-- <ul class="treeview-menu">
                            <li><a href="../Report/CustomerRegister"><i class="fa fa-circle-o"></i>Customer Register</a></li>
                            <li><a href="../Report/InvoiceSummeryDateRange"><i class="fa fa-circle-o"></i>Invoice Summery - Date Range</a></li>
                            <li><a href="../Report/CustomerWiseInvoiceSummery"><i class="fa fa-circle-o"></i>Invoice Summery - Customer</a></li>
                            <li><a href="../Report/ItemWiseSalesSummery"><i class="fa fa-circle-o"></i>Invoice Summery - Item</a></li>
                            <li><a href="../Report/CustomerWisePayment"><i class="fa fa-circle-o"></i>Customer Payment - Customer</a></li>
                            <li><a href="../Report/CusDuePayament"><i class="fa fa-circle-o"></i>Customer Due Payment</a></li>
                        </ul> -->
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
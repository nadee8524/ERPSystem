<div class="content-wrapper" >
    <!-- Content Header (Page header) -->

    <section class="content-header">

    </section>


    <!-- Main content -->

    <section class="invoice">
        <div id="capture">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <img src="<?= RESOURCES ?>dist/logo.png" width="70" height="35">
                        <small class="pull-right" id="date"></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info" >
                <h3 style="text-align: center">Purchase Order</h3>
                <h3></h3>
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Top Notch Water Systems</strong><br>
                        No.01,<br>
                        Dumbara Junction,Ellagawa<br>
                        Phone: 0342 268 640<br/>
                        Email: TopNotchwatersystems@gmail.com
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address id="cusadd">

                    </address>
                </div><!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b id="invNo"></b><br/>
                    <br/>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="forceWidth text-left" style="text-align: center forceWidth">Raw Material</th>
                                <th style="text-align: center forceWidth" >Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="data">

                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-8">

                </div><!-- /.col -->
                
            </div><!-- /.row -->
        </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                <button class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</button>
                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;" id="createPDF"><i class="fa fa-download"></i> Generate PDF</button>-->
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
//    var invNo = $('#cmbCus').val();
    var poNo = '<?php echo $_POST['txtPONo']; ?>';
    $.ajax({
        url: "/TopNotch/po/loadPoData",
        method: "POST",
        data: {sData: poNo},
        dataType: "JSON",
        success: function (data) {
            $('#data').empty();
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].description + "</td>";
                html += "<td>" + data[a].qty + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
//            document.getElementById("invNo").innerHTML = "Invoice#: "+data[0].invNo;
            document.getElementById("invNo").innerHTML = "PONo#: " + data[0].poNo;
            document.getElementById("date").innerHTML += "Date: " + formatDate(data[0].podate);
            var add = "";
            add += "<strong>" + data[0].fname + " " + data[0].lname + "</strong><br>";
            add += data[0].address + "<br>";
            add += "Phone: " + data[0].tp + "<br/>";
            add += "Email: " + data[0].email;
            document.getElementById("cusadd").innerHTML += add;
        }
    });
    $(document).ready(function () {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = dd + "/" + mm + "/" + yyyy;
//        document.getElementById("date").innerHTML += "Date: " + today;
//        document.getElementById("date").innerHTML += "Date: 26-11-2019" ;
    });
    function formatDate(date) {
        date = new Date(date);
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0');
        var yyyy = date.getFullYear();
        return date = dd + "-" + mm + "-" + yyyy;
    }

$("#print").on('click', function () {
    window.print();
});
</script>
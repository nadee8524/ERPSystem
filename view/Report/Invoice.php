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
                                <th class="forceWidth text-center">Item</th>
                                <th style="text-align: center forceWidth"  >Price</th>
                                <th style="text-align: center forceWidth" >Quantity</th>
                                <th style="text-align: center forceWidth" >Amount</th>
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
                <div class="col-xs-4">
                    <p class="lead" id="due">Amount Due</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Net Total:</th>
                                <td id="netTot"></td>
                            </tr>
                            <tr>
                                <th>Discount (%):</th>
                                <td id="discount"></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td id="total"></td>
                            </tr>
                        </table>
                    </div>
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
    var invNo = '<?php echo $_POST['txtInvNo']; ?>';
    $.ajax({
        url: "/TopNotch/invoice/retrieveInvoiceNo",
        method: "POST",
        data: {sData: invNo},
        dataType: "JSON",
        success: function (data) {
            $('#data').empty();
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].description + "</td>";
                html += "<td>" + data[a].sellPrice + ".00</td>";
                html += "<td>" + data[a].qty + "</td>";
                html += "<td class='text-center'>" + data[a].amount + ".00</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
            document.getElementById("netTot").innerHTML = data[0].netamount + ".00";
            document.getElementById("discount").innerHTML = (data[0].netamount * data[0].discount) / 100 + ".00";
            document.getElementById("total").innerHTML = data[0].totamount + ".00";
//            document.getElementById("invNo").innerHTML = "Invoice#: "+data[0].invNo;
            document.getElementById("invNo").innerHTML = "Invoice#: " + data[0].invNo;
            document.getElementById("date").innerHTML += "Date: " + formatDate(data[0].invdate);
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Customer Due Payment</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select class="form-control" name="cmbCus" id="cmbCus">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label></label>
                                        <div class="input-group">
                                            <input type="button" name="submit" id="btnSearch" class="btn btn-primary" value="Search">
                                        </div>
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                        </div><!--md-->
                    </div>
                </div><!--row-->
            </form>
        </div><!-- /.box -->
    </section>

    <!-- Main content -->
    <section class="invoice" id="report">
        <!-- title row -->
        <div class="row justify-content-between">
            <div class="col-xs-10">
                <h2 class="page-header">
                    Customer Payment Summery
                    <small id="date"></small>
                </h2>
                <h4 id="date"></h4>
            </div><!-- /.col -->
            <div class="col-xs-2">
                <small class="pull-right"><img src="<?= RESOURCES ?>dist/logo.png" width="70" height="35"></small>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-11 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Customer</th>
                            <th>Invoice Date</th>
                            <th>Invoice Amount</th>
                            <th>Total Paid</th>
                            <th class='text-center'>Balance Amount</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-5">

            </div><!-- /.col -->
            <div class="col-xs-11">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">Total Balance:</th>
                            <td id="total" class="text-right"></td>
                        </tr>
                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        document.getElementById("report").style.display = "none";
    });

    //Load Customer
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/customer/loadName", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].fname + " " + data[a].lname;
                html += "</option>";
            }
            document.getElementById("cmbCus").innerHTML += html;
        }
    };

//Search 
    $(document).on("click", "#btnSearch", function () {
        document.getElementById("report").style.display = "block";
        var search = {
            customer: $('#cmbCus').val()
        };
        $.ajax({
            url: "/TopNotch/customer/loadCusDuePayments",
            method: "POST",
            data: {sData: search},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                var html = "";
                var total = 0;
                for (var a = 0; a < data.length; a++) {
                    total = total + (parseFloat(data[a].balAmount));
                    html += "<tr>";
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
                    html += "<td>" + data[a].invDate + "</td>";
                    html += "<td class='text-right'>" + data[a].invoiceAmount + ".00</td>";
                    html += "<td class='text-right'>" + data[a].totalPaid + ".00</td>";
                    html += "<td class='text-right'>" + data[a].balAmount + ".00</td>";
                    html += "</tr>";
                }
                document.getElementById("data").innerHTML += html;
                document.getElementById("total").innerHTML = total + ".00";
                document.getElementById("date").innerHTML = $('#cmbCus option:selected').text();
            }
        });
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
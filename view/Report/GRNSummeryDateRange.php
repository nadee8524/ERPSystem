<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">GRN Summery - Date Range</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>From</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="dateFrom"/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>To</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="dateTo"/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                            <div class="col-md-4">
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
                    GRN Summery
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
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>GRN No </th>
                            <th>Date</th>
                            <th>Supplier </th>
                            <th class="text-center">Total Amount</th>
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
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">Total:</th>
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
        $('#dateFrom').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
        $('#dateTo').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
    });

//Search 
    $(document).on("click", "#btnSearch", function () {
        document.getElementById("report").style.display = "block";

        var dateFrom = $('#dateFrom').val();
        var dateTo = $('#dateTo').val();
        var search = {
            fromDate: $("#dateFrom").val(),
            toDate: $("#dateTo").val()
        };
        $.ajax({
            url: "/TopNotch/report/GRNSummeryDate",
            method: "POST",
            data: {sData: search},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                var html = "";
                var total = 0;
                for (var a = 0; a < data.length; a++) {
                    total = total + (parseFloat(data[a].totalamount));
                    html += "<tr>";
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + formatDate(data[a].grndate) + "</td>";
                    html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
                    html += "<td class='text-right'>" + data[a].totalamount + ".00</td>";
                    html += "</tr>";
                }
                document.getElementById("data").innerHTML += html;
                document.getElementById("total").innerHTML = total + ".00";
                document.getElementById("date").innerHTML = "From: " +
                        $('#dateFrom').val() + " To: " + $('#dateTo').val();
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
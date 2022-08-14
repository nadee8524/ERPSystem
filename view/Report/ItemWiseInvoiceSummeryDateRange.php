<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Item Wise Invoice Summery - Date Range</h3>
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
                                            <input type="text" class="form-control pull-right" id="dateFrom" />
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
                                            <input type="text" class="form-control pull-right" id="dateTo" />
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
                        </div>
                        <!--md-->
                    </div>
                </div>
                <!--row-->
            </form>
        </div><!-- /.box -->
    </section>

    <!-- Main content -->
    <section class="invoice" id="report">
        <!-- title row -->
        <div class="row justify-content-between">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Item Wise Invoice Summery
                    <small id="date"></small>
                </h2>
                <h4 id="date"></h4>
            </div><!-- /.col -->

        </div>
        <!-- info row -->
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice No </th>
                            <th>Date</th>
                            <th>Customer </th>
                            <th>Item</th>
                            <th>Item Category</th>
                            <th>Unit Price</th>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        document.getElementById("report").style.display = "none";
        $('#dateFrom').datepicker({
            dateFormat: 'yy-mm-dd'
        }).datepicker('setDate', 'today');
        $('#dateTo').datepicker({
            dateFormat: 'yy-mm-dd'
        }).datepicker('setDate', 'today');
    });

    //Search 
    $(document).on("click", "#btnSearch", function() {
        document.getElementById("report").style.display = "block";

        var dateFrom = $('#dateFrom').val();
        var dateTo = $('#dateTo').val();
        var search = {
            fromDate: $("#dateFrom").val(),
            toDate: $("#dateTo").val()
        };
        $.ajax({
            url: "<?= APPROOT ?>/invoice/retrieveInvoiceItem",
            method: "POST",
            data: {
                sData: search
            },
            dataType: "JSON",
            success: function(data) {
                $('#data').empty();
                console.log(data);
                var html = "";
                var total = 0;
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td>" + data[a].invoice_no + "</td>";
                    html += "<td>" + formatDate(data[a].date) + "</td>";
                    html += "<td>" + data[a].first_name + " " + data[a].middle_name + " " + data[a].last_name + "</td>";
                    html += "<td>" + data[a].item_code + " - " + data[a].item_name + "</td>";
                    html += "<td>" + data[a].category + "</td>";
                    html += "<td class='text-right'>" + data[a].unit_price + ".00</td>";
                    html += "</tr>";
                }
                document.getElementById("data").innerHTML += html;
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

    $("#print").on('click', function() {
        window.print();
    });
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row justify-content-between">
            <div class="col-xs-10">
                <h2 class="page-header" id="date">
                    Item Report
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="forceWidth">Item Name</th>
                            <th class="forceWidth">Item Category</th>
                            <th class="forceWidth">Item Sub Category</th>
                            <th class="forceWidth">Item Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
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
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?= APPROOT ?>/item/loadItem", true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            var total = 0;
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].item_name + "</td>";
                html += "<td>" + data[a].category + "</td>";
                html += "<td>" + data[a].sub_category + "</td>";
                html += "<td>" + data[a].quantity + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
            document.getElementById("total").innerHTML += total;
        }
    };

    $(document).ready(function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
    });

    $("#print").on('click', function() {
        window.print();
    });
</script>
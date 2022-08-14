<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item List
            <small>View Manage Item Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Item List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Items</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmItemList">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id">
                                        <label for="inputID">Item ID</label>
                                        <input type="text" class="form-control" id="itemid" placeholder="Enter Item ID" name="itemid" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" id="category" required>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select class="form-control" name="subcat" id="subcat" required>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputDescription">Item Name</label>
                                        <input type="text" class="form-control" id="itemname" placeholder="Enter Item Name" name="itemname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPrice">Quantity</label>
                                        <input type="text" class="form-control" id="qty" placeholder="Enter Quantity" name="qty" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPrice">Unit Price</label>
                                        <input type="text" class="form-control" id="price" placeholder="Enter Unit Price" name="txtPrice" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <!--<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>-->
                            <input type="button" class="btn btn-primary" id="btnUpdate" value="Update" />
                            <!--<button type="submit" name="submit" onclick="submitForm('CollectionScheduleReport.php')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</button>-->
                            <script>
                                function submitForm(action) {
                                    $("#advform").attr("action", action);
                                    $("#advform").submit();
                                }
                            </script>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>
            <!--/.col (left) -->
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Item List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Id</th>
                                    <th>Category </th>
                                    <th>Sub Category </th>
                                    <th>Item Name </th>
                                    <th>Quantity </th>
                                    <th>Unit Price </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    //Load category
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?= APPROOT ?>/item/loadCategory", true);
    ajax.send();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].category;
                html += "</option>";
            }
            document.getElementById("category").innerHTML += html;
        }
    };

    //Load subcategory
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?= APPROOT ?>/item/loadSubCategory", true);
    ajax.send();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].sub_category;
                html += "</option>";
            }
            document.getElementById("subcat").innerHTML += html;
        }
    };

    $(document).ready(function() {
        loadItem();
    });

    function loadItem() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "<?= APPROOT ?>/item/loadItems", true);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";;
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + data[a].item_code + "</td>";
                    html += "<td>" + data[a].item_category + "</td>";
                    html += "<td>" + data[a].item_subcategory + "</td>";
                    html += "<td>" + data[a].item_name + "</td>";
                    html += "<td>" + data[a].quantity + "</td>";
                    html += "<td>" + data[a].unit_price + "</td>";
                    html += "<td><input type='submit' id='btnView' class='btn btn-success btn-xs'value='View'>\n\
            <button type='button' class='btn btn-danger btn-xs' id='btnDel'>Delete</button></td>";
                    html += "</tr>";
                }
                document.getElementById("data").innerHTML += html;
                $('#table1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bRetrieve": true,
                    "bAutoWidth": false
                });
            }
        };
    }

    //load items
    $('table tbody').on('click', '#btnView', function() {
        var currow = $(this).closest('tr');
        $("#id").val(currow.find('td:eq(0)').text());
        $("#itemid").val(currow.find('td:eq(1)').text());
        $("#category").val(currow.find('td:eq(2)').text());
        $("#subcat").val(currow.find('td:eq(3)').text());
        $("#itemname").val(currow.find('td:eq(4)').text());
        $("#qty").val(currow.find('td:eq(5)').text());
        $("#price").val(currow.find('td:eq(6)').text());
    })

    //update
    $(document).ready(function() {
        $(document).on("click", "#btnUpdate", function() {
            $("#frmItemList").validate();
            if ($("#frmItemList").valid()) {
                var item = {
                    id: $("#id").val(),
                    itemId: $("#itemid").val(),
                    category: $("#category").val(),
                    subCat: $("#subcat").val(),
                    itemname: $("#itemname").val(),
                    qty: $("#qty").val(),
                    price: $("#price").val()
                };
                $.ajax({
                    url: "<?= APPROOT ?>/item/updateItem",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        itemData: item
                    },
                    success: function(data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Item Successfully Updated.</div></div>');
                        //                        alert("Successfully registered!");
                        $('#table1').find("tr:gt(0)").remove();
                        loadItem();
                        console.log(data);
                        $(frmItemList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                        alert(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });
    });

    //delete
    $('table tbody').on("click", "#btnDel", function() {
        if (confirm("Are you sure you want to delete this record?")) {
            var currow = $(this).closest('tr');
            var id = currow.find('td:eq(0)').text();
            $.ajax({
                url: "<?= APPROOT ?>/Item/deleteItem",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Customer Successfully Deleted.</div></div>');
                    //                        alert("Successfully registered!");
                    $('#table1').find("tr:gt(0)").remove();
                    loadItem();
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">This Item has an Invoice.</div></div>');
                    // console.log(errorThrown);
                }
            });
        }
    });
</script>
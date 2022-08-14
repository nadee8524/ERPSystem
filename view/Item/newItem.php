<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Item Form
            <small>Creating New Items</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Item</a></li>
            <li class="active">New Item</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Fill all Fields</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmItemDet">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>
            <!--/.col (left) -->

        </div> <!-- /.row -->
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

    //save
    $(document).ready(function() {
        $("#frmItemDet").validate({
            rules: {
                itemId: {
                    required: true
                }
            }
        });
        $(document).on("click", "#btnSave", function() {
            $("#frmItemDet").validate();
            if ($("#frmItemDet").valid()) {
                var item = {
                    itemId: $("#itemid").val(),
                    category: $("#category").val(),
                    subCat: $("#subcat").val(),
                    itemname: $("#itemname").val(),
                    qty: $("#qty").val(),
                    price: $("#price").val()
                };
                $.ajax({
                    url: "<?= APPROOT ?>/item/addItem",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        itemData: item
                    },
                    success: function(data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Item Successfully Added.</div></div>');
                        //                        alert("Successfully registered!");
                        console.log(data);
                        $(frmItemDet).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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
</script>
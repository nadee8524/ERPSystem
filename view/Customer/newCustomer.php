<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Customer Form
            <small>Creating New Customer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">New Customer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-6">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Fill all Fields</h3>
                    </div><!-- /.box-header -->
                    <div id="err">

                    </div>
                    <!-- form start -->
                    <form id="frmCustomer" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <!--<input type="hidden" id="invno" name="txtInvNo">-->
                                        <label>Title</label>
                                        <select class="form-control" name="title" id="title" required>
                                            <option>Mr.</option>
                                            <option>Mrs.</option>
                                            <option>Miss.</option>
                                            <option>Dr.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--md-->
                            <div class="col-md-9">
                                <div class="box-body">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group">
                                        <label for="inputFname">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="txtFName" required>
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                            <!--md-->
                        </div>
                        <!--row-->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputFname">Middle Name</label>
                                <input type="text" class="form-control" id="mname" placeholder="Enter Middle Name" name="txtMName" required="">
                            </div>
                            <div class="form-group">
                                <label for="inputLname">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="txtLName" required>
                            </div>
                            <div class="form-group">
                                <label for="inputTelephone">Contact Number</label>
                                <input type="cont" class="form-control" id="contact" placeholder="Enter Contact" name="txtCont" required>
                            </div>
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-control" name="district" id="district" required>
                                    <option></option>
                                </select>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                            <!--<button type="submit" name="savecus" id="btnSave" class="btn btn-primary">Submit</button>-->
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>
            <!--/.col (left) -->

        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        $("#frmCustomer").validate({
            rules: {
                fname,
                lname,
                mname,
                contact: {
                    required: true,
                }
            }
        });
        //save
        $(document).on("click", "#btnSave", function() {
            $("#frmCustomer").validate();
            if ($("#frmCustomer").valid()) {
                var customer = {
                    //                    cusId: $("#customerid").val(),
                    title: $("#title").val(),
                    fName: $("#fname").val(),
                    mName: $("#mname").val(),
                    lName: $("#lname").val(),
                    contact: $("#contact").val(),
                    district: $("#district").val()
                };

                $.ajax({
                    url: "<?= APPROOT ?>/customer/addCustomer",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        cusData: customer
                    },
                    success: function(data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Customer Successfully Registered.</div></div>');
                        //                        alert("Successfully registered!");
                        console.log(data);
                        $(frmCustomer).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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

    //Load District
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?= APPROOT ?>/customer/loadDistrict", true);
    ajax.send();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].district;
                html += "</option>";
            }
            document.getElementById("district").innerHTML += html;
        }
    };
</script>
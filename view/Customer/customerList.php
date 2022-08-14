<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer List
            <small>View Manage Customer Detail</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Customers</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form role="form" id="frmCusList">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!--<input type="hidden" id="invno" name="txtInvNo">-->
                                                <label>Title</label>
                                                <select class="form-control" name="title" id="title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss.</option>
                                                    <option value="Dr.">Dr.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--md-->
                                        <div class="col-md-8">
                                            <!-- Date dd/mm/yyyy -->
                                            <div class="form-group">
                                                <label for="inputFname">First Name</label>
                                                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="txtFName" required>
                                            </div><!-- /.form group -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCusmname">Middle Name</label>
                                        <input type="text" class="form-control" id="cusMName" placeholder="Enter Middle Name" name="txtCusMName" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCuslname">Last Name</label>
                                        <input type="text" class="form-control" id="cusLName" placeholder="Enter Last Name" name="txtCusMName" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputTelephone">Contact Number</label>
                                        <input type="text" class="form-control" id="contact" placeholder="Enter Contact Number" name="txtCont" required>
                                    </div>

                                    <div class="form-group">
                                        <label>District</label>
                                        <select class="form-control" name="district" id="district">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <!--box-body-->
                            </div>
                            <!--md-->
                        </div>
                        <!--row-->
                        <div class="box-footer">
                            <!--<button type="submit" name="updatecus" id="updatecus" class="btn btn-primary">Update</button>-->
                            <input type="button" name="submit" id="btnUpdate" class="btn btn-primary" value="Update">
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
                        <h3 class="box-title">Customer List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Id </th>
                                    <th>Title </th>
                                    <th>Name</th>
                                    <th>Contact No </th>
                                    <th>District</th>
                                    <th></th>
                                    <th></th>
                                    <!--<th></th>-->
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

    $(document).ready(function() {
        loadCustomers();
    });

    function loadCustomers() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "<?= APPROOT ?>/customer/loadCustomers", true);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + data[a].title + "</td>";
                    html += "<td>" + data[a].first_name + " " + data[a].middle_name + " " + data[a].last_name + "</td>";
                    html += "<td>" + data[a].contact_no + "</td>";
                    html += "<td>" + data[a].district + "</td>";
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
    //Load Customers
    $('table tbody').on('click', '#btnView', function() {
        var currow = $(this).closest('tr');
        var cusName = currow.find('td:eq(2)').text().split(" ");
        $("#id").val(currow.find('td:eq(0)').text());
        $("#title").val(currow.find('td:eq(1)').text());
        $("#fname").val(cusName[0]);
        $("#cusMName").val(cusName[1]);
        $("#cusLName").val(cusName[2]);
        $("#contact").val(currow.find('td:eq(3)').text());
        $("#district").val(currow.find('td:eq(4)').text());
    })

    //Update
    $(document).ready(function() {
        $("#frmCusList").validate({
            rules: {
                fname,
                cusMName,
                cusLName,
                contact: {
                    required: true
                }
            }
        });

        $(document).on("click", "#btnUpdate", function() {
            $("#frmCusList").validate();
            if ($("#frmCusList").valid()) {
                var customer = {
                    id: $("#id").val(),
                    title: $("#title").val(),
                    fName: $("#fname").val(),
                    mName: $("#cusMName").val(),
                    lName: $("#cusLName").val(),
                    contact: $("#contact").val(),
                    district: $("#district").val()
                };
                $.ajax({
                    url: "<?= APPROOT ?>/customer/updateCustomer",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        cusData: customer
                    },
                    success: function(data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Customer Successfully Updated.</div></div>');
                        //                        alert("Successfully registered!");
                        $('#table1').find("tr:gt(0)").remove();
                        loadCustomers();
                        console.log(data);
                        $(frmCusList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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
                url: "<?= APPROOT ?>/customer/deleteCustomer",
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
                    loadCustomers();
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">This Customer has made an Invoice.</div></div>');
                    // console.log(errorThrown);
                }
            });
        }
    });
</script>
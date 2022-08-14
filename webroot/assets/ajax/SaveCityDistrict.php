<?php

session_start();

//Redirect if user not logged in
if (empty($_SESSION["userId"])) {
    header("Location: Login.php");
} else {
//Redirect if not an admin
    if ($_SESSION["userPrivilege"] != "admin") {
        header("Location: UserPage.php");
    }
}


/**
 * "userId", "userPicture", "userName", "userPrivilege" are main variables that can identify users and their privilege
 */
//imports
include '../DBCon.php';
include '../Validation.php';


if (!empty($_POST["conid"])) {
    try {
        $conId = test_input($_POST["conid"]);
        $con = connect_database();
        $sql = "SELECT * FROM `District` WHERE `ConId` = " . $conId . " ORDER BY `Status` DESC, `DistrictName` ASC ";
        //echo $sql;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["DisId"] . '">' . $row["DistrictName"] . '</option>';
            }
        } else {
            echo '<option disabled selected>No District Found<option>';
        }
        $con->close();
    } catch (Exception $exc) {
            echo '<option disabled selected>No District Found<option>';
    }
}
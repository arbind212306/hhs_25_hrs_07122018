<?php
//pr($joinee);
//die;
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            #customers {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #763240;
                color: white;
            }
            tr td:nth-child(1){
                width:20%;
                font-weight:bold;

            }
        </style>
    </head>
    <body>
        <div style="padding:5%;">
            <table id="customers" style="padding:5%;">
                <tr>
                    <th colspan="2" style="text-align:center;">User Details <?php
                        if (!empty($joinee['emp_id'])) {
                            echo "( " . $joinee['emp_id'] . ")";
                        }
                        ?></th>
                </tr>
                <tr>
                    <td>MRF ID</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['mrf_id'])) {
                            echo $joinee['user_detail']['mrf_id'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Recruitment ID</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['recruitment_id'])) {
                            echo $joinee['user_detail']['recruitment_id'];
                        }
                        ?>
                    </td>

                <tr>
                    <td>Emp ID</td>
                    <td>
                        <?php
                        if (!empty($joinee['emp_id'])) {
                            echo $joinee['emp_id'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td>
                        <?php
                        if (!empty($joinee['first_name'])) {
                            echo $joinee['first_name'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Middle name</td>
                    <td>
                        <?php
                        if (!empty($joinee['middle_name'])) {
                            echo $joinee['middle_name'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>
                        <?php
                        if (!empty($joinee['last_name'])) {
                            echo $joinee['last_name'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <?php
                        if (!empty($joinee['email'])) {
                            echo $joinee['email'];
                        }
                        ?>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>DOJ</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['doj'])) {
                            echo date('d-M-Y', strtotime($joinee['user_detail']['doj']));
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Business</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['busines']['title'])) {
                            echo $joinee['user_detail']['busines']['title'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Unit</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['unit']['title'])) {
                            echo $joinee['user_detail']['unit']['title'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['department']['title'])) {
                            echo $joinee['user_detail']['department']['title'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Band</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['band']['title'])) {
                            echo $joinee['user_detail']['band']['title'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Supervisor Emp ID</td>
                    <td>
                        <?php
                        if (!empty($joinee['user_detail']['supervisor_emp_id'])) {
                            echo $joinee['user_detail']['supervisor_emp_id'];
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>    
    </body>
</html>
<?php
//die;
?>
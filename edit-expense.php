<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
<style>
.red-circle
{
	background: #ffff19;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	display: flex;
 
}
.green-circle
{
	background: #72ff00;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	display: flex;

}
</style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Munshi System</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script>
      function addExpense()
{  
   var datastring=$("#expense_frm").serialize();
   //alert(datastring);exit;
   $.ajax({
        type: "post",
        url: "request_process.php?calling=47",
        data: datastring,
        success: function(responseData, textStatus, jqXHR) {
            //alert(responseData);
            if(responseData.search('done')!='-1')
            {
               var arr=responseData.split('-');
                //alert(arr[1]);exit;
                $("#expense_frm")[0].reset();
                $("#success_expense").html(arr[1]);
                $("#success_expense").show();
                $("#fail_expense").hide();
            }
            else
            {
                $("#fail_expense").html(responseData);
                $("#success_expense").hide();
                $("#fail_expense").show();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    })
}

    </script>
  </head>
<?php
include("header.php");
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                             <?php
              $id = htmlspecialchars($_GET["expid"]);
                     $expense = $db->getExpensebyId($id);
                      //echo $expense['0']['fld_expense_on']; 
                           // print_r($expense);
                      ?>
                <h3>Pending Expense Approvals </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<table id="datdatable" class="table table-striped table-bordered">
                    <div id="success_expense" style="display:none;"></div>
                    <div id="fail_expense" style="display:none;"></div>
                    <form id="expense_frm" method="post">
                    <tr>
                        <th>Select Appartment</th>
                        
                        <td colspan="3">
                        <select id="expense_on" name="expense_on" aria-controls="datatable" value="<?php echo $expense['0']['fld_expense_on']; ?>" class="form-control input-sm" onchange="owner_for_common_pool(this.value);">
                        <option value="0">Common Pool</option>
                        <?php

                          


                            $getBuilding=$db->getAllBuilding();
                            if($getBuilding[0]!="")
                            {   
                                foreach($getBuilding as $building)
                                {
                              ?>

                                    <option <?php if($expense['0']['fld_expense_on'] == $building['fld_id'] ){ echo 'selected'; } ?> value="<?=$building['fld_id']?>"><?=$building['fld_building']?> <?=$building['fld_apt_no']?></option>
                                    
                                    
                                    <?php
                                }
                            }
                        ?>
                        </select>
                    </td>
                    </tr>
                    <tr id="chrgeto" style="display:none;">
                        <th>
                            Charge to
                        </th>
                        <td colspan="3">
                        <select aria-controls="datatable" class="form-control input-sm" id="charge_to" name="charge_to">
                                <?php
                                    $getallowner=$db->getSuperAdmin();
                                    foreach($getallowner as $ben)
                                    {
                                        ?>
                                        <option  value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Expense Type</th>
                        <td colspan="3">
                        <select aria-controls="datatable" id="expense_type" name="expense_type" class="form-control input-sm">
                        
                            <option value="">Select Expense Type</option>
                            <?php
                                $GetExpenseType=$db->GetExpenseType();
                                //if($GetExpenseType[0]!="")
                                {
                                    foreach($GetExpenseType as $expenseType)
                                    {
                                        ?>
                                        <option <?php if($expense['0']['fld_expense_type'] == $expenseType['fld_expense_type'] ){ echo 'selected'; } ?> value="<?=$expenseType['fld_expense_type']?>"><?=$expenseType['fld_expense_type']?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Expense</th>
                        <td colspan="3"><input type="text" class="form-control input-sm" value="<?php echo $expense['0']['fld_expense']; ?>"  id="expense" name="expense" onkeypress="return isNumber(event)"/></td>
                    </tr>
                    <tr>
                        <th>Payment to</th>
                        <td colspan="3"><input type="text" class="form-control input-sm" value="<?php echo $expense['0']['fld_payment_to']; ?>" id="paymentto" name="paymentto"/></td>
                    </tr>
                    <tr>
                        <th>Payment By</th>
                        <td colspan="3">
                            <!--<input type="text" class="form-control input-sm" id="paymentby" name="paymentby"/>-->
                            <select class="form-control input-sm" id="paymentby" name="paymentby">
                                <?php
                                    $GetAllBeneficiary=$db->GetAllBeneficiary();
                                    foreach($GetAllBeneficiary as $ben)
                                    {
                                        ?>
                                        <option <?php if($expense['0']['fld_payment_by'] == $ben['fld_name'] ){ echo 'selected'; } ?> value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                        <tr>
                            <th>Payment Date</th>
                            <td>
                                <select class="form-control input-sm" id="date" name="date">
                                    
                                    <?php
                                        $date=date("d");
                                        for($i=1;$i<=31;$i++)
                                        {
                                            if($i<=9)
                                            {
                                                $i="0".$i;
                                            }
                                            ?>
                                            <option value="<?=$i?>"
                                            <?php
                                            if($date==$i)
                                            {
                                                echo "Selected";
                                            }                                       
                                            
                                            ?>
                                            ><?=$i?></option>
                                            <?php
                                        }                                       
                                    ?>
                                </select>
                            </td>
                        <td>
                        <?php
                        $month=date("m");
                        ?>
                        <select class="form-control input-sm" id="month" name="month">
                            <option value="0">Select Month</option>
                            <option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
                            <option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
                            <option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
                            <option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
                            <option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
                            <option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
                            <option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
                            <option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
                            <option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
                            <option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
                            <option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
                            <option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
                        </select>
                        </td>
                        <td>
                        <select class="form-control input-sm" id="year" name="year">
                            <?php
                            for($i=2016;$i<=date("Y");$i++)
                            {
                                ?>
                                <option value="<?=$i?>"
                                <?php
                                    if(date("Y")==$i)
                                    {
                                        echo "Selected";
                                    }
                                    ?>
                                ><?=$i?></option>
                                <?php
                            }
                            ?>
                        </select>
                        </td>
                        </tr>
                           
                    <tr>
                        <input type="hidden"  name="id" value="<?php echo $id; ?>">
                        <th>Description</th>
                        <td colspan="3"><textarea id="description"  class="form-control" name="description"><?php echo $expense['0']['fld_description']; ?></textarea></td>
                    </tr>
                    
                    </form>
                    <tr>
                    <td></td>
                    <td colspan="3">
                        <input type="Submit" value="Submit" onclick="addExpense()" class="btn btn-success"/>
                    </td>
                    </tr>
                    </table>
					
					</div>
				</div>
			</div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>
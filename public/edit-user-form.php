<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    // $ID = "";
    return false;
    exit(0);
}

if (isset($_POST['btnEdit'])) {

	    $name = $db->escapeString(($_POST['name']));
	    $dob = $db->escapeString($_POST['dob']);
        $email = $db->escapeString($_POST['email']);
        $mobile = $db->escapeString($_POST['mobile']);
        $gender = $db->escapeString($_POST['gender']);
        $address = $db->escapeString($_POST['address']);
        $bank_id = (isset($_POST['bank_id']) && !empty($_POST['bank_id'])) ? $db->escapeString($fn->xss_clean($_POST['bank_id'])) : "";
        $bank= $db->escapeString($_POST['bank']);
		$error = array();

		if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($dob)) {
            $error['dob'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($email)) {
            $error['email'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($mobile)) {
            $error['mobile'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($gender)) {
            $error['gender'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($address)) {
            $error['address'] = " <span class='label label-danger'>Required!</span>";
        }

		

		if ( !empty($name) && !empty($dob) && !empty($email) && !empty($mobile)&& !empty($gender)&& !empty($address)) 
		{
			
            if($bank =='all'){
                $sql = "UPDATE `users` SET `name`='$name',`dob` = '$dob', `email` = '$email', `mobile` = '$mobile', `gender` = '$gender', `address` = '$address', `bank` = '$bank', `bank_id` = ''  WHERE id = $ID";
                $db->sql($sql);
            }
            elseif($bank=='select'){
                $sql = "UPDATE `users` SET `name`='$name',`dob` = '$dob', `email` = '$email', `mobile` = '$mobile', `gender` = '$gender', `address` = '$address', `bank` = '', `bank_id` = '$bank_id' WHERE id = $ID";
                $db->sql($sql);
            }
             $update_result = $db->getResult();
			if (!empty($update_result)) {
				$update_result = 0;
			} else {
				$update_result = 1;
			}

			// check update result
			if ($update_result == 1) {

			    $error['update_user'] = " <section class='content-header'><span class='label label-success'>User updated Successfully</span></section>";
			} else {
				$error['update_user'] = " <span class='label label-danger'>Failed to update</span>";
			}
		}
	} 


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM users WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "users.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit User<small><a href='users.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Users</a></small></h1>
	<small><?php echo isset($error['update_user']) ? $error['update_user'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-12">
		
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_user_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
										<label for="exampleInputEmail1"> Name</label><?php echo isset($error['name']) ? $error['name'] : ''; ?>
										<input type="text" class="form-control" name="name" value="<?php echo $res[0]['name']; ?>">
									 </div>
									 <div class="col-md-4">
										<label for="exampleInputEmail1">DOB</label><?php echo isset($error['dob']) ? $error['dob'] : ''; ?>
										<input type="date" class="form-control" name="dob" value="<?php echo $res[0]['dob']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Email</label><?php echo isset($error['email']) ? $error['email'] : ''; ?>
										<input type="email" class="form-control" name="email" value="<?php echo $res[0]['email']; ?>">
									 </div>
                                     <div class="col-md-4">
										<label for="exampleInputEmail1">Mobile Number</label><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
										<input type="mobile" class="form-control" name="mobile" value="<?php echo $res[0]['mobile']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
                           <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
                                        <label for="">Select Gender</label> <i class="text-danger asterik">*</i> <?php echo isset($error['gender']) ? $error['gender'] : ''; ?><br>
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male"<?=$res[0]['gender'] == 'Male' ? ' selected="selected"' : '';?>>Male</option>
                                            <option value="Female"<?=$res[0]['gender'] == 'Female' ? ' selected="selected"' : '';?> >Female</option>
                                        </select>
									 </div>
                                     <div class="col-md-6">
										<label for="exampleInputEmail1">Address</label><i class="text-danger asterik">*</i> <?php echo isset($error['address']) ? $error['address'] : ''; ?>
										<textarea rows="2" type="address" class="form-control" name="address" ><?php echo $res[0]['address']; ?></textarea>
									 </div>
								</div>
						   </div>
						   <br>
                           <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Bank</label> 
                                            <select id="bank" name="bank" class="form-control">
                                                <option value="select"<?=$res[0]['bank'] == 'select' ? ' selected="selected"' : '';?>>Select</option>
                                                <option value="all"<?=$res[0]['bank'] == 'all' ? ' selected="selected"' : '';?> >All</option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Bank Id</label> 
                                            <select id='bank_id' name="bank_id" class='form-control' required>
                                                    <?php
                                                        $sql = "SELECT id,bank_name FROM `banks`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['id'] ?>' <?=$res[0]['bank_id'] == $value['id'] ? ' selected="selected"' : '';?>><?= $value['bank_name'] ?></option>
                                                        <?php } ?>
                                            </select>
                                    </div>
                                </div>            
                            </div>
					
					</div><!-- /.box-body -->
                       
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
					
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>


<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {

        $name = $db->escapeString(($_POST['name']));
        $dob = $db->escapeString(($_POST['dob']));
        $email = $db->escapeString(($_POST['email']));
        $mobile = $db->escapeString(($_POST['mobile']));
        $gender = $db->escapeString($_POST['gender']);
        $bank = $db->escapeString($_POST['bank']);
        $address = $db->escapeString($_POST['address']);
        
        // get image info
        $menu_image = $db->escapeString($_FILES['product_image']['name']);
        $image_error = $db->escapeString($_FILES['product_image']['error']);
        $image_type = $db->escapeString($_FILES['product_image']['type']);

        // create array variable to handle error
        $error = array();
            // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["product_image"]["name"]));
        
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
        if (empty($bank)) {
            $error['bank'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($address)) {
            $error['address'] = " <span class='label label-danger'>Required!</span>";
        }
       
       
       if (!empty($name) && !empty($dob) && !empty($email) && !empty($mobile)&& !empty($gender) && !empty($bank)&& !empty($email) && !empty($address)) {
            $result = $fn->validate_image($_FILES["product_image"]);
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['product_image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                // upload new image
                $upload = move_uploaded_file($_FILES['product_image']['tmp_name'], 'upload/users/' . $menu_image);
        
                // insert new data to menu table
                $upload_image = 'upload/users/' . $menu_image;

            
           
            $sql_query = "INSERT INTO users (name,dob,email,mobile,gender,bank,address,image)VALUES('$name','$dob','$email','$mobile','$gender','$bank','$address','$upload_image')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                
                $error['add_user'] = "<section class='content-header'>
                                                <span class='label label-success'>User Added Successfully</span> </section>";
            } else {
                $error['add_user'] = " <span class='label label-danger'>Failed</span>";
            }
        }
    }
?>
<section class="content-header">
    <h1>Add New User <small><a href='users.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Users</a></small></h1>

    <?php echo isset($error['add_user']) ? $error['add_user'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_doctor_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                           <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                            <input type="text" class="form-control" name="name" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Date of Birth</label> <i class="text-danger asterik">*</i><?php echo isset($error['dob']) ? $error['dob'] : ''; ?>
                                        <input type="date" class="form-control" name="dob" required />
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Gender</label> <i class="text-danger asterik">*</i><?php echo isset($error['gender']) ? $error['gender'] : ''; ?>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="">select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                            <input type="email" class="form-control"  name="email" required/>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Mobile Number</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                            <input type="number" class="form-control"  name="mobile" required/>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Bank</label> <i class="text-danger asterik">*</i><?php echo isset($error['bank']) ? $error['bank'] : ''; ?>
                                            <input type="text" class="form-control"  name="bank" required/>
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Address</label> <i class="text-danger asterik">*</i><?php echo isset($error['address']) ? $error['address'] : ''; ?>
                                            <textarea type="text" rows="3" class="form-control"  name="address" required></textarea>
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputFile">Profile</label> <i class="text-danger asterik">*</i><?php echo isset($error['product_image']) ? $error['product_image'] : ''; ?>
                                        <input type="file" name="product_image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="product_image" required/>
                                        <img id="blah" src="#" alt="" />
                                    </div>
                                </div>

                            </div>
         
                    </div>
                  
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                    </div>

                </form>

            </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_doctor_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            dob: "required",
            product_image: "required",
            email:"required",
            mobile:"required",
            address:"required",
            bank:"required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<!--code for page clear-->
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>
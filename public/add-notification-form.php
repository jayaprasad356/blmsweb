<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;


if (isset($_POST['btnsAdd'])) {


        $title = $db->escapeString($_POST['title']);
        $description = $db->escapeString($_POST['description']);

        

        if (empty($title)) {
            $error['title'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }
       

      

        if (!empty($title) && !empty($description))
         {
            $sql_query ="INSERT INTO notifications (title,description) VALUES ('$title','$description')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result ==1) {
                $error['add_notification'] = "<span class='label label-success'>Notification sent Successfully</span>";
            } else {
                $error['add_notification'] = "<span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Notification <small><a href='notifications.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Notifications</a></small></h1>

    <?php echo isset($error['add_notification']) ? $error['add_notification'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-8">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Notification</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form id='notification_form' method="post" action="send-multiple-push.php" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                 <div class='col-md-6'>
                                    <label for="exampleInputEmail1">Title</label><i class="text-danger asterik">*</i><?php echo isset($error['title']) ? $error['title'] : ''; ?>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                                <div class='col-md-8'>
                                    <label for="exampleInputEmail1">Description</label><i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                                    <textarea type="text" class="form-control" name="description" rows="5"  required></textarea>
                                </div>
                            </div>

                        </div>
                            
                    </div>
                  
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                    </div>

                </form>
                <div id="result"></div>

            </div><!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#department').select2({
        width: 'element',
        placeholder: 'Type in department to search',

    });
    $('#batch').select2({
        width: 'element',
        placeholder: 'Type in batch to search',

    });
    $('#notification_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {

                    $('#result').html(result.message);
                    $('#result').show().delay(6000).fadeOut();
                    $('#notification_form').each(function() {
                        this.reset();
                    });
                    
                }
            });

        });
</script>
<?php $db->disconnect(); ?>
<style>
    .form-control {
        background: #e8ebed;
        color: #657380;
        font-size: 15px;
        font-weight: 700;
        padding: 16px;
        width: 100%;
        height: auto;
        outline: 0;
        border: 2px solid #e8ebed;
        box-shadow: none;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
        transition: all 0.2s;
    }
</style>
<?php echo validation_errors(); ?>
<!-- container -->
<div class="document-title" style="">
    <div class="container">
        <h1 class="center">Registration</h1>
    </div><!-- /.container -->
</div><!-- /.document-title -->
<div class="container">
    <?php
    $attribute = array('id' => 'form1');
    echo form_open('Employee/register', $attribute)
    ?>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <img src="<?php echo asset_url() . 'images/38-1.gif'; ?>" id="loader" style="display: none">
            <div class="form-group" id="messages">
                <?php
                if (isset($Error)) {
                    echo $Error;
                }
                ?>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3" id="section1">
            <h3><b>Let's get started</b></h3>
            <p>SIGNIN UP FOR PHARMA TALENT IS FASTER AND FREE</p>
            <br/>
            <div class="form-group">
                <label> Company Name</label>
                <input type="text" placeholder="Enter Your Full Name" class="form-control" id="name" <?php echo isset($name) && $name != '' ? 'readonly="readonly"' : '' ?> name="name" value="<?php echo isset($name) ? $name : '' ?>">    
            </div><!-- /.form-group -->
             <div class="form-group">
                <label>Contact Person</label>
                <input type="text" placeholder="Enter Contact Person" class="form-control" id="Contactperson" required="required" name="Contactperson" value="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" placeholder="Enter Your Email Id" class="form-control" id="email" <?php echo isset($email) && $email != '' ? 'readonly="readonly"' : '' ?> name="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div><!-- /.form-group -->
            <div class="form-group">
                <label>Mobile</label>
                <input type="mobile" placeholder="Enter Your Mobile" class="form-control" id="mobile"  required="required" name="mobile" maxlength="11" value="">    
            </div><!-- /.form-group -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Enter Your Password" class="form-control" id="password" required="required" name="password" value="">
            </div>
            
            
             
            
            <!-- /.form-group -->


            <button type="button" id="Save" class="btn btn-secondary btn-block">SIGN UP</button>
        </div>
        <div class="col-sm-6 col-sm-offset-3" id="section2" style="display: none">
            <div class="form-group">
                <label>Enter Verification Code</label>
                <input type="text" class="form-control" id="ver_code" name="ver_code" value="">

            </div><!-- /.form-group -->
            <div class="form-group">
                <button type="button" id="Verify" class="btn btn-secondary">Verify</button>
                <button type="button" id="Resend" class="btn btn-warning">Resend</button>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3" id="section3" style="display: none">
            <button type="submit" id="Register" class="btn btn-secondary">Register</button>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <br/>
            <p>By clicking Signup you agree to the <span class="policy" ><a>Terms</a></span> and <span class="policy" ><a>Privacy Policy</a></span>.</p>

            <p>Already have a Pharma Talent account? <a>Sign in</a>.</p>
        </div>
    </div>
</form>
</div>
<script>
    $("#Save").click(function () {
        sendVerification();
    });

    $("#Resend").click(function () {
        sendVerification();
    });

    function sendVerification() {
        $("#loader").show();
        var email = $("#mobile").val();
        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var password = $("#password").val();
        var url = '<?php echo site_url('User/SendVerification'); ?>';
        if (email != '' && name != '' && mobile != '' && password != '') {
            $.ajax({
                type: "POST",
                url: url,
                data: {mobile: mobile}, // serializes the form's elements.
                success: function (data)
                {
                    $("#loader").hide();
                    if (data == '200') {
                        $("#section1").hide();
                        $("#section2").show();

                        $("#messages").html('<p class="alert alert-success">Verification Code Is Sent To Your Mobile No');
                    } else if (data == '400') {

                        $("#messages").html('<p class="alert alert-danger">Already registered And Verified');
                    }

                }
            });

        } else {
            $("#messages").html('<p class="alert alert-danger">Please Enter Name, Emailid ,Password And Mobile No');
        }
    }

    $("#Verify").click(function () {
        $("#loader").show();
        $("#messages").addClass('loaderimage')
        var mobile = $("#mobile").val();
        var ver_code = $("#ver_code").val();
        var url = '<?php echo site_url('User/Verify'); ?>';
        $.ajax({
            type: "POST",
            url: url,
            data: {mobile: mobile, ver_code: ver_code}, // serializes the form's elements.
            success: function (data)
            {
                $("#loader").hide();
                if (data == '200') {

                    $("#section2").hide();
                    $("#Save").hide();
                    $("#section3").hide();
                    $("#section1").show();
                    $("#messages").html('<p class="alert alert-success">Verified Successfully');
                    $("#form1").submit();
                } else if (data == '400') {

                    $("#messages").html('<p class="alert alert-danger">Already registered And Verified');
                } else if (data == '500') {

                    $("#messages").html('<p class="alert alert-danger">System Error Occured');
                } else if (data == '300') {

                    $("#messages").html('<p class="alert alert-danger">Verification Code Dosnt Match');
                }


            }
        });
    });
</script>

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
<div class="document-title">
    <div class="container">
        <h1 class="center">Login</h1>
    </div><!-- /.container -->
</div><!-- /.document-title -->


<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">
            <h3 style="color:red;"><?php
                if (isset($user)) {
                    echo $user;
                }
                ?></h3>
            <?php echo validation_errors(); ?>
            <?php echo form_open('Employee/login') ?>

            <div class="row">
                <div class="col-sm-12">

                    <h3><b>Welcome to Pharma Talent</b></h3>
                    <p>LOGIN HERE USING YOUR USERNAME AND PASSWORD</p>
                    <br/>
                    <div class="form-group">
                        <label >E-mail</label>
                        <input type="text" class="form-control" name="email"/>
                    </div><!-- /.form-group -->

                    <div class="form-group " >
                        <label >Password</label>
                        <input type="password" class="form-control" name="password"/>
                    </div><!-- /.form-group -->
                    <div class="form-group " >
                        <button type="submit" class="btn btn-secondary btn-block">LOGIN</button>
                        <br/>
                        <a href="<?php echo site_url('Employee/register') ?>">Click Here To Register</a>
                    </div>
                </div><!-- /.col-* -->
            </div><!-- /.row -->

            </form>

        </div><!-- /.col-* -->
    </div><!-- /.row -->
</div><!-- /.container -->
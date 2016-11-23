<!-- God knows how it works =D -->
<div class="row">
    <div class="col-lg-12 center-block text-center bg-primary">
        </br>
        <div class="row">
            <p class="col-lg-12"><strong><h4>Login Page</h4></strong></p>
        </div>
        <div class="row text-right">
            <form class="form-horizontal" action="<?=URL?>/Login/run" method="post">
                <div class="form-group">
                    <label for="userLogin" class="col-lg-offset-3 col-lg-2" control-label>Login</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="userLogin" name="userLogin" placeholder="Login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="userPass" class="col-lg-offset-3 col-lg-2" control-label>Password</label>
                    <div class="col-lg-3">
                        <input type="password" class="form-control"  id="userPass" name="userPass" placeholder="Password">
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-lg-offset-3 col-lg-12 center-block">
                        <div class="btn-group btn-group-md col-lg-8 col-lg-offset-3" role="group">
                                <button type="submit" class="btn btn-success col-lg-5">Log In</button>
                                <a class="btn btn-default col-lg-5" href="..">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
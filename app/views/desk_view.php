<?php
$name_post = $email_post = $text_post = $imgSrc_post = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if( !isset($_POST['inName']) ){
        $name_error = "Field is required!";
    }else{
        $name_post = test_input($_POST['inName']);
        if( empty($name_post) || is_null($name_post) || strlen($name_post) < 4 ){
            $name_error = "Name is too short. 4 characters or more. Spaces are allowed";
        }
    }

    if( !isset($_POST['inEmail']) ){
        $email_error = "Field is required!";
    }else{
        $email_post = test_input($_POST['inEmail']);
        if(empty($email_post) || is_null($email_post) || !filter_var($email_post, FILTER_VALIDATE_EMAIL)){
            $email_error = "Incorrect email";
        }
    }

    if( !isset($_POST['inReview']) ){
        $text_error = "Field is required!";
    }else{
        $text_post = test_input($_POST['inReview']);
        if(empty($text_post) || is_null($text_post)){
            $text_error = "Incorrect text";
        }
    }

    if(!isset($name_error) && !isset($email_error) && !isset($text_error)){
        $link = connect_db();
        $current_date = date('Y-m-d');
        $current_time = date('h:i:s');

        $sql = "INSERT INTO reviews (rvwName, rvwEmail, rvwText, rvwDate, rvwTime)
                VALUES ('$name_post','$email_post','$text_post', '$current_date', '$current_time')";

        if($link->query($sql) !== TRUE){
            $flag = false;
            echo "ERROR: ". $sql . " | " . $link->error;
        }else{
            $flag = true;
        }
        disconnect_db($link);

        unset($name_post);
        unset($email_post);
        unset($text_post);
    }
}
?>


<div class="row">
    <div class="col-lg-offset-1 col-lg-10">


        <div><?//=$this->data?></div>
        <!-- REVIEW INPUT MODULE - BEGIN -->
        <div class="row table-bordered bg-primary">
            <p class=""><?= $flag ? "Record successfully added!" : "&nbsp";?></p>
            <form class="form-horizontal" action="<?=htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post">
                <div class="form-group">
                    <label for="inName" class="col-lg-offset-1 col-lg-2 control-label">Name</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="inName" name="inName" placeholder="Name" value="<?=!isset($name_error)?  $name_post : ""?>">
                    </div>
                    <?php if(isset($name_error)){
                        echo "<div class='row col-lg-offset-3 col-lg-8'><small>$name_error</small></M></div>";
                    }?>
                </div>
                <div class="form-group">
                    <label for="inEmail" class="col-lg-offset-1 col-lg-2 control-label">Email address</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="inEmail" name="inEmail" placeholder="Email" value="<?=!isset($email_error)?  $email_post : ""?>">
                    </div>
                    <?php if(isset($email_error)){
                        echo "<div class='row col-lg-offset-3 col-lg-8'><small>$email_error</small></M></div>";
                    }?>
                </div>
                <div class="form-group">
                    <label for="inReview" class="col-lg-offset-1 col-lg-2 control-label">Review</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" rows="3" id="inReview" name="inReview" placeholder="Review"><?=!isset($text_error)?  $text_post : ""?></textarea>
                    </div>
                    <?php if(isset($text_error)){
                        echo "<div class='row col-lg-offset-3 col-lg-8'><small>$text_error</small></M></div>";
                    }?>
                </div>
                <div class="form-group">
                    <label for="inImage" class="col-lg-offset-1 col-lg-2 control-label">Image</label>
                    <input type="file" class="col-lg-3" id="inImage">
                    <div class="col-lg-offset-3 col-lg-3">
                        <div class="btn-group btn-group-md" role="group">
                            <button type="button" class="btn btn-default" disabled="disabled">Preview</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- REVIEW INPUT MODULE - END -->



        <!-- PREVIEW OUTPUT MODULE - BEGIN -->
        <div class="row table-bordered hidden">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <strong><?=$name?></strong> <small><span class="text-lowercase text-muted">[<?=$email?>]</span></small>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if(!is_null($imgSrc) && !empty($imgSrc)){
                        echo "<div class='col-lg-4'><img src='$imgSrc'></div>";
                        echo "<div class='col-lg-offset-1 col-lg-6 text-justify'>$text</div>";
                    }else{
                        echo "<div class=' col-lg-11 text-justify'>$text</div>";
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-6 text-muted"><small><?=$date?> <?=$time?></small></div>
                    <!-- if edited by administrator -->
                    <?php
                    if($isMaintained != 0){
                        echo "<div class='col-lg-6 text-right text-muted'><small>Edited by administrator</small></div>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- PREVIEW OUTPUT MODULE - END-->



        <!-- REVIEW SORTING OPTIONS MODULE - BEGIN -->
        <div class="row table-bordered">
            <div class="col-lg-12">
                <div class="row text-center">
                    <!-- need to add glyphs of up and down-->
                    <div class="col-lg-offset-5 col-lg-1">Sort by</div>
                    <div class="col-lg-2"><a href="/Desk/orderBy/name"><ins>Name</ins></a></div>
                    <div class="col-lg-2"><a href="/Desk/orderBy/email"><ins>Email</ins></a></div>
                    <div class="col-lg-2"><a href="/Desk/orderBy/date"><ins>Date</ins></a></div>
                </div>
            </div>
        </div>
        <!-- REVIEW SORTING OPTIONS MODULE - END -->



        <!-- REVIEW OUTPUT MODULE - BEGIN -->
        <?php
        if($data->num_rows > 0){
            while($row = $data->fetch_assoc()){
                $name = $row['rvwName'];
                $email = $row['rvwEmail'];
                $text = $row['rvwText'];
                $imgSrc = $row['rvwImgSrc'];
                $date = $row['rvwDate'];
                $time = $row['rvwTime'];
                $isMaintained = $row['isMaintained'];
        ?>
        <div class="row table-bordered">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <strong><?=$name?></strong> <small><span class="text-lowercase text-muted">[<?=$email?>]</span></small>
                    </div>
                </div>
                <div class="row">
                    <?php
                        if(!is_null($imgSrc) && !empty($imgSrc)){
                            echo "<div class='col-lg-4'><img src='$imgSrc'></div>";
                            echo "<div class='col-lg-offset-1 col-lg-6 text-justify'>$text</div>";
                        }else{
                            echo "<div class=' col-lg-11 text-justify'>$text</div>";
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-6 text-muted"><small><?=$date?> <?=$time?></small></div>
                    <!-- if edited by administrator -->
                    <?php
                        if($isMaintained != 0){
                            echo "<div class='col-lg-6 text-right text-muted'><small>Edited by administrator</small></div>";
                        }
                    ?>

                </div>
            </div>
        </div>
        <?php
            }
        }else{
            echo "<h3>0 results</h3>";
        }
        ?>
        <!-- REVIEW OUTPUT MODULE - END -->



    </div>
</div>

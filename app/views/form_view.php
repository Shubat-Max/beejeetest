<!-- REVIEW INPUT MODULE - BEGIN -->
<?
//Передать дату
//Вытащить из даты все необходимое
?>
<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        <div class="row table-bordered bg-primary">
            <p class=""><?= $flag ? "Record successfully added!" : "&nbsp";?></p>
            <?php
                //Think it need to be modified
                $path = explode('/', $_SERVER['REQUEST_URI']);
                if(empty($path[1])){
                    $path[1] = "Desk";
                }
            ?>
            <form class="form-horizontal" action="/Desk/transmission" method="post">
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
    </div>
</div>
<!-- REVIEW INPUT MODULE - END -->
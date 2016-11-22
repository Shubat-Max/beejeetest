<div class="row">
    <div class="col-lg-offset-1 col-lg-10">

        <!-- REVIEW SORTING OPTIONS MODULE - BEGIN -->
        <div class="row table-bordered">
            <div class="col-lg-12">
                <div class="row text-center">
                    <!-- need to add glyphs of up and down-->
                    <div class="col-lg-offset-3 col-lg-1">Sort by</div>
                    <div class="col-lg-2"><a href="/Moderator/orderBy/status"><ins>Status</ins></a></div>
                    <div class="col-lg-2"><a href="/Moderator/orderBy/name"><ins>Name</ins></a></div>
                    <div class="col-lg-2"><a href="/Moderator/orderBy/email"><ins>Email</ins></a></div>
                    <div class="col-lg-2"><a href="/Moderator/orderBy/date"><ins>Date</ins></a></div>
                </div>
            </div>
        </div>
        <!-- REVIEW SORTING OPTIONS MODULE - END -->

        <!-- REVIEW OUTPUT MODULE - BEGIN -->
        <?php
        if($data->num_rows > 0){
            while($row = $data->fetch_assoc()){
                $id = $row['rvwID'];
                $name = $row['rvwName'];
                $email = $row['rvwEmail'];
                $text = $row['rvwText'];
                $imgSrc = $row['rvwImgSrc'];
                $date = $row['rvwDate'];
                $time = $row['rvwTime'];
                $isApproved = $row['isApproved'];
                $isMaintained = $row['isMaintained'];
                ?>

                <?php
                    if($isApproved == 0){
                        echo "<div class='row table-bordered'>";
                    }elseif($isApproved ==2){
                        echo "<div class='row table-bordered bg-success'>";
                    }else{
                        echo "<div class='row table-bordered bg-danger'>";
                    }
                ?>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <strong><?=$name?>&nbsp</strong><small><span class="text-lowercase text-muted">[<?=$email?>]</span></small><span class="text-lowercase text-muted">&nbsp#<?=$id?></span>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            if(!is_null($imgSrc) && !empty($imgSrc)){
                                echo "<div class='col-lg-1'><img src='$imgSrc' width='100px'></div>";
                                echo "<div class='col-lg-offset-1 col-lg-9 text-justify'>$text</div>";
                            }else{
                                echo "<div class=' col-lg-11 text-justify'>$text</div>";
                            }
                            ?>

                        <center>
                            <div class="col-lg-1 center-block">
                                <div class="btn-group-vertical btn-group-xs " role="group" aria-label="Control Panel">
                                    <a href="<?=URL?>/Moderator/approve/<?=$id?>" class="btn btn-default" aria-label="Approve" title="Approve">
                                        <span class="glyphicon glyphicon-ok-sign"></span>
                                    </a>
                                    <a href="<?=URL?>/Moderator/edit/<?=$id?>" class="btn btn-default" aria-label="Edit" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="<?=URL?>/Moderator/dismiss/<?=$id?>" class="btn btn-default" aria-label="Dismiss" title="Dismiss">
                                        <span class="glyphicon glyphicon-remove-sign"></span>
                                    </a>
                                </div>
                            </div>
                        </center>



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
            echo "0 results";
        }
        ?>
        <!-- REVIEW OUTPUT MODULE - END -->

    </div>
</div>
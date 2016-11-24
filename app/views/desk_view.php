



<!-- REVIEW OUTPUT MODULE - BEGIN -->
<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
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
                            echo "<div class='col-lg-4'><img src='/$imgSrc'></div>";
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
    </div>
</div>
<!-- REVIEW OUTPUT MODULE - END -->
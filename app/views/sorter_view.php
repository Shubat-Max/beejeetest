<!-- REVIEW SORTING OPTIONS MODULE - BEGIN -->
<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        <div class="row table-bordered">
            <div class="col-lg-12">
                <?php
                    //Think it need to be modified
                    $path = explode('/', $_SERVER['REQUEST_URI']);
                    if(empty($path[1])){
                        $path[1] = "Desk";
                    }
                ?>
                <div class="row text-center">
                    <div class="col-lg-offset-5 col-lg-1">Sort by</div>
                    <div class="col-lg-2"><a href="/<?=$path[1]?>/orderBy/name"><ins>Name</ins></a></div>
                    <div class="col-lg-2"><a href="/<?=$path[1]?>/orderBy/email"><ins>Email</ins></a></div>
                    <div class="col-lg-2"><a href="/<?=$path[1]?>/orderBy/date"><ins>Date</ins></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- REVIEW SORTING OPTIONS MODULE - END -->
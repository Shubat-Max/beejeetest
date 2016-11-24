<div class="row">
    <div class="col-lg-12 center-block bg-primary">
        <form action="<?=URL?>/Editor/confirm/<?=$this->rvwID?>" method="post">
            <div class="col-lg-12"><h4><strong>Editor</strong></h4></div>
            <div class="col-lg-12">&nbsp</div>
            <div class="col-lg-offset-1 col-lg-10">
                <textarea class="form-control" rows="5" id="editedText" name="editedText"><?=$this->data?></textarea>
            </div>
            <div class="col-lg-12">&nbsp</div>
            <div class="btn-group btn-group-md col-lg-8 col-lg-offset-3" role="group">
                <button type="submit" class="btn btn-success col-lg-5">Submit</button>
                <a class="btn btn-default col-lg-5" href="<?=URL?>/Moderator">Back</a>
            </div>
            <div class="col-lg-12">&nbsp</div>
        </form>
    </div>
</div>
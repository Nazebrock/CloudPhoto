<?php
if (isset($_FILES['fic'])) {
    transfert($albumId);
}
?>
<div class="row">
    <div class="col-lg-offset-4">
        <div class="col-lg-5">

            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="#" method="post">
                <div class="form-group">
                    <label for="fic" class="col-sm-2 control-label">Photo</label>
                    <div class="col-sm-10">
                        <input type="file"  id="fic" name="fic[]" multiple>
                    </div>
                </div>

                <div class="col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Envoyer</button>
                </div> 
            </form>

        </div> 
    </div>
</div>
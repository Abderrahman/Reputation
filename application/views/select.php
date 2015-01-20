<?php $query_id = $this->session->userdata('current_query') ?>
<div class="row">
    <div class="col-lg-1">
        <label for="g1"><h4>Query:</h4></label>
    </div>
    <div class="col-lg-3">
        <select name="query" class="form-control">
            <?php foreach($data as $key => $value){ ?>
            <option value="<?= $key ?>" <?php if ($key == $query_id) {echo "selected";} ?>><?= $value ?></option>
            <?php } ?>
        </select>
    </div>
</div>
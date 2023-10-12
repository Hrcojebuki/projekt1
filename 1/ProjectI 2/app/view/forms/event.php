<div class="p-4 mb-4 bg-light rounded-3">
    <div class="card-body">
        <form class="row g-3" method="POST" action="index.php?page=event&method=<?php echo isset($data["model_data"])?"edit":"create" ?>&param=<?php echo isset($data["model_data"])?$data["model_data"]->get_id():"" ?>">
            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input required value="<?php echo isset($data["model_data"])?$data["model_data"]->name:"" ?>" type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="col-12">
                <div class="row">
                    <label for="startdate" class="form-label">Start Date</label>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_datestart()[0]:"" ?>" required type="date" class="form-control" id="datestart" name="datestart">
                    </div>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_datestart()[1]:"" ?>" type="time" class="form-control" id="timestart" name="timestart">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <label for="startdate" class="form-label">End Date</label>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_dateend()[0]:"" ?>" required type="date" class="form-control" id="dateend" name="dateend">
                    </div>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_dateend()[1]:"" ?>" type="time" class="form-control" id="timeend" name="timeend">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="capacity" class="form-label">Max capacity</label>
                <input value="<?php echo isset($data["model_data"])?$data["model_data"]->numberallowed:"" ?>" required type="text" class="form-control" id="capacity" name="capacity">
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Venue</label>
                <select name="venue" class="form-select">
                <?php
                foreach($data["all_venues"] as $venue){
                    $default = isset($data["model_data"]) && $venue->get_id() == $data["model_data"]->get_idvenue() ? "selected='selected'" : "";
                  echo "<option {$default} value='{$venue->get_id()}'>{$venue->name} (max. {$venue->capacity})</option>";
                }
                ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?php echo isset($data["model_data"])?"Edit":"Create" ?> Event</button>
            </div>
        </form>
    </div>
</div>
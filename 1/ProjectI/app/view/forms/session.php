<div class="p-4 mb-4 bg-light rounded-3">
    <div class="card-body">
        <form class="row g-3" method="POST" action="index.php?page=session&method=<?php echo isset($data["model_data"])?"edit":"create" ?>&param=<?php echo isset($data["model_data"])?$data["model_data"]->get_id():"" ?>">
            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input required value="<?php echo isset($data["model_data"])?$data["model_data"]->name:"" ?>" type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="col-12">
                <div class="row">
                    <label for="datestart" class="form-label">Start Date</label>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_startdate()[0]:"" ?>" required type="date" class="form-control" id="datestart" name="datestart">
                    </div>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_startdate()[1]:"" ?>" type="time" class="form-control" id="timestart" name="timestart">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <label for="dateend" class="form-label">End Date</label>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_enddate()[0]:"" ?>" required type="date" class="form-control" id="dateend" name="dateend">
                    </div>
                    <div class="col-md-6">
                        <input value="<?php echo isset($data["model_data"])?$data["model_data"]->get_enddate()[1]:"" ?>" type="time" class="form-control" id="timeend" name="timeend">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="capacity" class="form-label">Max capacity</label>
                <input value="<?php echo isset($data["model_data"])?$data["model_data"]->numberallowed:"" ?>" required type="text" class="form-control" id="capacity" name="capacity">
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Event</label>
                <select name="event" class="form-select">
                <?php
                foreach($data["all_events"] as $event){
                    $default = isset($data["model_data"]) && $event->get_id() == $data["model_data"]->event ? "selected='selected'" : "";
                  echo "<option {$default} value='{$event->get_id()}'>{$event->name}</option>";
                }
                ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?php echo isset($data["model_data"])?"Edit":"Create" ?> Session</button>
            </div>
        </form>
    </div>
</div>
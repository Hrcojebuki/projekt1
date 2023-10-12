<div class="p-4 mb-4 bg-light rounded-3">
    <div class="card-body">
        <form class="row g-3" method="POST" action="index.php?page=attendee&method=<?php echo isset($data["model_data"])?"edit":"create" ?>&param=<?php echo isset($data["model_data"])?$data["model_data"]->get_id():"" ?>">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input required value="<?php echo isset($data["model_data"])?$data["model_data"]->name:"" ?>" type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo isset($data["model_data"])?"optional":""?>">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Role</label>
                <select name="role" class="form-select">
                <?php
                foreach($data["all_roles"] as $role){
                  $default = isset($data["model_data"]) && $role->get_id() == $data["model_data"]->role ? "selected='selected'" : "";
                  echo "<option {$default} value='{$role->get_id()}'>{$role->name}</option>";
                }
                ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?php echo isset($data["model_data"]) ?"Edit":"Create"?> Attendee</button>
            </div>
        </form>
    </div>
</div>
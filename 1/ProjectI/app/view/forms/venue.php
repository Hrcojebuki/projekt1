<div class="p-4 mb-4 bg-light rounded-3">
    <div class="card-body">
        <form class="row g-3" method="POST" action="index.php?page=venue&method=<?php echo isset($data["model_data"])?"edit":"create" ?>&param=<?php echo isset($data["model_data"])?$data["model_data"]->get_id():"" ?>">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input value="<?php echo isset($data["model_data"])?$data["model_data"]->name:"" ?>" required type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-md-6">
                <label for="capacity" class="form-label">Capacity</label>
                <input value="<?php echo isset($data["model_data"])?$data["model_data"]->capacity:"" ?>" required type="text" class="form-control" id="capacity" name="capacity">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?php echo isset($data["model_data"])?"Edit":"Create" ?> Venue</button>
            </div>
        </form>
    </div>
</div>
<div class="p-4 mb-4 bg-light rounded-3">
    <div class="card-body">
        <form class="row g-3" method="POST" action="index.php?page=role&method=<?php echo isset($data["model_data"])?"edit":"create" ?>&param=<?php echo isset($data["model_data"])?$data["model_data"]->get_id():"" ?>">
            <div class="col-md-12">
                <label for="name" class="form-label">Name</label>
                <input value="<?php echo isset($data["model_data"])?$data["model_data"]->name:"" ?>" required type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?php echo isset($data["model_data"])?"Edit":"Create" ?> Role</button>
            </div>
        </form>
    </div>
</div>
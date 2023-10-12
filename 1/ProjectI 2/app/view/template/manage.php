<div class="container fill py-5">
  <div class="p-4 mb-4 bg-light rounded-3">
    <div class="row">
      <div class="col-md-6">
        <div class="container-fluid py-5">
          <h1 class="display-6 fw-bold"><?php if(isset($data["title"])) echo $data["title"] ?></h1>
          <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium pariatur commodi,
            delectus eligendi nam odit fugiat labore sequi sit amet.</p>
        </div>
      </div>
      <div class="col-md-6 m-auto">
      <?php if(isset($data["form"]) && $data["show_create"]) include $data["form"] ?>
      </div>
    </div>
  </div>
  <?php if(isset($data["table"])) echo $data["table"]?>
</div>
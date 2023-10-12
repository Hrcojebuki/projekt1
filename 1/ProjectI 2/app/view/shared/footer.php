    <div class="container">
      <footer class="py-5">
        <div class="row">
          <div class="col-6 col-md-3 mb-3">
            <h5>More Links</h5>
            <ul class="nav flex-column">
            <?php 
              $show_pages = isset($_SESSION['role']) ? Permissions::get_pages_show($_SESSION['role']) : [];
              foreach (scandir('app/view/template/') as $file) {
                  $file_parts = explode(".", $file);
                  $file_name = $file_parts[0];
                  if(isset($_SESSION['role']) && in_array($file_parts[0], $show_pages)) continue;
                  $file_name_c = ucfirst($file_name);
                  if($file_parts[1]==="php") {
                      echo "<li class='nav-item mb-2'><a href='index.php?page={$file_name}' class='nav-link p-0 text-muted'>{$file_name_c}</a></li>";
                  }
              }
            ?>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-3">
            <h5>My Sites</h5>
            <ul class="nav flex-column">
            <?php 
              if (isset($_SESSION['role'])) foreach ($show_pages as $file) {
                  $file_name = $file;
                  $file_name_c = ucfirst($file_name);
                  if($file_parts[1]==="php") {
                      echo "<li class='nav-item mb-2'><a href='index.php?page={$file_name}' class='nav-link p-0 text-muted'>{$file_name_c}</a></li>";
                  }
              }
            ?>
            </ul>
          </div>
          <div class="col-md-5 offset-md-1 mb-3">
            <form>
              <h5>Subscribe to our newsletter</h5>
              <p>Monthly digest of what's new and exciting from us.</p>
              <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="newsletter1" class="visually-hidden">Email address</label>
                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                <button class="btn btn-primary" type="button">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
          <p>&copy; 2022 Company, Inc. All rights reserved.</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
          </ul>
        </div>
      </footer>
    </div>
    </body>
</html>
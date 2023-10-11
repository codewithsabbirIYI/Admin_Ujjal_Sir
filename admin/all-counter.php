<?php 

    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check 
    if($_SESSION['role_id'] != 4){
      

    get_header();
    get_sidebar();

?>

      <div class="row">
          <div class="col-md-12 breadcumb_part">
              <div class="bread"> 
                  <ul>
                      <li><a href=""><i class="fas fa-home"></i>Home</a></li>
                      <li><a href=""><i class="fas fa-angle-double-right"></i>Dashboard</a></li>                             
                  </ul>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                      <div class="col-md-8 card_title_part">
                          <i class="fab fa-gg-circle"></i>All Counter Information
                      </div>  
                      <div class="col-md-4 card_button_part">
                          <a href="add-counter.php" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Counter</a>
                      </div>  
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover custom_table">
                    <thead class="table-dark">
                      <tr>
                        <th>Counter Icon</th>
                        <th>Counter Number</th>
                        <th>Counter Title</th>
                        <th>Counter Text</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <!-- all data find and loop here  -->
                    <?php
                      $sel= "SELECT * FROM counters ORDER BY id ASC";
                      $Q=mysqli_query($con,$sel); 
                      while($data=mysqli_fetch_assoc($Q)){
                    ?>

                    <!-- table item here  -->
                    <tr>
                      <td><i class="<?= $data["counter_icon"];?> text-black"></i></td>
                      <td><?= $data["counter_number"]; ?> </td>
                      <td><?= $data["counter_title"]; ?></td>
                      <td><?= $data["counter_text"]; ?></td>                     
                      <td>
                          <div class="btn-group btn_group_manage" role="group">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="view-counter.php?v=<?= $data["id"]; ?>">View</a></li>
                              <li><a class="dropdown-item" href="edit-counter.php?e=<?= $data["id"]; ?>">Edit</a></li>
                              <li><a class="dropdown-item" href="delete-counter.php?d=<?= $data["id"]; ?>">Delete</a></li>
                            </ul>
                          </div>
                      </td>
                    </tr>


                    <?php 
                      } 
                    ?>
                  <!-- all data find and loop end here  -->

                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="btn-group" role="group" aria-label="Button group">
                    <button type="button" class="btn btn-sm btn-dark">Print</button>
                    <button type="button" class="btn btn-sm btn-secondary">PDF</button>
                    <button type="button" class="btn btn-sm btn-dark">Excel</button>
                  </div>
                </div>  
              </div>
          </div>
      </div>
  </div>

<?php

  get_footer();
}else{
  header('Location: index.php');
}

?>
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
                          <i class="fab fa-gg-circle"></i>All Banner Information
                      </div>  
                      <div class="col-md-4 card_button_part">
                          <a href="add-banner.php" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Banner</a>
                      </div>  
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover custom_table">
                    <thead class="table-dark">
                      <tr>
                        <th>Banner Title</th>
                        <th>Baner Subtitle</th>
                        <th>Banner Text</th>
                        <th>Button Link</th>
                        <th>Button Text</th>
                        <th>Banner Image</th>
                        <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>

                    <!-- all data find and loop here  -->
                    <?php
                      $sel= "SELECT * FROM banners ORDER BY banner_id ASC";
                      $Q=mysqli_query($con,$sel); 
                      while($data=mysqli_fetch_assoc($Q)){
                    ?>

                    <!-- table item here  -->
                    <tr>
                      <td><?php echo $data['banner_title']; ?></td>
                      <td><?= $data["banner_subtitle"]; ?> </td>
                      <td><?= $data["banner_text"]; ?></td>
                      <td><?= $data["button_link"]; ?></td>
                      <td><?= $data["button_text"]; ?></td>
                      
                      <td>

                        <?php

                          if($data["banner_image"] != ''){
                            ?>
                            <img height="40" class="img200" src="uploads/<?= $data['banner_image']; ?>" alt="banner"/>
                          <?php
                          }else{
                            ?>
                            <img height="40" src="images/avatar.jpg" alt="banner"/>
                          <?php
                          }
                        
                        ?>

                      </td>
                      <td>
                          <div class="btn-group btn_group_manage" role="group">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="view-banner.php?v=<?= $data["banner_id"]; ?>">View</a></li>
                              <li><a class="dropdown-item" href="edit-banner.php?e=<?= $data["banner_id"]; ?>">Edit</a></li>
                              <li><a class="dropdown-item" href="delete-banner.php?d=<?= $data["banner_id"]; ?>">Delete</a></li>
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
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
                          <i class="fab fa-gg-circle"></i>All About Information
                      </div>  
                      <div class="col-md-4 card_button_part">
                          <!-- <a href="add-about.php" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add About Content</a> -->
                      </div>  
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover custom_table">
                    <thead class="table-dark">
                      <tr>
                        <th>About Title</th>
                       
                        <th>Button Link</th>
                        <th>Button Text</th>
                        <th>About Home Image</th>
                        <th>About Page Image</th>
                        <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>

                    <!-- all data find and loop here  -->
                    <?php
                      $sel= "SELECT * FROM about";
                      $Q=mysqli_query($con,$sel); 
                      while($data=mysqli_fetch_assoc($Q)){
                    ?>

                    <!-- table item here  -->
                    <tr>
                      <td><?php echo $data['about_title']; ?></td>
                   
                      <td><?= $data["button_link"]; ?></td>
                      <td><?= $data["button_text"]; ?></td>
                      <!-- about home image  -->
                      <td>

                        <?php

                          if($data["about_home_image"] != ''){
                            ?>
                            <img height="40" class="img200" src="uploads/<?= $data['about_home_image']; ?>" alt="about"/>
                          <?php
                          }else{
                            ?>
                            <img height="40" src="images/avatar.jpg" alt="about"/>
                          <?php
                          }
                        
                        ?>

                      </td>
                          <!-- about page image  -->
                      <td>

                        <?php

                          if($data["about_pase_image"] != ''){
                            ?>
                            <img height="40" class="img200" src="uploads/<?= $data['about_pase_image']; ?>" alt="about"/>
                          <?php
                          }else{
                            ?>
                            <img height="40" src="images/avatar.jpg" alt="about"/>
                          <?php
                          }
                        
                        ?>

                      </td>
                      <td>
                          <div class="btn-group btn_group_manage" role="group">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="view-about.php?v=<?= $data["id"]; ?>">View</a></li>
                              <li><a class="dropdown-item" href="edit-about.php?e=<?= $data["id"]; ?>">Edit</a></li>
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
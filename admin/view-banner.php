<?php

    require_once('functions/functions.php');

    // login check 
    needLogged();
    
    // role check 
    if($_SESSION['role_id'] != 4){
    
    get_header();
    get_sidebar();

    $id = $_GET['v'];
    $sel = "SELECT * FROM banners WHERE banner_id = '$id'";
    $datas = mysqli_query($con, $sel);
    $data = mysqli_fetch_assoc($datas);

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
                          <i class="fab fa-gg-circle"></i>View Banner Information
                      </div>  
                      <div class="col-md-4 card_button_part">
                          <a href="all-banner.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Banners</a>
                      </div>  
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                          <table class="table table-bordered table-striped table-hover custom_view_table">
                            <tr>
                              <td>Banner Title</td>  
                              <td>:</td>  
                              <td><?= $data['banner_title']?></td>  
                            </tr>
                            <tr>
                              <td>Banner Subtitle</td>  
                              <td>:</td>  
                              <td><?= $data['banner_subtitle']?></td>  
                            </tr>
                            <tr>
                              <td>Banner Text</td>  
                              <td>:</td>  
                              <td><?= $data['banner_text']?></td>  
                            </tr>
                            <tr>
                              <td>Button Link</td>  
                              <td>:</td>  
                              <td><?= $data['button_link']?></td>  
                            </tr>
                            <tr>
                              <td>Button Text</td>  
                              <td>:</td>  
                              <td><?= $data['button_text']?></td>  
                            </tr>
                            <tr>
                              <td>Photo</td>  
                              <td>:</td>  
                              <td>
                                <?php

                                  if($data["banner_image"] != ''){
                                    ?>
                                    <img height="80" class="img200" src="uploads/<?= $data['banner_image']; ?>" alt="banner"/>
                                  <?php
                                  }else{
                                    ?>
                                    <img height="40" src="images/avatar.jpg" alt="banner"/>
                                  <?php
                                  }

                                ?>
                              </td>  
                            </tr>
                          </table>
                      </div>
                      <div class="col-md-2"></div>
                  </div>
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
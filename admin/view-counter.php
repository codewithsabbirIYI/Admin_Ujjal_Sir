<?php

    require_once('functions/functions.php');

    // login check 
    needLogged();
    
    // role check 
    if($_SESSION['role_id'] != 4){
    
    get_header();
    get_sidebar();

    $id = $_GET['v'];
    $sel = "SELECT * FROM counters WHERE id = '$id'";
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
                          <i class="fab fa-gg-circle"></i>View Counter Information
                      </div>  
                      <div class="col-md-4 card_button_part">
                          <a href="all-counter.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Counters</a>
                      </div>  
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                          <table class="table table-bordered table-striped table-hover custom_view_table">
                            <tr>
                              <td>Counter Icon</td>  
                              <td>:</td>  
                              <td><i class="<?= $data['counter_icon']?> text-black"></i></td>  
                            </tr>
                            <tr>
                              <td>Counter Number</td>  
                              <td>:</td>  
                              <td><?= $data['counter_number']?></td>  
                            </tr>
                            <tr>
                              <td>Counter Title</td>  
                              <td>:</td>  
                              <td><?= $data['counter_title']?></td>  
                            </tr>
                            <tr>
                              <td>Counter Text</td>  
                              <td>:</td>  
                              <td><?= $data['counter_text']?></td>  
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
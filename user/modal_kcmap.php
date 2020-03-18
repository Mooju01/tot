<!--kc map-->
<?php
session_start();
if(isset($last_eq_id)){
  $src_pic=substr($last_eq_id,0,8);
  //หารูป
  $sql=$mysqli->query("SELECT *
                    FROM kc_pic
                    WHERE eq_id='$src_pic'");

  $direc=substr($last_eq_id,0,5);
  $floor=substr($last_eq_id,6,-4);
  $result=$sql->num_rows;
  if($result>0){
    while($row=$sql->fetch_assoc()){
      $pic=$row['pic'];
    }
  }
//หาหมุดที่ถูกใช้
  if($_SESSION['type']=='emp'){
    $sql=$mysqli->query("SELECT DISTINCT slot
                        FROM terminal
                        INNER JOIN emp_tel
                        ON terminal.tel=emp_tel.tel
                        WHERE terminal.eq_id='$last_eq_id'
                        ");
  }elseif($_SESSION['type']=='hotel'){
    $sql=$mysqli->query("SELECT DISTINCT slot
                        FROM terminal
                        INNER JOIN hotel_tel
                        ON terminal.tel=hotel_tel.tel
                        WHERE terminal.eq_id='$last_eq_id'
                        ");
  }else{
    $sql=$mysqli->query("SELECT DISTINCT slot
                        FROM terminal
                        INNER JOIN private_tel
                        ON terminal.tel=private_tel.tel
                        WHERE terminal.eq_id='$last_eq_id'
                        ");
  }
    
    $slot=array();
    while($row=$sql->fetch_assoc()){
      array_push($slot,$row['slot']);
    }

?>
<div class="modal fade" id="modal_kcmap" tabindex="1" role="dialog" aria-labelledby="Modalkc" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >KC Map</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>KC Map : <?=$location;?></label>
          <!-- <img src="./pic/kc/AB002/568.jpg" style="width:100%;"> -->
          <?php
          if($result>0){
          ?>
            <img src="./pic/kc/<?=$direc;?>/<?=$floor;?>/<?=$pic;?>" style="width:100%;">
          <?php
          }else{
            echo "<br>"."ไม่พบรูปภาพ KC";
          }
          ?>
          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-12">
            
              <label>ดูข้อมูลที่ใช้ใช้แล้ว</label>
              <select name="slot" class="form-control" onchange="src_emp(this.value,'<?=$last_eq_id;?>')">
                  <option value="">-----เลือกหมุด------</option>
                  <?php
                  foreach($slot as $key=>$value){
                    ?>
                    <option value="<?=$slot[$key];?>"><?=$slot[$key];?></option>
                    <?php
                  }
                  ?>
              </select>
            </div>
          </div>
        </div>
        <div id="showkcemp"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
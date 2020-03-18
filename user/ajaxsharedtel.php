<?php
include '../connect.php';
session_start();
$_SESSION['type_phone']='other';
$emp_id=$_POST['emp_id'];
$_SESSION['tel']=$_POST['tel'];
$sql=$mysqli->query("SELECT route_tel.label,route_tel.slot,route_tel.type,equipment.location,route_tel.eq_id,route_tel.memo
                    FROM route_tel
                    INNER JOIN emp_tel
                    ON route_tel.route=emp_tel.route
                    INNER JOIN equipment
                    ON route_tel.eq_id=equipment.eq_id
                    WHERE emp_tel.tel='".$_SESSION['tel']."' AND emp_tel.emp_id='$emp_id'
                    ORDER BY route_tel.eq_id ASC");
$arraylabelpri=array();
$arrayslotpri=array();
$arraylabelsec=array();
$arrayslotsec=array();
$arraylocation=array();
while($row=$sql->fetch_assoc()){
  $memo=$row['memo'];
    if($row['type']=='pt' || $row['type']=='tt'){
        array_push($arraylabelpri,$row['label']);
        array_push($arrayslotpri,$row['slot']);
        $addlocation=array(
            'location'=>$row['location'],
            'eq_id'=>$row['eq_id']
          );
        array_push($arraylocation,$addlocation);
    }else{
        array_push($arraylabelsec,$row['label']);
        array_push($arrayslotsec,$row['slot']);
    }
}
unset($addlocation);
?>
<form action="" method="post" id="frm_checkadd">
                  <div class="col-12">
                    <!--==================================emp info============================-->
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <h3>ข้อมูลพนักงาน</h3>
                      </div>        
              <?php
              foreach($_SESSION['emp_info'] as $value){
              ?>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  <span class="info-around">รหัสพนักงาน : <?=$value['emp_id'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ชื่อพนักงาน : <?=$value['emp_name'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">อีเมล์ : <?=$value['emp_email'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ส่วนงานที่สังกัด : <?=$value['div_code'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">สถานที่นั่ง : <?=$value['location'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">เบอร์โทร: <?=$_SESSION['tel'];?></span> 
                </div>
              </div>
              <?php
              }
              ?>
              <hr>
                    </div>
                    <!--==================================emp info end============================-->
                    <div class="form-group">
                      <div class="row justify-content-center">
                          <h3>เส้นทาง</h3>
                      </div>
                      <div class="row">
                        <div class="col-12">
                        <div class="map_title">
                          เลือกจุดที่ต้องการพ่วง  
                        </div> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-4 head_title">สถานที่</div>
                        <div class="col-4 head_title"><B>Terminal Primary</B></div>
                        <div class="col-4 head_title">Terminal Secondary</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-12">
                        <?php
                        $count=0;
                            foreach($arraylabelpri as $key => $value ){
                              
                        ?>
                        <div class="row">
                          <div class="col-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck<?=$count;?>" type="checkbox" name="Check[]" value="<?=$count;?>" onclick="checklocation(this.value)">
                                <label class="custom-control-label location_name" for="customCheck<?=$count;?>"><?=$arraylocation[$key]['location'];?></label>
                                <input type="hidden" name="location[]" value="<?=$arraylocation[$key]['location'];?>">
                                <input type="hidden" name="eq_id[]" value="<?=$arraylocation[$key]['eq_id'];?>">
                            </div>
                          </div>
                          <div class="col-4">
                              <input type="hidden" name="labelpri[]" value="<?=$arraylabelpri[$key];?>">
                              <input type="hidden" name="slotpri[]" value="<?=$arrayslotpri[$key];?>">
                              <span class="label_slot"><?=$arraylabelpri[$key];?>/slot :<?=$arrayslotpri[$key];?></span>
                          </div>
                          <?php
                              if(isset($arraylabelsec[$key])){
                          ?>
                          <div class="col-4">
                              <input type="hidden" name="labelsec[]" value="<?=$arraylabelsec[$key];?>">
                              <input type="hidden" name="slotsec[]" value="<?=$arrayslotsec[$key];?>">
                              <span class="label_slot"><?=$arraylabelsec[$key];?>/slot :<?=$arrayslotsec[$key];?></span>
                          </div>
                          <?php
                              }else{
                              ?>
                              <div class="col-4">
                              <span class="label_slot"><?=$memo;?></span>
                              <input type="hidden" name="memo" value="<?=$memo;?>">
                              </div>
                              <?php
                              }
                          ?>
                        </div>
                        <?php
                        $count++;
                            }
                            
                        ?>
                        </div>                          
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-facebook" onclick="backpage('block_sharedtel','1');">ย้อนกลับ</button>
                            <button type="button" class="btn btn-facebook" onclick="choiceadd();">ถัดไป</button>
                        </div>
                    </div>
                  </div>
                </form>
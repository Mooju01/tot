<?php 
include_once '../connect.php';

$b_eq_id=(isset($_POST["b_eq_id"]))?$_POST["b_eq_id"]:NULL ;
$type=(isset($_POST["type"]))?$_POST["type"]:NULL ;
if(isset($type)){
    if($type=='show'){
        if($b_eq_id!=""){
            $showfloor=array();
            //หาชั้นทั้งหมดที่มี pabx kc mdf
            $sql=$mysqli->query("SELECT eq_id
                                FROM terminal
                                WHERE eq_id LIKE '".$b_eq_id."F__%' 
                                GROUP BY eq_id
                                ORDER BY eq_id ASC");
            $check=true;
            while($row=$sql->fetch_assoc()){
                $subfloor=substr($row['eq_id'],6);
                $subfloor=substr($subfloor,0,2);
                if(count($showfloor)>0){
                    for($i=0;$i<count($showfloor);$i++){
                        if($showfloor[$i]!=$subfloor){
                            $check=true;
                            $addfloor=$subfloor;
                        }else{
                            $check=false;
                            $addfloor=NULL;
                            break;
                        }
                    }
                    if($check==true){
                    array_push($showfloor,$addfloor);
                    }
                }
                else{
                    array_push($showfloor,$subfloor);
                    
                }
                
            }
            unset($count);
            ?>
            <span class="title-add_edit">ชั้น<span class="star">*</span></span>
                <select class="form-control form-control-alternative" name="floor" onchange="showeq_id(this.value,'<?=$b_eq_id;?>');">
                <option value="" selected>----------เลือกชั้น---------</option>
                    <?php
                    foreach($showfloor as $key=>$value){
                    ?>
                    <option value="<?=$showfloor[$key];?>" >
                    <?php
                        echo $showfloor[$key];
                    ?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
        }
    }elseif($type=='floor_kc'){
        if($b_eq_id!=""){
            $showfloor=array();
            //หาชั้นทั้งหมดที่มี pabx kc mdf
            $sql=$mysqli->query("SELECT eq_id
                                FROM terminal
                                WHERE eq_id LIKE '".$b_eq_id."F__C%' 
                                GROUP BY eq_id
                                ORDER BY eq_id ASC");
            $check=true;
            while($row=$sql->fetch_assoc()){
                $subfloor=substr($row['eq_id'],6);
                $subfloor=substr($subfloor,0,2);
                if(count($showfloor)>0){
                    for($i=0;$i<count($showfloor);$i++){
                        if($showfloor[$i]!=$subfloor){
                            $check=true;
                            $addfloor=$subfloor;
                        }else{
                            $check=false;
                            $addfloor=NULL;
                            break;
                        }
                    }
                    if($check==true){
                    array_push($showfloor,$addfloor);
                    }
                }
                else{
                    array_push($showfloor,$subfloor);
                    
                }
                
            }
            unset($count);
            ?>
            <span class="title-add_edit">ชั้น<span class="star">*</span></span>
                <select class="form-control form-control-alternative" name="floor" onchange="showeq_id(this.value,'<?=$b_eq_id;?>');">
                <option value="" selected>----------เลือกชั้น---------</option>
                    <?php
                    foreach($showfloor as $key=>$value){
                    ?>
                    <option value="<?=$showfloor[$key];?>" >
                    <?php
                        echo $showfloor[$key];
                    ?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
        }
    }
}else{
    //search MDF Building
    $src_mdf=array();
    $sql=$mysqli->query("SELECT terminal.eq_id,equipment.location
                        FROM terminal
                        INNER JOIN equipment
                        ON terminal.eq_id=equipment.eq_id
                        WHERE terminal.eq_id LIKE '".$b_eq_id."F__B%' 
                        GROUP BY terminal.eq_id
                        ORDER BY terminal.eq_id ASC");
    $result=$sql->num_rows;
    for($i=0;$i<$result;$i++){
        $row=$sql->fetch_assoc();
        array_push($src_mdf,$row);
    }
    //end search MDF Building
    if($b_eq_id!=""){
    ?>
    <label>ที่อยู่ MDF ปลายทาง<span class="star">*</span></label>
        <select class="form-control form-control-alternative location_name" name="eq_id" onchange="check_mdf(this.value);">
            <option value="" selected>----------เลือก MDF ปลายทาง---------</option>
            <?php
            foreach($src_mdf as $key){
            ?>
            <option value="<?=$key["eq_id"];?>" >
            <?php
                echo $key["location"];
            ?></option>
            <?php
            }
            ?>
        </select>
        <label id="error_mdf" class="select-error2" style="display:none;">กรุณาเลือก MDF</label>
<?php
    }
}
?>


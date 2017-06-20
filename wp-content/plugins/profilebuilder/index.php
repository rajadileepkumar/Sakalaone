<?php
/**
* Plugin Name: Profile Builder
* Plugin URI: https://www.github.com/rajadileepkumar
* Description: Resume Builder Page for Subscribers
* Version: 1.0.0
* Author: Raja Dileep Kumar
* Author URI: https://github.com/rajadileepkumar
* License: GPL2
*/
if(!class_exists('Profile_Builder')){
    class Profile_Builder{
        public function __construct()
        {
            add_action('admin_menu', array($this,'profile_users_menu'));
            add_action('admin_enqueue_scripts',array($this,'admin_load_scripts'));
        }

        public function profile_users_menu() {
            add_menu_page('Profile Page', 'Resume Builder', 'subscriber', 'profile_builder', array($this,'profile_builder_page'),'dashicons-id-alt');
            add_menu_page('Documents', 'Documents', 'subscriber', 'download_builder', array($this,'download_builder_page'),'dashicons-portfolio');
        }

        public function admin_load_scripts(){
            wp_enqueue_script( 'FileSaver', plugins_url('js/FileSaver.js', __FILE__) );
            wp_enqueue_script( 'jquery.wordexport', plugins_url('js/jquery.wordexport.js', __FILE__) );
        }

        public function profile_builder_page(){
            global $current_user;
            global $wpdb;
            $user_id = get_current_user_id();
            $upId = $_REQUEST['upId1'];
            $sql = "select * from wp_users_profile where userId = $user_id";
               $selectResult = $wpdb->get_results($sql);
               foreach ($selectResult as $value) {
                    $upId = $value->upId;
                    $firstName = $value->firstName;
                    $lastName = $value->lastName;
                    $fatherName = $value->fatherName;
                    $motherName = $value->motherName;
                    $phoneNumber = $value->phoneNumber;
                    $dob = $value->dob;
                    $email = $value->email;
                    $address = $value->address;
                    $yopSslc = $value->yopSslc;
                    $regNumberSslc= $value->regNumberSslc;
                    $perSslc = $value->perSslc;
                    $yopPuc = $value->yopPuc;
                    $regNumberPuc = $value->regNumberPuc;
                    $perPuc = $value->perPuc;
                    $yopG = $value->yopG;
                    $regNumberG = $value->regNumberG;
                    $perG = $value->perG;
                    $yopPg = $value->yopPg;
                    $regNumberPg = $value->regNumberPg;
                    $perPg = $value->perPg;
                    $other1 = $value->other1;
                    $otheryop1 = $value->otheryop1;
                    $otherper1 = $value->otherper1;
                    $other2 = $value->other2;
                    $otheryop2 = $value->otheryop2;
                    $otherper2 = $value->otherper2;
                    $cDate = $value->cDate;
                    $place = $value->place;
               }
            if($_POST['profile'] && $upId==''){
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $fatherName = $_POST['fatherName'];
                $motherName = $_POST['motherName'];
                $phoneNumber = $_POST['phoneNumber'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $yopSslc = $_POST['yopSslc'];
                $regNumberSslc= $_POST['regNumberSslc'];
                $perSslc = $_POST['perSslc'];
                $yopPuc = $_POST['yopPuc'];
                $regNumberPuc = $_POST['regNumberPuc'];
                $perPuc = $_POST['perPuc'];
                $yopG = $_POST['yopG'];
                $regNumberG = $_POST['regNumberG'];
                $perG = $_POST['perG'];
                $yopPg = $_POST['yopPg'];
                $regNumberPg = $_POST['regNumberPg'];
                $perPg = $_POST['perPg'];
                $other1 = $_POST['other1'];
                $otheryop1 = $_POST['otheryop1'] ;
                $otherper1 = $_POST['otherper1'] ;
                $other2 = $_POST['other2'];
                $otheryop2 = $_POST['otheryop2'] ;
                $otherper2 = $_POST['otherper2'] ;
                $cDate = $_POST['cDate'];
                $place = $_POST['place'];
                $signature = $_POST['signature'];
               
                $insertProfile = $wpdb->prepare("insert into wp_users_profile (firstName,lastName,fatherName,motherName,dob,phoneNumber,email,address,yopSslc,regNumberSslc,perSslc,yopPuc,regNumberPuc,perPuc,yopG,regNumberG,perG,yopPg,regNumberPg,perPg,other1,otheryop1,otherper1,other2,otheryop2,otherper2,place,cDate,signature,userId) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%d)",$firstName,$lastName,$fatherName,$motherName,$dob,$phoneNumber,$email,$address,$yopSslc,$regNumberSslc,$perSslc,$yopPuc,$regNumberPuc,$perPuc,$yopG,$regNumberG,$perG,$yopPg,$regNumberPg,$perPg,$other1,$otheryop1,$otherper1,$other2,$otheryop2,$otherper2,$place,$cDate,$signature,$user_id);  
               
                 $result = $wpdb->query($insertProfile);
                 if($result){
                    $message = "Updated Successfully";
                 }
               
            }
            else if($_POST['profile']){
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $fatherName = $_POST['fatherName'];
                $motherName = $_POST['motherName'];
                $phoneNumber = $_POST['phoneNumber'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $yopSslc = $_POST['yopSslc'];
                $regNumberSslc= $_POST['regNumberSslc'];
                $perSslc = $_POST['perSslc'];
                $yopPuc = $_POST['yopPuc'];
                $regNumberPuc = $_POST['regNumberPuc'];
                $perPuc = $_POST['perPuc'];
                $yopG = $_POST['yopG'];
                $regNumberG = $_POST['regNumberG'];
                $perG = $_POST['perG'];
                $yopPg = $_POST['yopPg'];
                $regNumberPg = $_POST['regNumberPg'];
                $perPg = $_POST['perPg'];
                $other1 = $_POST['other1'];
                $otheryop1 = $_POST['otheryop1'] ;
                $otherper1 = $_POST['otherper1'] ;
                $other2 = $_POST['other2'];
                $otheryop2 = $_POST['otheryop2'] ;
                $otherper2 = $_POST['otherper2'] ;
                $cDate = $_POST['cDate'];
                $place = $_POST['place'];
                $signature = $_POST['signature'];
                $updateQuery = "UPDATE wp_users_profile SET firstName='$firstName',lastName='$lastName',fatherName='$fatherName',motherName='$motherName',phoneNumber='$phoneNumber',dob='$dob',email='$email',address='$address',yopSslc='$yopSslc',regNumberSslc='$regNumberSslc',perSslc='$perSslc',yopPuc='$yopPuc',regNumberPuc='$regNumberPuc',perPuc='$perPuc',yopG='$yopG',regNumberG='$regNumberG',perG='$perG',yopPg='$yopPg',regNumberPg='$regNumberPg',perPg='$perPg',other1='$other1',otheryop1='$otheryop1',otherper1='$otherper1',other2='$other2',otheryop2='$otheryop2',otherper2='$otherper2',cDate='$cDate',place='$place',signature='$signature' WHERE upId = $upId";
                $result=$wpdb->query($updateQuery);
                if($result){
                    $message = "Updated Successfully";
                }
                 
            }
            
            ?>
            <?php 
                $sql = "Select * from wp_users_profile WHERE upId = $upId";
                $sqlQuery = $wpdb->get_results($sql);
                foreach ($sqlQuery as $key) {
                    $firstName = $value->firstName;
                    $lastName = $value->lastName;
                    $fatherName = $value->fatherName;
                    $motherName = $value->motherName;
                    $phoneNumber = $value->phoneNumber;
                    $dob = $value->dob;
                    $email = $value->email;
                    $address = $value->address;
                    $yopSslc = $value->yopSslc;
                    $regNumberSslc= $value->regNumberSslc;
                    $perSslc = $value->perSslc;
                    $yopPuc = $value->yopPuc;
                    $regNumberPuc = $value->regNumberPuc;
                    $perPuc = $value->perPuc;
                    $yopG = $value->yopG;
                    $regNumberG = $value->regNumberG;
                    $perG = $value->perG;
                    $yopPg = $value->yopPg;
                    $regNumberPg = $value->regNumberPg;
                    $perPg = $value->perPg;
                    $other1 = $value->other1;
                    $otheryop1 = $value->otheryop1;
                    $otherper1 = $value->otherper1;
                    $other2 = $value->other2;
                    $otheryop2 = $value->otheryop2;
                    $otherper2 = $value->otherper2;
                    $cDate = $value->cDate;
                    $place = $value->place;
                }
            ?>
            <div id="page-content">
                <?php
                    $content .= "<style> .label { font-weight:bold;float:left } .label > span { float:left } </style>";

                    $content .= "<div style='border:3px solid black;margin:20px;'><br/>";
                    $content .= "<div align='center' style='font-weight:bold;font-size:1.5em;'><u>RESUME</u></div><br/><br/>";
                    $content .= "<div style='margin-left:100px;'>";

                    
                    if(!empty($firstName)){
                        $content .= "<span class='label'>First Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$firstName."</span><br/><br/>";    
                    }
                    if(!empty($lastName)){
                        $content .= "<span class='label' > Last Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$lastName."</span><br/><br/>";
                    }
                    if(!empty($fatherName)){
                        $content .= "<span class='label' > Father's Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$fatherName."</span><br/><br/>";
                    }
                    if(!empty($motherName)){
                        $content .= "<span class='label' > Mother's Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$motherName."</span><br/><br/>";
                    }
                    if(!empty($phoneNumber)){
                        $content .= "<span class='label' > Phone Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$phoneNumber."</span><br/><br/>";
                    }
                    if(!empty($email)){
                        $content .= "<span class='label' > Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$email."</span><br/><br/>";
                    }
                    if(!empty($dob)){
                        $content .= "<span class='label' > Date Of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$dob."</span><br/><br/>";
                    }
                    if(!empty($address)){
                        $content .= "<span class='label' > Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>".$address."</span><br/><br/>";
                    }

                    $content .= "<table border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse;' width='900'><tr><th colspan='4'>Academic Details</th></tr>";                    
                    $content .= "<tr><th>Qualification</th><th>Board</th><th>Passing Year</th><th>Percentage</th></tr>"; 
                    $content .= "<tr><td >SSLC</td>";                    
                    $content .= "<td>".$yopSslc."</td>";
                    $content .= "<td>".$regNumberSslc."</td>";
                    $content .= "<td>".$perSslc."</td></tr>";
                    
                    $content .= "<tr><td>PUC</td>";                    
                    $content .= "<td>".$yopPuc."</td>";
                    $content .= "<td>".$regNumberPuc."</td>";
                    $content .= "<td>".$perPuc."</td></tr>";
                    
                    $content .= "<tr><td>Graduation</td>";                    
                    $content .= "<td>".$yopG."</td>";
                    $content .= "<td>".$regNumberG."</td>";
                    $content .= "<td>".$perG."</td></tr>";

                    if(!empty($yopPg)){
                        $content .= "<tr><td>PG</td>";                    
                        $content .= "<td>".$yopPg."</td>";
                        $content .= "<td>".$regNumberPg."</td>";
                        $content .= "<td>".$perPg."</td></tr>";
                    }

                    if(!empty($other1)){
                        $content .= "<tr><td>Other1</td>";                    
                        $content .= "<td>".$other1."</td>";
                        $content .= "<td>".$otheryop1."</td>";
                        $content .= "<td>".$otherper1."</td></tr>";
                    }
                    
                    if(!empty($other2)){
                        $content .= "<tr><td>Other2</td>";                    
                        $content .= "<td>".$other2."</td>";
                        $content .= "<td>".$otheryop2."</td>";
                        $content .= "<td>".$otherper2."</td></tr>";
                    }

                    $content .= "</table></br><br/>";
                    $content .= "<div><span class='label'> Experience: </span><span>-----------------------------------------------------------------------------------------------------------------------------------------------------</span></div></br><br/>";

                    $content .= "<div><span class='label'> Place :</span> ".$place."<div align='right' style='margin-right:50px;'>Your's faithfully<div/></div>";
                    
                    $content .= "<div><span class='label'> Date :</span> ".$cDate."<div align='right' style='margin-right:50px;'>".$firstName." ".$lastName."<div/></div>";
                    
                    $content .= "<br/><br/>"; 
                    $content .= "</div>";   
                    $content .= "</div>";
                ?>
            </div>
            <div class="wrap">
                    <div style='float:left;font-size:1.5em;font-weight:bold'>Profile Page &nbsp&nbsp&nbsp&nbsp </div>
                    <div style='float:left;font-size:1.1em;'><a class="word-export" href="javascript:void(0)">Print Resume</a></div>
                    <div align='center' style='font-size:1.1em;font-weight:bold'><?php echo $message;?></div>
                    <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="abc" id="abc">
                        <table class="form-table">
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="firstName">First Name</label>
                                </th>
                                <td>
                                    <input type="hidden" name="upId1" id="upId1" value="<?php echo $upId?>">
                                    <input type="text"class="regular-text" name="firstName" id="firstName" value="<?php echo $firstName?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="lastName">Last Name</label>
                                </th>
                                <td>
                                    <input type="text" name="lastName" id="lastName" class="regular-text" value="<?php echo $lastName?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="fatherName">Father's Name</label>
                                </th>
                                <td>
                                    <input type="text" name="fatherName" id="fatherName" class="regular-text" value="<?php echo $fatherName?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="motherName">Mother's Name</label>
                                </th>
                                <td>
                                    <input type="text" name="motherName" id="motherName" class="regular-text" value="<?php echo $motherName?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="dob">Date Of Birth</label>
                                </th>
                                <td>
                                    <input type="date" name="dob" id="dob" class="regular-text" value="<?php echo $dob?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="phoneNumber">Phone Number</label>
                                </th>
                                <td>
                                    <input type="text" name="phoneNumber" id="phoneNumber" class="regular-text" value="<?php echo $phoneNumber?>">
                                </td>
                                <th>
                                    <label for="email">Email</label>
                                </th>
                                <td>
                                    <input type="email" name="email" id="email" class="regular-text" value="<?php echo $email?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="address">Address</label>
                                </th>
                                <td>
                                    <textarea cols="35" rows="5" name="address" id="address"><?php echo $address?></textarea>
                                </td>
                            </tr>
                        </table>
                        <h2>Accdemic Details</h2>
                        <table class="form-table">
                            <tr>
                                <th style="text-align:center">
                                    <label>Qualification</label>
                                </th> 
                                <th style="text-align:center">
                                    <label>Board</label>
                                </th>    
                                <th style="text-align:center">
                                    <label>Passing Year</label>
                                </th>    
                                <th style="text-align:center">
                                    <label>Percentage (%) </label>
                                </th>    
                            </tr>
                            <tr class="user-first-name-wrap" width="100%">
                                <th  width="25%">
                                    <label for="sslc">SSLC</label>
                                </th>
                                <td width="25%">
                                    <input type="text" name="yopSslc" id="yopSslc" class="regular-text" value="<?php echo $yopSslc?>" style="width:20em;">
                                </td>
                                <td width="25%">
                                    <input type="text" name="regNumberSslc" id="regNumberSslc" class="regular-text" value="<?php echo $regNumberSslc?>" style="width:20em;">
                                </td>
                                <td width="25%">
                                    <input type="text" name="perSslc" id="perSslc" class="regular-text" value="<?php echo $perSslc?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="puc">PUC</label></th>
                                <td>
                                    <input type="text" name="yopPuc" id="yopPuc" class="regular-text" value="<?php echo $yopPuc?>" style="width:20em;">
                                </td>    
                                <td>
                                    <input type="text" name="regNumberPuc" id="regNumberPuc" class="regular-text" value="<?php echo $regNumberPuc?>" style="width:20em;">
                                </td>
                                <td>    
                                    <input type="text" name="perPuc" id="perPuc" class="regular-text" value="<?php echo $regNumberPuc?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="grdu">Graduation</label></th>
                                <td>
                                    <input type="text" name="yopG" id="yopG" class="regular-text" value="<?php echo $yopG?>" style="width:20em;">
                                </td>    
                                <td>
                                    <input type="text" name="regNumberG" id="regNumberG" class="regular-text" value="<?php echo $regNumberG?>" style="width:20em;">
                                </td>
                                <td>      
                                    <input type="text" name="perG" id="perG" class="regular-text" value="<?php echo $perG?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="Pgrdu">PG</label></th>
                                <td>
                                    <input type="text" name="yopPg" id="yopPg" class="regular-text" value="<?php echo $yopPg?>" style="width:20em;">
                                </td>    
                                <td>
                                    <input type="text" name="regNumberPg" id="regNumberPg" class="regular-text" value="<?php echo $regNumberPg?>" style="width:20em;">
                                </td>
                                <td>      
                                    <input type="text" name="perPg" id="perPg" class="regular-text" value="<?php echo $perPg?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="Pgrdu">Other1</label></th>
                                <td>
                                    <input type="text" name="other1" id="other1" class="regular-text" value="<?php echo $other1?>" style="width:20em;">
                                </td>    
                                <td>
                                    <input type="text" name="otheryop1" id="otheryop1" class="regular-text" value="<?php echo $otheryop1?>" style="width:20em;">
                                </td>
                                <td>      
                                    <input type="text" name="otherper1" id="otherper1" class="regular-text" value="<?php echo $otherper1?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="Pgrdu">Other2</label></th>
                                <td>
                                    <input type="text" name="other2" id="other2" class="regular-text" value="<?php echo $other2?>" style="width:20em;">
                                </td>    
                                <td>
                                    <input type="text" name="otheryop2" id="otheryop2" class="regular-text" value="<?php echo $otheryop2?>" style="width:20em;">
                                </td>
                                <td>      
                                    <input type="text" name="otherper2" id="otherper2" class="regular-text" value="<?php echo $otherper2?>" style="width:20em;">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th>
                                    <label for="place">Place</label></th>
                                <td>
                                    <input type="text" name="place" id="place" class="regular-text" value="<?php echo $place?>">
                                </td>
                            </tr>
                            <tr class="user-first-name-wrap">
                                <th><label for="cDate">Date</label></th>
                                <td>
                                    <input type="date" name="cDate" id="cDate" class="regular-text" value="<?php echo $cDate?>">
                                </td>
                            </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" value="Update Profile" class="button button-primary" name="profile" id="profile">
                        </p>
                        <style type="text/css">
                            .resume-link{
                                text-align: right;
                                position: relative;
                                right: 100px;
                            }
                        </style>
                        <script type="text/javascript">
                            jQuery(document).ready(function($) {
                                var content = "<?php echo $content; ?>";
                                $("a.word-export").click(function(event) {
                                    $("#page-content").html(content).hide();
                                    $("#page-content").wordExport();
                                });
                            });
                        </script>
                    </form>
                </div>
            <?php
        }

        public function download_builder_page(){
            global $current_user;
            wp_get_current_user();
            $args = array(
                'posts_per_page' => '-1',
                'author' => $current_user->ID,
                'post_type'=>'cmdm_page'
            );
            $new = new WP_Query($args);
            ?>
            <div class="wrap">
            <h2>All Downloads</h2>

            <p><a target="_blank" href="<?php echo home_url('/cmdownload/add/')?>" class="button button-primary">Add New</a></p>
            <table class="abc" border="2">
                <tr><td>Id</td><td>File Name</td><td>Download Link</td><td>Content</td></tr>
                <?php
                while ($new->have_posts()) : $new->the_post();
                    ?>
                        <tr>
                            <td><?php the_ID();?></td>
                            <td><?php the_title();?></td>
                            <td><a href="<?php the_guid()?>" target="_blank"><?php the_title()?></a></td>
                            <td><?php the_content();?></td>
                        </tr>
                    <?php
                    endwhile;
            ?></table></div><?php
        }
        
    }
}
$obj = new Profile_Builder();
?>
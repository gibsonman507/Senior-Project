<?php     
/*  
 * All code in the following file was originally designed and implemented 
 * by Alex Connor Carrozzi for a Senior Project for the 2014-2015 academic year
 * The University of New Hampshire Computer Science Department owns and
 * is responsible for all functionality contained in the web application
 * ScheduleIt
 *
 * 
 */
    
    $prod = 0;
     $sp = $prod==0?"Senior-Project/":"";
     //require_once 'email.php';

    //My Libraries
    require_once 'common.php';
    require_once 'block.php';
    
    $ret_msg['status'] = 'success';
    $ret_msg['msg'] = '';

    //I dont know how.. can you?
    
    //Handle Form Submissions
    if(isset($_REQUEST['fullname'])){
        $name = $_REQUEST['fullname'];
        $email = $_REQUEST['email'];
        $timeslot_id = $_REQUEST['timeslot_id'];
        $cal_id = $_REQUEST['cal_id'];
        
        
        $GLOBALS['g_calid'] = $cal_id;
        require_once $_SERVER['DOCUMENT_ROOT']."/{$sp}utilities/google_api_init.php";
            
        if($name == ''){
            //TODO: Handle Errors
            $ret_msg['status'] = 'error';
            $ret_msg['msg'] = 'Enter your full name';
        }elseif($email==''){
            //TODO: Handle Errors
            $ret_msg['status'] = 'error';
            $ret_msg['msg'] = 'Enter your UNH ID';
        }else{
              $info = $manager->getSegmentById($timeslot_id);
              $target_segment = $info['segment'];
              $delete_event = $info['delete_event'];
              $new_events = $manager->insert_segment($g_calid,$delete_event,$target_segment,$name,$email);
              
              //Set a random string cookie to deter spammers
              //This cookie should be deleted upon cancellation
              if(isset($new_events)){
                setcookie('ofn3793filnf49842kc3ji972inr');
              }
           
            //Construct Email information
            $student_email = "{$email}@wildcats.unh.edu";
            $subject = "ScheduleIt Appointment Confirmation";
            $message = "This is a test email from ScheduleIt";
            
            try{
                $_email = new Email('professor.jones567@gmail.com');
                if(!$_email->send($student_email,$subject,$message)){
                    $ret_msg['msg'] = 'error';
                }
                Logger::write("STATUS: Email successfully sent to: $student_email with message: $message");
            }catch(Exception $e){
                Logger::write("Email::send failed - ".$e->getMessage());
            }
        }
        header("Content-Type: application/json");
        echo json_encode($ret_msg);
    }

?>
<?php
/*

   @Author  : Chikitsa Patel
   @Date    : Monday 14 Jan, 2019
   @Purpose : To store session in database instead of file system.

*/
require_once 'pdo.php';
class Session{
    
  private $db;
    
    public function __construct(){  
        // Instantiate new Database object  
        $this->db = new Database;

        // Set handler to overide SESSION  
        session_set_save_handler(  
        array($this, "_open"),  
        array($this, "_close"),  
        array($this, "_read"),  
        array($this, "_write"),  
        array($this, "_destroy"),  
        array($this, "_gc")  
        );

        // Start the session  
        session_start();  
   }  
    
/**  
* Open  
*/  
    
        public function _open(){  
            // If successful  
            if($this->db){  
            // Return True  
            return true;  
            }  
            // Return False  
            return false;  
        }  
    
/**  
* Close  
*/  
        public function _close(){  
            // Close the database connection  
            // If successful  
            if($this->db->close()){  
                // Return True  
                return true;  
            }  
            // Return False  
            return false;  
        }  
     /**  
 * Read  
 */  
     public function _read($id){  
         // Set query  
         $this->db->query("SELECT data,ip_address,user_agent FROM `aertrip_user_sessions` WHERE `active_status` = 1 AND `session_id` = :id");

         // Bind the Id  
         $this->db->bind(':id', $id);

         // Attempt execution  
         // If successful  
         if($this->db->execute()){  
             // Save returned row  
             $row = $this->db->single(); 
             
             if($_SERVER['REMOTE_ADDR'] == $row['ip_address'] && $_SERVER['HTTP_USER_AGENT'] == $row['user_agent']){
                 return $row['data'];
             } else {
                 //Possibility fraudant activity. Email and inform to concern persons.
                 return '';
             }
            
         }else{  
             // Return an empty string  
             return '';  
         }  
     } 
    
/**  
* Write  
*/  
    
        public function _write($id, $data){  
            
            // Set query  
            $this->db->query("REPLACE INTO `aertrip_user_sessions` (`session_id`,`datetime`,`data`,`ip_address`,`user_agent`) VALUES (:session_id, :datetime, :data, :ip_address, :user_agent)");

            // Bind data  
            $this->db->bind(':session_id', $id);  
            $this->db->bind(':datetime', time());  
            $this->db->bind(':data', $data);
            $this->db->bind(':ip_address', $_SERVER['REMOTE_ADDR']);
            $this->db->bind(':user_agent', $_SERVER['HTTP_USER_AGENT']);

            // Attempt Execution  
            // If successful  
            if($this->db->execute()){  
                // Return True  
                return true;  
            }

            // Return False  
            return false;  
        }  
    
/**  
* Destroy  
*/  
        public function _destroy($id){  
            // Set query  
            $this->db->query("UPDATE `aertrip_user_sessions` SET `active_status` = :active_status AND `inactive_datetime` = :inactive_datetime WHERE `session_id` = :id");

            // Bind data  
            $this->db->bind(':id', $id);
            $this->db->bind(':active_status', 0);
            $this->db->bind(':inactive_datetime', time());

            // Attempt execution  
            // If successful  
            if($this->db->execute()){  
                // Return True  
                return true;  
            }

            // Return False  
            return false;  
        }  
/**  
 * Garbage Collection  
 */  
         public function _gc($max){  
            
             $current_time = time();
             $inactive_time = time() - $max;
             // Set query  
             $this->db->query('UPDATE `aertrip_user_sessions` SET `active_status` = :status AND `inactive_datetime` = :inactive_datetime WHERE  `datetime` < :old');

             // Bind data  
             $this->db->bind(':old', $inactive_time);
             $this->db->bind(':active_status', 3);
             $this->db->bind(':inactive_datetime', $current_time);

             // Attempt execution  
             if($this->db->execute()){  
                 // Return True  
                 return true;  
             }

             // Return False  
             return false;  
         }  
}


?>

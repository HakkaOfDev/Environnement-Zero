<?php

/**
* This class is the main class to manage the privates messages (delete, clear, create, get)
*/

class PrivateMessage {

	private $db;
	private $auth;

	/**
	* Constructor of PrivateMessage class
	*
	* @param $db
	* @param $auth
	*/
	public function __construct()
    {
        $this->db = App::getDatabase();
        $this->auth = App::getAuth();
    }

    /**
	* Check if a discussion exists between 2 users
	*
	* @param string $user1
	* @param string $user2
	*
	* @return boolean
    */
	public function hasPrivateMessage($db, $user1, $user2) {
		$name1 = $user1.'_'.$user2;
		$messageExist = $db->query('SELECT * FROM messages_name WHERE name = ?', [$name1]);
		if ($messageExist->fetch()){
			return true;
		} else {

			$name2 = $user2.'_'.$user1;
			$verification = $db->query('SELECT * FROM messages_name WHERE name = ?', [$name2]);
			if($verification->fetch()){
				return true;
			} else {
				return false;
			}
		}


	}

    public function hasPrivateMessageByName($db, $name) {
        $messageExist = $db->query('SELECT * FROM messages_name WHERE name = ?', [$name]);
        if ($messageExist->fetch()){
            return true;
        } else {
            return false;
        }

    }

	/**
	* Get private message name
	*
	* @param string $user1
	* @param string $user2
	*
	* @return string $name
	*/
	public function getPrivateMessage($db, $user1, $user2){
		$name1 = $user1.'_'.$user2;
		$messageExist = $db->query('SELECT * FROM messages_name WHERE name = ?', [$name1]);
		$targetMessage = $messageExist->fetch();
		
		if ($targetMessage){
			return $targetMessage->name;
		} else {

			$name2 = $user2.'_'.$user1;
			$verification = $db->query('SELECT * FROM messages_name WHERE name = ?', [$name2]);
			$targetMessage2 = $verification->fetch();

			if($targetMessage2){
				return $targetMessage2->name;
			} else {
				return null;
			}
		}
	}

	/**
	* Create the table for a private message between two users
	*
	* @param string $user1
	* @param string $user2
	*/
	public function createPrivateMessage($db, $user1, $user2){

		$name = strtolower($user1).'_'.strtolower($user2);
		try {
            $db->query("INSERT INTO messages_name (name) VALUES (?)", [$name]);
            $db->query("CREATE TABLE IF NOT EXISTS {$name} (
                          id int(11) AUTO_INCREMENT,
                          id_student int(11) NOT NULL,
                          message_content text NOT NULL,
                          date timestamp NOT NULL,
                          PRIMARY KEY (ID)
                          )")->execute();
        } catch (Exception $e){
		    echo $e->getMessage();
        }
	}
	
	/**
	* Delete the table from specify private message
	*
	* @param string $user1
	* @param string $user2
	*/
	public function deletePrivateMessage($db, $name){
		if($this->hasPrivateMessageByName($db, $name)){
            $db->query("DROP TABLE IF EXISTS {$name}")->execute();
			$db->query("DELETE FROM messages_name WHERE name = ?", [$name]);
		}
	}

	/**
	* Return array of all privates messages from a specific student
	*
	* @param string $user1
	* 
	* @return array $messages
	*/
	public function getAllMessages($db, $user1){

		$messages = [];
		$query = $db->query('SELECT * FROM messages_name');
		while ($query->fetch()){
			$message = $query->fetch();
			if(strpos($message['name'], $user1)){
				$split = split('_', $message['name']);
				if($split[0] == $user1){
					array_push($messages, $split[1]);
				} else {
					array_push($messages, $split[0]);
				}
			}
		}
		return $messages;
	}
}

?>
<?php
include('./includes/db-config.php');

$bddpw = $db['password'];
$bddipdatabase = $db['ipdatabase'];
$bddlogin = $db['login'];
$bddip = $db['ip'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = new action($bddpw,$bddipdatabase,$bddlogin,$bddip);

$action->execute($bddpw,$bddipdatabase,$bddlogin,$bddip);



class action {

	public $bdd;
 
 
	public function action($bddpw,$bddipdatabase,$bddlogin,$bddip) {
		try { $this->bdd = new PDO($bddipdatabase, $bddlogin, $bddpw); }
		catch (Exception $ex) { die('ERROR:INVALID_DATABASE_CONNECTION'); }
	}

 
	public function execute($bddpw,$bddipdatabase,$bddlogin,$bddip) {
		
        $pasteData = $this->executeQuery("SELECT * FROM PASTE_Pastes WHERE ExpirationDate < ?;", array(time()));
        
        while (isset($pasteData['UID'])) {

            $pasteData = $this->executeQuery("SELECT * FROM PASTE_Pastes WHERE ExpirationDate < ?;", array(time()));
                
            if (isset($pasteData['UID'])) {
                    
                $file = "./raw/" . $pasteData['UID'];
                $fileLink = fopen($file, 'w');
                fclose($fileLink);
                unlink($file);

                $this->executeQuery("DELETE FROM PASTE_Pastes WHERE UID = ?;", array($pasteData['UID']));
                
            }
            
        }
		
    }
 
	
 
	private function executeQuery($query, $args, $fetch = true) {
		$response = $this->bdd->prepare($query);
		$response->execute($args);
		if ($fetch) {
			$authData = $response->fetch();
			$response->closeCursor();
			return ($authData);
		}
		else {
			Return ($response);
		}
	}
 
 
}

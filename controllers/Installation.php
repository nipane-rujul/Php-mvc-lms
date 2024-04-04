<?php

namespace src\controllers;

use src\core\Application;
use src\models\Database;

class Installation extends Controller{
    
    public function install(){
        if(Application::$app->request->getMethod() == "POST"){
            $data = Application::$app->request->getBody();
        
            $user = $data['username'];
            $password = $data['password'];
            $email = $data['email'];
            $dbname = $data['dbname'];
            $dbuser = $data['dbuser'];
            $dbpass = $data['dbpass'];
            $documentRoot = $_SERVER['DOCUMENT_ROOT'];
            // creating config file and storing details
            try{
                $config = fopen($documentRoot."/../config.php", "w") or throw new \Exception("Make sure have neccessary permissions");

            }
            catch(\Exception $e){
                echo "here";
                // $_SESSION['error'] = $e->getMessage();
                // header('Location: '. "../views/adminReg.php");
                exit;
            }
            // echo "here";
             $configContent = "<?php\n";
    $configContent .= "// Database Configuration\n";
    $configContent .= "\$dbConfig = [\n";
    $configContent .= "\t'server' => 'localhost',\n"; // Assuming localhost, change it if needed
    $configContent .= "\t'dbname' => '{$dbname}',\n";
    $configContent .= "\t'username' => '{$dbuser}',\n";
    $configContent .= "\t'dbpass' => '{$dbpass}',\n";
    $configContent .= "\t'password' => '{$password}',\n";
    $configContent .= "\t'email' => '{$email}'\n";
    $configContent .= "];\n";
    $configContent .= "?>";

    // Write content to the file
    fwrite($config, $configContent);
    $envFilePath = $documentRoot . "/../.env";
    // Close the file
    fclose($config);
    $envContent = "DB_SERVER=localhost\n"; // Change if necessary
    $envContent .= "DB_NAME={$dbname}\n";
    $envContent .= "DB_USER={$dbuser}\n";
    $envContent .= "DB_PASS={$dbpass}\n";

    // Append the content to the .env file
    file_put_contents($envFilePath, $envContent, FILE_APPEND);
    $data['server'] = 'localhost';
    $db = Database::getInstance($data);  
    $db->initializeDatabase();
         Application::$app->response->redirect('login');
        }
        else{
            $this->layout = 'auth';
            $this->render("install");
        }
    }

}
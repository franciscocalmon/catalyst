<?php
<<<<<<< HEAD

ini_set('display_errors',1);
ini_set('auto_detect_line_endings',TRUE);


=======
>>>>>>> 4f593f60b19465ba5287758697fa409b951ef0d3
class User{
  private $host;
  private $file;
  private $dbUsername;
  private $dbPassword;
  private $dryRun;
<<<<<<< HEAD
  private $options;
  private $link;
  public $test;

    function __construct($options){
        $this->options = $options;
    }

    /*
    Method checkOptions
    Take
    Return True if all options are correct
    Return Errors if there is any
    */

   function checkOptions(){
      $opt = $this->options;
      $err = array();
      //print_r($opt);

      if(isset($opt['file']) && !preg_match('/^[\/\w\-. ]+$/',$opt['file'])){
        $err['file'] = 'The "--file" arg needs a value.';
      }elseif(!isset($opt['file'])){
        $err['file'] = 'The "--file" arg is compulsory.';
      }

      // As the DB name wasn't provided, I am assuming it is fcalmon_catalyst
      if( (isset($opt['u']) && $opt['u'] != '') && (isset($opt['p']) && $opt['p'] != '') ){
        if(!isset($opt['h']) || $opt['h'] == ''){
          //We are asuming the host would be localhost
          $this->h = 'localhost';
        }else{
          $this->h = $opt['h'];
        }
        $this->u = $opt['u'];
        $this->p = $opt['p'];

        //Creating the DB connection
        // If the user is entering the DB details, I assume they want to connect
        if(!$this->conn()){
          $err['database'] = 'Unable to connect to MySQL. Error No:'.mysqli_connect_errno();
        }

      }else{
        $err['database'] = 'Unable to connect to MySQL. All the parameters (-u, -p, -h) are compulsory';
      }

      if(isset($opt['dry_run'])){
        $file = $opt['file'];
        if(!$this->processCSV($file,true))
          return $err['csv'] = '(DRY RUN) We had Error(s) processing the CSV file'.PHP_EOL;
      }

      if(!isset($opt['dry_run']) && !isset($opt['create_table'])){
        $file = $opt['file'];
        if(!$this->processCSV($file))
          return $err['csv'] = 'We had Error(s) processing the CSV file'.PHP_EOL;
      }

      if(isset($opt['create_table'])){
        $created = $this->createTable();

        if(!$created){
          $err['table'] = $created;
        }else{
          return 'Table Dropped, Created and script halted'.PHP_EOL;
        }
      }

      if(isset($opt['help'])){
        return '
HELP
--file [csv file name] - this is the name of the CSV to be parsed
--create_table - this will cause the MySQL users table to be built (and no further action will be taken)
--dry_run - this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the database won\'t be altered
-u - MySQL username
-p - MySQL password
-h - MySQL host
--help - which will output the above list of directives with details.';
      }

      if(empty($err))
        return true;
      else
        return $err;
   }

   //This method Drops and then Creates the User Table

   function createTable(){
     $mysqli = $this->conn();

     if($mysqli===false){
       return 'Unable to connect to MySQL. Error No:'.mysqli_connect_errno();
     }

     if (
       !$mysqli->query("DROP TABLE IF EXISTS `Users`") ||
       !$mysqli->query("CREATE TABLE `Users` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NULL , `surname` VARCHAR(50) NULL , `email` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`), UNIQUE `email` (`email`(50))) ENGINE='InnoDB'")
     ) {
      return "Table deletion/creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    $mysqli->close();
     return true;
   }

   //This methd processes the CSV file
   //If $dry_run == true, there will be no writing on the database
   function processCSV($file,$dry_run=false){

    $mysqli = $this->conn();

     $row = 0;
     $handle = fopen('/home/fcalmon/public_html/catalyst/csv/'.$file,'r');
     if(!$handle){
       return 'File Does not exist';
     }
     $err=0;
     if($dry_run){
       print 'Dry Run';
       $mysqli->autocommit(false);
     }
     while ( ($data = fgetcsv($handle) ) !== FALSE ) {
       if($row>0 && count($data)>1){

         $name = ucfirst(strtolower(trim($data[0])));
         $surname = ucfirst(trim(strtolower($data[1])));
         $email = strtolower(trim($data[2]));

         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            if(!$dry_run){
              if($mysqli->query( 'INSERT INTO Users (name,surname,email) VALUES ("'.$name.'","'.$surname.'","'.$email.'")' ) !==TRUE){
                print 'Error Inserting '.$mysqli->error.PHP_EOL;
                $err++;
              }
            }

            if($dry_run){
              //$mysqli->autocommit(FALSE);
              //$mysqli->begin_transaction();
              if($mysqli->query( 'INSERT INTO Users (name,surname,email) VALUES ("'.$name.'","'.$surname.'","'.$email.'")' ) !==TRUE){
                print 'Error Inserting '.$mysqli->error.PHP_EOL;
                $err++;
              }

            }

          } else {
            echo($name."'s email: $email, is not a valid email address".PHP_EOL);
            $err++;
          }

         unset($name);
         unset($surname);
         unset($email);
       }

        $row++;
    }

        if($dry_run){
          $mysqli->rollback();
        }
        $mysqli->autocommit(true);
        $mysqli->close();

      if($err==0)
        return true;
   }

   //This method created the Database Connection
   function conn(){

     $mysqli = new mysqli($this->h, $this->u, $this->p, "fcalmon_catalyst");
    
     if($mysqli->connect_errno)
       return false;
     else {
       return $mysqli;
    }

   }
=======
  public $test;

    function __construct(){
        $this->test = 'here';
        return $this->test;
    }

>>>>>>> 4f593f60b19465ba5287758697fa409b951ef0d3

}
?>

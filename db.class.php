<?php

        class Db{
            protected static $connection;

            public function connnect(){

                if(!isset(self::$connection)){
                $config = parse_ini_file("config.ini");
                self::$connection = new mysqli("127.0.0.1",$config["username"],$config["password"],$config["ql_nhansu"]);
                }
                if(self::$connection==false){
                    return false;
                }
                return self::$connection;
            }

            public function query_execute($queryString){
                $connection = $this -> connnect();
                $result = $connection->query($queryString);
                $connection->close();
                return $result;
            }

            public function select_to_array($queryString){
                $rows = array();
                $result = $this->query_execute($queryString);
                if($result==false) return false;
                while($item=$result->fetch_assoc()){
                    $rows[]= $item;
                }
                return $rows;
            }

        }

?>
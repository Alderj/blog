<?php

    Class pessoa{

        private $pdo;
        //conexao com bando de dados
        public function __construct($dbname, $host, $user, $senha)
        {
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host".$host,$user,$senha);
            } catch (Exception $e) {
                echo "Erro com banco de dados: ".$e->getMessage();
                exit();
            }catch (Exception $e) {
                echo "Erro generico: ".$e->getMessage();
                exit();
            }           
        }


        
        public function BuscarDados()
        {
            $res = array();

            $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");

            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

    }
?>
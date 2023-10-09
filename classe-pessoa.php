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

        //FUNCAO DE CADASTRAR PESSOA NO BANCO DE DADOS
        public function cadastrarPessoa($nome, $telefone, $email)
        {
            //ANTES DE CADASTRAR VERIFICAR SE JA POSSUI O EMAIL CADASTRADO
            $cmd = $this->pdo->prepare("SELECT id from pessoa WHERE email = :e");
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            if($cmd->rowCount() > 0) // email ja existe no banco
            {
                return false;
            } else {
                $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");
                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":t", $telefone);
                $cmd->bindValue(":e", $email);
                $cmd->execute();
                return true;              
            }

        }

    }
?>
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

        public function excluirPessoa($id)
        {
            $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
        }

        //BUSCAR DADIS DE UMA PESSOA
        public function buscarDadosPessoa($id)
        {
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }


        //ATUALIZAR DADOS DO DB
        public function atualizarDados()
        {


        }

    }
?>
<?php 
/*
 * Class : DbConfig.php 
 * Autor : William peixoto silva
 * Função: Montar estrutura Básica para Create, Read, Update & Delete, utilizando PDO
 * Data  : 13/06/17
 */
class mysql{
	//VARIÁVEL $CON PUBLICA PRA SER USADA EM TODOS OS MÉTODOS
	public $con;
	//MÉTODO CONSTRUTOR INICIA A CONEXÃO COM O MYSQL
	public function __construct($con,$user,$host,$pass){
    //TENTAR E PEGAR ERRO COM TRY-CAT
		try{
		$this->con = new PDO("mysql:dbname=$con;hostname=$host",$user,$pass);
		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			//EXIBE MENSAGEM DE ERRO SE DESCONECTADO
		echo "Desconectado".$this->con = $e->getMessage();	
		}
	}
	//MÉTODO QUE SELECIONA A TABELA E FAZ *UMA* CONSULTA *iNTEIRA*
	public function selecttab($tab){
		
		$stmt = $this->con->prepare("SELECT * FROM $tab");
		$stmt->execute();
		//LAÇO EM ARRAY PRA IMPRESSÃO DE DADOS
		while ($row = $stmt->fetch()){
			echo "<br />Nome.:".$row['nome'];
			echo "<br />Telefone.:".$row['telefone'];
			echo "<br />Email.:".$row['email']."<hr></hr>";
		}
	}
	//MÉTODO PARA INSERIR DADOS NA TABELA
	public function inserttab($tab,$nome,$telefone,$email){
		
		$stmt = $this->con->prepare("INSERT INTO $tab (nome,telefone,email)VALUES('$nome','$telefone','$email')");
		$stmt->execute();
	}
	//MÉTODO PARA ATUALIZAR DADOS NA TABELA
	public function updatetab($tab,$nome,$telefone,$email,$id){
		
		$stmt = $this->con->prepare("UPDATE $tab SET nome='$nome',telefone='$telefone',email='$email' WHERE id='$id'");
		$stmt->execute();
	}
	//MÉTODO PARA DELETAR DADOS NA TABELA
	public function Deletetab($tab,$id){
		
		$stmt = $this->con->prepare("DELETE FROM $tab  WHERE id='$id'");
		$stmt->execute();
	}}
?>
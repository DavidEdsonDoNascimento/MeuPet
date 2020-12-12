<?php
    require_once('Entidade.php');
    class Pessoa extends Entidade
    {
        private $razaoSocial;
        private $nomeFantasia;
        private $documento;
        private $categoria;
        private $endereco;
        private $telefonepreferencial;
        private $telefoneopcional1;
        private $telefoneopcional2;
        private $telefoneopcional3;
        private $observacao;
        private $email;
        private $senha;        
		
		public function __construct()
		{
		}
		public function __construct($razaosocial, $nomefantasia, $documento, $categoria, $endereco, $telefonepreferencial, $telefoneop1, $telefoneop2, $telefoneop3, $obs, $email, $senha)
		{
			$this->razaoSocial = $razaosocial;
			$this->nomeFantasia = $nomefantasia;
			$this->documento = $documento;
			$this->categoria = $categoria;
			$this->endereco = $endereco;
			$this->telefonepreferencial = $telefonepreferencial;
			$this->telefoneopcional1 = $telefoneop1;
			$this->telefoneopcional2 = $telefoneop2;
			$this->telefoneopcional3 = $telefoneop3;
			$this->observacao = $obs;
			$this->email = $email;
			$this->senha = $senha;			
		}

    }

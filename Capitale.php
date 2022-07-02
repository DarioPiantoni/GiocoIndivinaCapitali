<?php
	class Capitale{
		private $id;
		private $nome;
		private $nomeNazione;
		
		public function __construct($id,$nome,$nomeNazione)
		{
			$this->id=$id;
			$this->nome=$nome;
			$this->nomeNazione=$nomeNazione;
		}
		
		public function getId()
		{
			return $this->id;
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function getNomeNazione()
		{
			return $this->nomeNazione;
		}
	}
?>
<?php

    class database {
        private $host       = 'localhost';
        private $user       = 'root';
        private $pwd        = '';
        private $client     = 'etufarm';

        protected function connect() {
            $connection = "mysql:host=" . $this->host . ';dbname=' . $this->client;
            $pdo        = new PDO($connection, $this->user, $this->pwd);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $pdo;
        }

        protected function searchDatabase() {
            try {
                $db = new pdo('mysql:host='. $this->host .'; dbname='. $this->client .'; charset=utf8', $this->user, $this->pwd);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }

    }

    
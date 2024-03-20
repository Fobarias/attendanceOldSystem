<?php 

    class employee extends database {
        protected function getEmpInfo() {
            $sql = "SELECT * FROM employee";

            $result = $this->connect()->prepare($sql);
            $result->execute([]);

            return $result;
        }

        protected function setVacation($value, $id) {
            $sql    = "UPDATE employee SET vacation = ? WHERE id = ?";

            $run    = $this->connect()->prepare($sql);
            $run->execute([$value, $id]);
        }

        protected function getEmpNameFromID($id) {
            $sql = "SELECT name FROM employee WHERE id = ?";

            $run = $this->connect()->prepare($sql);
            $run->execute([$id]);
            $result = $run->fetch();

            return $result;
        }

        protected function getEmpSignaFromID($id) {
            $sql = "SELECT signature FROM employee WHERE id = ?";

            $run = $this->connect()->prepare($sql);
            $run->execute([$id]);
            $result = $run->fetch();

            return $result;
        }

        protected function getFirst() {
            $sql = "SELECT * FROM attendance";

            $result = $this->connect()->prepare($sql);
            $result->execute([]);

            return $result;
        }

        protected function getAllEntrance() {
            $sql = "SELECT * FROM attendance";

            $result = $this->connect()->prepare($sql);
            $result->execute([]);

            return $result;
        }

        protected function getAllEntrances() {
            $sql = "SELECT * FROM attendance";

            $result = $this->connect()->prepare($sql);
            $result->execute([]);

            return $result;
        }

        protected function getEntrance() {
            $sql = "SELECT COUNT(*) FROM attendance";

            $run = $this->connect()->prepare($sql);
            $run->execute([]);
            $result = $run->fetch();

            return $result;
        }

        protected function deleteSelectedRow($id) {
            $sql    = "DELETE FROM attendance WHERE id = ?";

            $run    = $this->connect()->prepare($sql);
            $run->execute([$id]);
        }

        protected function getEntraceForMonth($date) {
            $sql = "SELECT * FROM attendance WHERE date LIKE ?";

            $result = $this->connect()->prepare($sql);
            $result->execute([$date]);

            return $result;
        }

        protected function getEntranceBasedOnId($id) {
            $sql = "SELECT * FROM attendance WHERE id = ?";

            $result = $this->connect()->prepare($sql);
            $result->execute([$id]);

            return $result;
        }

        protected function saveHours($arv, $lev, $id) {
            $sql    = "UPDATE attendance SET arrivalTime = ?, leavingTime = ? WHERE id = ?";

            $run    = $this->connect()->prepare($sql);
            $run->execute([$arv, $lev, $id]);
        }

        protected function insertData($id, $date, $arv, $lev) {
            $sql = "INSERT INTO attendance (uid, date, arrivalTime, leavingTime) VALUES (?, ?, ?, ?);";
           
            $run    = $this->connect()->prepare($sql);
            $run->execute([$id, $date, $arv, $lev]);
        }
    }
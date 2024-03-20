<?php 

    class employeeController extends employee {
        public function updateVacation($value, $id) {
            $this->setVacation($value, $id);
        }

        public function deleteRow($id) {
            $this->deleteSelectedRow( $id);
        }

        public function getEntranceMonth($date) {
            $result = $this->getEntraceForMonth($date);
            return $result;
        }

        public function getEmpName($id) {
            $result = $this->getEmpNameFromID($id);
            return $result;
        }

        public function getSignature($id) {
            $result = $this->getEmpSignaFromID($id);
            return $result;
        }

        public function updateHours($arv, $lev, $id) {
            $this->saveHours($arv, $lev, $id);
        }

        public function saveDataEmp($id, $date, $arv, $lev) {
            $this->insertData($id, $date, $arv, $lev);
        }

        public function getDetails() {
            $info = $this->getEmpInfo();
            return $info;
        }
    }
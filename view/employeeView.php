<?php

    class employeeView extends employee {
        public function employeeVacation() {
            $result = $this->getEmpInfo();
            $k = 1; 
            while($row = $result->fetch()) {
                $checked = ($row['vacation'] == 1 ? 'checked' : ''); 
                echo '
                    <tr>
                        <th scope="row">'. $k .'</th>
                        <td>'. $row['name'] .'</td>
                        <td>
                            <div class="form-check">
                                <input id="emp'. $row['id'] .'" onclick="updateInfo(this.id)" class="form-check-input addVac" '. $checked .' type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    In concediu?
                                </label>
                            </div>
                        </td>
                    </tr>
                ';
                $k++;
            }
        }

        public function employeeOnVacation() {
            $result = $this->getEmpInfo();
            $k = 0; 
            while($row = $result->fetch()) {
                if($row['vacation'] == 1) {
                    $k++;
                }
            }
            echo $k; 
        }

        public function getFirstEntrance() {
            $result = $this->getFirst();
            $k = 1;
            while($row = $result->fetch()) {
                $empName = $this->getEmpNameFromID($row['uid']);
                if($row['arrivalTime'] != 'CO') {
                    $signatureArray = $this->getEmpSignaFromID($row['uid']);
                    $signature = "<img src='assets/img/". $signatureArray['signature'] . "' style='width: 25% !important'>";
                    if($row['leavingTime'] == '') {
                        $signatureLeave = '';
                    } else {
                        $signatureLeave = "<img src='assets/img/". $signatureArray['signature'] . "' style='width: 25% !important'>";
                    }
                } else {
                    $signature = '';
                    $signatureLeave = '';
                }
                if($row['date'] == date("Y-m-d")) {
                    echo '
                        <tr>
                            <td id="hideMobile">'. $k .'</td>
                            <td>'. $empName['name'] .'</td>
                            <td>'. $row['date'] .'</td>
                            <td>'. $row['arrivalTime'] .'</td>
                            <td id="hideTable">'. $signature .'</td>
                            <td>'. $row['leavingTime'] .'</td>
                            <td id="hideTable">'. $signatureLeave .'</td>
                            <td>
                                <button id="edit_'. $row['id'] .'" onclick="edit(this.id)" data-bs-toggle="modal" data-bs-target="#verticalycentered" type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button id="delete_'. $row['id'] .'" onclick="deleteRow(this.id)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    ';
                }
                $k++;
            }
        }

        public function entrance($date) {
            $result = $this->getAllEntrance();
            $k = 1;
            while($row = $result->fetch()) {
                $empName = $this->getEmpNameFromID($row['uid']);
                if($row['arrivalTime'] != 'CO') {
                    $signatureArray = $this->getEmpSignaFromID($row['uid']);
                    $signature = "<img src='assets/img/". $signatureArray['signature'] . "' style='width: 25% !important'>";
                    if($row['leavingTime'] == '') {
                        $signatureLeave = '';
                    } else {
                        $signatureLeave = "<img src='assets/img/". $signatureArray['signature'] . "' style='width: 25% !important'>";
                    }
                } else {
                    $signature = '';
                    $signatureLeave = '';
                }
                if($date == $row['date']) {
                    echo '
                        <tr>
                            <td id="hideMobile">'. $k .'</td>
                            <td>'. $empName['name'] .'</td>
                            <td>'. $row['date'] .'</td>
                            <td>'. $row['arrivalTime'] .'</td>
                            <td id="hideTable">'. $signature .'</td>
                            <td>'. $row['leavingTime'] .'</td>
                            <td id="hideTable">'. $signatureLeave .'</td>
                            <td>
                                <button id="edit_'. $row['id'] .'" onclick="edit(this.id)" data-bs-toggle="modal" data-bs-target="#verticalycentered" type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button id="delete_'. $row['id'] .'" onclick="deleteRow(this.id)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    ';
                }
                $k++;
            }
        }

        public function totalMonth() {
            $result = $this->getAllEntrances();
            $month = date('m');

            $x = 0;

            while($row = $result->fetch()) {
                $dateSplit = explode('-', $row['date']);
                if($dateSplit[1] == $month) {
                    $x++;
                }
            }

            echo $x;
        }

        public function displayHours($id) {
            $result = $this->getEntranceBasedOnId($id);
            while($row = $result->fetch()) {
                if($row['arrivalTime'] == 'CO') {
                    $arrivingTime  = '';
                    $leavingTime   = '';
                    $vacationCheck = 'checked';
                } else {
                    $arrivingTime  = $row['arrivalTime'];
                    $leavingTime   = $row['leavingTime'];
                    $vacationCheck = '';
                }
                echo '
                <div class="modal-header">
                    <h5 class="modal-title">Editare ore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editBody">
                    <div id="error">
                    
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ora sosire</label>
                        <div class="col-sm-6 mt-2">
                            <input type="time" min="08:00" value="'. $arrivingTime .'" max="18:00" name="arrTime" id="arrTime">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ora plecare</label>
                        <div class="col-sm-6 mt-2">
                            <input type="time" min="08:00" max="18:00" value="'. $leavingTime .'" name="levTime" id="levTime">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">In concediu?</label>
                        <div class="col-sm-6 mt-2">
                            <input '. $vacationCheck .' class="form-check-input addVac" type="checkbox" id="vacation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Inchide</button>
                    <button id="save_'. $row['id'] .'" type="button" onclick="saveHours(this.id)" class="btn btn-primary">Salveaza</button>
                </div>';
            }
        }

        public function displayEmp() {
            $result = $this->getEmpInfo();
            while($row = $result->fetch()) {
                echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>"';
            }
        }
    }
<?php
    include('../modal/autoload_extra.php');
    $empCont = new employeeController();
    $empView = new employeeView();

    $requestID = $_POST['requestID'];

    if($requestID == 1) {
        $value = $_POST['value'];
        $empID = $_POST['empid'];

        echo '<script>console.log('. $value .')</script>';

        $empCont->updateVacation($value, $empID);
    } elseif($requestID == 2) {
        if(isset($_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $date = date("Y-m-d");
        }

        $empView->entrance($date);

    } elseif($requestID == 3) {
        $idResult = $_POST['deleteRow'];
        $idArray = explode('_', $idResult);

        $empCont->deleteRow($idArray[1]);
    } elseif($requestID == 4) {
        $idResult = $_POST['edit'];
        $idArray = explode('_', $idResult);

        $empView->displayHours($idArray[1]);
    } elseif($requestID == 5) {
        $save = $_POST['save'];
        $idArray = explode('_', $save);
        $arrv = $_POST['arrv'];
        $leav = $_POST['leav'];
        $vac = $_POST['vac'];

        echo $vac . ' - ' . $arrv . ' - ' . $leav;

        if($vac == 1) {
            $arrivalTime = 'CO';
            $leavingTime = 'CO';
        } else {
            $arrivalTime = $arrv;
            $leavingTime = $leav;
        }

        echo $arrivalTime . ' - ' . $leavingTime . ' - ';

        $empCont->updateHours($arrivalTime, $leavingTime, $idArray[1]);
    } elseif($requestID == 6) {
        $id = $_POST['id'];
        $arrv = $_POST['arrTime'];
        $leav = $_POST['levTime'];
        $vac = $_POST['vac'];
        $date = $_POST['date'];

        if($vac == 1) {
            $arrivalTime = 'CO';
            $leavingTime = 'CO';
        } else {
            $arrivalTime = $arrv;
            $leavingTime = $leav;
        }

        $empCont->saveDataEmp($id, $date, $arrivalTime, $leavingTime);
    } 
    
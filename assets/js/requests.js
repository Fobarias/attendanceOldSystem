function selectOnDate(dateSelected) {
  $.ajax({
    url: 'systems/ajaxRequest.php',
    type: 'post',
    data: {
      requestID: 2,
      date: dateSelected,
    },
    success: function(result) {
        $("#showTable").html(result);
    }
  })
}


$(document).ready(function() {
  $('#datePicker').on('change', function() {
    var dateSelected = $("#datePicker").val();
    selectOnDate(dateSelected);
  });
})

function updateInfo(id) {
  const empid_def = id;
  const empid_array = id.split("emp");
  empid = empid_array[1];

  if($('#' + empid_def).is(":checked")) {
    value = 1;
  } else {
    value = 0;
  }

  $.ajax({
    url: 'systems/ajaxRequest.php',
    type: 'post',
    data: {
      requestID: 1,
      empid: empid,
      value: value
    },
    success: function(result){
      $('#ttest').html(result);
    }
  });
}

function deleteRow(id) {
  const deleteRow = id;
  $.ajax({
    url: 'systems/ajaxRequest.php',
    type: 'post',
    data: {
      requestID: 3,
      deleteRow: deleteRow
    },
    success: function(result){
      var dateSelected = $("#datePicker").val();
      selectOnDate(dateSelected);
    }
  });
}

function edit(id) {
  const edit = id;
  $.ajax({
    url: 'systems/ajaxRequest.php',
    type: 'post',
    data: {
      requestID: 4,
      edit: edit
    },
    success: function(result){
      $('#editBody').html(result)
    }
  });
}

function saveHours(id) {
  const save = id;
  const arrv = $('#arrTime').val();
  const leav = $('#levTime').val();
  if($('#vacation').is(":checked")) {
    vac = 1;
  } else {
    vac = 0;
  }

  if(vac == 0 && arrv == '') {
    $('#error').html(`
    <div class="alert mt-3 border-danger alert-dismissible fade show" role="alert">
      <p>Daca angajatul nu este in concediu, trebuie sa selectati ora de sosire si plecare</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`)
  } else {
    $.ajax({
      url: 'systems/ajaxRequest.php',
      type: 'post',
      data: {
        requestID: 5,
        save: save,
        arrv: arrv,
        leav: leav,
        vac:  vac
      },
      success: function(result){
        var dateSelected = $("#datePicker").val();
        selectOnDate(dateSelected);
      }
    });
  }

}

function saveData() {
  let id, arrTime, levTime, vac, date
  id = $('#employeeSelect').val()
  arrTime = $('#arrTimeEmp').val()
  levTime = $('#levTimeEmp').val()
  if($('#vacEmp').is(":checked")) {
    vac = 1
  } else {
    vac = 0
  }
  date = $("#datePickerEmp").val()

  if(id != '') {
    if(date != '') {
      if(vac == 0 && arrTime == '') {
        $('#errorEmp').html(`
          <div class="alert mt-3 border-danger alert-dismissible fade show" role="alert">
            <p>Daca angajatul nu este in concediu, trebuie sa selectati ora de sosire si plecare</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`)
      } else {
        $.ajax({
          url: 'systems/ajaxRequest.php',
          type: 'post',
          data: {
            requestID: 6,
            id: id,
            arrTime: arrTime,
            levTime: levTime,
            vac:  vac,
            date: date
          },
          success: function(result){
            $('#errorEmp').html(`
            <div class="alert mt-3 border-success alert-dismissible fade show" role="alert">
              <p>Date introduse cu succes</p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`)
            $('#employeeSelect').val(0);
            $('#arrTimeEmp').val('');
            $('#levTimeEmp').val('');
            $('#vacEmp').prop('checked', false);
            $("#datePickerEmp").val('');

            var dateSelected = $("#datePicker").val();
            selectOnDate(dateSelected);
          }
        });
      }
    } else {
      $('#errorEmp').html(`
      <div class="alert mt-3 border-danger alert-dismissible fade show" role="alert">
        <p>Trebuie sa selectati o data</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`)
    }
  } else {
    $('#errorEmp').html(`
      <div class="alert mt-3 border-danger alert-dismissible fade show" role="alert">
        <p>Trebuie sa selectati un angajat</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`)
  }
}
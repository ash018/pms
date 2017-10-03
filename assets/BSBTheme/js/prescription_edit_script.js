function vitalNameAutoComplete(availableTagsE) {
    $("#vitalName").autocomplete({
        source: availableTagsE,
        max: 20,
        minLength: 2
    });
}

function InvestigationNameAutoComplete(availableTags) {
    $("#InvestigationName").autocomplete({
        source: availableTags,
        max: 20,
        minLength: 2
    });
}
//function DrugTypeNameAutoComplete(availableTagsDTN) {
//    $("#DrugTypeName").autocomplete({
//        source: availableTagsDTN,
//        max: 20, minLength: 2,
//        appendTo: "#myModal"
//    });
//}

function drugTypeNameAutoComplete(availableTagsDTN) {
      
        var allType = [];
        var allId = [];
        for(var i = 0; i<availableTagsDTN.length; i++){
            allType[i] = availableTagsDTN[i].type; 
            allId[i] = availableTagsDTN[i].id;
        }
        
    $("#DrugTypeName").autocomplete({
        source: allType,
        minLength: 0,
        select : function(event,ui){
            $(this).attr("data-node",'');
            var index = $.inArray(ui.item.value, allType);
            var dbId = allId[index];
            $(this).attr("data-node",dbId);
        },
        appendTo: "#myModal"
    }).focus(function(event,ui) {
            //$(this).val(ui.item.type);
            $(this).autocomplete("search", "");
    });
}

//function DrugNameAutoComplete(dataSource) {
//    $("#DrugName").autocomplete({
//        source: dataSource,
//        max: 20, minLength: 2,
//        appendTo: "#myModal"
//    });
//
//}

function drugNameAutoComplete() {
    var allDrug = [];
    var allId = [];
    $("#DrugName").autocomplete({
        source:  function (request, response) {
            var drugTypeId = $("#DrugTypeName").attr("data-node");
            $.ajax({
                url: "get_drug_by_drugType_id.php?",
                type: "get",
                data: "drugTypeId="+drugTypeId+"&drugName="+$("#DrugName").val(),
                cache: false,
                dataType: "json",
                success: function (data) {
                    if(data.length > 0){
                        for(var i = 0; i<data.length; i++){
                            allDrug[i] = data[i].drugName; 
                            allId[i] = data[i].id;
                        }
                    }
                    //console.log('All Response'+allDrug);
                    response(allDrug);
                }
            });
    },
        minLength: 0,
        select : function(event,ui){
            $(this).attr("data-node",'');
            var index = $.inArray(ui.item.value, allDrug);
            var dbId = allId[index];
            $(this).attr("data-node",dbId);
        },
        appendTo: "#myModal"
    }).focus(function(event,ui) {
            //$(this).val(ui.item.type);
            $(this).autocomplete("search", "");
    });

}
function custom_alert(message, title) {
    if (!title)
        title = 'Alert';

    if (!message)
        message = 'No Message to Display.';

    $('<div></div>').html(message).dialog({
        title: title,
        resizable: false,
        modal: true,
        position: {
            my: "center",
            at: "center",
            of: $('#editprescriptionform')
        },
        buttons: {
            'Ok': function () {
                $(this).dialog('close');
            }
        }
    }).prev(".ui-dialog-titlebar").css({'background': '#f44336'});
}

function generatePreviousPrescription(examination, investigation, medicationRule) {

    if (examination !== '') {
        for (var i = 0; i < examination.length; i++) {
            var exUpdateDiv = "<div id='examinDiv_" + examination[i].id + "' class='row clearfix'>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input class='form-control' name='vitalName[]'  value='" + examination[i].name + "' type='text'>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input class='form-control' name='NotesE[]' value='" + examination[i].description + "' type='text'>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input type='button' id='btnDeleteExamin_" + examination[i].id + "'  class='btn btn-danger form-control deleteExamination' value='Remove'/>" +
                    " </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            $("#addexamination").append(exUpdateDiv);
        }
    }


    if (investigation !== '') {
        for (var i = 0; i < investigation.length; i++) {
            var invstUpdateDiv = "<div id='investiDiv_" + investigation[i].id + "' class='row clearfix'>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input class='form-control' name='investigationName[]' value='" + investigation[i].name + "' type='text'>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input class='form-control' name='investigationNote[]' value='" + investigation[i].description + "' type='text'>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-4 col-sm-4'>" +
                    "<div class='form-group'>" +
                    "<div class='form-line'>" +
                    "<input type='button' id='btnDeleteInvestigation_" + investigation[i].id + "'  class='btn btn-danger form-control deleteInvestigation' value='Remove'/>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";

            $("#addinvestigation").append(invstUpdateDiv);
        }
    }

    var valuesDrugAdvice = [];
    var textDrugAdvice = [];
    var valuesDuration = [];
    var textDuration = [];

    $('#DrugAdvice option').each(function () {
        valuesDrugAdvice.push(this.value);
        textDrugAdvice.push(this.text);
    });

    $('#DurationType option').each(function () {
        valuesDuration.push(this.value);
        textDuration.push(this.text);
    });

    //console.log(valuesDrugAdvice.toString());
    var dAdviceOptionValue = [];
    var dDurationType = [];
    for (var i = 0; i < valuesDrugAdvice.length; i++) {
        dAdviceOptionValue.push({value: valuesDrugAdvice[i], tx: textDrugAdvice[i]});
    }

    for (var i = 0; i < valuesDuration.length; i++) {
        dDurationType.push({value: valuesDuration[i], tx: textDuration[i]});
    }



    if (medicationRule !== '') {
        for (var i = 0; i < medicationRule.length; i++) {
            var dAdviceDNode = '', dDurationTypeDNode = '';
            for (var k = 0; k < dAdviceOptionValue.length; k++) {
                if (dAdviceOptionValue[k].tx === medicationRule[i].drugAdvice) {
                    dAdviceDNode = dAdviceOptionValue[k].value;
                }
            }
            for (var j = 0; j < dDurationType.length; j++) {
                if (dDurationType[j].tx === medicationRule[i].durationType) {
                    dDurationTypeDNode = dDurationType[j].value;
                }
            }

            var mediRuForEdit = "<tr id='tableRow_" + medicationRule[i].id + "'>" +
                    "<td><input id='DrugTypeName_" + medicationRule[i].id + "' class='form-control' readonly='readonly' type='text' name='DrugTypeName[]' value='" + medicationRule[i].drugTypeName + "'/></td>" +
                    "<td><input id='DrugName_" + medicationRule[i].id + "' class='form-control' readonly='readonly' type='text' name='DrugName[]' value='" + medicationRule[i].drugName + "'/></td>" +
                    "<td><input id='IntervalWiseDose_" + medicationRule[i].id + "' class='form-control' readonly='readonly' type='text' name='IntervalWiseDose[]' value='" + medicationRule[i].intervalWiseDose + "'/></td>" +
                    "<td><input id='DurationDurationType_" + medicationRule[i].id + "' class='form-control' readonly='readonly' type='text' name='DurationDurationType[]' value='" + medicationRule[i].duration + "-" + medicationRule[i].durationType + "' data-node='" + dDurationTypeDNode + "'/>" +
                    "<input id='DrugAdvice_" + medicationRule[i].id + "' name='DrugAdvice[]' type='hidden' value='" + medicationRule[i].drugAdvice + "' readonly='readonly' class='form-control' data-node='" + dAdviceDNode + "'>" +
                    "<input id='TimesaDay_" + medicationRule[i].id + "' name='TimesaDay[]' type='hidden' value='" + medicationRule[i].timesaDay + "'>" +
                    "<input id='DoseInitial_" + medicationRule[i].id + "' name='DoseInitial[]' type='hidden' value='" + medicationRule[i].doseInitial + "'>" +
                    "<input id='When_" + medicationRule[i].id + "' name='When[]' type='hidden' value='" + medicationRule[i].when + "'>" +
                    "</td>" +
                    "<td><a class='btn btn-info btn-sm btnLanier editMedicationRule' id='editRowFromTable_" + medicationRule[i].id + "'><i class='material-icons'>mode_edit</i></a></td>" +
                    "<td><a class='btn btn-danger btn-sm deleterow' id='deleteRowFromTable_" + medicationRule[i].id + "'><i class='material-icons'>delete</i></a></td>" +
                    "</tr>";


            $("#mainTable tbody").append(mediRuForEdit);
        }
    }
}

function newEandI(examination, investigation) {
    var examinName = '', examinNote = '', investigationName = '', investigationNote = '';
    var x;
    var y;
    if (examination !== '') {
        x = parseInt(examination[examination.length - 1].id) + 1;
    } else {
        x = 1;
    }
    if (investigation !== '') {
        y = parseInt(investigation[investigation.length - 1].id) + 1;
    } else {
        y = 1;
    }

    $("#create-newE").click(function (e) {
        examinName = $("#vitalName").val();
        examinNote = $("#NotesE").val();

        var examineDiv = "<div id='examinDiv_" + x + "' class='row clearfix'>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input class='form-control' name='vitalName[]'  value='" + examinName + "' type='text'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input class='form-control' name='NotesE[]' value='" + examinNote + "' type='text'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input type='button' id='btnDeleteExamin_" + x + "'  class='btn btn-danger form-control deleteExamination' value='Remove'/>" +
                " </div>" +
                "</div>" +
                "</div>" +
                "</div>";
        if (examinName !== '') {
            $("#addexamination").append(examineDiv);
            $("#vitalName").val('');
            $("#NotesE").val('');
            x++;
        } else {
            custom_alert("Examination name can not be empty.", "Error");
        }
    });

    $("#create-newI").click(function (e) {
        investigationName = $("#investigationName").val();
        investigationNote = $("#investigationNote").val();

        var investigationDiv = "<div id='investiDiv_" + y + "' class='row clearfix'>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input class='form-control' name='investigationName[]' value='" + investigationName + "' type='text'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input class='form-control' name='investigationNote[]' value='" + investigationNote + "' type='text'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-4 col-sm-4'>" +
                "<div class='form-group'>" +
                "<div class='form-line'>" +
                "<input type='button' id='btnDeleteInvestigation_" + y + "'  class='btn btn-danger form-control deleteInvestigation' value='Remove'/>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>";

        if (investigationName !== '') {
            $("#addinvestigation").append(investigationDiv);
            $("#investigationName").val('');
            $("#investigationNote").val('');
            y++;
        } else {
            custom_alert("Investigation name can not be empty.", "Error");
        }

    });
}

function addMedicationRuleWithNewIndex(indexMedicationRule) {
    var addRowToDiv = 0;
    if (indexMedicationRule !== '') {
        addRowToDiv = parseInt(indexMedicationRule[Object.keys(indexMedicationRule).length - 1].id) + 1;
    } else {
        addRowToDiv = 1;
    }

    $("#myModal").on("click", "#addmedicationrule", function (e) {

        var drugTypeName = '', drugName = '', doseInitial = '', timesaDay = '',
                when = '', intervalWiseDose = '', duration = '', durationType = '',
                drugAdvice = '';

        drugTypeName = $("#DrugTypeName");
        drugName = $("#DrugName");
        doseInitial = $("#DoseInitial");
        timesaDay = $("#TimesaDay");

        when = $("#When");
        intervalWiseDose = $("#IntervalWiseDose");
        duration = $("#Duration");
        durationType = $("#DurationType");
        drugAdvice = $("#DrugAdvice");

        var mediRule = "<tr id='tableRow_" + addRowToDiv + "'>" +
                "<td><input id='DrugTypeName_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DrugTypeName[]' value='" + drugTypeName.val() + "'/></td>" +
                "<td><input id='DrugName_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DrugName[]' value='" + drugName.val() + "'/></td>" +
                "<td><input id='IntervalWiseDose_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='IntervalWiseDose[]' value='" + intervalWiseDose.val() + "'/></td>" +
                "<td><input id='DurationDurationType_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DurationDurationType[]' value='" + duration.val() + "-" + durationType.find(":selected").text() + "' data-node='" + durationType.find(":selected").val() + "'/>" +
                "<input id='DrugAdvice_" + addRowToDiv + "' name='DrugAdvice[]' type='hidden' value='" + drugAdvice.find(":selected").text() + "' readonly='readonly' class='form-control' data-node='" + drugAdvice.find(":selected").val() + "'>" +
                "<input id='TimesaDay_" + addRowToDiv + "' name='TimesaDay[]' type='hidden' value='" + timesaDay.val() + "'>" +
                "<input id='DoseInitial_" + addRowToDiv + "' name='DoseInitial[]' type='hidden' value='" + doseInitial.val() + "'>" +
                "<input id='When_" + addRowToDiv + "' name='When[]' type='hidden' value='" + when.val() + "'>" +
                "</td>" +
                "<td><a class='btn btn-info btn-sm btnLanier editMedicationRule' id='editRowFromTable_" + addRowToDiv + "'><i class='material-icons'>mode_edit</i></a></td>" +
                "<td><a class='btn btn-danger btn-sm deleterow' id='deleteRowFromTable_" + addRowToDiv + "'><i class='material-icons'>delete</i></a></td>" +
                "</tr>";

        drugTypeName.val('');
        drugName.val('');
        doseInitial.val('');
        intervalWiseDose.val('');

        $("#TimesaDay option[value=0]").prop('selected', true);
        $("#When option[value=0]").prop('selected', true);
        $("#Duration option[value=0]").prop('selected', true);
        $("#DurationType option[value=0]").prop('selected', true);
        $("#DrugAdvice option[value=0]").prop('selected', true);

        addRowToDiv++;

        $("#mainTable tbody").append(mediRule);
        $("#myModal").modal("toggle");
    });
    $("#myModal").on("click", "#saveAndAddMedicationrule", function (e) {
        var drugTypeName = '', drugName = '', doseInitial = '', timesaDay = '',
                when = '', intervalWiseDose = '', duration = '', durationType = '',
                drugAdvice = '';

        drugTypeName = $("#DrugTypeName");
        drugName = $("#DrugName");
        doseInitial = $("#DoseInitial");
        timesaDay = $("#TimesaDay");

        when = $("#When");
        intervalWiseDose = $("#IntervalWiseDose");
        duration = $("#Duration");
        durationType = $("#DurationType");
        drugAdvice = $("#DrugAdvice");

        var mediRule = "<tr id='tableRow_" + addRowToDiv + "'>" +
                "<td><input id='DrugTypeName_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DrugTypeName[]' value='" + drugTypeName.val() + "'/></td>" +
                "<td><input id='DrugName_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DrugName[]' value='" + drugName.val() + "'/></td>" +
                "<td><input id='IntervalWiseDose_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='IntervalWiseDose[]' value='" + intervalWiseDose.val() + "'/></td>" +
                "<td><input id='DurationDurationType_" + addRowToDiv + "' class='form-control' readonly='readonly' type='text' name='DurationDurationType[]' value='" + duration.val() + "-" + durationType.find(":selected").text() + "' data-node='" + durationType.find(":selected").val() + "'/>" +
                "<input id='DrugAdvice_" + addRowToDiv + "' name='DrugAdvice[]' type='hidden' value='" + drugAdvice.find(":selected").text() + "' readonly='readonly' class='form-control' data-node='" + drugAdvice.find(":selected").val() + "'>" +
                "<input id='TimesaDay_" + addRowToDiv + "' name='TimesaDay[]' type='hidden' value='" + timesaDay.val() + "'>" +
                "<input id='DoseInitial_" + addRowToDiv + "' name='DoseInitial[]' type='hidden' value='" + doseInitial.val() + "'>" +
                "<input id='When_" + addRowToDiv + "' name='When[]' type='hidden' value='" + when.val() + "'>" +
                "</td>" +
                "<td><a class='btn btn-info btn-sm btnLanier editMedicationRule' id='editRowFromTable_" + addRowToDiv + "'><i class='material-icons'>mode_edit</i></a></td>" +
                "<td><a class='btn btn-danger btn-sm deleterow' id='deleteRowFromTable_" + addRowToDiv + "'><i class='material-icons'>delete</i></a></td>" +
                "</tr>";



        addRowToDiv++;
        if (drugTypeName.val() !== '' && drugName.val() !== '') {
            $("#mainTable tbody").append(mediRule);
            drugTypeName.val('');
            drugName.val('');
            doseInitial.val('');
            intervalWiseDose.val('');

            $("#TimesaDay").val(0).change();
            //$("#DrugTypeName option[value=0]").prop('selected', true);
            $("#When").val(0).change();
            $("#Duration").val(0).change();
            $("#DurationType").val(0).change();
            $("#DrugAdvice").val(0).change();
            //$("#myModal").modal("toggle");
        } else {
            custom_alert("Please Make a proper Medication Rule.", "Error");
        }

    });

    $("#mainTable tbody").on("click", ".deleterow", function (e) {
        //e.preventDefault();
        var deleteRowId = $(this).attr('id').split('_')[1];
        var trId = "#tableRow_" + deleteRowId
        $(trId).remove();
        addRowToDiv--;
    });



}

$(document).ready(function () {

    $("#addexamination").on("click", ".deleteExamination", function (e) {
        //$(".deleteExamination").parent('div').parent('div').id()
        var removeBtnId = this.id;
        var parentExaminiId = '#examinDiv_' + removeBtnId.split('_')[1];
        $(parentExaminiId).remove();

    });

    $("#addinvestigation").on("click", ".deleteInvestigation", function (e) {
        var removeInvesBtnId = this.id;
        var parentInvestigationiniId = '#investiDiv_' + removeInvesBtnId.split('_')[1];
        $(parentInvestigationiniId).remove();

    });


    $("#mainTable tbody").on("click", ".editMedicationRule", function (e) {
        var editedRowId = $(this).attr('id').split('_')[1];

        $("#saveAndAddMedicationrule").remove();
        $("#addmedicationrule").remove();
        $("#modalclosebtn").remove();
        $("#addmedicationruleEdit").remove();

        var addmedicationrule = "<button id='addmedicationruleEdit' type='button' class='btn  btn-info' data-row-id='" + editedRowId + "' ><span class='glyphicons glyphicon glyphicon-floppy-save' aria-hidden='true'></span>Update</button>";
        var closeBtn = "<button id='modalclosebtn' type='button' class='btn btn-danger' data-dismiss='modal'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Close</button>";


        var DrugTypeNameEdit = "#DrugTypeName_" + editedRowId;
        var DrugNameEdit = "#DrugName_" + editedRowId;

        var IntervalWiseDoseEdit = "#IntervalWiseDose_" + editedRowId;
        var TimesaDayEdit = "#TimesaDay_" + editedRowId;
        var DoseInitialEdit = "#DoseInitial_" + editedRowId;

        var WhenEdit = "#When_" + editedRowId;
        var DurationDurationTypeEdit = "#DurationDurationType_" + editedRowId;
        var DrugAdviceEdit = "#DrugAdvice_" + editedRowId;


        $("#myModal").modal();
        $("#modalbottombuttoncontrol").append(addmedicationrule);
        $("#modalbottombuttoncontrol").append(closeBtn);

        $("#DrugTypeName").val($(DrugTypeNameEdit).val());
        $("#DrugName").val($(DrugNameEdit).val());

        $("#DoseInitial").val($(DoseInitialEdit).val());
        $("#IntervalWiseDose").val($(IntervalWiseDoseEdit).val());

        var valTimesaDay = $(TimesaDayEdit).val();
        var valWhen = $(WhenEdit).val();
        var valDuration = $(DurationDurationTypeEdit).val().split('-')[0];
        var valDurationType = $(DurationDurationTypeEdit).attr('data-node');//$(DurationDurationTypeEdit).val().split('-')[1];
        var valDrugAdvice = $(DrugAdviceEdit).attr('data-node');//$(DrugAdviceEdit).val();

        $('#TimesaDay').val(valTimesaDay).change();
        $('#When').val(valWhen).change();
        $('#Duration').val(valDuration).change();
        $('#DurationType').val(valDurationType).change();
        $('#DrugAdvice').val(valDrugAdvice).change();

    });

    $("#myModal").on("click", "#addmedicationruleEdit", function (e) {
        var drugTypeName = '', drugName = '', doseInitial = '', timesaDay = '',
                when = '', intervalWiseDose = '', duration = '', durationType = '',
                drugAdvice = '';

        drugTypeName = $("#DrugTypeName");
        drugName = $("#DrugName");
        doseInitial = $("#DoseInitial");
        timesaDay = $("#TimesaDay");

        when = $("#When");
        intervalWiseDose = $("#IntervalWiseDose");
        duration = $("#Duration");
        durationType = $("#DurationType");
        drugAdvice = $("#DrugAdvice");

        var rowId = $(this).attr('data-row-id');
        //console.log("Edit the current Row " + rowId);

        $("#DrugTypeName_" + rowId).val(drugTypeName.val());
        $("#DrugName_" + rowId).val(drugName.val());
        $("#DoseInitial_" + rowId).val(doseInitial.val());

        $("#TimesaDay_" + rowId).val(timesaDay.val());
        $("#When_" + rowId).val(when.val());
        $("#IntervalWiseDose_" + rowId).val(intervalWiseDose.val());

        //$("#Duratione_" + rowId).val(duration.val());
        //$("#DurationType_" + rowId).val(durationType.val());
        
        $("#DurationDurationType_"+rowId).val(duration.val()+'-'+durationType.find(":selected").text());
        
        $("#DurationDurationType_" + rowId).attr('data-node', durationType.find(":selected").val());
        $("#DrugAdvice_" + rowId).val(drugAdvice.find(":selected").text());
        $("#DrugAdvice_" + rowId).attr('data-node', drugAdvice.find(":selected").val());

        $("#myModal").modal("toggle");

    });

    $("#create-newRx").button().on("click", function () {
        /*
         * myModal property initial using below code
         */
        $("#saveAndAddMedicationrule").remove();
        $("#addmedicationrule").remove();
        $("#modalclosebtn").remove();
        $("#addmedicationruleEdit").remove();

        $("#DrugTypeName").val('');
        $("#DrugName").val('');
        $("#DoseInitial").val('');
        $("#IntervalWiseDose").val('');

        $('#TimesaDay').val(0).change();
        $('#When').val(0).change();
        $('#Duration').val(0).change();
        $('#DurationType').val(0).change();
        $('#DrugAdvice').val(0).change();

        var saveAndAddMedicationrule = "<button id='saveAndAddMedicationrule' type='button' class='btn  btn-info' ><span class='glyphicons glyphicon glyphicon-floppy-save' aria-hidden='true'>" +
                "</span>Save & Add Other</button>";
        var addmedicationrule = "<button id='addmedicationrule' type='button' class='btn  btn-info' ><span class='glyphicons glyphicon glyphicon-floppy-save' aria-hidden='true'></span>Add</button>";
        var closeBtn = "<button id='modalclosebtn' type='button' class='btn btn-danger' data-dismiss='modal'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Close</button>";
        $("#myModal").modal();
        $("#modalbottombuttoncontrol").append(saveAndAddMedicationrule);
        $("#modalbottombuttoncontrol").append(addmedicationrule);
        $("#modalbottombuttoncontrol").append(closeBtn);

    });

    $("#datepicker1").datepicker({
        minDate: '0',
        dateFormat: 'yy-mm-dd'
    });

    $("#nextVisitDurationType").change(function () {
        var time = $("#nextVisitDurationCount").val();
        var duratin = $(this).find(":selected").val();

        var result = new Date(new Date());

        if (duratin == 1) {
            result.setDate(parseInt(result.getDate()) + parseInt(time));
            result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
        }
        if (duratin == 2) {
            result.setDate(parseInt(result.getDate()) + parseInt(time) * 7);
            result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
        }
        if (duratin == 3) {
            result.setDate(result.getDate());
            result.setMonth(parseInt(parseInt(result.getMonth() + 1) + parseInt(time)));
        }
        if (duratin == 4) {
            result.setDate(result.getDate());
            result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
            result.setYear(parseInt(parseInt(result.getFullYear()) + parseInt(time)));
        }

        $("#showNextVisitingDate").css("display", "block");
        var finalNextDate = result.getFullYear() + '-' + result.getMonth() + '-' + result.getDate();
        $("#datepicker1").val(finalNextDate);
    });


    $("#nextVisitDurationCount").on("change keyup paste", function () {
        var duratin = $("#nextVisitDurationType").find(":selected").val();
        var time = $(this).val();
        if (duratin != '0' && time != '') {
            $("#datepicker1").val();
            var result = new Date(new Date());

            if (duratin == 1) {
                result.setDate(parseInt(result.getDate()) + parseInt(time));
                result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
            }
            if (duratin == 2) {
                result.setDate(parseInt(result.getDate()) + parseInt(time) * 7);
                result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
            }
            if (duratin == 3) {
                result.setDate(result.getDate());
                result.setMonth(parseInt(parseInt(result.getMonth() + 1) + parseInt(time)));
            }
            if (duratin == 4) {
                result.setDate(result.getDate());
                result.setMonth(parseInt(parseInt(result.getMonth()) + parseInt(1)));
                result.setYear(parseInt(parseInt(result.getFullYear()) + parseInt(time)));
            }
            var finalNextDate = result.getFullYear() + '-' + result.getMonth() + '-' + result.getDate();
            $("#datepicker1").val(finalNextDate);
        }

    });
});

$(document).on('click','.value-control',function(){
    var action = $(this).attr('data-action')
    var target = $(this).attr('data-target')
    var value  = parseFloat($('[id="'+target+'"]').val());
    if(isNaN(value)){
        value = 0;
    }
    if ( action == "plus" && value != 99 ) {
        value++;
    }
    if ( action == "minus" && value != 0) {
        value--;
    }
    $('[id="'+target+'"]').val(value)
});

$(document).ready(function () {

    //colony index create mouse source display
    if($("#source").val() == "1"){
        $("#selectCage").show();
    }
    else{
        $("#selectCage").hide();
    }
    $("#source").change(function() {
        if($("#source").val() == "1"){
            $("#selectCage").show();
        }
        else{
            $("#selectCage").hide();
        }
    });

    //mouse table untagged checkbox display options
    $(".untaggedInput").hide();
    $(".untaggedChk").click(function(){
        if (this.checked) {
            $("#new_tag_"+this.id).show();
            $("#sex_"+this.id).show();
        } else {
            $("#new_tag_"+this.id).hide();
            $("#sex_"+this.id).hide();
        }

    });

    //select Euthanize options
    //$("#euthPurpose").hide();
    $("#euthExperiment").hide();
    $("#euthStorage").hide();
    $("#submit_Euthanization").hide();
    $("#submit_euthanize").click(function(){
        $("#euthPurpose").show();
    });
    $("#purpose").change(function() {
        if($("#purpose").val() == "1"){
            $("#euthStorage").hide();
            $("#euthExperiment").show();
            $("#submit_Euthanization").hide();
        }
        else if($("#purpose").val() == "2"){
            $("#euthStorage").show();
            $("#euthExperiment").hide();
            $("#submit_Euthanization").hide();
        }
        else if($("#purpose").val() == "3"){
            $("#euthExperiment").hide();
            $("#euthStorage").hide();
            $("#submit_Euthanization").show();
        }else{
            $("#euthStorage").hide();
            $("#euthExperiment").hide();
            $("#submit_Euthanization").hide();
        }

    });
    $("#experiment").change(function() {
        if($("#experiment").val() != "0"){
            $("#submit_Euthanization").show();
        }else{
            $("#submit_Euthanization").hide();
        }
    });
    $("#storage").change(function() {
        if($("#storage").val() != "0"){
            $("#submit_Euthanization").show();
        }else{
            $("#submit_Euthanization").hide();
        }
    });

    //validation
    $("#quantity").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });
});

//    $('#createMice').on('submit', function() {
//        var id = $('#source').val();
//        var formAction = $('#createMice').attr('action');
//        $('#createMice').attr('action', formAction + id);
//    });

/*CREATE BREEDER CAGE*/

//event to get drop-down Female one box change
function checkFemaleOne(){
    var ddl_one = document.getElementById('female_one');
    var ddl_two = document.getElementById('female_two');
    var ddl_three = document.getElementById('female_three');

    //get value of female_one
    var f_one = $('#female_one').val();

    //reset 2nd and 3rd indexes if it matches new selection
    if(f_one == $('#female_two').val()) {
        ddl_two.selectedIndex = 0;

    }
    if(f_one == $('#female_three').val()) {
        ddl_three.selectedIndex = 0;
    }

    //return all values visible in second ddl if any have been hidden
    for(var i = 0; i < ddl_two.options.length; i++) {
        ddl_two.options[i].style.display = "block";
    }

    //reset all values visible in third ddl if any have been hidden and don't match second selected
    for(var i = 0; i < ddl_three.options.length; i++) {
        if ($('#female_two').val() != ddl_two.options[i].value) {
            ddl_three.options[i].style.display = "block";
        }
    }

    //remove this value from the second drop down
    for(var i = 0; i < ddl_two.options.length; i++){
        if(f_one != 0) {
            if (ddl_two.options[i].value == f_one) {
                ddl_two.options[i].style.display = "none";
                ddl_three.options[i].style.display = "none";
                ddl_two.disabled = false;
            }
        }else{//Reset and disable the 2nd and 3rd drop downs if 1st de-selected
            ddl_two.options[i].style.display = "block";
            ddl_three.options[i].style.display = "block";
            ddl_two.selectedIndex = 0;
            ddl_three.selectedIndex = 0;
            ddl_two.disabled = true;
            ddl_three.disabled = true;
        }
    }
}

function checkFemaleTwo(){
    var ddl_three = document.getElementById('female_three');

    //get value of female_two
    var f_two = $('#female_two').val();
    var f_one = $('#female_one').val();

    //return all values visible if any have been hidden
    for(var i = 0; i < ddl_three.options.length; i++) {
        ddl_three.options[i].style.display = "block";
    }

    //reset 3rd value if it matches new selection
    if(f_two == $('#female_three').val()) {
        ddl_three.selectedIndex = 0;
    }

    //remove this option from the 3rd drop down
    for(var i = 0; i < ddl_three.options.length; i++){
        if(f_two != 0) {
            if (ddl_three.options[i].value == f_two || ddl_three.options[i].value == f_one) {
                ddl_three.options[i].style.display = "none";
                ddl_three.disabled = false;
            }
        }else{//Reset and disable the 2nd and 3rd drop downs if 1st de-selected
            ddl_three.options[i].style.display = "block";
            ddl_three.selectedIndex = 0;
            ddl_three.disabled = true;
        }
    }
}

//Confirm removal of mouse from surgery.
function confirmRemove()
{
    return confirm("Remove mouse from this surgery?");
}

/*CONFIRMATION OF DELETE USING ALERT*/
//function is used, not recognised due to laravel FORM annotation.
function confirmDelete()
{
    return confirm("Are you sure you want to delete?");
}

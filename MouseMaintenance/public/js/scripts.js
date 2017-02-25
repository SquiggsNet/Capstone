
//Colony Index Page, Mouse Creation Function
function selectedSource(){
    var dropDown = document.getElementById("source");
    var currentValue = dropDown.options[dropDown.selectedIndex].value;

    if(currentValue == "1"){
        document.getElementById("selectCage").style.display = "block";
    }else{
        document.getElementById("selectCage").style.display = "none";
    }
}


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

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

    //select Euthanize
    $("#submit_euthanize").click(function(){
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

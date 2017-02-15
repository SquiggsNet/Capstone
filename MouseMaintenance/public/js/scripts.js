
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


//    $('#createMice').on('submit', function() {
//        var id = $('#source').val();
//        var formAction = $('#createMice').attr('action');
//        $('#createMice').attr('action', formAction + id);
//    });

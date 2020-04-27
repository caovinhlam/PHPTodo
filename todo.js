// Ajax call to add form
$(document).ready(function(){
    $('#addForm').submit(function(){
        $.ajax({
            type: 'POST',
            url: '../todoweb/add.php', 
            data: $(this).serialize()
        })
        .done(function(data){
            document.getElementById("addClose").click()
            location.reload();
        })
        .fail(function() {
            alert( "Posting failed." );
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });
});

// Sets minimum date to current date
$(document).ready(function(){
    $('.datePicker').attr({
        "min" : new Date().toISOString().split("T")[0]
    });       
});

// Automatically fill in user inputs when editing entries
function editEntry(id) {
    // id of the current row we're editing
    $('#editId').val(id);
    $title = $('#'+id+'title').text()
    $desc = $('#'+id+'desc').text()
    $date = $('#'+id+'date').text()
    $('#editTitle').val($title)
    $('#editDesc').val($desc)
    $('#editDate').val($date)
}

// Ajax call to edit form
$(document).ready(function(){
    $('#editForm').submit(function(){
        $.ajax({
            type: 'POST',
            url: '../todoweb/edit.php', 
            data: $(this).serialize()
        })
        .done(function(data){
            document.getElementById("editClose").click()
            location.reload();
        })
        .fail(function() {
            alert( "Posting failed." );
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });
});

// Ajax call to delete form
function deleteEntry(id) {
    var $delete = confirm("Are you sure you want to delete this record?");
    if ($delete == true)
    {
        $.get('../todoweb/delete.php', {id:id})
        .done(function(response) {
            alert("success");
            location.reload();
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    }
}
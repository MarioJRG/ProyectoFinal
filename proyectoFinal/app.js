fetchTask();

$('#task-form').submit(function(e) {
    const postData ={
        name: $('#name').val(),
        description: $('#description').val()

    };
    $.post('task-add.php',postData,function (response)  {
       
        fetchTask();
       $('#task-form').trigger('reset');
    });
    e.preventDefault();
});

function fetchTask(){
    $.ajax({
        url: 'task-list.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template='';
            task.forEach(task => {
                template +=`
                <tr taskId=${task.id} taskName=${task.nameUser}>
                    <td>${task.id}</td>
                    <td>${task.nameUser}</td>
                    <td>${task.description}</td>
                    
                   
                                    
                                          
                    <td>
                    <button class="task-delete btn btn-danger">
                    Delete
                    </button>

                    </td>
                    </form>
                </tr>
                    
                `
                      
            });
            $('#task').html(template);
        }
    
    
    });  
}

$(document).on('click','.task-delete',function(){
    let element=$(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    
    let nameC = $('#name').val();
    
    let userIdC = $('#id').val();
    
    $.post('task-delete.php',{id,nameC,userIdC},function(response){
        fetchTask();
    })
})
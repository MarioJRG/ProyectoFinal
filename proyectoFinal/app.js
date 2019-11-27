
$('#task-form').submit(function(e) {
    const postData ={
        name: $('#name').val(),
        description: $('#description').val()

    };
    $.post('task-add.php',postData,function (response)  {
       console.log(response);

       $('#task-form').trigger('reset');
    });
    e.preventDefault();
});
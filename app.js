$(function(){
    let input_hidden = document.getElementById('taskid');
    let edit = false;
    $('#task-search').hide();
    showALLTasks();
    $('#search').keyup(function(){
        $('#task-search').hide();
        let search = $('#search').val();
        if(search){
            let template = '';
            $.ajax({
                url: 'php/index.php?action=taskSearch',
                type: 'POST',
                data: {search : search},
                success: function(response){
                    if(response){
                        let tasks = JSON.parse(response);
                        tasks.forEach(element => {
                            template += `<li>${element.name}</li>`;
                        });
                        $('#container-ul').html(template);
                        $('#task-search').show();
                    }
                    
                }
            })

        }
    });

    $('#task-form').submit(function(e){
        e.preventDefault();
        let name_task = $('#name').val();
        let desc_task = $('#description').val();
        let url = edit == false  ?  'php/index.php?action=saveTask' :  'php/index.php?action=upDateTask';
        let id =  edit == false ? '' : input_hidden.value;

        $.ajax(
           {
            url: url,
            type: 'POST',
            data: {name : name_task, 
                    description: desc_task,
                    id: id
                },
            success: function(response){
                
                    // alert("TAREA AGREGADA");
                    $('#task-form').trigger('reset');
                    showALLTasks();
                    
                    
            }
           }
        );
    });
function showALLTasks(){
    $.ajax({
        url: 'php/index.php?action=tasksAll',
        type: 'POST',
        success: function(response){
            if(response){
                let template = '';
                let tasks = JSON.parse(response);
                tasks.forEach(element => {
                    template += `<tr><td>${element.id}</td><td>${element.name}</td><td>${element.description}</td><td><button class="btn btn-danger btn-delete w-100" data-id="${element.id}">Eliminar</button><button class="btn btn-warning btn-edit w-100 mt-2" data-id="${element.id}">Editar</button></td></tr>`;
                });
                $('#task').html(template);
                let btns_delete = document.querySelectorAll('.btn-delete');
                btns_delete.forEach(element=>{
                    element.addEventListener('click',()=>{
                            let id = element.dataset.id;
                            deleteTask(id);
                    });
                });
                let btns_edit = document.querySelectorAll('.btn-edit');
                btns_edit.forEach(element=>{
                    element.addEventListener('click',()=>{
                            let id = element.dataset.id;
                            console.log(id)
                            editTask(id);
                    });
                });
            }
        }
    });
}


let deleteTask = (id)=>{
    $.ajax(
        {
            url:'php/index.php',
            type:'GET',
            data:{action:'delete',id:id},
            success: function(response){
                console.log(response);
                showALLTasks();
            }
            
        }
    );
}  

let editTask = (id)=>{
    $.ajax(
        {
            url:'php/index.php',
            type:'GET',
            data:{action:'getOneTask',id:id},
            success: function(response){
                let result = JSON.parse(response);
                $('#name').val(result.name);
                $('#description').val(result.description); 
                edit=true;       
            }
            
        }
    );
    input_hidden.value=id;
}
 
    
});
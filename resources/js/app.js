import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {
getUsers();
function getUsers()
{
  $.ajax({
    type: "GET",
    url: "/api/user",
    success: function(response) {
      var options = '<option value="">Select User</option>';
      response.data.forEach(function(user) {
        options += '<option value="'+user.id+'">'+user.name+'</option>';
      });
      $('#user').html(options);
    }
  }); 
}
  $("#addTaskBtn").click(function() {
    resetAddTaskFrom();
    $("#addTaskModal").removeClass("hidden");
  });

  $("#closeAddTaskBtn").click(function() {
    $("#addTaskModal").addClass("hidden");
    resetAddTaskFrom();
  });

  
function resetAddTaskFrom()
{
  $("#addTaskForm .input-error").text("");
  $("#title").val('');
  $("#user").val('');
  $("#status").val('pending');
  $("#addTaskForm textarea").val("");
  $("#taskId").val("");
  $('#submitAddTaskBtn').html('Add');
  $('#save-message').text('');
}
function initEditAction()
{
  $('.edit-task-btn').on('click',function(){
    $("#addTaskModal").removeClass("hidden");
    var id = $(this).data('id');
    $.ajax({
      type: "GET",
      url: "/api/task/"+id,
      success: function(response) {
        $('#title').val(response.data.title);
        $('#description').val(response.data.description);
        $('#status').val(response.data.status);
        $('#user').val(response.data.user_id);
        $('#taskId').val(response.data.id);
        $('#submitAddTaskBtn').html('update');
      },
      
    });
  });
}
function initMarkAsCompleted()
{
  $('.markAsCompleted').on('click',function(){
    var id = $(this).data('id');
      $.ajax({
        type: "GET",
        url: "/api/task/mark_as_completed/"+id,
        success: function(response) {
          $('#task-' + id).remove();
        },
        
      });
  });
}
function initDetailAction()
{
  $('#closeTaskDetailBtn').on('click',function(){
    $("#taskDetailModal").addClass("hidden");
  });
  $('.taskDetailBtn').on('click',function(){
    $("#taskDetailModal").removeClass("hidden");
    var id = $(this).data('id');
    $.ajax({
      type: "GET",
      url: "/api/task/"+id,
      success: function(response) {
        $('#detail-title').text('#'+id+" "+response.data.title);
        $('#detail-description').text(response.data.description);
        
      },
      
    });
  });
}
function initDeleteEvent()
{
  $('.deleteTaskBtn').on('click',function(){
    $("#deleteTaskModal").removeClass("hidden");
    var id = $(this).data('id');
    $('#deleteTaskId').val(id);
  });
  $('#deleteNoTaskBtn').on('click',function(){
    $("#deleteTaskModal").addClass("hidden");
  });

  $('#deleteYesTaskBtn').on('click',function(){
      $.ajax({
        type: "post",
        url: "/api/task/delete",
        data:{id:$('#deleteTaskId').val(),'_token':$('#deleteToken').val()},
        success: function(response) {
          $('#task-' + $('#deleteTaskId').val()).remove();
          $("#deleteTaskModal").addClass("hidden");
        },
        error: function(xhr) {
          
        }
      });
  });
}
function showTaskCard(task)
{
  var shortDesc = task.description.substring(0, 100);
  var taskStatusColor = task.status == 'pending'? 'bg-red-400' : 'bg-green-400';
  var markAsCompletedBtn = '';
  if(task.status == 'pending')
  {
    markAsCompletedBtn = '<button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 markAsCompleted" data-id="'+task.id+'">Mark as completed</button>';
  }
  let jsValue = `<div class="shadow-lg p-3 " id="task-`+task.id+`">
                      <div>
                          <button class="px-4 mb-2 py-1 text-xs text-white font-semibold  border border-purple-200 cursor-default  focus:ring-offset-2 `+taskStatusColor +`">`+task.status+`</button>
                          `+ markAsCompletedBtn +`
                          <h1 class="font-bold bg-gray-200 px-2 py-1">#`+task.id+ ` `+ task.title+`</h1>
                          <h4 class="font-bold text-xs ">Assined to `+ task.user +`<i></i></h4>
                          <p class="font-light text-xs mt-2">
                              `+shortDesc+`......
                          </p>
                      </div>
                        <div class="p-2 mt-2">
                          <button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 taskDetailBtn" data-id="`+task.id+`">more details</button>
                          <button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 edit-task-btn" data-action="edit" data-id="`+task.id+`">Edit</button>
                          <button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 deleteTaskBtn" data-id="`+task.id+`">Delete</button>
                      </div>
                  </div>`;
                  return jsValue;
}
$.ajax({
  type: "GET",
  url: "/api/task",
  success: function(response) {
    response.data.forEach(function(task) {
      var taskCard = showTaskCard(task);
      $('#taskCardGrid').prepend(taskCard);
    });
    initDeleteEvent();
    initEditAction();
    initDetailAction();
    initMarkAsCompleted();
  },
  error: function(xhr) {
    
  }
});
 
  $("#submitAddTaskBtn").on('click', function() {
    let isValid = true;

      // Clear previous error messages
      $("#addTaskForm .input-error").text("");

      // Title validation
      const title = $("#title").val();
      if (title.length < 5) {
          $("#titleError").text("Title must be at least 5 characters long");
          isValid = false;
      }

      // Description validation
      const description = $("#description").val();

      if (description === "") {
        $("#descriptionError").text("Description is required");
        isValid = false;
      }
      if (description.length < 10) {
          $("#descriptionError").text("Description must be at least 10 characters long");
          isValid = false;
      }

      // Status validation
      const status = $("#status").val();
      if (status === "") {
          $("#statusError").text("Please select the status");
          isValid = false;
      }

      // Users validation
      const user = $("#user").val();
      if (user == "") {
        $("#userError").text("Please select the user");
        isValid = false;
    }


      if (isValid) {
        const formData = {
          title: title,
          description: description,
          status: status,
          user_id: user,
          task_id: $('#taskId').val(),
          _token:$('#token').val()
      };

      $.ajax({
          type: "POST",
          url: "/api/task",
          data: formData,
          success: function(response) {
            if(response.data)
             {
              var taskCard = showTaskCard(response.data);
              $('#taskCardGrid').prepend(taskCard);
              
              resetAddTaskFrom();
              initDeleteEvent();
              initEditAction();
              initDetailAction();
              initMarkAsCompleted();
              $('#save-message').text("Created successfull");
              
             }else{
              $('#save-message').text(response.message);
             }
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              const errors = xhr.responseJSON.errors;
              // Display validation errors
              if (errors.user_id) {
                  $('#userError').text(errors.user_id[0]);
              }
              if (errors.tittle) {
                  $('#tittleError').text(errors.tittle[0]);
              }
              if (errors.description) {
                  $('#descriptionError').text(errors.description[0]);
              }
              if (errors.status) {
                $('#statusError').text(errors.status[0]);
            }
          }
              
          }
        });  
      } 
  });
});

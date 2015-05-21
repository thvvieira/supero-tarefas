/*
 * @author Shaumik "Dada" Daityari
 * @copyright December 2013
 */

/* Some info
Using newer versions of jQuery and jQuery UI in place of the links given in problem statement
All data is stored in local storage
User data is extracted from local storage and saved in variable todo.data
Otherwise, comments are provided at appropriate places
*/

var request = new XMLHttpRequest();
request.open("GET", "http://localhost:81/supero-tarefas/rest_tarefas/index.json", false);
request.send(null);

var todo = todo || {},
    data = JSON.parse(request.responseText);
	//data = JSON.parse(xhr.responseText);
	
data = data || {};

(function(todo, data, $) {

    var defaults = {
            todoTask: "todo-task",
            todoHeader: "task-header",
            todoDate: "task-date",
            todoDescription: "task-description",
            taskId: "task-",
            formId: "todo-form",
            dataAttribute: "data",
            deleteDiv: "delete-div"
        }, codes = {
            "1" : "#pending",
            "2" : "#inProgress",
            "3" : "#completed"
        };

    todo.init = function (options) {

        options = options || {};
        options = $.extend({}, defaults, options);

        $.each(data, function (index, params) {
			//console.log(params);
            generateElement(params);
        });

        /*generateElement({
            id: "123",
            code: "1",
            title: "asd",
            date: "22/12/2013",
            description: "Blah Blah"
        });*/

        /*removeElement({
            id: "123",
            code: "1",
            title: "asd",
            date: "22/12/2013",
            description: "Blah Blah"
        });*/

        // Adding drop function to each category of task
        $.each(codes, function (index, value) {
            $(value).droppable({
                drop: function (event, ui) {
                        var element = ui.helper,
                            css_id = element.attr("id"),
                            id = css_id.replace(options.taskId, ""),
                            object = data[id];

                            // Removing old element
                            removeElement(object);

                            // Changing object code
                            object.code = index;

                            // Generating new element
                            generateElement(object);

                            // Updating Local Storage
                            data[id] = object;
                            //localStorage.setItem("todoData", JSON.stringify(data));

                            // Hiding Delete Area
                            $("#" + defaults.deleteDiv).hide();
                    }
            });
        });

        // Adding drop function to delete div
        $("#" + options.deleteDiv).droppable({
            drop: function(event, ui) {
                var element = ui.helper,
                    css_id = element.attr("id"),
                    id = css_id.replace(options.taskId, ""),
                    object = data.tarefas[findById(data.tarefas,id)];

                // Removing old element
                removeElement(object);

                // Updating local storage
                //delete data[id];
                //localStorage.setItem("todoData", JSON.stringify(data));

                // Hiding Delete Area
                $("#" + defaults.deleteDiv).hide();
            }
        })

    };

    // Add Task
    var generateElement = function(params){
		
		console.log(params);
        var parent = $(codes[params[0].Tarefa.prioridade]),
            wrapper;

        if (!parent) {
            return;
        }

        wrapper = $("<div />", {
            "class" : defaults.todoTask,
            "id" : defaults.taskId + params[0].Tarefa.id,
            "data" : params[0].Tarefa.id
        }).appendTo(parent);

        $("<div />", {
            "class" : defaults.todoHeader,
            "text": params[0].Tarefa.titulo
        }).appendTo(wrapper);

        $("<div />", {
            "class" : defaults.todoDate,
            "text": params[0].Tarefa.created
        }).appendTo(wrapper);

        $("<div />", {
            "class" : defaults.todoDescription,
            "text": params[0].Tarefa.descricao
        }).appendTo(wrapper);

	    wrapper.draggable({
            start: function() {
                $("#" + defaults.deleteDiv).show();
            },
            stop: function() {
                $("#" + defaults.deleteDiv).hide();
            },
	        revert: "invalid",
	        revertDuration : 200
        });
	
    };

    // Remove task
    var removeElement = function (params) {
		console.log(params);
		
        $("#" + defaults.taskId + params.Tarefa.id).remove();
		request.open("POST", "http://localhost:81/supero-tarefas/rest_tarefas/delete/"+params.Tarefa.id+".json", true);
		request.send();
		
    };

    todo.add = function() {
        var inputs = $("#" + defaults.formId + " :input"),
            errorMessage = "Title can not be empty",
            id, title, description, date, tempData;

        if (inputs.length !== 4) {
            return;
        }

        title = inputs[0].value;
        description = inputs[1].value;
        date = inputs[2].value;

        if (!title) {
            generateDialog(errorMessage);
            return;
        }

        id = new Date().getTime();

        tempData = {
            prioridade: "1",
            titulo: title,
            created: date,
            modified: date,
            descricao: description
        };

        // Saving element in local storage
		request.open("POST", "http://localhost:81/supero-tarefas/rest_tarefas/add.json", true);
		data[id] = tempData;
		request.send(JSON.stringify(data));
		console.log(request);
        //data[id] = tempData;
        //localStorage.setItem("todoData", JSON.stringify(data));

        // Generate Todo Element
        generateElement(tempData);

        // Reset Form
        inputs[0].value = "";
        inputs[1].value = "";
        inputs[2].value = "";
    };

    var generateDialog = function (message) {
        var responseId = "response-dialog",
            title = "Messaage",
            responseDialog = $("#" + responseId),
            buttonOptions;

        if (!responseDialog.length) {
            responseDialog = $("<div />", {
                    title: title,
                    id: responseId
            }).appendTo($("body"));
        }

        responseDialog.html(message);

        buttonOptions = {
            "Ok" : function () {
                responseDialog.dialog("close");
            }
        };

	    responseDialog.dialog({
            autoOpen: true,
            width: 400,
            modal: true,
            closeOnEscape: true,
            buttons: buttonOptions
        });
    };

    todo.clear = function () {
        //data = {};
        //localStorage.setItem("todoData", JSON.stringify(data));
        //$("." + defaults.todoTask).remove();
    };

})(todo, data, jQuery);

function findById(source, id) {
  for (var i = 0; i < source.length; i++) {
  console.log(source[i]);
    if (source[i].Tarefa.id === id) {
      return i;
    }
  }
  throw "Couldn't find object with id: " + id;
}
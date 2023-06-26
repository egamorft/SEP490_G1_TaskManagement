export var data_user = fetch('../../../data/fullcalendar/json/user.json')
            .then((response) => response.json())
            .then(json => parseDataHTML(json, "buttons-user"));

export var data_task = fetch('../../../data/fullcalendar/json/task.json')
            .then((response) => response.json())
            .then(json => parseDataHTML(json, "buttons-task"));


function parseDataHTML(json, canvas) {
    var buttons = ``;
    json.forEach(function(data){
        var html_button = `
            <div class='button-action button-${data.id}'>
                <input class="form-check-input" style='background-color: ${data.color}; border-color: ${data.color}' type="checkbox" id="${data.id}" value="${data.content}" checked>
                <span class="button-${data.id}-text">${data.content}</span>
            </div>
        `;
        buttons += html_button;
    });

    var html = `
        <div class='${canvas}'>
            ${buttons}
        </div>
    `;

    $('#calendar .fc-toolbar-chunk:last-child').append(html);
};
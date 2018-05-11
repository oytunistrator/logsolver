/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');

window.dtGenerator = function(id, columns, ajax, order) {
    columns.push({
        "targets": 7,
        "render": function(data, type, row, meta) {
            return '<a class="btn" href="' + window.location.href + '/delete/' + row.id + '">Delete</a> <a class="btn" href="' + window.location.href + '/view/' + row.id + '">View</a>';
        }
    });

    $(id).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": ajax,
        "responsive": true,
        "columns": columns,
        "order": order
    });
};

if ($(".logs").length > 0) {
    window.dtGenerator(".logs", [
        { "data": "id" },
        { "data": "filename" },
        { "data": "created_at" }
    ], {
        "url": window.location.href + "/data",
        "data": function(data) {}
    }, [
        [1, "desc"]
    ]);
}

if ($(".logentries").length > 0) {
    window.dtGenerator(".logentries", [
        { "data": "id" },
        {
            "data": "type",
            "render": function(data, type, row, meta) {
                switch (row.type) {
                    case "WARNING":
                        return "<span class='text-warning'>" + row.type + "</span>";
                    case "WARN":
                        return "<span class='text-warning'>" + row.type + "</span>";
                    case "INFO":
                        return "<span class='text-info'>" + row.type + "</span>";
                    case "ERROR":
                        return "<span class='text-danger'>" + row.type + "</span>";
                    case "EXCEPTION":
                        return "<span class='text-danger'>" + row.type + "</span>";
                }
            }
        },
        {
            "data": "entry",
            "className": 'entry',
            "render": function(data, type, row, meta) {
                var entry = "";
                if (row.entry.length > 50) {
                    entry += row.entry.substring(0, 50) + "...";
                } else {
                    entry += row.entry;
                }
                return entry;
            }
        },
        { "data": "logdate" }
    ], {
        "url": window.location.href + "/data",
        "data": function(data) {}
    }, [
        [1, "desc"]
    ]);
}

$(".progress").hide();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".ajaxUploader").on('submit', function(event) {
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE
    $(".progress").show();

    // Create a formdata object and add the files
    var data = new FormData();
    data.append("file", $('input[type=file]')[0].files[0]);

    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();

            // Upload progress
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    //Do something with upload progress
                    $('.progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                }
            }, false);

            // Download progress
            xhr.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    // Do something with download progress
                    $('.progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                }
            }, false);

            return xhr;
        },
        url: 'store',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR) {
            if (typeof data.error === 'undefined') {
                // Success so call function to process the form
                $(".progress").hide();
            } else {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });
});
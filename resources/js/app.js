require('./bootstrap');
require('./utils');



$(document).ready(function() {

    $('#init').on('click', function() {
        makeRequest('/init', 'POST', {}, function(data) {
            console.log(data);
        });
    });

    $('#output').on('click', function() {
        makeRequest('/calculate', 'POST', {}, function(data) {
            if(data.success){
                $.each(data.output, function(i, item){
                    $('#output-list').append('<li>' + item.order_id + ' - ' + item.box  +'</li>');
                });
            }
        });
    });

});

$(function() {

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "4.0",
            value: 12
        }, {
            label: "3.0 - 3.9",
            value: 30
        }, {
            label: "2.0 - 2.9",
            value: 20
        },
        {
            label: "0 - 2.0",
            value: 20
        }],
        resize: true
    });


});

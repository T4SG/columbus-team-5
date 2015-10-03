$(function() {

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "4.0",
            value: 12
        }, {
            label: "3.0+",
            value: 30
        }, {
            label: "2.0+",
            value: 20
        },
        {
            label: "< 2.0",
            value: 20
        }],
        resize: true
    });


});

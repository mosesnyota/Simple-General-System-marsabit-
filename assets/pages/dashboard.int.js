
/*
 Template Name: Zinzer - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Dashboard js
 */

!function ($) {
    "use strict";

    var Dashboard = function () {
    };

    //creates line chart
    Dashboard.prototype.createLineChart = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          hideHover: 'auto',
          gridLineColor: '#eef0f2',
          resize: true, //defaulted to true
          lineColors: lineColors
        });
    },

    //creates Donut chart
    Dashboard.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true,
            colors: colors
        });
    },




    Dashboard.prototype.init = function () {
        //create line chart
        var $data  = [
            { y: '2014', a: 45, b: 65 },
            { y: '2015', a: 75,  b: 95 },
            { y: '2016', a: 50,  b: 40 },
            { y: '2017', a: 95,  b: 65 },
            { y: '2018', a: 50,  b: 40 },
            { y: '2019', a: 65,  b: 75 },
            { y: '<?php  2020; ?>', a: 80, b: 90 }
          ];
        this.createLineChart('morris-line-example', $data, 'y', ['a', 'b'], ['Series D', 'Series E'], ['#5985ee', '#46cd93']);

        //creating donut chart
        var $donutData = [
            {label: "Budget", value: 12},
            {label: "Used", value: 30},
            {label: "Balance", value: 20}
        ];
        this.createDonutChart('morris-donut-example', $donutData, ['#4bbbce', '#5985ee', '#46cd93']);

    },

        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);
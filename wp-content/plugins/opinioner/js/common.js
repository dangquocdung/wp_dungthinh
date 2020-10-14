/** 
 * Opinioner plugin allows you to ask questions to readers of articles and evaluates the answers.
 * Exclusively on Envato Market: https://1.envato.market/opinioner
 * 
 * @encoding     UTF-8
 * @version      1.0.0
 * @copyright    Copyright (C) 2019 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license      Envato Standard License https://1.envato.market/KYbje
 * @author       Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 * @support      dmitry@merkulov.design
 **/

(function($) {
    
    "use strict";
    
    var dataBezierSmoothing = function( data ) {

        var previousData = data;

        for ( var i = 0; i < data.length; i++ ) {

            if ( i === 0 ) {

                data[i] = 0.5 * ( 1.25 * previousData[ i + 1 ] + data[ i ] );

            } else if ( i === data.length - 1 ) {

                data[i] = 0.5 * ( 1.25 * previousData[ i - 1 ]  + data[ i ] );

            } else {

                data[i] = 0.5 * ( 0.5 * ( previousData[ i - 1 ] + previousData[ i + 1 ] ) + data[ i ] );

            }

        }

    };

    /**
    * Create Vote Chart.
    **/
    var showChart = function(id, debug) {
        jQuery('#opinioner-' + id + ' .ct-chart').show();

        var i, j;
        var data = JSON.parse(JSON.stringify(window['opinioner_data_' + id]));

        if (!debug) {

            for ( i = 0; i < data.series.length; i++ ) {

                for ( var r = 0; r <= data.smooth; r++ ) {

                    dataBezierSmoothing( data.series[i] );

                }

            }

        }

        /** Create a new line chart object. */
        var chart = new Chartist.Line(
            '#opinioner-' + id + ' .ct-chart',
            data,
            {
                showPoint: false,
                showArea: true,
                axisX: { showGrid: false, showLabel: false, offset: 0 },
                axisY: { showGrid: true, showLabel: !!debug, offset: debug ? 60 : 0, scaleMinSpace: 40 },
                chartPadding: {
                    top: 1,
                    right: 0,
                    bottom: 1,
                    left: 0
                },
                fullWidth: true
            }
        );

        /** Cart animation on draw. */
        chart.on('draw', function (data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 1500,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });
    };

    window.showChart = showChart;

    /** Init charts. */
    $(function() {
        $('.opinioner-chart').each(function () {
            var id = $(this).data('id');
            var debug = $(this).data('debug');
            if (id) {
                showChart($(this).data('id'), debug);
            }
        });
    });
    
})(jQuery);
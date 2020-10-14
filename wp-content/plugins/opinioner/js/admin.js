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

jQuery(function ( $ ) {
    
    jQuery( document ).ready( function () {
    
        var $title = $('#title');
        var $excerpt = $('#excerpt');
        var $left_value_field = $('#left-value-field');
        var $right_value_field = $('#right-value-field');

        var $chart_values = $('#opinioner-chart-values');
        var $preview_button = $('#opinioner-preview-button');
        var $preview = $('#opinioner-preview');

        var tpl_preview = wp.template( 'opinioner' );
        var tpl_chart_values = wp.template( 'opinioner-chart-values' );

        var getVotesSampleData = function ( votes ) {
            var i;
            var arr = [];

            for ( i = 0; i < 100; i++ ) {
                arr[i] = 0;
            }

            var votes1 = Math.ceil(votes * 9 / 10);
            var votes2 = votes - votes1;

            // Fill votes
            for ( i = 0; i < votes1; i++ ) {
                arr[Math.floor(Math.random() * 100)]++;
            }
            for ( i = 0; i < votes2; i++ ) {
                arr[Math.floor(Math.random() * 2) * 99]++;
            }

            return arr;
        };
        var openPreviewPopup = function () {
            var votes_count = 500;
            var title = $title.val().trim();
            var description = $excerpt.val().trim();
            var left_value = $left_value_field.val().trim();
            var right_value = $right_value_field.val().trim();

            window.opinioner_data_sample = {
                series: [getVotesSampleData(votes_count)]
            };

            $preview.html(tpl_preview({
                votes_count: votes_count,
                title: title,
                description: description,
                left_value: left_value,
                right_value: right_value
            }));

            tb_show(opinioner_dict.preview, '#TB_inline?width=550&height=600&inlineId=opinioner-preview');
        };
        
        var updateChartValues = function () {
            $chart_values.html(tpl_chart_values({
                left_value: $left_value_field.val().trim(),
                right_value: $right_value_field.val().trim()
            }));
        };

        if ( $chart_values.length ) {
            $left_value_field.keyup(updateChartValues).change(updateChartValues);
            $right_value_field.keyup(updateChartValues).change(updateChartValues);
            updateChartValues();
        }

        $preview_button.click(function () {
            openPreviewPopup();
            showChart('sample');
        });
    });
});

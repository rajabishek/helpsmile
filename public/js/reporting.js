$(function () {
    
    var Reporting = {

        init: function(){
            this.chartData = [{
                "date": "2013-01-27",
                "value": 84
            }];
            this.bindEvents();
            this.sendData();
        },

        bindEvents:function(){
            AmCharts.ready($.proxy(this.initialiseChart,this));
        },

        jumpToLoadingState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_loading');
        },

        jumpToNormalState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_normal');
        },

        initialiseChart:function(){

            this.donationsChart = AmCharts.makeChart("donations-chart", {
                "type": "serial",
                "theme": "light",
                "marginRight": 80,
                "autoMarginOffset": 20,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<div style='margin:5px; font-size:19px;'><span style='font-size:13px;'>[[category]]</span><br>[[value]]</div>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis":false,
                    "offset":30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount":true,
                    "color":"#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha":0,
                    "valueLineAlpha":0.2
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": this.chartData
            });

            this.donationsChart.addListener("rendered", this.zoomChart());
            this.zoomChart();
        },

        zoomChart: function(){
            this.donationsChart.zoomToIndexes(this.donationsChart.dataProvider.length - 40, this.donationsChart.dataProvider.length - 1);
        },

        sendData: function(){
            
            //this.jumpToLoadingState();
        
            $.ajax({
                type: 'get',
                url: '/manager/dashboard/reporting',
                dataType: 'json',
                beforeSend: $.proxy(this.donationsChartBeforeSendHandler,this),
                success: $.proxy(this.donationsChartResponseHandler,this),
                error: $.proxy(this.donationsChartErrorHandler,this)
            });
        },

        donationsChartBeforeSendHandler:function(){

        },

        donationsChartResponseHandler:function(result){
            var donations = result.data;
            var chartData = [];
            $.each(donations, function(index, value){
                chartData.push({
                    'date': value.day,
                    'value': value.donated_donations
                });
            });
            this.donationsChart.dataProvider = chartData;
            this.donationsChart.validateData();
        },

        donationsChartErrorHandler:function(xhr, textStatus, thrownError)
        {    
            // this.jumpToNormalState();
            // this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            // this.errorBox.fadeIn();
            // return this.passwordInputField.val('');
        }
    };

    Reporting.init();
});
BX.ready(function(){

    var myChart = echarts.init(document.getElementById("charts"));

    if (orgzdrav_chartsdata) {
        let orgzdrav_values = orgzdrav_chartsdata.VALUES
        let orgzdrav_subjects = orgzdrav_chartsdata.SUBJECTS
        let orgzdrav_color = orgzdrav_chartsdata.COLORS

        run(orgzdrav_values, orgzdrav_subjects, orgzdrav_color);
    }

    function run(_rawData, countries, color) {

        const datasetWithFilters = [];
        const seriesList = [];
        echarts.util.each(countries, function (country, key) {

            var datasetId = 'dataset_' + key;
            datasetWithFilters.push({
                id: datasetId,
                fromDatasetId: 'dataset_raw',
                transform: {
                    type: 'filter',
                    config: {
                        and: [
                            { dimension: 'Subject', '=': key }
                        ]
                    }
                }
            });
            seriesList.push({
                type: 'line',
                datasetId: datasetId,
                showSymbol: false,
                name: country,
                labelLayout: {
                    moveOverlap: 'shiftY'
                },
                emphasis: {
                    focus: 'series'
                },
                encode: {
                    x: 'Year',
                    y: 'Income',
                    label: ['Subject', 'Income'],
                    itemName: 'Year',
                    tooltip: ['Income']
                }
            });
        });

        option = {
            animationDuration: 1000,
            dataset: [
                {
                    id: 'dataset_raw',
                    source: _rawData
                },
                ...datasetWithFilters
            ],
            color:
                color
            ,
            title: {
                text: ''
            },
            tooltip: {
                axisPointer: {
                    type: 'cross'
                }
            },
            xAxis: {
                type: 'category',
                nameLocation: 'middle'
            },
            yAxis: {
                name: 'Income'
            },
            dataZoom: {
                show : true,
                realtime : true,
                orient: 'vertical'
            },
            series: seriesList
        };
        myChart.setOption(option);
    }
});
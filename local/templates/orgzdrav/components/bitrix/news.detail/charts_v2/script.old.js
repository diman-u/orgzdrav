BX.ready(function(){

    var myChart = echarts.init(document.getElementById("charts"));

    if (orgzdrav_chartsdata) {
        // console.log(orgzdrav_chartsdata);
        let orgzdrav_values = orgzdrav_chartsdata.VALUES
        let orgzdrav_subjects = orgzdrav_chartsdata.SUBJECTS
        let orgzdrav_color = orgzdrav_chartsdata.COLORS

        run(orgzdrav_values, orgzdrav_subjects, orgzdrav_color);
    }

    function run(_rawData, countries, color) {

        const datasetWithFilters = [];
        const seriesList = [];
        echarts.util.each(countries, function (country, key) {
            // console.log(key);
            var datasetId = 'dataset_' + key;
            datasetWithFilters.push({
                id: datasetId,
                fromDatasetId: 'dataset_raw',
                transform: {
                    type: 'filter',
                    config: {
                        and: [
                            //{ dimension: 'Year', gte: 2000 },
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
                // endLabel: {
                //     show: true,
                //     formatter: function (params) {
                //         return params.value[3] + ': ' + params.value[0];
                //     }
                // },
                labelLayout: {
                    moveOverlap: 'shiftY'
                },
                emphasis: {
                    focus: 'series'
                },
                encode: {
                    x: 'Год',
                    y: 'ОКС',
                    label: ['Subject', 'ОКС'],
                    itemName: 'Год',
                    tooltip: ['ОКС']
                }
            });
        });

        option = {
            animationDuration: 5000,
            dataset: [
                {
                    id: 'dataset_raw',
                    source: _rawData
                },
                ...datasetWithFilters
            ],
            // color:
            //     color
            // ,
            title: {
                text: ''
            },
            tooltip: {
                // order: 'valueDesc',
                //trigger: 'axis',
                // displayMode: 'single'
                axisPointer: {
                    type: 'cross'
                }
            },
            xAxis: {
                type: 'category',
                nameLocation: 'middle',
            },
            yAxis: {
                name: 'ОКС'
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
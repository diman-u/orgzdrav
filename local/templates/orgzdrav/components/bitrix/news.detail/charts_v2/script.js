BX.ready(function(){
	if (!window.ORGZDRAV || !window.ORGZDRAV.chartsdata) {
		return;
	}
	
	var myChart = echarts.init(document.getElementById('charts'));
	OrgzdravChart.run(myChart, window.ORGZDRAV.chartsdata)
});

const OrgzdravChart = (() => {
	return {
		run: (myChart, config) => {
			const groupsList = [];
			echarts.util.each(config.GROUPS, (data, color) => {
				groupsList.push({
					type: 'line',
					name: color,
					color: color,
					showSymbol: true,
					endLabel: {
						show: true,
						formatter: function (params) {
							return color + ': ' + params.value.toFixed(2);
						}
					},
					labelLayout: {
						moveOverlap: 'shiftY'
					},
					emphasis: {
						focus: 'series'
					},
					data: data,
					lineStyle: {
						type: 'solid',
						width: 4
					}
				});
			});
			
			
			const datasetWithFilters = [];
			const seriesList = [];
			
			echarts.util.each(config.SUBJECTS, (name, index) => {
				const datasetId = 'dataset_' + index;
				
				datasetWithFilters.push({
					id: datasetId,
					fromDatasetId: 'dataset_raw',
					transform: {
						type: 'filter',
						config: { dimension: 'Субъект РФ', '=': index }
					}
				});
				seriesList.push({
					_key: index,
					type: 'line',
					datasetId: datasetId,
					showSymbol: false,
					name: name,
					endLabel: {
						show: true,
						formatter: function (params) {
							return name + ': ' + params.value[0];
						}
					},
					labelLayout: {
						moveOverlap: 'shiftY'
					},
					emphasis: {
						focus: 'series'
					},
					encode: {
						x: 'Год',
						y: 'ОКС',
						label: ['Субъект РФ', 'ОКС'],
						itemName: 'Год',
						tooltip: ['ОКС']
					},
					lineStyle: {
						type: 'solid',
						width: 4
					}
				});
			});
			
			let option = {
				animationDuration: 3000,
				dataset: [
					{
						id: 'dataset_raw',
						source: config.VALUES
					},
					...datasetWithFilters
				],
				title: {
					text: config.NAME
				},
				tooltip: {
					order: 'valueDesc',
					trigger: 'axis'
				},
				toolbox: {
					show: true,
					feature: {
						dataView: { readOnly: false },
						restore: {},
						saveAsImage: {}
					}
				},
				xAxis: {
					type: 'category',
					boundaryGap: false,
					data: config.YEAR
				},
				yAxis: {
					name: 'ОКС'
				},
				grid: {
					left: 40,
					right: 220
				},
				series: groupsList
			};
			
			myChart.setOption(option);
			
			
			myChart.on('click', (params) => {
				
				if ('series' !== params.componentType) {
					return;
				}
				

					
				myChart.setOption(
					{
						xAxis: {
							type: 'category',
							nameLocation: 'middle'
						},
						series: seriesList.filter((item) => {
							return config.GROUPS_KEYS[params.seriesName].includes(item._key);
						})
					}, 
					{
						replaceMerge: ['xAxis', 'series']
					}
				);
			});
			
		}
	};
})();			
/*			
			
			const datasetWithFilters = [];
			const seriesList = [];
			
			echarts.util.each(config.SUBJECTS, (name, index) => {
				const datasetId = 'dataset_' + index;
				
				datasetWithFilters.push({
					id: datasetId,
					fromDatasetId: 'dataset_raw',
					transform: {
						type: 'filter',
						config: { dimension: 'Субъект РФ', '=': index }
					}
				});
				seriesList.push({
					type: 'line',
					datasetId: datasetId,
					showSymbol: false,
					name: name,
					endLabel: {
						show: true,
						formatter: function (params) {
							return name + ': ' + params.value[0];
						}
					},
					labelLayout: {
						moveOverlap: 'shiftY'
					},
					emphasis: {
						focus: 'series'
					},
					encode: {
						x: 'Год',
						y: 'ОКС',
						label: ['Субъект РФ', 'ОКС'],
						itemName: 'Год',
						tooltip: ['ОКС']
					}
				});
			});
			
			let option = {
				animationDuration: 5000,
				dataset: [
					{
						id: 'dataset_raw',
						source: config.VALUES
					},
					...datasetWithFilters
				],
				title: {
					text: config.NAME
				},
				tooltip: {
					axisPointer: {
						type: 'cross'
					}
				},
				toolbox: {
					show: true,
					feature: {
						dataView: { readOnly: false },
						restore: {}
					}
				},
				//color: config.COLORS,
				xAxis: {
					type: 'category',
					nameLocation: 'middle',
					data: config.YEAR
				},
				yAxis: {
					name: 'ОКС'
				},
				grid: {
					left: 40,
					right: 220
				},
				series: groupsList
			};
			
			myChart.setOption(option);
			
			
			myChart.on('click', (params) => {
				if ('series' !== params.componentType) {
					return;
				}
				
				console.log(params);
					
				myChart.setOption(
					{
						series: seriesList.slice(0, 2)
					}, 
					{
						replaceMerge: ['series']
					}
				);
			});
		}
	};
})();


/*function run(_rawData) {
  // var countries = ['Australia', 'Canada', 'China', 'Cuba', 'Finland', 'France', 'Germany', 'Iceland', 'India', 'Japan', 'North Korea', 'South Korea', 'New Zealand', 'Norway', 'Poland', 'Russia', 'Turkey', 'United Kingdom', 'United States'];
  const countries = [
    'Finland',
    'France',
    'Germany',
    'Iceland',
    'Norway',
    'Poland',
    'Russia',
    'United Kingdom'
  ];
  const datasetWithFilters = [];
  const seriesList = [];
  echarts.util.each(countries, function (country) {
    var datasetId = 'dataset_' + country;
    datasetWithFilters.push({
      id: datasetId,
      fromDatasetId: 'dataset_raw',
      transform: {
        type: 'filter',
        config: {
          and: [
            { dimension: 'Year', gte: 1950 },
            { dimension: 'Country', '=': country }
          ]
        }
      }
    });
    seriesList.push({
      type: 'line',
      datasetId: datasetId,
      showSymbol: false,
      name: country,
      endLabel: {
        show: true,
        formatter: function (params) {
          return params.value[3] + ': ' + params.value[0];
        }
      },
      labelLayout: {
        moveOverlap: 'shiftY'
      },
      emphasis: {
        focus: 'series'
      },
      encode: {
        x: 'Year',
        y: 'Income',
        label: ['Country', 'Income'],
        itemName: 'Year',
        tooltip: ['Income']
      }
    });
  });
  option = {
    animationDuration: 10000,
    dataset: [
      {
        id: 'dataset_raw',
        source: _rawData
      },
      ...datasetWithFilters
    ],
    title: {
      text: 'Income of Germany and France since 1950'
    },
    tooltip: {
      order: 'valueDesc',
      trigger: 'axis'
    },
    xAxis: {
      type: 'category',
      nameLocation: 'middle'
    },
    yAxis: {
      name: 'Income'
    },
    grid: {
      right: 140
    },
    series: seriesList
  };
  myChart.setOption(option);
}

/*    var myChart = echarts.init(document.getElementById("charts"));

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
});*/
(function(window)
{
   "use strict";

BX.Vue.create({ 
	el: '#calc',
	data: {
		ready: true,
		
		p01: 47.50, 	// Число штатных должностей врачей в целом по организации
		p02: 18.50, 	// Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях
		p03: 27.00, 	// Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях
		p04: 37.75, 	// Число занятых должностей врачей в целом по организации
		p05: 12.25, 	// Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях
		p06: 25.00, 	// Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях
		p07: 24,		// Число физических лиц врачей основных работников на занятых должностях всего
		p08: 7, 		// Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях
		p09: 19, 		// Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в стационарных условиях
		p10: 500000, 	// Численность обслуживаемого населения
		p11: 64.75, 	// Число штатных должностей среднего медицинского персонала (СМП) в целом по организации
		p12: 19.25, 	// Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях
		p13: 28.50, 	// Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях
		p14: 60.00, 	// Число занятых должностей среднего медицинского персонала (СМП) в целом по организации
		p15: 15.25, 	// Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях
		p16: 22.25, 	// Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях
		p17: 49, 		// Число физических лиц среднего медицинского персонала основных работников на занятых должностях всего
		p18: 12, 		// Число физических лиц среднего медицинского персонала основных работников амбулаторных
		p19: 12, 		// Число физических лиц среднего медицинского персонала основных работников в стационарных условиях
	},
	computed: {
		result01() {
			// Обеспеченность врачами всего
			return parseFloat(this.p07) / parseInt(this.p10) * 10000;
		},
		result02() {
			// Обеспеченность врачами в поликлинике
			return parseFloat(this.p08) / parseInt(this.p10) * 10000;
		},
		result03() {
			// Обеспеченность врачами в стационаре
			return parseFloat(this.p09) / parseInt(this.p10) * 10000;
		},
		result04() {
			// Укомплектованность занятыми ставками врачей всего
			return parseFloat(this.p04) / parseFloat(this.p01) * 100;
		},
		result05() {
			// Укомплектованность врачами в поликлинике
			return parseFloat(this.p05) / parseFloat(this.p02) * 100;
		},
		result06() {
			//  Укомплектованность врачами в стационаре
			return parseFloat(this.p06) / parseFloat(this.p03) * 100;
		},
		result07() {
			// Коэффициент совместительства врачей всего
			return parseFloat(this.p04) / parseInt(this.p07);
		},
		result08() {
			// Коэффициент совместительства врачей в поликлинике
			return parseFloat(this.p05) / parseInt(this.p08);
		},
		result09() {
			// Коэффициент совместительства врачей в стационаре
			return parseFloat(this.p06) / parseInt(this.p09);
		},
		result10() {
			// Обеспеченность СМП всего
			return parseInt(this.p17) / parseInt(this.p10) * 10000;
		},
		result11() {
			// Обеспеченность СМП в поликлинике
			return parseInt(this.p18) / parseInt(this.p10) * 10000;
		},
		result12() {
			// Обеспеченность СМП в стационаре
			return parseInt(this.p19) / parseInt(this.p10) * 10000;
		},
		result13() {
			// Укомплектованность СМП всего
			return parseFloat(this.p14) / parseFloat(this.p11) * 100;
		},
		result14() {
			// Укомплектованность СМП в поликлинике
			return parseFloat(this.p15) / parseFloat(this.p12) * 100;
		},
		result15() {
			// Укомплектованность СМП в стационаре
			return parseFloat(this.p16) / parseFloat(this.p13) * 100;
		},
		result16() {
			// Коэффициент совместительства СМП всего
			return parseFloat(this.p14) / parseInt(this.p17);
		},
		result17() {
			//  Коэффициент совместительства СМП в поликлинике
			return parseFloat(this.p15) / parseInt(this.p18);
		},
		result18() {
			// Коэффициент совместительства СМП в стационаре
			return parseFloat(this.p16) / parseInt(this.p19);
		},
		result04a() {
			// Укомплектованность физическими лицами врачей всего
			return parseInt(this.p07) / parseFloat(this.p01) * 100;
		},
		result05a() {
			// Укомплектованность физическими лицами врачей в поликлинике
			return parseInt(this.p08) / parseFloat(this.p02) * 100;
		},
		result06a() {
			// Укомплектованность физическими лицами врачей в стационаре
			return parseInt(this.p09) / parseFloat(this.p03) * 100;
		},
		result13a() {
			// Укомплектованность физическими лицами СМП всего
			return parseInt(this.p17) / parseFloat(this.p11) * 100;
		},
		result14a() {
			// Укомплектованность физическими лицами СМП в поликлинике
			return parseInt(this.p18) / parseFloat(this.p12) * 100;
		},
		result15a() {
			// Укомплектованность физическими лицами СМП в стационаре
			return parseInt(this.p19) / parseFloat(this.p13) * 100;
		},
	},
	methods: {
		resultDeviation(name, value) {
			if ('undefined' == typeof this.deviations[name]) {
				return false;
			}
			
			return this.deviations[name].find((element, index, array) => {
				return element.range[0] <= value && element.range[1] >= value;
			});
		},
		resultDeviationClass(name, value) {
			const deviation = this.resultDeviation(name, value);
			
			return deviation ? 'badge--'+deviation.scale : '';
		},
		resultDeviationText(name, value) {
			const deviation = this.resultDeviation(name, value);
			
			return deviation ? deviation.text : '';
		},
		displayResultValue(value) {
			return (0 < value) ? '+' + value : value;
		},
		
		resLoadPerOneMedicalPosition() {
			// Нагрузка на 1,0 занятую врачебную должность
			return {
				norm: this.normativeRecommended,
				actual: this.resultActualLoadOnePosition,
				deviation: this.resultLoadDeviationOnePositionYear
			};
		},
		resSharePreventiveVisits() {
			// Удельный вес профилактических посещений
			return {
				norm: this.normativeRecommended,
				actual: this.resultPreventiveVisitsYearEnd,
				deviation: this.resultSharePreventiveVisitsYearEnd
			};
		},
		resShareDiseaseVisits() {
			// Удельный вес посещений по заболеванию 
			return {
				norm: this.normativeRecommended,
				actual: this.resultDiseaseVisitsYearEnd,
				deviation: this.resultShareDiseaseVisitsYearEnd
			};
		},
		resShareHomeVisits() {
			// Удельный вес посещений на дому
			return {
				norm: this.normativeRecommended,
				actual: this.resultHomeVisitsYearEnd,
				deviation: this.resultShareHomeVisitsYearEnd
			};
		},
		resVisitsPerOneResidentYearEnd() {
			// Число посещений на 1 жителя
			return {
				norm: this.normativeRecommended,
				actual: this.resultActualVisitsYearEnd,
				deviation: this.resultVisitsPerOneResidentYearEnd
			};
		},
		
		openInfo(name) {
			let resultFn = this['res'+name] || false;
			
			if (resultFn) {
				this.$refs.info.open(name, resultFn());
			}
		},
		exportPdf() {
			const resultData = [];
			let postData = [];

			postData = {
				data: this.$data,
				result: resultData
			}

			let form = new FormData();
			form.append('type', 'staff');
			form.append('data', JSON.stringify(postData));

			let options = {
				method: 'post',
				body: form
			}

			fetch('https://www.orgzdrav.com/bitrix/services/main/ajax.php?mode=class&c=orgzdrav%3Acalc.pdf&action=importPdf', options)
				.then( res => res.blob() )
				.then( blob => {
					var file = window.URL.createObjectURL(blob);
					window.location.assign(file);
				});
		},
		exportData() {
			return {
				name: this.name
			};
		}
	}
});

})(window);

$(function() {
	$('#calc').on('click', '.js-control-help', function(e) { e.preventDefault() })
	
	tippy.delegate('#calc', {
		target: 'a.js-control-help',
		interactive: false,
		arrow: true,
		placement: 'right',
		onShow(instance) {
			instance.setContent(instance.reference.title);
		}
	});
});
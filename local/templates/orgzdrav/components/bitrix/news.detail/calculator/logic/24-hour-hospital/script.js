(function(window)
{
   "use strict";

BX.Vue.component('calc-info', 
{
	data() {
		return {
			active: false,
			result: null,
			name: null
		}
    },
	methods: {
		open: function(name, result) {
			this.name = name;
			this.result = result;
			
			this.active = true;
			
			$('html').addClass('u-clipped');
		},
		close: function() {
			this.active = false;
			
			$('html').removeClass('u-clipped');
		}
	},
    template: `
		<div class="modal modal--md" :class="{ 'modal--active': active }">
			<div class="modal__dialog">
				<calc-result-2 :name="name" :res="result" v-if="result" />
				<button class="btn btn--big btn--block" @click="close">Понятно</button>
			</div>
		</div>
	`
});

BX.Vue.component('calc-result', 
{
	props: {
		'name': {
			type: String,
			required: true
		},
		'norm': {
			type: Number,
			default: 0
		},
		'actual': {
			type: Number,
			required: true,
			default: 0
		},
		'deviation': {
			type: Number,
			required: true,
			default: 0
		},
		'digits': {
			type: Number,
			default: 1
		},
		'pct': {
			type: Boolean,
			default: true
		}
	},
	data() {
		return {
			title: '',
			description: '',
			suffix: 'default',
			numb: 0
		}
    },
	computed: {
		displayDeviation() {
			return ((0 < this.deviation) ? '+' : '') + this.deviation.toFixed(this.digits) + (this.pct ? '%' : '');
		}
	},
	watch: {
		deviation: {
			immediate: true,
			handler () {
				const deviation = this.resultDeviation();
				
				this.description = deviation ? deviation.text : '';
				this.suffix = deviation ? deviation.scale : 'default';
				
				let min = Math.min(this.actual, this.norm);
				for (let i = 1; i < 10000; i *= 10) {
					if (min < i) {
						this.numb = i;
						break;
					}
				}
			}
		}
	},
	methods: {
		resultDeviation() {
			if ('undefined' == typeof this.$parent.deviations[this.name]) {
				return false;
			}
			
			return this.$parent.deviations[this.name].find((element, index, array) => {
				return element.range[0] <= this.deviation && element.range[1] >= this.deviation;
			});
		},
		displayWidth(value) {
			return (0 >= value) ? 0 : (value / this.numb * 100)+'%';
		},
		displayValue(value) {
			return value.toFixed(this.digits);
		},
		
		exportData() {
			return {
				name: this.name,
				norm: this.norm,
				actual: this.actual.toFixed(2),
				description: this.description,
				deviation: this.deviation.toFixed(2),
				digits: this.digits,
				pct: this.pct
			};
		}
	},
	mounted() {
		this.title = this.$parent.titles[this.name];
	},
    template: `
		<div>
			<div class="block block--line">
				<h5 v-text="title"></h5>
				<div class="text-right">
					<span class="badge" :class="'badge--'+suffix" v-text="displayDeviation"></span>
					<span class="explanation">Отклонение</span>
				</div>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Фактическое значение</div>
					<div class="progress" :class="'progress--'+suffix">
						<div class="progress__bar" role="progressbar" :style="{ width: displayWidth(actual) }"></div>
					</div>
					<div class="value-line__value" v-text="displayValue(actual)"></div>
				</div>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Норматив</div>
					<div class="progress">
						<div class="progress__bar" role="progressbar" :style="{ width: displayWidth(norm) }"></div>
					</div>
					<div class="value-line__value" v-text="displayValue(norm)"></div>
				</div>
			</div>
			<div class="block block--separate content pt-24 pb-24">
				<h5 class="mb-12">Рекомендации</h5>
				<div v-html="description"></div>
			</div>
		</div>
	`
});

BX.Vue.component('calc-result-2', 
{
	props: {
		'name': {
			type: String,
			required: true
		},
		'res': {
			type: Object,
			required: true
		},
		'digits': {
			type: Number,
			default: 1
		},
		'pct': {
			type: Boolean,
			default: true
		}
	},
	data() {
		return {
			title: '',
			description: '',
			suffix: 'default',
			numb: 0
		}
    },
	computed: {
		displayDeviation() {
			return ((0 < this.res.deviation) ? '+' : '') + this.res.deviation.toFixed(this.digits) + (this.pct ? '%' : '');
		}
	},
	watch: {
		deviation: {
			immediate: true,
			handler () {
				const deviation = this.resultDeviation();
				
				this.description = deviation ? deviation.text : '';
				this.suffix = deviation ? deviation.scale : 'default';
				
				let min = Math.min(this.res.actual, this.res.norm);
				for (let i = 1; i < 10000; i *= 10) {
					if (min < i) {
						this.numb = i;
						break;
					}
				}
			}
		}
	},
	methods: {
		resultDeviation() {
			if ('undefined' == typeof this.$parent.deviations[this.name]) {
				return false;
			}
			
			return this.$parent.deviations[this.name].find((element, index, array) => {
				return element.range[0] <= this.res.deviation && element.range[1] >= this.res.deviation;
			});
		},
		displayWidth(value) {
			return (0 >= value) ? 0 : (value / this.numb * 100)+'%';
		},
		displayValue(value) {
			return value.toFixed(this.digits);
		},
		exportData() {
			return {
				name: this.name
			};
		}
	},
	mounted() {
		this.title = this.$parent.titles[this.name];
	},
    template: `
<div>
	<div class="block block--line">
		<h5 v-text="title"></h5>
		<div class="text-right">
			<span class="badge" :class="'badge--'+suffix" v-text="displayDeviation"></span>
			<span class="explanation">Отклонение</span>
		</div>
	</div>
	<div class="block block--separate">
		<div class="value-line">
			<div class="value-line__label">Фактическое значение</div>
			<div class="progress" :class="'progress--'+suffix">
				<div class="progress__bar" role="progressbar" :style="{ width: displayWidth(res.actual) }"></div>
			</div>
			<div class="value-line__value" v-text="displayValue(res.actual)"></div>
		</div>
	</div>
	<div class="block block--separate">
		<div class="value-line">
			<div class="value-line__label">Норматив</div>
			<div class="progress">
				<div class="progress__bar" role="progressbar" :style="{ width: displayWidth(res.norm) }"></div>
			</div>
			<div class="value-line__value" v-text="displayValue(res.norm)"></div>
		</div>
	</div>
	<div class="block block--separate content pt-24 pb-24">
		<h5 class="mb-12">Рекомендации</h5>
		<div v-html="description"></div>
	</div>
</div>
	`
});

BX.Vue.create({ 
	el: '#calc',
	data: {
		ready: false,
		
		titles: {},
		normative: [],
		normativeSelected: 6,
		
		deviations: {},
		
		monthStart: 0,
		monthEnd: 11,
		monthList: [
			'Январь',
			'Февраль',
			'Март',
			'Апрель',
			'Май',
			'Июнь',
			'Июль',
			'Август',
			'Сентябрь',
			'Октябрь',
			'Ноябрь',
			'Декабрь'
		],
		
		actual: 15, 						 // Фактическое число коек по профилю 
		averageAnnual: 13, 					 // Среднегодовое число коек
		patients: 208, 						 // Число поступивших больных 
		dischargedPatients: 218, 			 // Число выписанных больных (живыми) 
		diedPatients: 1, 					 // Число умерших в стационаре
		patientsBedDays: 2528, 				 // Проведено пациентами койко-дней 
		renovations: 0, 					 // Койко-дни, закрытия на ремонт 
		population: 500000, 				 // Численность обслуживаемого населения 
		completedHospitalizations: 360, 	 // Количество законченных случаев госпитализации по профилю
		dischargedPatientsPreviousYear: 510, // Число выписанных живыми за предыдущий год 
		diedPatientsPreviousYear: 1, 		 // Число умерших в стационаре за предыдущий год 
	},
	computed: {
		monthCount() {
			return 1 + (this.monthEnd - this.monthStart);
		},
		
		normativeDays() {
			return this.normative[this.normativeSelected] ? parseInt(this.normative[this.normativeSelected].days) : 0;
		},
		normativeTreatment() {
			return this.normative[this.normativeSelected] ? parseFloat(this.normative[this.normativeSelected].treatment) : 0;
		},
		
		resultBedDays() {
			// Формула расчета количества койко-дней на конец года
			return parseInt(this.patientsBedDays) / parseInt(this.monthCount) * 12;
		},
		resultBedOccupancy() {
			// Формула расчета занятости койки за год (работа койки)
			return this.resultBedDays / parseInt(this.averageAnnual);
		},
		resultAveragePatientStay() {
			// Формула расчета Средние сроки пребывания больного на койке
			return parseInt(this.patientsBedDays) / ((parseInt(this.patients) + parseInt(this.dischargedPatients) + parseInt(this.diedPatients)) / 2);
		},
		resultDischargedPatients() {
			// Формула расчета количества выписанных больных на конец года
			return parseInt(this.dischargedPatients) / parseInt(this.monthCount) * 12;
		},
		resultDiedPatients() {
			// Формула расчета количества умерших больных на конец года
			return parseInt(this.diedPatients) / parseInt(this.monthCount) * 12;
		},
		resultHospitalMortality() {
			// Формула расчета больничной летальности на конец года
			return (this.resultDiedPatients / (this.resultDiedPatients + this.resultDischargedPatients)) * 100;
		},
		resultHospitalMortalityPreviousYear() {
			// Формула расчета больничной летальности в прошлом году
			return parseInt(this.diedPatientsPreviousYear) / (parseInt(this.diedPatientsPreviousYear) + parseInt(this.dischargedPatientsPreviousYear)) * 100;
		},
		resultHospitalizationRate() {
			// Формула расчета Уровень госпитализаций на конец года
			return (parseInt(this.patients) / parseInt(this.monthCount) * 12) / parseInt(this.population) * 1000;
		},
		resultCompletedHospitalizations() {
			// Формула расчета Количество законченных случаев госпитализации по профилю
			return parseInt(this.completedHospitalizations) / parseInt(this.population) * 1000;
		},
		resultBedsWorkedAccordanceStandard() {
			// Формула расчета количества коек отработавших согласно нормативу работы койки
			return this.resultBedDays / this.normativeDays;
		},
		
		resultDeviationBedOccupancy() {
			// Формула расчета отклонения Занятости койки за год (работа койки) от норматива
			return this.resultBedOccupancy / this.normativeDays * 100 - 100;
		},
		resultDeviationAveragePatientStay() {
			// Формула расчета отклонения Средние сроки пребывания больного на койке от норматива
			return this.resultAveragePatientStay / this.normativeTreatment * 100 - 100;
		},
		resultDeviationHospitalMortality() {
			// Формула расчета отклонения Больничная летальность от Больничная летальность прошлого года
			return this.resultHospitalMortality / this.resultHospitalMortalityPreviousYear * 100 - 100;
		},
		resultDeviationHospitalizationsLevel() {
			// Формула расчета отклонения Уровень госпитализаций на конец отчетного года от Количество законченных случаев госпитализации по профилю
			return this.resultHospitalizationRate / this.resultCompletedHospitalizations * 100 - 100;
		},
		resultDeviationHospitalUnsecuredBeds() {
			// Формула расчета количества коек, необеспеченных госпитализациями на конец отчетного года
			return Math.ceil(parseInt(this.averageAnnual) - this.resultBedsWorkedAccordanceStandard);
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
		
		resBedOccupancy() {
			return {
				norm: this.normativeDays,
				actual: this.resultBedOccupancy,
				deviation: this.resultDeviationBedOccupancy
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

			Object.keys(this.$refs).forEach(key => {
				if (0 !== key.indexOf('calc_result')) {
					return;
				}
				resultData.push(this.$refs[key].exportData());
			});

			// BX.post
			postData = {
				data: this.$data,
				result: resultData
			}

			let form = new FormData();
			form.append('type', '24-hour-hospital');
			form.append('data', JSON.stringify(postData));

			let options = {
				method: 'post',
				body: form
			}

			fetch('https://www.orgzdrav.com/bitrix/services/main/ajax.php?mode=class&c=orgzdrav%3Acalc.pdf&action=importPdf', options)
				.then( res => res.blob() )
				.then( blob => {
					var file = window.URL.createObjectURL(blob);
					window.open(file, '_blank');
				});
		}
	},
	mounted()
    {
		fetch('/local/templates/orgzdrav/components/bitrix/news/calculator/bitrix/news.detail/.default/logic/24-hour-hospital/config.json')
			.then((response) => response.json())
			.then((data) => {
				this.titles = data.titles;
				this.normative = data.normative;
				this.deviations = data.deviations;
				
				this.ready = true;
			});
			
		this.monthEnd = (new Date()).getMonth();


    }
});

})(window);

$(function() {
	$('#calc').on('click', '.js-control-help', function(e) { e.preventDefault() })
	
	tippy.delegate('#calc', {
		target: 'a.js-control-help',
		allowHTML: true,
		interactive: false,
		arrow: false,
		maxWidth: '800px',
		theme: 'orgzdrav',
		placement: 'top',
		offset: 0,
		popperOptions: { 
			positionFixed: true 
		},
		onShow(instance) {
			instance.setContent('<img src="'+instance.reference.href+'" alt="" />');
		}
	});
});
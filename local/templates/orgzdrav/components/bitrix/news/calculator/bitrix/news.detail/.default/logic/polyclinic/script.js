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
		normativeSelected: 1,
		
		deviations: {},
		
		monthStart: 0,
		monthEnd: 7,
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
		
		actualPolyclinic: 14851, 			 // Фактическое число посещений по профилю в поликлинике
		actualHome: 3684, 					 // Фактическое число посещений по профилю на дому
		occupiedPositions: 6.75, 			 // Количество занятых должностей по специальности
		preventiveVisitsPolyclinic: 2222, 	 // Количество посещений с профилактической целью в поликлинике
		diseaseVisitsPolyclinic: 12629,		 // Количество посещений по заболеванию в поликлинике
		diseaseVisitsHome: 3127,			 // Количество посещений по заболеванию на дому
		population: 500000, 				 // Численность обслуживаемого населения 
	},
	computed: {
		monthCount() {
			return 1 + (this.monthEnd - this.monthStart);
		},
		
		normativeRecommended() {
			return this.normative[this.normativeSelected] ? parseInt(this.normative[this.normativeSelected].recommended) : 0;
		},
		
		preventiveVisitsHome() {
			// Количество посещений с профилактической целью на дому
			return parseInt(this.actualHome) - parseInt(this.diseaseVisitsHome);
		},
		
		resultActualVisitsYearEnd() {
			// Формула расчета количества посещений на конец года
			return (parseInt(this.actualPolyclinic) + parseInt(this.actualHome)) / parseInt(this.monthCount) * 12;
		},
		resultActualLoadOnePosition() {
			// Формула расчета фактической нагрузки на 1,0 занятую врачебную должность
			return this.resultActualVisitsYearEnd / parseFloat(this.occupiedPositions);
		},
		resultLoadDeviationOnePositionYear() {
			// Формула расчета отклонения нагрузки на 1,0 занятую врачебную должность за год от норматива
			return (this.resultActualLoadOnePosition / this.normativeRecommended) * 100 - 100;
		},
		resultPreventiveVisitsYearEnd() {
			// Формула расчета количества профилактических посещений на конец года
			return (parseInt(this.preventiveVisitsPolyclinic) + this.preventiveVisitsHome) / parseInt(this.monthCount) * 12;
		},
		resultSharePreventiveVisitsYearEnd() {
			// Формула расчета доли профилактических посещений на конец года
			return this.resultPreventiveVisitsYearEnd / this.resultActualVisitsYearEnd  * 100;
		},
		resultDiseaseVisitsYearEnd() {
			// Формула расчета количества посещений по заболеванию на конец года
			return (parseInt(this.diseaseVisitsPolyclinic) + parseInt(this.diseaseVisitsHome)) / parseInt(this.monthCount) * 12;
		},
		resultShareDiseaseVisitsYearEnd() {
			// Формула расчета доли посещений по заболеванию на конец года
			return this.resultDiseaseVisitsYearEnd / this.resultActualVisitsYearEnd  * 100;
		},
		resultHomeVisitsYearEnd() {
			// Формула расчета количества посещений на дому на конец года
			return parseInt(this.actualHome) / parseInt(this.monthCount) * 12;
		},
		resultShareHomeVisitsYearEnd() {
			// Формула расчета доли посещений на дому на конец года
			return this.resultHomeVisitsYearEnd / this.resultActualVisitsYearEnd * 100;
		},
		resultVisitsPerOneResidentYearEnd() {
			// Формула расчета количества посещений на 1 жителя на конец года
			return this.resultActualVisitsYearEnd / parseInt(this.population);
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
		}
	},
	mounted()
    {
		fetch('/local/templates/orgzdrav/components/bitrix/news/calculator/bitrix/news.detail/.default/logic/polyclinic/config.json')
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
		interactive: false,
		arrow: true,
		placement: 'right',
		onShow(instance) {
			instance.setContent(instance.reference.title);
		}
	});
});
<div class="grid">
	<div class="grid__column">
		<h3>Исходные данные</h3>
		<div class="card">
			<h5>Профиль специальности</h5>
			<div class="control control--select">
				<select v-model="normativeSelected">
					<option v-for="(item, index) in normative" :key="index" :value="index" :selected="index == normativeSelected">{{ item.name }}</option>
				</select>
			</div>
			
			<h5>Период</h5>
			<div class="grid grid--range">
				<div class="grid__column">
					<div class="control control--select">
						<select v-model="monthStart">
							<option v-for="(item, index) in monthList" :key="index" :value="index" :disabled="index > monthEnd" :selected="index == monthStart">{{ item }}</option>
						</select>
					</div>
				</div>
				<div class="grid__column">
					<div class="control control--select">
						<select v-model="monthEnd">
							<option v-for="(item, index) in monthList" :key="index" :value="index" :disabled="index < monthStart" :selected="index == monthEnd">{{ item }}</option>
						</select>
					</div>
				</div>
			</div>

			<h5>Показатели</h5>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Фактическое число посещений по профилю в поликлинике</label>
				<div class="control">
					<input type="text" v-model="actualPolyclinic" />
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Фактическое число посещений по профилю на дому</label>
				<div class="control">
					<input type="text" v-model="actualHome">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество занятых должностей по специальности</label>
				<div class="control">
					<input type="text" v-model="occupiedPositions">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество посещений с профилактической целью в поликлинике</label>
				<div class="control">
					<input type="text" v-model="preventiveVisitsPolyclinic">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество посещений по заболеванию в поликлинике</label>
				<div class="control">
					<input type="text" v-model="diseaseVisitsPolyclinic">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество посещений по заболеванию на дому</label>
				<div class="control">
					<input type="text" v-model="diseaseVisitsHome">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Численность обслуживаемого населения</label>
				<div class="control">
					<input type="text" v-model="population">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Число рассчитывается автоматически">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество посещений с профилактической целью на дому</label>
				<div class="control">
					<input type="text" v-model="preventiveVisitsHome" disabled>
				</div>
			</div>
		</div>
	</div>
				
	<div class="grid__column" v-if="ready">
		<h3>Результаты</h3>
		
		<div class="card card--action">
			<calc-result-2 ref="calc_result1" name="LoadPerOneMedicalPosition" :res="resLoadPerOneMedicalPosition()"></calc-result-2>
			
			<?/*<div class="block block--separate text-center">
				<a href="#" class="link" @click.prevent="openInfo('LoadPerOneMedicalPosition')">Смотреть рекомендации</a>
			</div>*/?>
		</div>
		
		<div class="card card--action">
			<calc-result-2 ref="calc_result2"  name="SharePreventiveVisits" :res="resSharePreventiveVisits()"></calc-result-2>
			
			<?/*<div class="block block--separate text-center">
				<a href="#" class="link" @click.prevent="openInfo('SharePreventiveVisits')">Смотреть рекомендации</a>
			</div>*/?>
		</div>
		
		<div class="card card--action">
			<calc-result-2 ref="calc_result3"  name="ShareDiseaseVisits" :res="resShareDiseaseVisits()"></calc-result-2>
			
			<?/*<div class="block block--separate text-center">
				<a href="#" class="link" @click.prevent="openInfo('ShareDiseaseVisits')">Смотреть рекомендации</a>
			</div>*/?>
		</div>
		
		<div class="card card--action">
			<calc-result-2 ref="calc_result4"  name="ShareHomeVisits" :res="resShareHomeVisits()"></calc-result-2>
			
			<?/*<div class="block block--separate text-center">
				<a href="#" class="link" @click.prevent="openInfo('ShareHomeVisits')">Смотреть рекомендации</a>
			</div>*/?>
		</div>
		
		<div class="card card--action">
			<calc-result-2 ref="calc_result5"  name="VisitsPerOneResidentYearEnd" :res="resVisitsPerOneResidentYearEnd()"></calc-result-2>
			
			<?/*<div class="block block--separate text-center">
				<a href="#" class="link" @click.prevent="openInfo('VisitsPerOneResidentYearEnd')">Смотреть рекомендации</a>
			</div>*/?>
		</div>
		

		<div class="card card--slim theme-green">
			<div class="flex-line--split">
				<h5>Сохранить результаты</h5>
<!--				<button class="btn btn--small btn--icon btn--dense-white"><i class="icon icon--md-printer"></i> Распечатать</button>-->
				<button id="importt" class="btn btn--small btn--icon btn--dense-white" @click="exportPdf">
                    <i class="icon icon--md-file"></i> Скачать в PDF</button>
			</div>
		</div>
	</div>
</div>
<calc-info ref="info" />
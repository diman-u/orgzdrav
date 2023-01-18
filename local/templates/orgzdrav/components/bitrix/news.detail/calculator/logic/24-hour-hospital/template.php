<div class="grid">
	<div class="grid__column">
		<h3>Исходные данные</h3>
		<div class="card">
			<h5>Профиль койки</h5>
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
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Фактическое число коек по профилю</label>
				<div class="control">
					<input type="text" v-model="actual" />
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Среднегодовое число коек</label>
				<div class="control">
					<input type="text" v-model="averageAnnual">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число поступивших больных</label>
				<div class="control">
					<input type="text" v-model="patients">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число выписанных живыми за предыдущий год</label>
				<div class="control">
					<input type="text" v-model="dischargedPatients">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число умерших в стационаре</label>
				<div class="control">
					<input type="text" v-model="diedPatients">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Проведено пациентами койко-дней</label>
				<div class="control">
					<input type="text" v-model="patientsBedDays">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Койко-дни, закрытия на ремонт</label>
				<div class="control">
					<input type="text" v-model="renovations">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Численность обслуживаемого населения</label>
				<div class="control">
					<input type="text" v-model="population">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2020.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Количество законченных случаев госпитализации по профилю</label>
				<div class="control">
					<input type="text" v-model="completedHospitalizations">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2019.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число выписанных живыми за предыдущий год</label>
				<div class="control">
					<input type="text" v-model="dischargedPatientsPreviousYear">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="/images/calculator/24-hour-hospital/F016_2019.jpg" class="js-control-help">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число умерших в стационаре за предыдущий год</label>
				<div class="control">
					<input type="text" v-model="diedPatientsPreviousYear">
				</div>
			</div>
		</div>
	</div>
				
	<div class="grid__column" v-if="ready">
		<h3>Результаты</h3>
		
		<div class="card card--action">
			<calc-result ref="calc_result1" name="BedOccupancy" :norm="normativeDays" :actual="resultBedOccupancy" :deviation="resultDeviationBedOccupancy"></calc-result>
		</div>

		<div class="card card--action">
			<calc-result ref="calc_result2" name="AveragePatientStay" :norm="normativeTreatment" :actual="resultAveragePatientStay" :deviation="resultDeviationAveragePatientStay"></calc-result>
		</div>
		<div class="card card--action">
			<calc-result ref="calc_result3" name="HospitalMortality" :norm="resultHospitalMortalityPreviousYear" :actual="resultHospitalMortality" :deviation="resultDeviationHospitalMortality"></calc-result>
		</div>
		<div class="card card--action">
			<calc-result ref="calc_result4" name="HospitalizationsLevel" :norm="resultCompletedHospitalizations" :actual="resultHospitalizationRate" :deviation="resultDeviationHospitalizationsLevel"></calc-result>
		</div>
		<div class="card card--action">
			<calc-result ref="calc_result5" name="HospitalUnsecuredBeds" :actual="resultDeviationHospitalUnsecuredBeds" :deviation="resultDeviationHospitalUnsecuredBeds" :digits="0" :pct="false"></calc-result>
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
<div class="grid">
	<div class="grid__column">
		<h3>Исходные данные</h3>
		<div class="card">
			<h5>Показатели</h5>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей врачей в целом по организации</label>
				<div class="control">
					<input type="text" v-model="p01" />
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p02">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p03">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей врачей в целом по организации</label>
				<div class="control">
					<input type="text" v-model="p04">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="ЕЕдиница измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p05">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p06">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Число физических лиц врачей основных работников на занятых должностях всего">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Численность обслуживаемого населения</label>
				<div class="control">
					<input type="text" v-model="p07">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p08">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p09">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Численность обслуживаемого населения</label>
				<div class="control">
					<input type="text" v-model="p10">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей среднего медицинского персонала (СМП) в целом по организации</label>
				<div class="control">
					<input type="text" v-model="p11">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p12">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p13">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей среднего медицинского персонала (СМП) в целом по организации</label>
				<div class="control">
					<input type="text" v-model="p14">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p15">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (две сотых 0,25; 0,50; 0,75; 1,00)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p16">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число физических лиц среднего медицинского персонала основных работников на занятых должностях всего</label>
				<div class="control">
					<input type="text" v-model="p17">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число физических лиц среднего медицинского персонала основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</label>
				<div class="control">
					<input type="text" v-model="p18">
				</div>
			</div>
			<div class="field-horizontal">
				<a href="#" class="js-control-help" title="Единица измерения: абсолютное число (целое)">
					<span class="icon icon--gray icon--md-info"></span>
				</a>
				<label>Число физических лиц среднего медицинского персонала основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в стационарных условиях</label>
				<div class="control">
					<input type="text" v-model="p19">
				</div>
			</div>
		</div>
	</div>
				
	<div class="grid__column" v-if="ready">
		<h3>Результаты</h3>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность врачами всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result01.toFixed(2)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность врачами в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result02.toFixed(2)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность врачами в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result03.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность занятыми ставками врачей всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result04.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность врачами в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result05.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность врачами в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result06.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства врачей всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result07.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства врачей в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result08.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства врачей в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result09.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность СМП всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result10.toFixed(2)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность СМП в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result11.toFixed(2)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Обеспеченность СМП в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result12.toFixed(2)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность СМП всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result13.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность СМП в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result14.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность СМП в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result15.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства СМП всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result16.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства СМП в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result17.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Коэффициент совместительства СМП в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result18.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами врачей всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result04a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами врачей в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result05a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами врачей в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result06a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами СМП всего</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result13a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами СМП в поликлинике</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result14a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
		<div class="card card--action">
			<div class="block block--line">
				<h5>Укомплектованность физическими лицами СМП в стационаре</h5>
			</div>
			<div class="block block--separate">
				<div class="value-line">
					<div class="value-line__label">Результат</div>
					<div class="progress progress--success">
						<div class="progress__bar" role="progressbar" style="width:100%"></div>
					</div>
					<div class="value-line__value" v-text="result15a.toFixed(1)"></div>
				</div>
			</div>
		</div>
		
                    
		<?/*<div class="card card--slim theme-green">
			<div class="flex-line">
				<h5>Сохранить результаты</h5>
				<button class="btn btn--small btn--icon btn--dense-white"><i class="icon icon--md-printer"></i> Распечатать</button>
				<button id="importt" class="btn btn--small btn--icon btn--dense-white">
                    <i class="icon icon--md-file"></i> Скачать в PDF</button>
			</div>
		</div>*/?>
	</div>
</div>
<calc-info ref="info" />
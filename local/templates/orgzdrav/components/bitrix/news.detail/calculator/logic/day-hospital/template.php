<div class="grid">
    <div class="grid__column">
        <h3>Исходные данные</h3>
        <div class="card">
            <h5>Профиль специальности</h5>
            <div class="control control--select">
                <select>
                    <option>приложение 1</option>
                    <option>графа 1 "Профиль"</option>
                </select>
            </div>

            <h5>Период</h5>
            <div class="grid grid--range">
                <div class="grid__column">
                    <div class="control control--select">
                        <select v-model="monthStart">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="grid__column">
                    <div class="control control--select">
                        <select v-model="monthEnd">
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>

            <h5>Показатели</h5>
            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Фактическое число посещений по профилю в поликлинике</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Фактическое число посещений по профилю на дому</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Количество занятых должностей по специальности</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Количество посещений с профилактической целью в поликлинике</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Количество посещений по заболеванию в поликлинике</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Количество посещений по заболеванию на дому</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Численность обслуживаемого населения </label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

            <div class="field-horizontal">
                <a href="#">
                    <span class="icon icon--gray icon--md-info"></span>
                </a>
                <label>Количество посещений с профилактической целью на дому</label>
                <div class="control">
                    <input type="text" value="1" />
                </div>
            </div>

        </div>
    </div>

    <div class="grid__column">
        <h3>Результаты</h3>
    </div>
</div>
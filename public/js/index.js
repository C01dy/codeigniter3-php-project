$(document).ready(function () {
	// Получить все записи на страницу
	getAllEntries();

	// Применить фильтрацию при вводе данных в форму
	$("#filter-form input").on(
		"keyup",
		_.debounce(function () {
			const formattedDataToSend = formatObjectKeysToCamel(
				getSerializedFormData("#filter-form"),
				"-"
			);
			getAllEntries(formattedDataToSend);
		}, 300)
	);

	// Добавление новой записи в реестр
	$("#add-form").on("submit", function (e) {
		e.preventDefault();
		const formattedDataToSend = formatObjectKeysToCamel(
			getSerializedFormData("#add-form"),
			"-"
		);

		addEntry(formattedDataToSend);
	});

	// Обновление записи в реестре
	$("#edit-form").on("submit", function (e) {
		e.preventDefault();
		const formattedDataToSend = formatObjectKeysToCamel(
			getSerializedFormData("#edit-form"),
			"-"
		);

		editEntryInfo(formattedDataToSend);
	});

	// Загрузка файла excel с таблией
	$("#import-excel-table-btn").on("click", function () {
		downloadExcelTable();
	});

	// Экспорт таблицы excel
	$("#export-excel-form").on("submit", function (e) {
		// e.preventDefault();
		exportExcelTable();
	});
});

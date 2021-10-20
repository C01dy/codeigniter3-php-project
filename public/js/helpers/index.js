// Очистка полей для ввода в форме пойска
function clearFilter() {
	$("#filter-form input").val("");
	getAllEntries();
}

// Передача данных в форму
function passDataToEditForm(
	smp,
	supervisoryAuthority,
	dateFrom,
	dateTo,
	plannedDuration,
	id
) {
	$("#editEntryModal")
		.find("#edintEntryLabel")
		.text(`Изменить информацию записи с номером ${id}`);
	$("#edit-form").find("#smp").val(smp);
	$("#edit-form").find("#date-from").val(dateFrom);
	$("#edit-form").find("#date-to").val(dateTo);
	$("#edit-form").find("#planned-duration").val(plannedDuration);
	$("#edit-form").find("#entry-id").val(id);
}

// Сериализация данных из формы из JSON в js объект
function getSerializedFormData(targetForm) {
	let formDataArray = [];
	$(targetForm)
		.serializeArray()
		.forEach(({ name, value }) => {
			formDataArray.push([name, value]);
		});

	const formDataObj = Object.fromEntries(formDataArray);
	return formDataObj;
}

// Форматирует ключи из foo_bar -> fooBar
function formatObjectKeysToCamel(obj, splitSym) {
	return Object.fromEntries(
		Object.entries(obj).map(([key, value]) => {
			return [
				key
					.split(splitSym)
					.map((el, idx) =>
						idx !== 0 ? el[0].toUpperCase() + el.slice(1) : el
					)
					.join(""),
				value,
			];
		})
	);
}

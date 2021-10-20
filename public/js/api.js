const ROOT_URL = "http://localhost/registry";

// Сброс фильтров при клике на кнопку
$("#clear-filter-btn").on("click", function (e) {
	e.preventDefault();
	clearFilter();
});

// Получить записи из реестра
function getAllEntries(dataObj = {}) {
	$.ajax({
		type: "GET",
		url: ROOT_URL + "/get_all_entries",
		data: {
			smp: dataObj.smp,
			supervisory_authority: dataObj.supervisoryAuthority,
			date_from: dataObj.dateFrom,
			date_to: dataObj.dateTo,
		},
		success: function (data) {
			if (Object.entries(dataObj).length) {
				$("#registry-table").find("tbody").empty();
			}
			data.forEach((el) => {
				$("#registry-table").find("tbody").append(`
              <tr>
                  <th class="text-center" scope="row">${el.id}</th>
                  <td>${el.smp}</td>
                  <td>${el.supervisory_authority}</td>
                  <td>${el.date_from} &#8211; ${el.date_to}</td>
                  <td>${el.planned_duration}</td>
                  <td>
                  	<div class="d-flex justify-content-center">
                         <button 
						  onclick="passDataToEditForm(
                              &quot;${el.smp}&quot;, 
                              &quot;${el.supervisory_authority}&quot;, 
                              &quot;${el.date_from}&quot;, 
                              &quot;${el.date_to}&quot;, 
                              ${el.planned_duration},
                              ${el.id})" 
						  title="Редактировать" 
						  data-toggle="modal" 
						  data-target="#editEntryModal" 
						  type="button" 
						  class="btn btn-secondary btn-sm text-center text-light mr-1"
                      >
                          <i class="fas fa-edit"></i>
                      </button>	
                      <button onclick="onRemoveEntry(${el.id})" data-toggle="modal" data-target="#deleteEntryModal" title="Удалить" type="button" class="btn btn-danger btn-sm text-center delete-btn">
                          <i class="fas fa-trash-alt"></i>
                      </button>
					</div>
                  </td>
              </tr>
          `);
			});
		},
		complete: function () {
			$("#registry-table").find("#table-loader").hide();
		},
	});
}

// Функция для обработки события удаления в модальном окне
function onRemoveEntry(id) {
	$("#modal-delete-btn").on("click", function (e) {
		removeEntry(id);
	});

	$("#modal-delete-body")
		.find("p")
		.replaceWith(
			`<p>Вы действительно хотите удалить запись с номером ${id}?</p>`
		);
}

// Добавить новую запись в таблицу
function addEntry({
	smp,
	supervisoryAuthority,
	dateFrom,
	dateTo,
	plannedDuration,
}) {
	$.ajax({
		type: "POST",
		url: ROOT_URL + "/add_entry",
		data: {
			smp,
			supervisory_authority: supervisoryAuthority,
			date_from: dateFrom,
			date_to: dateTo,
			planned_duration: plannedDuration,
		},
		success: function () {
			window.location.reload();
		},
		error: function (error) {
			$("body").append(`
        <div class="alert alert-danger right position-absolute fixed-bottom ml-auto mr-3 w-25" role="alert">
          A simple danger alert—check it out!
        </div>`);
		},
	});
}

// Редактировать запись в реестре
function editEntryInfo({
	entryId,
	smp,
	supervisoryAuthority,
	dateFrom,
	dateTo,
	plannedDuration,
}) {
	$.ajax({
		type: "POST",
		url: ROOT_URL + "/update_entry_info/" + entryId,
		data: {
			smp,
			supervisory_authority: supervisoryAuthority,
			date_from: dateFrom,
			date_to: dateTo,
			planned_duration: +plannedDuration,
		},
		success: function (data) {
			window.location.reload();
		},
	});
}

// Удалить запись в реестре
function removeEntry(entryId) {
	$.ajax({
		type: "DELETE",
		url: ROOT_URL + "/remove_entry/" + entryId,
		crossDomain: true,
		success: function (data) {
			console.log(data);
		},
	});
	window.location.reload();
}

function downloadExcelTable() {
	window.location.replace("registry/import_table_to_excel");
}

function exportExcelTable() {
	$.ajax({
		type: "POST",
		url: ROOT_URL + "/export_table_from_excel",
		data: new FormData(document.getElementById("export-excel-form")),
		contentType: false,
		cache: false,
		processData: false,
		success: function () {
			window.location.reload();
		},
	});
}

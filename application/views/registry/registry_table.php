<div class="container mt-5">
	<div class="
          bg-light
          row
		  justify-content-between
		  align-items-center
          pt-2
          pb-2
          m-0
          rounded-top"
	>
		<div class="col-md-6 col-sm-6 pr-0">
			<h5 class="mb-0 d-none d-md-block">Перечень плановых проверок</h5>
			<h6 class="d-md-none">Перечень плановых проверок</h6>
		</div>
		<!-- Навигация для экранов > 720px	-->
		<div class="col-md-6 d-none d-md-block">
			<div class="d-flex justify-content-end">
				<button class="btn btn-outline-primary btn-sm mr-2" data-toggle="collapse" href="#collapseExample"
						role="button" aria-expanded="false">
					Найти
					<i class="fas fa-filter"></i>
				</button>
				<button data-toggle="modal" data-target="#addEntryModal" class="btn btn-outline-info btn-sm mr-2">
					Добавить
					<i class="fas fa-plus-circle"></i>
				</button>
				<button
						class="btn btn-outline-success btn-sm"
						id="dropdownExcelActionsBtn"
						data-toggle="dropdown"
						aria-haspopup="true"
						aria-expanded="false"
				>
					Excel
					<i class="fas fa-file-excel"></i>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownExcelActionsBtn">
					<div class="dropdown-item btn btn-sm border-bottom" href="#" id="import-excel-table-btn">
						Импорт реестра в Excel (.xlsx)
					</div>
					<div class="dropdown-item" href="#" id="excel-table-btn" style="font-size: .9em">
						<form id="export-excel-form">
							<div class="form-group mb-0">
								<input name="import_excel" type="file" class="form-control-file" id="file-input">
							</div>
							<button id="export-file-btn" class="btn btn-primary btn-sm mt-1" type="submit">Отправить</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Навигация для мобильных устройств	-->
		<div class="col-sm-4 d-md-none pr-0 btn-group dropleft d-flex justify-content-end pr-2">
			<button class="btn btn-outline-primary btn-sm mr-2" data-toggle="collapse" href="#collapseExample"
					role="button" aria-expanded="false">
				<i class="fas fa-filter"></i>
			</button>
			<button class="btn btn-outline-dark btn-sm" type="button" id="dropdownMobileActionsBtn"
					data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-align-justify"></i>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMobileActionsBtn">
				<div class="dropdown-item" data-toggle="modal" data-target="#addEntryModal">Добавить</div>
				<div class="dropdown-item" href="#">Excel</div>
			</div>
		</div>

	</div>
	<!-- Фильтрация	-->
	<div class="collapse" id="collapseExample">
		<form class="pb-2 pt-1" id="filter-form">
			<div class="row">
				<div class="col">
					<label for="smp" style="font-size: .8em">Наименование СМП</label>
					<input name="smp" type="text" class="form-control form-control-sm"/>
				</div>
				<div class="col">
					<label for="supervisory-	authority" style="font-size: .8em">Контролирующий орган</label>
					<input name="supervisory-authority" type="text" class="form-control form-control-sm"/>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col">
					<label for="date-from" style="font-size: .8em">Период проверки с</label>
					<input name="date-from" type="text" class="form-control form-control-sm"/>
				</div>
				<div class="col">
					<label for="date-to" style="font-size: .8em">По</label>
					<input name="date-to" type="text" class="form-control form-control-sm"/>
				</div>
			</div>
			<button id="clear-filter-btn" class="btn btn-primary btn-sm mt-2">
				Сбросить фильтр <i class="ml-1 fas fa-brush"></i>
			</button>
		</form>
	</div>

	<div class="table-responsive">
		<table class="table table-striped table-sm table-bordered" id="registry-table">
			<thead style="font-size: .9em">
			<tr>
				<th class="text-center" scope="col">№</th>
				<th scope="col">Проверяемый СМП</th>
				<th scope="col">Контролирующий орган</th>
				<th scope="col">Плановый период проверки</th>
				<th scope="col">Плановая длительность</th>
				<th scope="col">Действия</th>
			</tr>
			</thead>
			<caption id="table-loader">
				<div class="d-flex justify-content-center">
					<div class="lds-facebook">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</caption>
			<tbody style="font-size: .9em">
			</tbody>
		</table>
	</div>
</div>

<style>
	.lds-facebook {
		display: inline-block;
		position: relative;
		width: 80px;
		height: 80px;
	}

	.lds-facebook div {
		display: inline-block;
		position: absolute;
		left: 8px;
		width: 16px;
		background: #6c757d;
		animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
	}

	.lds-facebook div:nth-child(1) {
		left: 8px;
		animation-delay: -0.24s;
	}

	.lds-facebook div:nth-child(2) {
		left: 32px;
		animation-delay: -0.12s;
	}

	.lds-facebook div:nth-child(3) {
		left: 56px;
		animation-delay: 0s;
	}

	@keyframes lds-facebook {
		0% {
			top: 8px;
			height: 64px;
		}
		50%, 100% {
			top: 24px;
			height: 32px;
		}
	}

</style>

<script src="../../../public/js/api.js"></script>
<script src="../../../public/js/index.js"></script>
<script src="../../../public/js/libs/jquery.js"></script>
<script src="../../../public/js/helpers/index.js"></script>

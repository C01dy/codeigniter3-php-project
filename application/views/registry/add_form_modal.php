<div class="modal fade" id="addEntryModal" tabindex="-1" aria-labelledby="addEntryLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addEntryLabel">Добавить новую запись в реестр</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="modal-add-body" class="modal-body">
				<div class="col-md-12">
					<form id="add-form" class="p-3 rounded">
						<div class="form-group">
							<label for="smp">Выберите СМП</label>
							<input name="smp" class="form-control" id="smp" placeholder="ООО 'Колосок'" required/>
						</div>
						<div class="row">
							<div class="col">
								<label for="date-from">Период проверки с</label>
								<input name="date-from" type="date" class="form-control" placeholder="20.12.2009"
									   required/>
							</div>
							<div class="col">
								<label for="date-to">По</label>
								<input name="date-to" type="date" class="form-control" placeholder="31.12.2009"
									   required/>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<label for="supervisory-authority">Контролирующий орган</label>
								<select name="supervisory-authority" class="custom-select" id="supervisory-authority">
									<option selected>Роспотребнадзор</option>
									<option>Природоохрана</option>
									<option>Налоговая</option>
								</select>
							</div>
						</div>
						<div class="form-group mt-3">
							<label for="planned-duration">Плановая длительность проверки</label>
							<input name="planned-duration" class="form-control" id="planned-inspection-period"
								   placeholder="5" required/>
							<div class="invalid-feedback">
								Заполните поле
							</div>
						</div>

						<button type="submit" class="btn btn-primary save-entry-btn">
							Сохранить
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

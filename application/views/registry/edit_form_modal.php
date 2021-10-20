<div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="editEntryLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editEntryLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="modal-edit-body" class="modal-body">
				<div class="col-md-12 ">
					<form id="edit-form" class="p-3 rounded">
						<div class="form-group">
							<label for="smp">Выберите СМП</label>
							<input name="smp" class="form-control" id="smp" placeholder="ООО 'Колосок'" required/>
						</div>
						<div class="row">
							<div class="col">
								<label for="date-from">Период проверки с</label>
								<input id="date-from" name="date-from" type="date" class="form-control"
									   placeholder="20.12.2009" required/>
							</div>
							<div class="col">
								<label for="date-to">По</label>
								<input id="date-to" name="date-to" type="date" class="form-control"
									   placeholder="31.12.2009" required/>
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
							<input name="planned-duration" class="form-control" id="planned-duration" required
								   placeholder="5"/>
						</div>

						<div class="row justify-content-end mt-1 mr-1">
							<button id="modal-edit-btn" type="button" class="btn btn-secondary mr-2"
									data-dismiss="modal">
								Отмена
							</button>
							<button type="submit" class="btn btn-primary save-edited-btn">
								Сохранить
							</button>
						</div>
						<input type="hidden" name="entry-id" id="entry-id">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


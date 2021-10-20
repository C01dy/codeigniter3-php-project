<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'C:/OpenServer/modules/php/PHP_7.1/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class Registry extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array("registry_model"));
		$this->load->library(array("form_validation"));
		$this->load->helper("format_date");
	}

	// Загрузка всех шаблонов на страницу
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('registry/registry_table');
		$this->load->view('registry/add_form_modal');
		$this->load->view('registry/edit_form_modal');
		$this->load->view('registry/delete_entry_modal');
		$this->load->view('templates/footer');
	}

	// Добавление новой записи в реестр
	public function add_entry()
	{
		$this->form_validation->set_rules('smp', 'smp', 'required');
		$this->form_validation->set_rules('supervisory_authority', 'supervisory authority', 'required');
		$this->form_validation->set_rules('date_from', 'date from', 'required');
		$this->form_validation->set_rules('date_to', 'date to', 'required');
		$this->form_validation->set_rules('planned_duration', 'planned duration', 'required');

		$smp = $this->input->post("smp");
		$supervisory_authority = $this->input->post("supervisory_authority");
		$date_from = $this->input->post("date_from");
		$date_to = $this->input->post("date_to");
		$planned_duration = $this->input->post("planned_duration");

		if ($this->form_validation->run() === FALSE) {
			$this->output->set_header('HTTP/2.0 500');
			echo 'Все поля должны быть заполнены';
		} else {
			$new_entry = array(
				"smp" => $smp,
				"supervisory_authority" => $supervisory_authority,
				"date_from" => $date_from,
				"date_to" => $date_to,
				"planned_duration" => $planned_duration,
			);

			header('Content-type: application/json');
			header("Access-Control-Allow-Origin: *");
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
			header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
			$this->registry_model->add_entry($new_entry);
			$array = array(
				'msg' => "Entry has been added"
			);
			echo json_encode($array);
		}
	}

	// Редактирование записи в реестре
	public function update_entry_info($entry_id = NULL)
	{
		$this->registry_model->update_entry_info($entry_id, array(
			"smp" => $this->input->post('smp'),
			"supervisory_authority" => $this->input->post('supervisory_authority'),
			"date_from" => $this->input->post('date_from'),
			"date_to" => $this->input->post('date_to'),
			"planned_duration" => $this->input->post('planned_duration')
		));
		echo "Entry has been edited";
	}

	// Удаление записи из реестра
	public function remove_entry($entry_id = NULL)
	{
		$this->registry_model->remove_entry($entry_id);
		echo "Entry has been deleted";
	}

	// Получение всех записей из реестра
	public function get_all_entries()
	{
		$smp = $this->input->get("smp");
		$supervisory_authority = $this->input->get("supervisory_authority");
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");

		if ($smp || $supervisory_authority || $date_from || $date_to) {
			header('Content-Type: application/json');
			$registry_data = $this->registry_model->get_all_registry(array(
				'smp' => $smp,
				'supervisory_authority' => $supervisory_authority,
				'date_from' => $date_from,
				'date_to' => $date_to
			));

			foreach ($registry_data as $key => $value) {
				$registry_data[$key]['date_from'] = format_date($value['date_from']);
				$registry_data[$key]['date_to'] = format_date($value['date_to']);
			}

			echo json_encode($registry_data);
		} else {
			header('Content-Type: application/json');
			$registry_data = $this->registry_model->get_all_registry();

			foreach ($registry_data as $key => $value) {
				$registry_data[$key]['date_from'] = format_date($value['date_from']);
				$registry_data[$key]['date_to'] = format_date($value['date_to']);
			}

			echo json_encode($registry_data);
		}
	}

	// Импорт таблицы Excel
	public function import_table_to_excel()
	{
		header('Content-Type: application/json');
		$registry_data = $this->registry_model->get_all_registry();
		$spreadsheet = new Spreadsheet();

		// Получаем текущий активный лист
		$sheet = $spreadsheet->getActiveSheet();

		// Переопределение формата даты в массиве
		foreach ($registry_data as $key => $value) {
			$registry_data[$key]['date_from'] = format_date($value['date_from']);
			$registry_data[$key]['date_to'] = format_date($value['date_to']);
		}

		// Устанавливаем заголовок таблицы
		$sheet->setCellValue('A1', 'Перечень плановых проверок');
		$sheet->mergeCells('A1:E1');

		// Устанавливаем размер шрифта заголовка
		$sheet->getStyle('A1')->getFont()->setSize(18);

		// Выравнивание заголовка по центру
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

		// Записываем header в таблицу
		$sheet->setCellValue('A2', '№');
		$sheet->setCellValue('B2', 'Проверяемый СМП');
		$sheet->setCellValue('C2', 'Контролирующий орган');
		$sheet->setCellValue('D2', 'Плановый период проверки с');
		$sheet->setCellValue('E2', 'Плановый период  до');
		$sheet->setCellValue('F2', 'Плановая длительность');
		$sheet->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

		$sheet->getStyle('A2:F2')->getFont()->setBold(true);

		// Стили для титульника таблицы
		$tableHead = [
			'fill' => [
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => 'E6E6E6'
				]
			],
			'borders' => [
				'bottom' => [
					'borderStyle' => Border::BORDER_THIN
				]
			]
		];

		$sheet->getStyle('A1:F1')->applyFromArray($tableHead);

		// Установка автоматической ширины колонок
		$sheet->getColumnDimension('A')->setWidth(3);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);

		// Заполняем таблицу
		$sheet->fromArray($registry_data, NULL, 'A3');

		$writer = new Xlsx($spreadsheet);
		$filename = 'registry_table';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	// Экспорт таблицы Excel
	public function export_table_from_excel()
	{
		$inputFileName = "C:/OpenServer/domains/fregat_project/public/assets/" . $_FILES["import_excel"]["name"];

		$file_type = IOFactory::identify($inputFileName);
		$reader = IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($inputFileName);
		$data = $spreadsheet->getActiveSheet()->toArray();
		$table_data = array_slice($data, 2);

		foreach ($table_data as $row) {
			if (in_array(null, $row) || count($row) !== 6) {
				$this->output->set_header('HTTP/2.0 500');
				echo 'Таблица заполнена неверно';
				return;
			} else {
				$insert_data = array(
					'smp' => $row[1],
					'supervisory_authority' => $row[2],
					'date_from' => $row[3],
					'date_to' => $row[4],
					'planned_duration' => $row[5]
				);
				header('Content-type: application/json');
				header("Access-Control-Allow-Origin: *");
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
				header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
				$this->registry_model->add_entry($insert_data);
			}
		}
	}
}

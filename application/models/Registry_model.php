<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registry_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Метод делает запрос к базе данных и обновляет запись с переданным аргументом id,
	 * который присутствует в колонке в таблице базы данных.
	 *
	 * @param array $data Входные данные новой записи в виде массива
	 * @return null
	 */
	public function get_all_registry(
		$data = array()
	)
	{
		$hasArgs = count(func_get_args()) > 0;

		if ($hasArgs) {
			$this->db->select("*");
			$this->db->from('registry_table');
			$this->db->like('smp', $data['smp']);
			$this->db->like('supervisory_authority', $data['supervisory_authority']);
			$this->db->like('date_from', $data['date_from']);
			$this->db->like('date_to', $data['date_to']);
			$query = $this->db->get();
			return $query->result_array();
		} else {
			$this->db->select("*");
			$this->db->from("registry_table");
			$query = $this->db->get();
			return $query->result_array();
		}
	}


	/**
	 * Метод делает запрос к базе данных и обновляет запись с переданным аргументом id,
	 * который присутствует в колонке в таблице базы данных.
	 *
	 * @param array $data Входные данные новой записи в виде массива
	 * @return null
	 */
	public function add_entry($data = array())
	{

		return $this->db->insert("registry_table", $data);
	}


	/**
	 * Метод делает запрос к базе данных и удаляет запись с переданным аргументом id,
	 * который присутствует в колонке в таблице базы данных.
	 *
	 * @param integer $entry_id Уникальный номер для обращения к записи в базе данных
	 * @return null
	 */
	public function remove_entry($entry_id)
	{
		$this->db->where("id", $entry_id);
		$this->db->delete("registry_table");
	}

	/**
	 * Метод делает запрос к базе данных и обновляет запись с переданным аргументом id,
	 * который присутствует в колонке в таблице базы данных.
	 *
	 * @param integer $entry_id Уникальный номер для обращения к записи в базе данных
	 * @param array $info Входные данные в виде массива
	 * @return null
	 */
	public function update_entry_info($entry_id, $info = array())
	{
		$this->db->where("id", $entry_id);
		return $this->db->update("registry_table", $info);
	}
}


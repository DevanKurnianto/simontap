<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{
	public function updatedata()
	{
		$query = "UPDATE `tbl_sensor` set `status` = 0";
		return $this->db->query($query);
	}

	public function DataMonitoring($where = null)
	{
		if ($where) {
			$this->db->where($where);
		}
		$this->db->order_by('id', 'desc');
		return $this->db->get('tbl_sensor')->result_array();
	}

	public function ambildibaca()
	{
		$this->db->select("*")->from('tbl_sensor')->order_by('id', 'DESC');
		return $this->db->get()->result_array();
	}

	public function getDataUser()
	{
		$query = "SELECT `tbl_user`.*, `user_role`.`role` FROM `tbl_user`
                    JOIN `user_role` ON `tbl_user`.`role_id` = `user_role`.`id_role`";

		return $this->db->query($query)->result_array();
	}

	public function suhuterbaru()
	{
		$this->db->select('suhu')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->suhu;
		}
		return false;
	}

	public function udaraterbaru()
	{
		$this->db->select('udara')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->udara;
		}
		return false;
	}

	public function beratterbaru()
	{
		$this->db->select('berat')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->berat;
		}
		return false;
	}

	public function alkoholterbaru()
	{
		$this->db->select('alkohol')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->alkohol;
		}
		return false;
	}

	public function jmldata($where = null)
	{
		return $this->db->get_where('tbl_sensor', $where);
	}

	public function DataUser()
	{
		return $this->db->get('tbl_user')->result_array();
	}

	public function deleteuser($where, $user)
	{
		$this->db->delete($user, $where);
	}

	public function deleterole($where, $role)
	{
		$this->db->delete($role, $where);
	}

	public function ubahRole($where = null, $data = null)
	{
		$this->db->update('user_role', $data, $where);
	}

	public function jmlAlkohol($where = null)
	{
		$this->db->select('COUNT(*) as jumlah_alkohol');
		$this->db->from('tbl_sensor');
		$this->db->where('alkohol >', 3);

		if ($where !== null) {
			$this->db->where($where);
		}

		$query = $this->db->get();
		$result = $query->row();

		return $result->jumlah_alkohol;
	}

	public function hasilProduksi($where = null)
	{
		$this->db->select('SUM(berat) as total_berat');
		$this->db->from('tbl_sensor');
		$this->db->where('alkohol >', 3);

		if ($where !== null) {
			$this->db->where($where);
		}

		$query = $this->db->get();
		$result = $query->row();

		return $result->total_berat;
	}

	public function notifikasiTopBar()
	{
	// 	$this->db->where('alkohol >=', 4);
		$this->db->where('suhu >=', 40);
		$this->db->where('status', 1);
		// $this->db->or_where('status', 1);
		$this->db->order_by('id', 'DESC');
		return $this->db->get('tbl_sensor');
	}

	public function updatesingledata($id)
	{
		$data = array(
			'status' => 0
		);

		$this->db->where('id', $id);
		$this->db->update('tbl_sensor', $data);
	}
	
	public function getAlkoholData()
	{
		$this->db->select('alkohol');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get('tbl_sensor')->row_array();
		return $result;
	}
}

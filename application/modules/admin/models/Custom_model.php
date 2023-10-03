<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db->reconnect();
		$this->load->database();
	}

	public function get_all_categories()
	{
		return $this->db->get_where('category', array('status' => 'active', 'parent' => 0))->result();
	}

	public function get_pre_slug($table, $slug)
	{
		$this->db->select('COUNT(*) AS NumHits');
		$this->db->like('slug', $slug);
		$row = $this->db->get($table)->result();

		return $row[0]->NumHits;
	}

	public  function get_meta_value_trans($id)
	{
		return $this->db->get_where('admin_option_trans', array('id =' => $id))->result_array();
	}



	public function record_count($table, $where = array())
	{
		$this->db->select('COUNT(*) AS NumHits');

		if (!empty($where) && is_array($where)) {
			foreach ($where as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$row = $this->db->get($table)->result();

		return $row[0]->NumHits;
	}

	public function my_insert($data, $table)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function my_where($table, $select = '*', $where = array(), $like = array(), $order = "", $orderby = "", $group_by = "", $where_in = "", $where_in_data = array(), $return = "", $join = array(), $chk = true)
	{
		$this->db->select($select);
		if (!empty($where_in) && !empty($where_in_data)) {
			$this->db->where_in($where_in, $where_in_data);
		}
		if (!empty($where) && is_array($where)) {
			foreach ($where as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		if (!empty($like) && is_array($like)) {
			foreach ($like as $key => $value) {
				$this->db->like($key, $value);
			}
		}

		if (!empty($join) && is_array($join)) {
			foreach ($join as $vkey => $vvalue) {
				$this->db->join($vkey, $vvalue);
			}
		}

		if (!empty($order) && !empty($orderby)) {
			$this->db->order_by($order, $orderby);
		}
		if (!empty($group_by)) {
			$this->db->group_by($group_by);
		}
		if ($return == "object") {
			return $this->db->get($table)->result();
		} else {
			return $this->db->get($table)->result_array();
		}
	}

	public function my_update($field, $where, $table)
	{

		if (!empty($field) && is_array($field) && !empty($where) && is_array($where) && !empty($table)) {
			foreach ($where as $key1 => $value1) {
				$this->db->where($key1, $value1);
			}

			$this->db->update($table, $field);
			return true;
		} else {
			return false;
		}
	}


	public function my_delete($where, $table)
	{

		if (!empty($where) && is_array($where) && !empty($table)) {
			$this->db->delete($table, $where);
			return true;
		} else {
			return false;
		}
	}

	public function get_data($query)
	{
		$result = $this->db->query($query);
		$aresult = array();
		foreach ($result->result() as $row) {
			$aresult[] = $row;
		}
		return $aresult;
	}

	public function get_data_array($query)
	{
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function count_last_month_record()
    {
        $this->db->from('va_transactions');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        return $this->db->count_all_results();
    }

	public function last_month_amount(){
		$this->db->select_sum('amount');
        $this->db->from('va_transactions');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['amount'];
	}

	public function last_month_transaction(){
		$this->db->select('*,va_transactions.id as va_transactions_id');
        $this->db->from('va_transactions');
        $this->db->join('admin_users', 'va_transactions.user_id = admin_users.id');
        $this->db->where('va_transactions.created_at >=', date('Y-m-d', strtotime('-30 days')));
        $query = $this->db->get();
        return $query->result();
	}
	public function va_account_details(){
		$this->db->select('*');
        $this->db->from('account_details');
        // $this->db->join('admin_users', 'account_details.user_id = admin_users.id');
        // $this->db->where('account_details.created_at >=', date('Y-m-d', strtotime('-30 days')));
        $query = $this->db->get();
        return $query->result();
	}
	public function get_last_month_payout_details() {
		$this->db->select('recepient_id, SUM(amount) as total_ordered_amount');
		$this->db->from('va_transactions');
		$this->db->where('created_at >=', date('Y-m-d', strtotime('-1 month')));
		$this->db->where('transaction_type', 'debit');
		$this->db->where('payment_note', 'success');
		$this->db->group_by('recepient_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_daterange($date1, $date2) {
        $this->db->select('admin_users.*,va_transactions.recepient_id, SUM(va_transactions.amount) as total_ordered_amount');
        $this->db->from('va_transactions');
		$this->db->join('admin_users', 'va_transactions.recepient_id = admin_users.id');
        $this->db->where('va_transactions.created_at >=', $date1);
        $this->db->where('va_transactions.created_at <=', $date2);
        $this->db->where('va_transactions.transaction_type', 'debit');
        $this->db->group_by('va_transactions.recepient_id');
        $query = $this->db->get();
        return $query->result();
    }


	public function RANDOM($user_id)
	{
		$this->db->where('seller_id !=', $user_id);
		$this->db->where('status', 1);
		$this->db->where('stock_status', 'instock');
		$this->db->order_by('id', 'RANDOM');
		$product = $this->db->get('product')->result_array();
		return $product;
	}
}

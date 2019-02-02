<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Model Class
 * to provide basic query
 */
class M_general extends CI_Model
{
    /**
     * The constructor of M_general 
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Select From one table
     *
     * @param string $table Table name to be selected
     * 
     * @param array $where a group of filters, 
     *      see Code Igniter Documentation about where clause using array
     *      array index name must be similar with field name inside table
     *      array value should contain the criteria of filters
     *
     * @param array $options a group of other options, like applying order by into query etc.
     *
     * @return array|NULL Value from the query result; otherwise, NULL
     */
    function get($table, $where = array(), $options = array())
    {
        if(!empty($options)) {
            if(!empty($options['order']))
                $this->db->order_by($options['order']);

            if(!empty($options['sum'])) {
                $this->db->select_sum($options['sum']);
            } else if(!empty($options['select'])) {
                $this->db->select($options['select']);
            }

            if(!empty($options['limit'])) {
                if(!empty($options['offset']))
                    $this->db->limit($options['limit'], $options['offset']);
                else
                    $this->db->limit($options['limit']);
            }

            if(!empty($options['group']))
                $this->db->group_by($options['group']);
        }

        $result = $this->db->where($where)->get($table);

        if(!empty($options['result']))
            $result = $result->$options['result']();
        else
            $result = $result->result();

        return $result;
    }

    /**
     * Insert into table
     *
     * @param string $table Table name to be inserted
     * 
     * @param array $values table fields and new values, 
     *      *see Code Igniter Documentation*
     *      array index name must be similar with field name inside table
     *      array value should contains new values to be inserted into table
     *
     * @param boolean $insert_batch Execute insert batch (bulk insert) (default: false)
     *
     * @return array The first index as result flag and the second index as message
     */
    function insert($table, $values = array(), $insert_batch = false)
    {
        if($insert_batch === true)
        {
            $flag = $this->db->insert_batch($table, $values);

            if($flag > 0)
                $flag = 1;
        }
        else
        {
            $flag = $this->db->insert($table, $values);
        }

        $result = array($flag, INSERT_iFLAG($flag));
        return $result;
    }

    /**
     * Update table values
     *
     * @param string $table Table name to be updated
     * 
     * @param array $values table fields and new values, 
     *      *see Code Igniter Documentation*
     *      array index name must be similar with field name inside table
     *      array value should contains values to be updated into table
     *
     * @param array $where Where clauses as filter 
     *      see Code Igniter Documentation about where clause using array
     *      array index name must be similar with field name inside table
     *      array value should contains filter
     *
     * @return array $result The first index as result flag and the second index as message
     */
    function update($table, $values = array(), $where = array())
    {
        if(empty($where)) {
            return array(FALSE, lang('msg_query_filter_empty'));
        }

        $this->db->where($where);
        $flag = $this->db->update($table, $values);
        $result = array($flag, UPDATE_iFLAG($flag));

        return $result;
    }

    /**
     * Insert or Update table values
     *
     * @param string $table Table name to be updated
     *
     * @param array $values table fields and new values,
     *      *see Code Igniter Documentation*
     *      array index name must be similar with field name inside table
     *      array value should contains values to be updated into table
     *
     * @param array $where Where clauses as filter
     *      see Code Igniter Documentation about where clause using array
     *      array index name must be similar with field name inside table
     *      array value should contains filter
     *
     * @return array The first index as result flag and the second index as message
     */
    function insert_update($table, $values = array(), $where = array())
    {
        if(empty($where)) {
            return array(FALSE, lang('msg_query_filter_empty'));
        }

        $this->db->where($where);
        $data = $this->db->get($table);

        if($data->num_rows() > 0) {
            $this->db->where($where);
            $flag = $this->db->update($table, $values);
            $result = array($flag, UPDATE_iFLAG($flag));
        } else {
            $flag = $this->db->insert($table, $values);
            $result = array($flag, INSERT_iFLAG($flag));
        }

        return $result;
    }

    /**
     * Delete from table
     *
     * @param string $table Table name to be deleted
     * 
     * @param array $where Where clauses as filter
     *      it should contain at least primary key of the table 
     *
     * @return array The first index as result flag and the second index as message
     */
    function delete($table, $where = array())
    {
        $this->db->where($where);
        $flag = $this->db->delete($table);
        $result = array($flag, DELETE_iFLAG($flag));

        return $result;
    }
}
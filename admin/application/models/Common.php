<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Model {

    function __construct() {
        parent::__construct();
    }

 //     function get_info($id, $table = "", $field = "id", $whereCon = "") {
//         if (!empty($id) && !empty($table)) {
//             $this->db->select('*');
//             if (!empty($whereCon)) {
//                 $this->db->where($whereCon);
//             }
//             $this->db->where($field, $id);
//             $query = $this->db->get($table);
//             echo $this->db->last_query(); die;
//             if ($query->num_rows() > 0) {
//                 return $query->row();
//             }
//         }
//         return NULL;
//     }


     function get_info($id = "", $table = "", $field = "id", $whereCon = "", $all_field = '*', $join = false, $GroupBy = false, $OrderBy = false,$limit = false, $having = false, $db_config = 'db') {
        if (!empty($id) && !empty($table)) {
            $this->$db_config->select($all_field);
            if ($join) {
                if (isset($join['table'])) {
                    $this->$db_config->join($join['table'], $join['on'], $join['type']);
                } else {
                    foreach ($join as $j) {
                        $this->$db_config->join($j['table'], $j['on'], $j['type']);
                    }
                }
            }
            if ($OrderBy) {
                if (isset($OrderBy['field']))
                    $this->$db_config->order_by($OrderBy['field'], $OrderBy['order']);
                else
                    foreach ($OrderBy as $Order)
                        $this->$db_config->order_by($Order['field'], $Order['order']);
            }
            
            if ($limit)
                $this->db->limit($limit);
            if (!empty($whereCon)) {
                $this->$db_config->where($whereCon);
            }
            if ($having)
                $this->$db_config->having($having);
            if ($GroupBy)
                $this->$db_config->group_by($GroupBy);
            if ($id && $field) {
                $this->$db_config->where($field, $id);
            }
            $query = $this->$db_config->get($table);
           // echo $this->$db_config->last_query(); die;
            
            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }
        return NULL;
    }
    
    function get_all_info($id = '', $table = "", $field = "id", $whereCon = "", $all_field = '*', $count = false, $join = false, $GroupBy = false, $OrderBy = false, $limit = false, $offset = false, $having = false, $QueryGet = false) {
//        echo "id: ".$id." table: ".$table." field: ".$field;
        if (!empty($table)) {
            $this->db->select($all_field);
            if (!empty($whereCon))
                $this->db->where($whereCon);
            if ($join && count($join) > 0) {
                if (isset($join['table']))
                    $this->db->join($join['table'], $join['on'], $join['type']);
                else
                    foreach ($join as $j)
                        $this->db->join($j['table'], $j['on'], $j['type']);
            }
            if ($OrderBy) {
                if (isset($OrderBy['field']))
                    $this->db->order_by($OrderBy['field'], $OrderBy['order']);
                else
                    foreach ($OrderBy as $Order)
                        $this->db->order_by($Order['field'], $Order['order']);
            }
            if ($limit)
                $this->db->limit($limit);
            if ($offset)
                $this->db->offset($offset);
            if ($having)
                $this->db->having($having);
            if ($id != "")
                $this->db->where($field, $id);
            if ($GroupBy)
                $this->db->group_by($GroupBy);
            $query = $this->db->get($table);
            if ($count)
                if ($QueryGet)
                    return array($this->db->last_query(), $query->num_rows());
                else
                    return $query->num_rows();
            if ($query->num_rows() > 0) {
                if ($QueryGet) {
                    //echo $this->db->last_query();die;
                    return array($this->db->last_query(), $query->result());
                } else {
                    //echo $this->db->last_query();die;
                    return $query->result();
                }
            }
        }
        if ($QueryGet) {
            return array($this->db->last_query(), array());
        } else {
            return array();
        }
    }
    


    function get_list($table = "", $ValueField = 'id', $NameField = 'name', $whereCon = '', $ExtraField = false, $StaticVal = false, $join = false, $OrderBy = false) {
        if (!empty($table)) {
            $this->db->select("$ValueField, $NameField , $ExtraField");
            if ($join) {
                if (isset($join['table'])) {
                    $this->db->join($join['table'], $join['on'], $join['type']);
                } else {
                    foreach ($join as $j) {
                        $this->db->join($j['table'], $j['on'], $j['type']);
                    }
                }
            }
            if ($OrderBy) {
                if (isset($OrderBy['field']))
                    $this->db->order_by($OrderBy['field'], $OrderBy['order']);
                else
                    foreach ($OrderBy as $Order)
                        $this->db->order_by($Order['field'], $Order['order']);
            }
            $data_array = array();
            if (!empty($whereCon)) {
                $this->db->where($whereCon);
            }
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                $NValueField = str_replace('.', '', trim(substr($ValueField, strpos($ValueField, '.'))));
                $NExtraField = str_replace('.', '', trim(substr($ExtraField, strpos($ExtraField, '.'))));
                $NNameField = str_replace('.', '', trim(substr($NameField, strpos($NameField, '.'))));
                foreach ($query->result() as $row) {
                    if ($ExtraField):
                        $data_array[$row->$NValueField] = $row->$NNameField . ' - ' . $row->$NExtraField . '';
                    elseif ($StaticVal):
                        $data_array[$row->$NValueField] = $row->$NNameField . ' (' . $StaticVal . ')';
                    else:
                        $data_array[$row->$NValueField] = $row->$NNameField;
                    endif;
                }
            }
            return $data_array;
        }
        return NULL;
    }

    function add_info($table, $data) {
        if (!empty($data) && !empty($table)) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        return NULL;
    }
    
    function update_info($id, $table, $data, $field = "id", $whereCon = "") {
        if (!empty($id) && !empty($table)) {
            if (!empty($whereCon)) {
                $this->db->where($whereCon);
            }
            $this->db->where($field, $id);
            return $this->db->update($table, $data);
        }
        return NULL;
    }
    
    function check_is_exists($table, $name, $field_name, $id = 0, $field = "id") {
        $name = strtolower($name);
        $this->db->select($field_name);
        if ($id > 0)
            $this->db->where($field.' != ', $id);
        $this->db->where($field_name, $name);
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    function db_query($query) {
        if ($query) {
            $query1 = $this->db->query($query);
            return $query1->result();
        }
    }

    function query($query, $type = false) {
        if ($type) {
            return $this->db->query($query)->$type();
        } else {
            return $this->db->query($query);
        }
    }
    


    function _send_email($type, $subject, $email, &$data) {
        $this->load->library('phpmailer_library');
        $mail =  $this->phpmailer_library->load();
        $response = true;
        //$mail =  $this->phpmailer_library;

        //Set PHPMailer to use the sendmail transport
        //$mail->isSendmail();
        //Set who the message is to be sent from
        $mail->setFrom('info@scopnixsolar.com', 'scopnix solar');
        //Set an alternative reply-to address
        $mail->addReplyTo('info@scopnixsolar.com', 'scopnix solar');
        //Set who the message is to be sent to
        $mail->addAddress($email, $data['fullname']);
        //Set the subject line
        $mail->Subject = 'Your registration details';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($this->load->view('email/' . $type . '-html', $data, TRUE));
        //Replace the plain text body with one created manually
        //send the message, check for errors
        if (!$mail->send()) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return  'success';
        }
    }
    
    
    function cashfree_verification_api($url,$data) {
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-client-id: ".CASHFREE_VERI_CLIENTID,
                "x-client-secret: ".CASHFREE_VERI_SECRET_KEY
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return $err;
        } else {
          return $response;
        }
    }

}

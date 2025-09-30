<?php

function success_elements() {
    return array('<div class="alert alert-block alert-success fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>', '</div>');
}

function error_elements() {
    return array('<div class="alert alert-block alert-danger fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>', '</div>');
}

function add_edit_form() {
    echo '<div id="add_edit_form" style="display: none;"><div id="display_update_form"></div></div>';
}

function randomNumber() {
    return rand(111,9999);
}


function add_detail_row($id) {
        $html = '<div class="tooltip-top">
                <a data-original-title="variation" data-placement="top" data-toggle="tooltip" href="javascript:;" class="btn btn-xs btn-default btn-equal btn-mini product_details" data-id="'.$id.'"><i class="fa fa-info-circle"></i></a>
            </div>';

        return $html;
    }

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function calculateEMI($p, $r, $n) {
    $r = $r/(12*100); // monthly interest rate
    $emi = ($p*$r*pow(1+$r,$n))/(pow(1+$r,$n)-1);
    return $emi;
}

function upload_file($post_file_name, $inner_dir, $old_file_name = '') {

    $ci = & get_instance();

    $upload_path = UPLOAD_DIR . $inner_dir;

    if (!file_exists(UPLOAD_DIR)) : mkdir(UPLOAD_DIR, 0777, TRUE);
    endif;
    if (!file_exists($upload_path)) : mkdir($upload_path, 0777, TRUE);
    endif;
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = '*';
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $config['max_size'] = 0;
    $config['encrypt_name'] = TRUE;

    $ci->load->library('upload', $config);

    if (isset($_FILES[$post_file_name]["name"]) && $_FILES[$post_file_name]["name"] != "") {
        if ($ci->upload->do_upload($post_file_name)) {
            $upload_data = $ci->upload->data();
            if (!empty($old_file_name)) {

                $file_path = UPLOAD_DIR . $inner_dir . "/" . $old_file_name;
                if ($file_path != "" && file_exists($file_path)):
                    unlink($file_path);
                endif;
            }

            return $upload_data;
        } else {
            return $ci->upload->display_errors();
        }
    }
    return FALSE;
}

function delete_file($inner_dir, $old_file_name = '') {

    $ci = & get_instance();

    $upload_path = UPLOAD_DIR . $inner_dir;

    if (!empty($old_file_name)) {

        $file_path = UPLOAD_DIR . $inner_dir . "/" . $old_file_name;
        if ($file_path != "" && file_exists($file_path)):
            unlink($file_path);
        endif;
        return TRUE;
    }

    return FALSE;
}


function active_row($id,$table,$column,$control) {
    $ci = & get_instance();
    //$column = $control.'_id';
    $action="";
    $IsActive = $ci->Common->get_info($column,$table, 'id', FALSE, 'status');
    //echo $ci->db->last_query();
    if ($IsActive) {
        if ($IsActive->status == 'ACTIVE') {
            $st = "checked";
        } else {
            $st = "";
        }
        $action = <<<EOF
            <div class="form-check form-switch form-switch-right form-switch-md">
            <input class="form-check-input code-switcher product_active" type="checkbox" id="form-grid-showcode" {$st} data-id="{$id}" data-control="{$control}">
            </div>
EOF;
    }
    return $action;
}

function user_active_row($id,$table,$column,$control) {
    $ci = & get_instance();
    //$column = $control.'_id';
    $action="";
    $IsActive = $ci->Common->get_info($column,$table, 'id',false,"activated");
    if ($IsActive) {
        if ($IsActive->activated == 1) {
            $st = "checked";
        } else {
            $st = "";
        }
        $action = <<<EOF
            <div class="form-check form-switch form-switch-right form-switch-md">
            <input class="form-check-input code-switcher product_active" type="checkbox" id="form-grid-showcode" {$st} data-id="{$id}" data-control="{$control}">
            </div>
EOF;
    }
    return $action;
}

function check_permission($module,$action) {
    $ci = & get_instance();
    //$column = $control.'_id';
    $role_id = $ci->session->userdata('role_id');
    $where = "role_id = '".$role_id."' and module_name = '".$module."'";
    $data = $ci->Common->get_info('1',TBL_PERMISSIONS, '',$where,$action);
    return $data;
}

function user_action_row($id,$table,$column,$control) {
    $ci = & get_instance();
    //$column = $control.'_id';
    $action="";
    $data = $ci->Common->get_info($column,$table, 'id',false,"is_aadhar_verified");
    /*<a class="btn btn-icon btn-warning w-30px h-30px me-3 " href="user/permission/{$column}" data-id="{$column}" data-original-title="Permission" data-control="user">
				<i class="fas fa-lock-open"></i>
			</a> 
	            <a class="btn btn-icon btn-warning w-30px h-30px me-3 " href="user/permission/{$column}" data-id="{$id}" data-original-title="Permission" data-control="user">
				<i class="fas fa-lock-open"></i>
			</a>
		
			*/
    if ($data->is_aadhar_verified == 1) {
        $action = <<<EOF
            
            <a class="btn btn-icon btn-info w-30px h-30px me-3 " href="user/visitingcard/{$column}" data-id="{$column}" data-original-title="Visiting Card" data-control="user">
				<i class="fas fa-address-card"></i>
			</a>
            <a class="btn btn-icon btn-secondary w-30px h-30px me-3 " href="user/certificate/{$column}" data-id="{$column}" data-original-title="Certificate" data-control="user">
				<i class="fa fa-medal"></i>
			</a>
            <a class="btn btn-icon btn-success w-30px h-30px me-3 " href="user/idcard/{$column}" data-id="{$column}" data-original-title="ID Card" data-control="user">
				<i class="fas fa-id-card-clip"></i>
			</a>
			<button class="btn btn-icon btn-primary w-30px h-30px me-3 open_my_form_form" data-id="{$column}" data-original-title="Edit User" data-control="user">
				<i class="ki-duotone ki-setting-3 fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>
			<button class="btn btn-icon btn-danger w-30px h-30px remove-item-btn delete_btn" data-original-title="Remove User" data-method="remove" data-table="tbl_users" data-column="id" data-id="{$id}">
				<i class="ki-duotone ki-trash fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>

EOF;
    } else {
        $action = <<<EOF
            <button disabled class="btn btn-icon btn-warning w-30px h-30px me-3 "  data-id="{$column}" data-original-title="Visiting Card" data-control="user">
				<i class="fas fa-address-card"></i>
			</button>
            <button disabled class="btn btn-icon btn-secondary w-30px h-30px me-3 " data-id="{$column}" data-original-title="Certificate" data-control="user">
				<i class="fa fa-medal"></i>
			</button>
            <button disabled class="btn btn-icon btn-success w-30px h-30px me-3 " data-id="{$column}" data-original-title="ID card" data-control="user">
				<i class="fas fa-id-card-clip"></i>
			</button>
			<button class="btn btn-icon btn-primary w-30px h-30px me-3 open_my_form_form" data-id="{$column}" data-original-title="Edit User" data-control="user">
				<i class="ki-duotone ki-setting-3 fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>
			<button class="btn btn-icon btn-danger w-30px h-30px remove-item-btn delete_btn" data-original-title="Remove User" data-method="remove"   data-table="tbl_users" data-column="id" data-id="{$column}">
				<i class="ki-duotone ki-trash fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>


EOF;

    }
    return $action;
}

function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $base64_string) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}


function one_singal_notification($playerIds, $msg) {

    $key = ''; // add one single key
    $message = $msg;

    $title = '';
    $ids = array($playerIds);
    $content = array(
        "en" => $message,
        "title" => $title,
        "message" => $msg,
    );
    $fields = array(
        'app_id' => "", // add one single app_id
        // 'included_segments' => array('All'),
        'large_icon' => "ic_launcher.png",
        'small_icon' => "ic_launcher_small.png",
        'include_player_ids' => $ids,
        'contents' => $content
    );

    $fields = json_encode($fields);
    //var_dump($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ' . $key));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    curl_close($ch);
    //print("\nJSON sent:\n");
    //print($response);
    return $response;
}

// Helper function to make API requests
function postRequest($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "x-api-version: 2022-09-01",
        'x-client-id: ' . CF_APP_ID,
        'x-client-secret: ' . CF_SECRET_KEY
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Generate Order
function createOrder($orderData) {
    $url = CF_API_BASE_URL . 'orders';
    return postRequest($url, $orderData);
}

// Generate Order
function withdrawMoney($withdrawData) {
    //$API_URL = "https://payout-api.cashfree.com/api/v2/transfer";
    $url = 'https://sandbox.cashfree.com/payout/transfers';
    return postRequest($url, $withdrawData);
}

// Verify Payment
function verifyPayment($orderId) {
    $url = CF_API_BASE_URL . 'orders/' . $orderId . '/payments';

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, "$url");
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2000);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        'Accept: application/json',
        'x-api-version: 2022-09-01',
        'Content-Type: application/json',
        'x-client-id: ' . CF_APP_ID,
        'x-client-secret: ' . CF_SECRET_KEY
    )
   );

   $results = curl_exec($ch);
   $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
   curl_close($ch);
   return $resps= json_decode($results, true);

}

?>
function save_attendance(){
		extract($_POST);
		$data  = " class_subject_id = '$class_subject_id' ";
		$data .= ", doc = '$doc' ";
		$data2  = " class_subject_id = '$class_subject_id' ";
		$data2 .= "and doc = '$doc' ";
		// echo "SELECT * FROM attendance_list where $data2 ".(!empty($id) ? " and attendance_id != {$id} " : '');
		$check = $this->db->query("SELECT * FROM attendance_list where $data2 ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
				
				$save = $this->db->query("INSERT INTO attendance_list set $data ");
			if($save){
				$id = $this->db->insert_id;
				foreach($student_id as $k => $v) {
					$data = " attendance_id = '$id' ";
					$data .= ", student_id = '$k' ";
					$data .= ", type = '$type[$k]' ";
						  $this->db->query("INSERT INTO attendance_record set $data ");
				}
			}
		}else{
			$save = $this->db->query("UPDATE attendance_list set $data where id=$id ");
			if($save){
				foreach($student_id as $k => $v) {
					$data = " attendance_id = '$id' ";
					$data .= "and student_id = '$k' ";
						  $this->db->query("UPDATE attendance_record set type = '$type[$k]' where $data ");
				}
			}
		}

		if($save){
			return 1;
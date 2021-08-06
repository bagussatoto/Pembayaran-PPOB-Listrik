<?php  
	class oop{
		
		function simpan($table,array $field){
			$sql = "INSERT INTO $table SET ";
			foreach ($field as $key => $value) {
				$sql.= "$key = '$value',";
			}
			$sql = rtrim($sql, ',');
			$jalan = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		}

		function tampil($table,$where,$cari){
			$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM $table $where $cari");
			while ($data = mysqli_fetch_array($sql)) 
				@$jalan[] = $data;
				return @$jalan;
		}

		function edit($table,$where){
			$sql = "SELECT * FROM $table WHERE $where";
			$jalan = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
			return $jalan;
		}

		function hapus($table,$where){
			$sql = mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM $table WHERE $where");
			return $sql;
		}

		function update($table,array $field,$where){
			$sql = "UPDATE $table SET ";
			foreach ($field as $key => $value) {
				$sql.="$key = '$value',";
			}
			$sql=rtrim($sql,',');
			$sql .=" WHERE $where";
			$jalan = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		}

		function caridata($table){
			$sql = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM $table"));
			return $sql;
		}

		function cekdata($table){
			$sql = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM $table"));
			return $sql;
		}		


		function pesan($pesan){
			echo "<script>alert('$pesan');</script>";
		}

		function alert($pesan,$alamat){
			echo "<script>alert('$pesan');document.location.href='$alamat'</script>";
		}

		function redirect($alamat){
			echo "<script>document.location.href='$alamat'</script>";
		}

		function no_record($col){
			echo "<tr><td colspan='$col' align='center'>Data Tidak Ada !!!</td></tr>";
		}

		function rupiah($uang){
			echo "Rp. ".number_format($uang,0,',','.').",-";
		}

		function bulan($bulan){
			switch ($bulan) {
				case '01':$bln="Januari";break;
				case '02':$bln="Februari";break;
				case '03':$bln="Maret";break;
				case '04':$bln="April";break;
				case '05':$bln="Mei";break;
				case '06':$bln="Juni";break;
				case '07':$bln="Juli";break;
				case '08':$bln="Agustus";break;
				case '09':$bln="September";break;
				case '10':$bln="Oktober";break;
				case '11':$bln="November";break;
				case '12':$bln="Desember";break;
				default:$bln="";break;
			}
			echo $bln;
		}

		function bulan_substr($bulan){
			switch ($bulan) {
				case '01':$bln="JAN";break;
				case '02':$bln="FEB";break;
				case '03':$bln="MAR";break;
				case '04':$bln="APR";break;
				case '05':$bln="MEI";break;
				case '06':$bln="JUN";break;
				case '07':$bln="JUL";break;
				case '08':$bln="AGU";break;
				case '09':$bln="SEP";break;
				case '10':$bln="OKT";break;
				case '11':$bln="NOV";break;
				case '12':$bln="DES";break;
				default:$bln="";break;
			}
			echo $bln;
		}

		function format_tanggal($tanggal){
			$tahun = substr($tanggal, 0,4);
			$bulan = substr($tanggal, 5,2);
			$tanggal = substr($tanggal, 8,2);
			switch ($bulan) {
				case '01':$bln="Januari";break;
				case '02':$bln="Februari";break;
				case '03':$bln="Maret";break;
				case '04':$bln="April";break;
				case '05':$bln="Mei";break;
				case '06':$bln="Juni";break;
				case '07':$bln="Juli";break;
				case '08':$bln="Agustus";break;
				case '09':$bln="September";break;
				case '10':$bln="Oktober";break;
				case '11':$bln="November";break;
				case '12':$bln="Desember";break;
				default:$bln="";break;
			}
			echo $tanggal." ".$bln." ".$tahun;
		}

		function hari($today){
			switch ($today) {
				case '1': @$hari="Senin"; break;
				case '2': @$hari="Selasa"; break;
				case '3': @$hari="Rabu"; break;
				case '4': @$hari="Kamis"; break;
				case '5': @$hari="Jumat"; break;
				case '6': @$hari="Sabtu"; break;
				case '7': @$hari="Minggu"; break;
				default: @$hari=""; break;
			}
			echo @$hari;
		}

		function login($table,$username,$password,$alamat){
			@session_start();
			$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM $table WHERE username = '$username' AND password = '$password'");
			$cek = mysqli_num_rows($sql);
			$data = mysqli_fetch_array($sql);
			if ($cek > 0) {
				if ($table == "manager") {
					@$_SESSION['username_manager'] = $data['username'];
					@$_SESSION['id_manager'] = $data['id_manager'];
					@$_SESSION['nama_manager'] = $data['nama_mgr'];
					@$_SESSION['aksi_manager'] = $data['aksi'];
					$this->alert("Login Berhasil, Selamat Datang ".$data['nama_mgr'],$alamat);
				}elseif($table == "teller"){
					@$_SESSION['username_teller'] = $data['username'];
					@$_SESSION['biaya_admin'] = $data['biaya_admin'];
					@$_SESSION['id_teller'] = $data['id_teller'];
					@$_SESSION['nama_teller'] = $data['nama'];
					@$_SESSION['aksi_teller'] = $data['aksi'];
					$this->alert("Login Berhasil, Selamat Datang ".$data['nama'],$alamat);
				}
			}else{
				$this->pesan("username atau password salah");
			}
		}

		function upload($tempat){
			@$alamatfile = $_FILES['foto']['tmp_name'];
			@$namafile = $_FILES['foto']['name'];
			move_uploaded_file($alamatfile,"$tempat/$namafile");
			return $namafile;
		}

	}
?>
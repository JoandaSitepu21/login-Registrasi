<?php
class M_login extends CI_Model{
    function cekadmin($u,$p){
        $hasil=$this->db->query("select*from tbl_users where users_username='$u'and users_password=md5('$p')");
        return $hasil;
    }
    function get_all_users(){
        $hsl=$this->db->query("SELECT tbl_users.*,IF(users_jenkel='L','Laki-Laki','Perempuan') AS jenkel FROM tbl_users");
        return $hsl;    
    }

    function simpan_users($nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
        $hsl=$this->db->query("INSERT INTO tbl_users (users_nama,users_jenkel,users_username,users_password,users_email,users_nohp,users_level,users_photo) VALUES ('$nama','$jenkel','$username',md5('$password'),'$email','$nohp','$level','$gambar')");
        return $hsl;
    }

    function simpan_users_tanpa_gambar($nama,$jenkel,$username,$password,$email,$nohp,$level){
        $hsl=$this->db->query("INSERT INTO tbl_users (users_nama,users_jenkel,users_username,users_password,users_email,users_nohp,users_level) VALUES ('$nama','$jenkel','$username',md5('$password'),'$email','$nohp','$level')");
        return $hsl;
    }

    //UPDATE users //
    function update_users_tanpa_pass($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
        $hsl=$this->db->query("UPDATE tbl_users set users_nama='$nama',users_jenkel='$jenkel',users_username='$username',users_email='$email',users_nohp='$nohp',users_level='$level',users_photo='$gambar' where users_id='$kode'");
        return $hsl;
    }
    function update_users($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
        $hsl=$this->db->query("UPDATE tbl_users set users_nama='$nama',users_jenkel='$jenkel',users_username='$username',users_password=md5('$password'),users_email='$email',users_nohp='$nohp',users_level='$level',users_photo='$gambar' where users_id='$kode'");
        return $hsl;
    }

    function update_users_tanpa_pass_dan_gambar($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level){
        $hsl=$this->db->query("UPDATE tbl_users set users_nama='$nama',users_jenkel='$jenkel',users_username='$username',users_email='$email',users_nohp='$nohp',users_level='$level' where users_id='$kode'");
        return $hsl;
    }
    function update_users_tanpa_gambar($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level){
        $hsl=$this->db->query("UPDATE tbl_users set users_nama='$nama',users_jenkel='$jenkel',users_username='$username',users_password=md5('$password'),users_email='$email',users_nohp='$nohp',users_level='$level' where users_id='$kode'");
        return $hsl;
    }
    //END UPDATE users//

    function hapus_users($kode){
        $hsl=$this->db->query("DELETE FROM tbl_users where users_id='$kode'");
        return $hsl;
    }
    function getusername($id){
        $hsl=$this->db->query("SELECT * FROM tbl_users where users_id='$id'");
        return $hsl;
    }
    function resetpass($id,$pass){
        $hsl=$this->db->query("UPDATE tbl_users set users_password=md5('$pass') where users_id='$id'");
        return $hsl;
    }

    function get_users_login($kode){
        $hsl=$this->db->query("SELECT * FROM tbl_users where users_id='$kode'");
        return $hsl;
    }
  
}

<?php 
class Database{
    private $host   = "localhost",
            $user   = "root",
            $pass   = "",
            $db     = "db_sabona";
    protected $koneksi;

    public function __construct(){
        try{
            $this->koneksi = new PDO("mysql:host=$this->host; dbname=$this->db", $this->user, $this->pass);
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo die($e->getMessage());
        }
    }
}
class Periode extends Database{
    public function readData($queryRead){
        try{
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function createData($nama_prd, $mulaitgl_prd){
        try{
            $queryCreate = "INSERT INTO tb_periode (nama_prd, mulaitgl_prd) VALUES (?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $nama_prd);
            $data->bindParam(2, $mulaitgl_prd);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    public function updateData($id_prd, $nama_prd, $mulaitgl_prd){
        try{
            $queryUpdate = "UPDATE tb_periode SET nama_prd=?, mulaitgl_prd=? WHERE id_prd=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $nama_prd);
            $data->bindParam(2, $mulaitgl_prd);
            $data->bindParam(3, $id_prd);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_prd){
        try{
            $queryDelete = "DELETE FROM tb_periode WHERE id_prd=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_prd);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

// ARISAN

class Arisan extends Database{
    public function readData($queryRead){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createData($idprd_ars, $jns_ars, $nama_ars, $tgl_ars, $masuk_ars, $keluar_ars, $ket_ars){
        try{
            // bindParam(): mengikat parameter untuk nama variabel yang ditentukan
            // rowcount(): mengembalikan jumlah baris yang dipengaruhi oleh DELETE, INSERT, UPDATE, atau analisis dampak.
            $queryCreate = "INSERT INTO tb_arisan (idprd_ars, jns_ars, nama_ars, tgl_ars, masuk_ars, keluar_ars, ket_ars) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $idprd_ars);
            $data->bindParam(2, $jns_ars);
            $data->bindParam(3, $nama_ars);
            $data->bindParam(4, $tgl_ars);
            $data->bindParam(5, $masuk_ars);
            $data->bindParam(6, $keluar_ars);
            $data->bindParam(7, $ket_ars);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateData($id_ars, $idprd_ars, $jns_ars, $nama_ars, $tgl_ars, $masuk_ars, $keluar_ars, $ket_ars){
        try{
            $queryUpdate = "UPDATE tb_arisan SET idprd_ars=?, jns_ars=?, nama_ars=?, tgl_ars=?, masuk_ars=?, keluar_ars=?, ket_ars=? WHERE id_ars=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $idprd_ars);
            $data->bindParam(2, $jns_ars);
            $data->bindParam(3, $nama_ars);
            $data->bindParam(4, $tgl_ars);
            $data->bindParam(5, $masuk_ars);
            $data->bindParam(6, $keluar_ars);
            $data->bindParam(7, $ket_ars);
            $data->bindParam(8, $id_ars);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_ars){
        try{
            $queryDelete = "DELETE FROM tb_arisan WHERE id_ars=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_ars);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

// ANGGOTA 

class Anggota extends Database{
    public function readData($queryRead){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createData($nama_agt, $tlp_agt, $almt_agt){
        try{
            // bindParam(): mengikat parameter untuk nama variabel yang ditentukan
            // rowcount(): mengembalikan jumlah baris yang dipengaruhi oleh DELETE, INSERT, UPDATE, atau analisis dampak.
            $queryCreate = "INSERT INTO tb_anggota (nama_agt, tlp_agt, almt_agt) VALUES (?, ?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $nama_agt);
            $data->bindParam(2, $tlp_agt);
            $data->bindParam(3, $almt_agt);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateData($id_agt, $nama_agt, $tlp_agt, $almt_agt){
        try{
            $queryUpdate = "UPDATE tb_anggota SET nama_agt=?, tlp_agt=?, almt_agt=? WHERE id_agt=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $nama_agt);
            $data->bindParam(2, $tlp_agt);
            $data->bindParam(3, $almt_agt);
            $data->bindParam(4, $id_agt);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_agt){
        try{
            $queryDelete = "DELETE FROM tb_anggota WHERE id_agt=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_agt);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

// BAYAR

class Bayar extends Database{
    public function readData($queryRead){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createData($idars_byr, $idagt_byr, $tgl_byr, $byr){
        try{
            // bindParam(): mengikat parameter untuk nama variabel yang ditentukan
            // rowcount(): mengembalikan jumlah baris yang dipengaruhi oleh DELETE, INSERT, UPDATE, atau analisis dampak.
            $queryCreate = "INSERT INTO tb_bayar (idars_byr, idagt_byr, tgl_byr, byr) VALUES (?, ?, ?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $idars_byr);
            $data->bindParam(2, $idagt_byr);
            $data->bindParam(3, $tgl_byr);
            $data->bindParam(4, $byr);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateData($id_byr, $idars_byr, $idagt_byr, $tgl_byr, $byr){
        try{
            $queryUpdate = "UPDATE tb_bayar SET idars_byr=?, idagt_byr=?, tgl_byr=?, byr=? WHERE id_byr=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $idars_byr);
            $data->bindParam(2, $idagt_byr);
            $data->bindParam(3, $tgl_byr);
            $data->bindParam(4, $byr);
            $data->bindParam(5, $id_byr);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_byr){
        try{
            $queryDelete = "DELETE FROM tb_bayar WHERE id_byr=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_byr);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

// DONASI

class Donasi extends Database{
    public function readData($queryRead){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createData($idars_dns, $idagt_dns, $tgl_dns, $dns){
        try{
            // bindParam(): mengikat parameter untuk nama variabel yang ditentukan
            // rowcount(): mengembalikan jumlah baris yang dipengaruhi oleh DELETE, INSERT, UPDATE, atau analisis dampak.
            $queryCreate = "INSERT INTO tb_donasi (idars_dns, idagt_dns, tgl_dns, dns) VALUES (?, ?, ?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $idars_dns);
            $data->bindParam(2, $idagt_dns);
            $data->bindParam(3, $tgl_dns);
            $data->bindParam(4, $dns);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateData($id_dns, $idars_dns, $idagt_dns, $tgl_dns, $dns){
        try{
            $queryUpdate = "UPDATE tb_donasi SET idars_dns=?, idagt_dns=?, tgl_dns=?, dns=? WHERE id_dns=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $idars_dns);
            $data->bindParam(2, $idagt_dns);
            $data->bindParam(3, $tgl_dns);
            $data->bindParam(4, $dns);
            $data->bindParam(5, $id_dns);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_dns){
        try{
            $queryDelete = "DELETE FROM tb_donasi WHERE id_dns=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_dns);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

// BIAYA LAINNYA 

class Biayalainnya extends Database{
    public function readData($queryRead){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            
            $statement = $this->koneksi->prepare($queryRead);
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createData(/*$idars_bl,*/ $nama_bl, $tgl_bl, $bl){
        try{
            // bindParam(): mengikat parameter untuk nama variabel yang ditentukan
            // rowcount(): mengembalikan jumlah baris yang dipengaruhi oleh DELETE, INSERT, UPDATE, atau analisis dampak.
            $queryCreate = "INSERT INTO tb_biayalainnya (idars_bl, nama_bl, tgl_bl, bl) VALUES (?, ?, ?, ?)";
            $data = $this->koneksi->prepare($queryCreate);
            
            $data->bindParam(1, $idars_bl);
            $data->bindParam(2, $nama_bl);
            $data->bindParam(3, $tgl_bl);
            $data->bindParam(4, $bl);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateData($id_bl, /*$idars_bl,*/ $nama_bl, $tgl_bl, $bl){
        try{
            $queryUpdate = "UPDATE tb_biayalainnya SET idars_bl=?, nama_bl=?, tgl_bl=?, bl=? WHERE id_bl=?";
            $data = $this->koneksi->prepare($queryUpdate);
            
            $data->bindParam(1, $idars_bl);
            $data->bindParam(2, $nama_bl);
            $data->bindParam(3, $tgl_bl);
            $data->bindParam(4, $bl);
            $data->bindParam(5, $id_bl);
            $data->execute();

            return $data->rowcount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteData($id_bl){
        try{
            $queryDelete = "DELETE FROM tb_biayalainnya WHERE id_bl=?";
            $data = $this->koneksi->prepare($queryDelete);
        
            $data->bindParam(1, $id_bl);

            $data->execute();
            return $data->rowCount();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

class Login extends Database{
    public function readData($username, $password){
        try{
            // Prepare(): menyiapkan instruksi atau argumen ke mysql.
            // result(): menjalankan query prepared(). 
            // fetchAll(): mengambil semua baris di dalam table database 
            $queryRead = "SELECT * FROM tb_user WHERE username=? AND password=?";
            $statement = $this->koneksi->prepare($queryRead);
            
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $password);
            
            $statement->execute();
            $data = $statement->fetchAll();
            
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

?>

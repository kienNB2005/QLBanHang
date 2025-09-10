<?php 
    class Database
    {
        public static function connect()
        {
            $host = 'localhost';
            $port = '3307';
            $dbname = 'qlbanhang';
            $user = 'root';
            $pass = '157359';

            try{
                $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",$user,$pass);
                //cấu hình để PDO báo lỗi (nếu có)
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //cấu hình dữ liệu mảng trả về mảng gọn gàng
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            } catch (PDOException $e){
                //hiển thị thông tin báo lỗi
                throw new Exception("Lỗi kết nối DB: " . $e->getMessage());
            }
        }
    }
    // $database = Database :: connect();
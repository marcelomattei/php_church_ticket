<?php
    class Worship {
        private $connection;

        function __construct() {
            $servername = 'localhost';
            $dbname = 'ibv_event_ticket';
            $username = 'root';
            $password = '';

            $connection = new mysqli($servername, $username, $password, $dbname);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }else{
                $this->conn=$connection;  
            }
        }

        public function list_available_worships() {
            $sql = "select *  from worship
                        where (date > current_date)
                        or (date = current_date and hour >= current_time)";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function list_all_worships() {
            $sql = "select *  from worship order by date, hour desc";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function find_by_id($id=string) {
            $sql = "select description, date, hour, places from worship where id = $id";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function create_worship($post_data=array()) {
            $description = mysqli_real_escape_string($this->conn, trim($post_data['description']));
            $hour = mysqli_real_escape_string($this->conn, trim($post_data['worshipHour']));
            $date = mysqli_real_escape_string($this->conn, trim($post_data['worshipDate']));
            $places = mysqli_real_escape_string($this->conn, trim($post_data['places']));

            $result = $this->conn->query("insert into worship (description, hour, date, places)
                values('$description', '$hour', '$date', $places)");

            if ($result) {
                $_SESSION['message'] = "Culto foi gravado com sucesso!";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Não foi possível gravar o culto!";
                $_SESSION['msg_type'] = "danger";
            }
        }

        public function delete_worship($get_data=array()) {
            $id = mysqli_real_escape_string($this->conn, trim($get_data['delete_worship']));
            $sql = "delete from worship where id = $id";
            $result = $this->conn->query($sql);

            if ($result) {
                $_SESSION['message'] = "Culto foi removido com sucesso!";
                $_SESSION['msg_type'] = "warning";
            } else {
                $_SESSION['message'] = "Não foi possível remover o culto!";
                $_SESSION['msg_type'] = "danger";
            }
        }

        function __destruct() {
            mysqli_close($this->conn);  
        }
    }
?>
<?php
    class Reservation {
        private $conn;

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

        private function get_current_and_total_number_by_worship_id($id) {
            $sql = "SELECT sum(r.quantity) as current, w.places as total 
                        FROM worship w
                            left join worship_registration r on w.id = r.worship_id
                        where r.worship_id = $id";
            $result=  $this->conn->query($sql);
            return $result->fetch_assoc();
        }

        private function is_registration_valid($quantity, $worship_id) {
            $row = $this->get_current_and_total_number_by_worship_id($worship_id);
            $current = is_null($row['current']) ? 0 : $row['current'];
            $total = $row['total'];

            if (($quantity + $current) > $total) {
                $_SESSION['message'] = "O culto selecionado já está com todos os lugares ocupados!";
                $_SESSION['msg_type'] = "warning";
                return false;
            }
            return true;
        }

        public function create_reservation($post_data=array()) {
            $quantity = mysqli_real_escape_string($this->conn, trim($post_data['quantity']));
            $worship_id = mysqli_real_escape_string($this->conn, trim($post_data['worship_id']));

            if ($this->is_registration_valid($quantity, $worship_id)) {
                for($i = 0; $i < $quantity; $i++) {
                    $name = mysqli_real_escape_string($this->conn, trim($post_data['name'][$i]));
                    $taxId = mysqli_real_escape_string($this->conn, trim($post_data['taxId'][$i]));
                    
                    $result = $this->conn->query("insert into worship_registration (name, tax_id, quantity, worship_id) 
                                    values ('$name', '$taxId', 1, $worship_id)");

                    if ($result) {
                        $_SESSION['message'] = "Registro foi realizado com sucesso!";
                        $_SESSION['msg_type'] = "success";
                    } else {
                        $_SESSION['message'] = "Não foi possível realizar o registro!";
                        $_SESSION['msg_type'] = "danger";
                    }
                }
            }
        }

        public function list_summary_active_reservations() {
            $sql = "SELECT w.id, sum(r.quantity) as current_qty, w.description, w.hour, w.date, w.places 
                        FROM worship_registration r
                            inner join worship w on w.id = r.worship_id
                    group by w.id, w.description, w.hour, w.date, w.places order by w.id desc";
            $result=  $this->conn->query($sql);
            return $result;
        }

        public function find_by_registration_by_worship_id($id=string) {
            $sql = "select name, quantity, tax_id 
                        from worship_registration where worship_id = $id";
            $result=  $this->conn->query($sql);
            return $result;
        }

        function __destruct() {
            mysqli_close($this->conn);  
        }
    }
?>
<?    Class connect{
    public $host = "localhost";
    public $user = "root";
    public $password = "";

    public $db = "beejee";
    public $charset = "utf8";

    public $pdo = "";

    public function __construct() {

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }
}

Class db extends connect{

    public $table_name = '';

    public function insert($data) {
        // $data['create_at'] = Date('Y-m-d H:i:s');
        $fields = $this->setFields($data);
        $sql = "INSERT INTO `{$this->table_name}` SET " . $fields;
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }

    public function update($data)
    {
        $fields = $this->setFields($data);
        $sql = "UPDATE `{$this->table_name}` SET ".$fields.' WHERE id=:id';
        $stmt = $this->pdo->prepare( $sql );

        return $stmt->execute($data);
    }

    public function setFields($items, $delimiter = ",") {
        $str = array();

        if(empty($items)) {
            return "";
        }

        foreach ($items as $key => $item) {
            $str[] = "`".$key."`=:".$key;
        }

        return implode($delimiter, $str);
    }

    public function getAll() {
        $sql = "SELECT * FROM `{$this->table_name}`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * (new ExampleClass())->getOne(['id' => 5])
     */
    public function getOne($where = []) {
        $sql = "SELECT * FROM `{$this->table_name}`";

        if( count( $where) > 0 ) {
            $fields = $this->setFields($where, " AND ");

            $sql .= " WHERE " . $fields;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where);
        $result = $stmt->fetch();

        return $result;
    }
}

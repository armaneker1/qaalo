<?php
require_once __ROOT__ . 'vendors/db2php/Db2PhpEntity.class.php';
require_once __ROOT__ . 'vendors/db2php/Db2PhpEntityBase.class.php';
require_once __ROOT__ . 'vendors/db2php/Db2PhpEntityModificationTracking.class.php';
require_once __ROOT__ . 'vendors/db2php/DFCInterface.class.php';
require_once __ROOT__ . 'vendors/db2php/DFCAggregate.class.php';
require_once __ROOT__ . 'vendors/db2php/DFC.class.php';
require_once __ROOT__ . 'vendors/db2php/DSC.class.php';
/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Topic extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {

    public static function create() {
        return new Topic();
    }

    private static $CLASS_NAME = 'Topic';

    const SQL_IDENTIFIER_QUOTE = '';
    const SQL_TABLE_NAME = 'topic';
    const SQL_INSERT = 'INSERT INTO topic (id,userID,title,createdOn,rate,url,inviteCode,viewCount,editorsPick) VALUES (?,?,?,?,?,?,?,?,?)';
    const SQL_INSERT_AUTOINCREMENT = 'INSERT INTO topic (userID,title,createdOn,rate,url,inviteCode,viewCount,editorsPick) VALUES (?,?,?,?,?,?,?,?)';
    const SQL_UPDATE = 'UPDATE topic SET id=?,userID=?,title=?,createdOn=?,rate=?,url=?,inviteCode=?,viewCount=?,editorsPick=? WHERE id=?';
    const SQL_SELECT_PK = 'SELECT * FROM topic WHERE id=?';
    const SQL_DELETE_PK = 'DELETE FROM topic WHERE id=?';
    const FIELD_ID = -957339078;
    const FIELD_USERID = 930718661;
    const FIELD_TITLE = -1495204647;
    const FIELD_CREATEDON = -988536600;
    const FIELD_RATE = -879583681;
    const FIELD_URL = 387271728;
    const FIELD_INVITECODE = -751947083;
    const FIELD_VIEWCOUNT = 1109047147;
    const FIELD_EDITORSPICK = -1281330264;

    private static $PRIMARY_KEYS = array(self::FIELD_ID);
    private static $AUTOINCREMENT_FIELDS = array(self::FIELD_ID);
    private static $FIELD_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_USERID => 'userID',
        self::FIELD_TITLE => 'title',
        self::FIELD_CREATEDON => 'createdOn',
        self::FIELD_RATE => 'rate',
        self::FIELD_URL => 'url',
        self::FIELD_INVITECODE => 'inviteCode',
        self::FIELD_VIEWCOUNT => 'viewCount',
        self::FIELD_EDITORSPICK => 'editorsPick');
    private static $PROPERTY_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_USERID => 'userID',
        self::FIELD_TITLE => 'title',
        self::FIELD_CREATEDON => 'createdOn',
        self::FIELD_RATE => 'rate',
        self::FIELD_URL => 'url',
        self::FIELD_INVITECODE => 'inviteCode',
        self::FIELD_VIEWCOUNT => 'viewCount',
        self::FIELD_EDITORSPICK => 'editorsPick');
    private static $PROPERTY_TYPES = array(
        self::FIELD_ID => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_USERID => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_TITLE => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_CREATEDON => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_RATE => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_URL => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_INVITECODE => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_VIEWCOUNT => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_EDITORSPICK => Db2PhpEntity::PHP_TYPE_BOOL);
    private static $FIELD_TYPES = array(
        self::FIELD_ID => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_USERID => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_TITLE => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 60, 0, false),
        self::FIELD_CREATEDON => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_RATE => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_URL => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 60, 0, false),
        self::FIELD_INVITECODE => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 16, 0, false),
        self::FIELD_VIEWCOUNT => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, true),
        self::FIELD_EDITORSPICK => array(Db2PhpEntity::JDBC_TYPE_BIT, 0, 0, true));
    private static $DEFAULT_VALUES = array(
        self::FIELD_ID => null,
        self::FIELD_USERID => 0,
        self::FIELD_TITLE => '',
        self::FIELD_CREATEDON => 0,
        self::FIELD_RATE => 0,
        self::FIELD_URL => '',
        self::FIELD_INVITECODE => '',
        self::FIELD_VIEWCOUNT => 0,
        self::FIELD_EDITORSPICK => '0');
    private $id;
    private $userID;
    private $title;
    private $createdOn;
    private $rate;
    private $url;
    private $inviteCode;
    private $viewCount;
    private $editorsPick;

    /**
     * set value for id 
     *
     * type:INT UNSIGNED,size:10,default:null,primary,unique,autoincrement
     *
     * @param mixed $id
     * @return Topic
     */
    public function &setId($id) {
        $this->notifyChanged(self::FIELD_ID, $this->id, $id);
        $this->id = $id;
        return $this;
    }

    /**
     * get value for id 
     *
     * type:INT UNSIGNED,size:10,default:null,primary,unique,autoincrement
     *
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * set value for userID 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @param mixed $userID
     * @return Topic
     */
    public function &setUserID($userID) {
        $this->notifyChanged(self::FIELD_USERID, $this->userID, $userID);
        $this->userID = $userID;
        return $this;
    }

    /**
     * get value for userID 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @return mixed
     */
    public function getUserID() {
        return $this->userID;
    }

    /**
     * set value for title 
     *
     * type:VARCHAR,size:60,default:null,index
     *
     * @param mixed $title
     * @return Topic
     */
    public function &setTitle($title) {
        $this->notifyChanged(self::FIELD_TITLE, $this->title, $title);
        $this->title = $title;
        return $this;
    }

    /**
     * get value for title 
     *
     * type:VARCHAR,size:60,default:null,index
     *
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * set value for createdOn 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @param mixed $createdOn
     * @return Topic
     */
    public function &setCreatedOn($createdOn) {
        $this->notifyChanged(self::FIELD_CREATEDON, $this->createdOn, $createdOn);
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * get value for createdOn 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @return mixed
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * set value for rate 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @param mixed $rate
     * @return Topic
     */
    public function &setRate($rate) {
        $this->notifyChanged(self::FIELD_RATE, $this->rate, $rate);
        $this->rate = $rate;
        return $this;
    }

    /**
     * get value for rate 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @return mixed
     */
    public function getRate() {
        return $this->rate;
    }

    /**
     * set value for url 
     *
     * type:VARCHAR,size:60,default:null,index
     *
     * @param mixed $url
     * @return Topic
     */
    public function &setUrl($url) {
        $this->notifyChanged(self::FIELD_URL, $this->url, $url);
        $this->url = $url;
        return $this;
    }

    /**
     * get value for url 
     *
     * type:VARCHAR,size:60,default:null,index
     *
     * @return mixed
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * set value for inviteCode 
     *
     * type:VARCHAR,size:16,default:null,index
     *
     * @param mixed $inviteCode
     * @return Topic
     */
    public function &setInviteCode($inviteCode) {
        $this->notifyChanged(self::FIELD_INVITECODE, $this->inviteCode, $inviteCode);
        $this->inviteCode = $inviteCode;
        return $this;
    }

    /**
     * get value for inviteCode 
     *
     * type:VARCHAR,size:16,default:null,index
     *
     * @return mixed
     */
    public function getInviteCode() {
        return $this->inviteCode;
    }

    /**
     * set value for viewCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @param mixed $viewCount
     * @return Topic
     */
    public function &setViewCount($viewCount) {
        $this->notifyChanged(self::FIELD_VIEWCOUNT, $this->viewCount, $viewCount);
        $this->viewCount = $viewCount;
        return $this;
    }

    /**
     * get value for viewCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @return mixed
     */
    public function getViewCount() {
        return $this->viewCount;
    }

    /**
     * set value for editorsPick 
     *
     * type:BIT,size:0,default:0,nullable
     *
     * @param mixed $editorsPick
     * @return Topic
     */
    public function &setEditorsPick($editorsPick) {
        $this->notifyChanged(self::FIELD_EDITORSPICK, $this->editorsPick, $editorsPick);
        $this->editorsPick = $editorsPick;
        return $this;
    }

    /**
     * get value for editorsPick 
     *
     * type:BIT,size:0,default:0,nullable
     *
     * @return mixed
     */
    public function getEditorsPick() {
        return $this->editorsPick;
    }

    /**
     * Get table name
     *
     * @return string
     */
    public static function getTableName() {
        return self::SQL_TABLE_NAME;
    }

    /**
     * Get array with field id as index and field name as value
     *
     * @return array
     */
    public static function getFieldNames() {
        return self::$FIELD_NAMES;
    }

    /**
     * Get array with field id as index and property name as value
     *
     * @return array
     */
    public static function getPropertyNames() {
        return self::$PROPERTY_NAMES;
    }

    /**
     * get the field name for the passed field id.
     *
     * @param int $fieldId
     * @param bool $fullyQualifiedName true if field name should be qualified by table name
     * @return string field name for the passed field id, null if the field doesn't exist
     */
    public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName = true) {
        if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
            return null;
        }
        $fieldName = self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
        if ($fullyQualifiedName) {
            return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
        }
        return $fieldName;
    }

    /**
     * Get array with field ids of identifiers
     *
     * @return array
     */
    public static function getIdentifierFields() {
        return self::$PRIMARY_KEYS;
    }

    /**
     * Get array with field ids of autoincrement fields
     *
     * @return array
     */
    public static function getAutoincrementFields() {
        return self::$AUTOINCREMENT_FIELDS;
    }

    /**
     * Get array with field id as index and property type as value
     *
     * @return array
     */
    public static function getPropertyTypes() {
        return self::$PROPERTY_TYPES;
    }

    /**
     * Get array with field id as index and field type as value
     *
     * @return array
     */
    public static function getFieldTypes() {
        return self::$FIELD_TYPES;
    }

    /**
     * Assign default values according to table
     * 
     */
    public function assignDefaultValues() {
        $this->assignByArray(self::$DEFAULT_VALUES);
    }

    /**
     * return hash with the field name as index and the field value as value.
     *
     * @return array
     */
    public function toHash() {
        $array = $this->toArray();
        $hash = array();
        foreach ($array as $fieldId => $value) {
            $hash[self::$FIELD_NAMES[$fieldId]] = $value;
        }
        return $hash;
    }

    /**
     * return array with the field id as index and the field value as value.
     *
     * @return array
     */
    public function toArray() {
        return array(
            self::FIELD_ID => $this->getId(),
            self::FIELD_USERID => $this->getUserID(),
            self::FIELD_TITLE => $this->getTitle(),
            self::FIELD_CREATEDON => $this->getCreatedOn(),
            self::FIELD_RATE => $this->getRate(),
            self::FIELD_URL => $this->getUrl(),
            self::FIELD_INVITECODE => $this->getInviteCode(),
            self::FIELD_VIEWCOUNT => $this->getViewCount(),
            self::FIELD_EDITORSPICK => $this->getEditorsPick());
    }

    /**
     * return array with the field id as index and the field value as value for the identifier fields.
     *
     * @return array
     */
    public function getPrimaryKeyValues() {
        return array(
            self::FIELD_ID => $this->getId());
    }

    /**
     * cached statements
     *
     * @var array<string,array<string,PDOStatement>>
     */
    private static $stmts = array();
    private static $cacheStatements = true;

    /**
     * prepare passed string as statement or return cached if enabled and available
     *
     * @param PDO $db
     * @param string $statement
     * @return PDOStatement
     */
    protected static function prepareStatement(PDO $db, $statement) {
        if (self::isCacheStatements()) {
            if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
                $dbInstanceId = spl_object_hash($db);
                if (empty(self::$stmts[$statement][$dbInstanceId])) {
                    self::$stmts[$statement][$dbInstanceId] = $db->prepare($statement);
                }
                return self::$stmts[$statement][$dbInstanceId];
            }
        }
        return $db->prepare($statement);
    }

    /**
     * Enable statement cache
     *
     * @param bool $cache
     */
    public static function setCacheStatements($cache) {
        self::$cacheStatements = true == $cache;
    }

    /**
     * Check if statement cache is enabled
     *
     * @return bool
     */
    public static function isCacheStatements() {
        return self::$cacheStatements;
    }

    /**
     * check if this instance exists in the database
     *
     * @param PDO $db
     * @return bool
     */
    public function existsInDatabase(PDO $db) {
        $filter = array();
        foreach ($this->getPrimaryKeyValues() as $fieldId => $value) {
            $filter[] = new DFC($fieldId, $value, DFC::EXACT_NULLSAFE);
        }
        return 0 != count(self::findByFilter($db, $filter, true));
    }

    /**
     * Update to database if exists, otherwise insert
     *
     * @param PDO $db
     * @return mixed
     */
    public function updateInsertToDatabase(PDO $db) {
        if ($this->existsInDatabase($db)) {
            return $this->updateToDatabase($db);
        } else {
            return $this->insertIntoDatabase($db);
        }
    }

    /**
     * Query by Example.
     *
     * Match by attributes of passed example instance and return matched rows as an array of Topic instances
     *
     * @param PDO $db a PDO Database instance
     * @param Topic $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return Topic[]
     */
    public static function findByExample(PDO $db, Topic $example, $and = true, $sort = null) {
        $exampleValues = $example->toArray();
        $filter = array();
        foreach ($exampleValues as $fieldId => $value) {
            if (null !== $value) {
                $filter[$fieldId] = $value;
            }
        }
        return self::findByFilter($db, $filter, $and, $sort);
    }

    /**
     * Query by filter.
     *
     * The filter can be either an hash with the field id as index and the value as filter value,
     * or a array of DFC instances.
     *
     * Will return matched rows as an array of Topic instances.
     *
     * @param PDO $db a PDO Database instance
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return Topic[]
     */
    public static function findByFilter(PDO $db, $filter, $and = true, $sort = null) {
        if (!($filter instanceof DFCInterface)) {
            $filter = new DFCAggregate($filter, $and);
        }
        $sql = 'SELECT * FROM topic'
                . self::buildSqlWhere($filter, $and, false, true)
                . self::buildSqlOrderBy($sort);

        $stmt = self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }

    /**
     * Will execute the passed statement and return the result as an array of Topic instances
     *
     * @param PDOStatement $stmt
     * @return Topic[]
     */
    public static function fromStatement(PDOStatement $stmt) {
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        return self::fromExecutedStatement($stmt);
    }

    /**
     * returns the result as an array of Topic instances without executing the passed statement
     *
     * @param PDOStatement $stmt
     * @return Topic[]
     */
    public static function fromExecutedStatement(PDOStatement $stmt) {
        $resultInstances = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $o = new Topic();
            $o->assignByHash($result);
            $o->notifyPristine();
            $resultInstances[] = $o;
        }
        $stmt->closeCursor();
        return $resultInstances;
    }

    /**
     * Get sql WHERE part from filter.
     *
     * @param array $filter
     * @param bool $and
     * @param bool $fullyQualifiedNames true if field names should be qualified by table name
     * @param bool $prependWhere true if WHERE should be prepended to conditions
     * @return string
     */
    public static function buildSqlWhere($filter, $and, $fullyQualifiedNames = true, $prependWhere = false) {
        if (!($filter instanceof DFCInterface)) {
            $filter = new DFCAggregate($filter, $and);
        }
        return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
    }

    /**
     * get sql ORDER BY part from DSCs
     *
     * @param array $sort array of DSC instances
     * @return string
     */
    protected static function buildSqlOrderBy($sort) {
        return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
    }

    /**
     * bind values from filter to statement
     *
     * @param PDOStatement $stmt
     * @param DFCInterface $filter
     */
    public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
        $filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
    }

    /**
     * Execute select query and return matched rows as an array of Topic instances.
     *
     * The query should of course be on the table for this entity class and return all fields.
     *
     * @param PDO $db a PDO Database instance
     * @param string $sql
     * @return Topic[]
     */
    public static function findBySql(PDO $db, $sql) {
        $stmt = $db->query($sql);
        return self::fromExecutedStatement($stmt);
    }

    /**
     * Delete rows matching the filter
     *
     * The filter can be either an hash with the field id as index and the value as filter value,
     * or a array of DFC instances.
     *
     * @param PDO $db
     * @param array $filter
     * @param bool $and
     * @return mixed
     */
    public static function deleteByFilter(PDO $db, $filter, $and = true) {
        if (!($filter instanceof DFCInterface)) {
            $filter = new DFCAggregate($filter, $and);
        }
        if (0 == count($filter)) {
            throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
        }
        $sql = 'DELETE FROM topic'
                . self::buildSqlWhere($filter, $and, false, true);
        $stmt = self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        $stmt->closeCursor();
        return $affected;
    }

    /**
     * Assign values from array with the field id as index and the value as value
     *
     * @param array $array
     */
    public function assignByArray($array) {
        $result = array();
        foreach ($array as $fieldId => $value) {
            $result[self::$FIELD_NAMES[$fieldId]] = $value;
        }
        $this->assignByHash($result);
    }

    /**
     * Assign values from hash where the indexes match the tables field names
     *
     * @param array $result
     */
    public function assignByHash($result) {
        $this->setId($result['id']);
        $this->setUserID($result['userID']);
        $this->setTitle($result['title']);
        $this->setCreatedOn($result['createdOn']);
        $this->setRate($result['rate']);
        $this->setUrl($result['url']);
        $this->setInviteCode($result['inviteCode']);
        $this->setViewCount($result['viewCount']);
        $this->setEditorsPick($result['editorsPick']);
    }

    /**
     * Get element instance by it's primary key(s).
     * Will return null if no row was matched.
     *
     * @param PDO $db
     * @return Topic
     */
    public static function findById(PDO $db, $id) {
        $stmt = self::prepareStatement($db, self::SQL_SELECT_PK);
        $stmt->bindValue(1, $id);
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if (!$result) {
            return null;
        }
        $o = new Topic();
        $o->assignByHash($result);
        $o->notifyPristine();
        return $o;
    }

    /**
     * Bind all values to statement
     *
     * @param PDOStatement $stmt
     */
    protected function bindValues(PDOStatement &$stmt) {
        $stmt->bindValue(1, $this->getId());
        $stmt->bindValue(2, $this->getUserID());
        $stmt->bindValue(3, $this->getTitle());
        $stmt->bindValue(4, $this->getCreatedOn());
        $stmt->bindValue(5, $this->getRate());
        $stmt->bindValue(6, $this->getUrl());
        $stmt->bindValue(7, $this->getInviteCode());
        $stmt->bindValue(8, $this->getViewCount());
        $stmt->bindValue(9, $this->getEditorsPick());
    }

    /**
     * Insert this instance into the database
     *
     * @param PDO $db
     * @return mixed
     */
    public function insertIntoDatabase(PDO $db) {
        if (null === $this->getId()) {
            $stmt = self::prepareStatement($db, self::SQL_INSERT_AUTOINCREMENT);
            $stmt->bindValue(1, $this->getUserID());
            $stmt->bindValue(2, $this->getTitle());
            $stmt->bindValue(3, $this->getCreatedOn());
            $stmt->bindValue(4, $this->getRate());
            $stmt->bindValue(5, $this->getUrl());
            $stmt->bindValue(6, $this->getInviteCode());
            $stmt->bindValue(7, $this->getViewCount());
            $stmt->bindValue(8, $this->getEditorsPick());
        } else {
            $stmt = self::prepareStatement($db, self::SQL_INSERT);
            $this->bindValues($stmt);
        }
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        $lastInsertId = $db->lastInsertId();
        if (false !== $lastInsertId) {
            $this->setId($lastInsertId);
        }
        $stmt->closeCursor();
        $this->notifyPristine();
        return $affected;
    }

    /**
     * Update this instance into the database
     *
     * @param PDO $db
     * @return mixed
     */
    public function updateToDatabase(PDO $db) {
        $stmt = self::prepareStatement($db, self::SQL_UPDATE);
        $this->bindValues($stmt);
        $stmt->bindValue(10, $this->getId());
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        $stmt->closeCursor();
        $this->notifyPristine();
        return $affected;
    }

    /**
     * Delete this instance from the database
     *
     * @param PDO $db
     * @return mixed
     */
    public function deleteFromDatabase(PDO $db) {
        $stmt = self::prepareStatement($db, self::SQL_DELETE_PK);
        $stmt->bindValue(1, $this->getId());
        $affected = $stmt->execute();
        if (false === $affected) {
            $stmt->closeCursor();
            throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
        }
        $stmt->closeCursor();
        return $affected;
    }

    /**
     * get element as DOM Document
     *
     * @return DOMDocument
     */
    public function toDOM() {
        return self::hashToDomDocument($this->toHash(), 'Topic');
    }

    /**
     * get single Topic instance from a DOMElement
     *
     * @param DOMElement $node
     * @return Topic
     */
    public static function fromDOMElement(DOMElement $node) {
        $o = new Topic();
        $o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
        $o->notifyPristine();
        return $o;
    }

    /**
     * get all instances of Topic from the passed DOMDocument
     *
     * @param DOMDocument $doc
     * @return Topic[]
     */
    public static function fromDOMDocument(DOMDocument $doc) {
        $instances = array();
        foreach ($doc->getElementsByTagName('Topic') as $node) {
            $instances[] = self::fromDOMElement($node);
        }
        return $instances;
    }

}

?>
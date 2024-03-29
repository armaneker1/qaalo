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
class Url extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {

    public static function create() {
        return new Url();
    }

    private static $CLASS_NAME = 'Url';

    const SQL_IDENTIFIER_QUOTE = '';
    const SQL_TABLE_NAME = 'url';
    const SQL_INSERT = 'INSERT INTO url (id,link,original,clickCount,topicID) VALUES (?,?,?,?,?)';
    const SQL_INSERT_AUTOINCREMENT = 'INSERT INTO url (link,original,clickCount,topicID) VALUES (?,?,?,?)';
    const SQL_UPDATE = 'UPDATE url SET id=?,link=?,original=?,clickCount=?,topicID=? WHERE id=?';
    const SQL_SELECT_PK = 'SELECT * FROM url WHERE id=?';
    const SQL_DELETE_PK = 'DELETE FROM url WHERE id=?';
    const FIELD_ID = -836810246;
    const FIELD_LINK = -1015664359;
    const FIELD_ORIGINAL = -679320720;
    const FIELD_CLICKCOUNT = 1088732742;
    const FIELD_TOPICID = -928563957;

    private static $PRIMARY_KEYS = array(self::FIELD_ID);
    private static $AUTOINCREMENT_FIELDS = array(self::FIELD_ID);
    private static $FIELD_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_LINK => 'link',
        self::FIELD_ORIGINAL => 'original',
        self::FIELD_CLICKCOUNT => 'clickCount',
        self::FIELD_TOPICID => 'topicID');
    private static $PROPERTY_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_LINK => 'link',
        self::FIELD_ORIGINAL => 'original',
        self::FIELD_CLICKCOUNT => 'clickCount',
        self::FIELD_TOPICID => 'topicId');
    private static $PROPERTY_TYPES = array(
        self::FIELD_ID => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_LINK => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_ORIGINAL => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_CLICKCOUNT => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_TOPICID => Db2PhpEntity::PHP_TYPE_INT);
    private static $FIELD_TYPES = array(
        self::FIELD_ID => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_LINK => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 20, 0, false),
        self::FIELD_ORIGINAL => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 45, 0, false),
        self::FIELD_CLICKCOUNT => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, true),
        self::FIELD_TOPICID => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false));
    private static $DEFAULT_VALUES = array(
        self::FIELD_ID => null,
        self::FIELD_LINK => '',
        self::FIELD_ORIGINAL => '',
        self::FIELD_CLICKCOUNT => 0,
        self::FIELD_TOPICID => 0);
    private $id;
    private $link;
    private $original;
    private $clickCount;
    private $topicId;

    /**
     * set value for id 
     *
     * type:INT UNSIGNED,size:10,default:null,primary,unique,autoincrement
     *
     * @param mixed $id
     * @return Url
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
     * set value for link 
     *
     * type:VARCHAR,size:20,default:null
     *
     * @param mixed $link
     * @return Url
     */
    public function &setLink($link) {
        $this->notifyChanged(self::FIELD_LINK, $this->link, $link);
        $this->link = $link;
        return $this;
    }

    /**
     * get value for link 
     *
     * type:VARCHAR,size:20,default:null
     *
     * @return mixed
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * set value for original 
     *
     * type:VARCHAR,size:45,default:null
     *
     * @param mixed $original
     * @return Url
     */
    public function &setOriginal($original) {
        $this->notifyChanged(self::FIELD_ORIGINAL, $this->original, $original);
        $this->original = $original;
        return $this;
    }

    /**
     * get value for original 
     *
     * type:VARCHAR,size:45,default:null
     *
     * @return mixed
     */
    public function getOriginal() {
        return $this->original;
    }

    /**
     * set value for clickCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @param mixed $clickCount
     * @return Url
     */
    public function &setClickCount($clickCount) {
        $this->notifyChanged(self::FIELD_CLICKCOUNT, $this->clickCount, $clickCount);
        $this->clickCount = $clickCount;
        return $this;
    }

    /**
     * get value for clickCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @return mixed
     */
    public function getClickCount() {
        return $this->clickCount;
    }

    /**
     * set value for topicID 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @param mixed $topicId
     * @return Url
     */
    public function &setTopicId($topicId) {
        $this->notifyChanged(self::FIELD_TOPICID, $this->topicId, $topicId);
        $this->topicId = $topicId;
        return $this;
    }

    /**
     * get value for topicID 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @return mixed
     */
    public function getTopicId() {
        return $this->topicId;
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
            self::FIELD_LINK => $this->getLink(),
            self::FIELD_ORIGINAL => $this->getOriginal(),
            self::FIELD_CLICKCOUNT => $this->getClickCount(),
            self::FIELD_TOPICID => $this->getTopicId());
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
     * Match by attributes of passed example instance and return matched rows as an array of Url instances
     *
     * @param PDO $db a PDO Database instance
     * @param Url $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return Url[]
     */
    public static function findByExample(PDO $db, Url $example, $and = true, $sort = null) {
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
     * Will return matched rows as an array of Url instances.
     *
     * @param PDO $db a PDO Database instance
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return Url[]
     */
    public static function findByFilter(PDO $db, $filter, $and = true, $sort = null) {
        if (!($filter instanceof DFCInterface)) {
            $filter = new DFCAggregate($filter, $and);
        }
        $sql = 'SELECT * FROM url'
                . self::buildSqlWhere($filter, $and, false, true)
                . self::buildSqlOrderBy($sort);

        $stmt = self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }

    /**
     * Will execute the passed statement and return the result as an array of Url instances
     *
     * @param PDOStatement $stmt
     * @return Url[]
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
     * returns the result as an array of Url instances without executing the passed statement
     *
     * @param PDOStatement $stmt
     * @return Url[]
     */
    public static function fromExecutedStatement(PDOStatement $stmt) {
        $resultInstances = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $o = new Url();
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
     * Execute select query and return matched rows as an array of Url instances.
     *
     * The query should of course be on the table for this entity class and return all fields.
     *
     * @param PDO $db a PDO Database instance
     * @param string $sql
     * @return Url[]
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
        $sql = 'DELETE FROM url'
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
        $this->setLink($result['link']);
        $this->setOriginal($result['original']);
        $this->setClickCount($result['clickCount']);
        $this->setTopicId($result['topicID']);
    }

    /**
     * Get element instance by it's primary key(s).
     * Will return null if no row was matched.
     *
     * @param PDO $db
     * @return Url
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
        $o = new Url();
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
        $stmt->bindValue(2, $this->getLink());
        $stmt->bindValue(3, $this->getOriginal());
        $stmt->bindValue(4, $this->getClickCount());
        $stmt->bindValue(5, $this->getTopicId());
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
            $stmt->bindValue(1, $this->getLink());
            $stmt->bindValue(2, $this->getOriginal());
            $stmt->bindValue(3, $this->getClickCount());
            $stmt->bindValue(4, $this->getTopicId());
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
        $stmt->bindValue(6, $this->getId());
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
        return self::hashToDomDocument($this->toHash(), 'Url');
    }

    /**
     * get single Url instance from a DOMElement
     *
     * @param DOMElement $node
     * @return Url
     */
    public static function fromDOMElement(DOMElement $node) {
        $o = new Url();
        $o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
        $o->notifyPristine();
        return $o;
    }

    /**
     * get all instances of Url from the passed DOMDocument
     *
     * @param DOMDocument $doc
     * @return Url[]
     */
    public static function fromDOMDocument(DOMDocument $doc) {
        $instances = array();
        foreach ($doc->getElementsByTagName('Url') as $node) {
            $instances[] = self::fromDOMElement($node);
        }
        return $instances;
    }

}

?>
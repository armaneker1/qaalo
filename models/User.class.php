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
class User extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
    
    public function getThumbPhotoUrl() {
        if ($this->photo == "") {
            return __WEBROOT__ . "inc/thumb.jpg";
        } else {
            return __WEBROOT__ . "inc/img/user/t". $this->photo .".jpg";
        }
    }
    
    public function getPhotoUrl() {
        if ($this->photo == "") {
            return __WEBROOT__ . "inc/profile.jpg";
        } else {
            return __WEBROOT__ . "inc/img/user/". $this->photo .".jpg";
        }
    }
    
    public static function create() {
        return new User();
    }

    public function getFirstname() {
        $arr = explode(' ', trim($this->fullname));
        return $arr[0];
    }

    private static $CLASS_NAME = 'User';

    const SQL_IDENTIFIER_QUOTE = '';
    const SQL_TABLE_NAME = 'user';
    const SQL_INSERT = 'INSERT INTO user (id,email,password,lastLogin,fullname,bio,url,profession,mailSettings,loginCount,validationCode,photo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
    const SQL_INSERT_AUTOINCREMENT = 'INSERT INTO user (email,password,lastLogin,fullname,bio,url,profession,mailSettings,loginCount,validationCode,photo) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
    const SQL_UPDATE = 'UPDATE user SET id=?,email=?,password=?,lastLogin=?,fullname=?,bio=?,url=?,profession=?,mailSettings=?,loginCount=?,validationCode=?,photo=? WHERE id=?';
    const SQL_SELECT_PK = 'SELECT * FROM user WHERE id=?';
    const SQL_DELETE_PK = 'DELETE FROM user WHERE id=?';
    const FIELD_ID = -147180002;
    const FIELD_EMAIL = 518840249;
    const FIELD_PASSWORD = -361507490;
    const FIELD_LASTLOGIN = 306960400;
    const FIELD_FULLNAME = -246687651;
    const FIELD_BIO = -267619227;
    const FIELD_URL = -267600692;
    const FIELD_PROFESSION = -2018814209;
    const FIELD_MAILSETTINGS = -542146499;
    const FIELD_LOGINCOUNT = 1712791849;
    const FIELD_VALIDATIONCODE = -1491451255;
    const FIELD_PHOTO = 528863823;

    private static $PRIMARY_KEYS = array(self::FIELD_ID);
    private static $AUTOINCREMENT_FIELDS = array(self::FIELD_ID);
    private static $FIELD_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_EMAIL => 'email',
        self::FIELD_PASSWORD => 'password',
        self::FIELD_LASTLOGIN => 'lastLogin',
        self::FIELD_FULLNAME => 'fullname',
        self::FIELD_BIO => 'bio',
        self::FIELD_URL => 'url',
        self::FIELD_PROFESSION => 'profession',
        self::FIELD_MAILSETTINGS => 'mailSettings',
        self::FIELD_LOGINCOUNT => 'loginCount',
        self::FIELD_VALIDATIONCODE => 'validationCode',
        self::FIELD_PHOTO => 'photo');
    private static $PROPERTY_NAMES = array(
        self::FIELD_ID => 'id',
        self::FIELD_EMAIL => 'email',
        self::FIELD_PASSWORD => 'password',
        self::FIELD_LASTLOGIN => 'lastLogin',
        self::FIELD_FULLNAME => 'fullname',
        self::FIELD_BIO => 'bio',
        self::FIELD_URL => 'url',
        self::FIELD_PROFESSION => 'profession',
        self::FIELD_MAILSETTINGS => 'mailSettings',
        self::FIELD_LOGINCOUNT => 'loginCount',
        self::FIELD_VALIDATIONCODE => 'validationCode',
        self::FIELD_PHOTO => 'photo');
    private static $PROPERTY_TYPES = array(
        self::FIELD_ID => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_EMAIL => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_PASSWORD => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_LASTLOGIN => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_FULLNAME => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_BIO => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_URL => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_PROFESSION => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_MAILSETTINGS => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_LOGINCOUNT => Db2PhpEntity::PHP_TYPE_INT,
        self::FIELD_VALIDATIONCODE => Db2PhpEntity::PHP_TYPE_STRING,
        self::FIELD_PHOTO => Db2PhpEntity::PHP_TYPE_STRING);
    private static $FIELD_TYPES = array(
        self::FIELD_ID => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_EMAIL => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 255, 0, false),
        self::FIELD_PASSWORD => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 18, 0, false),
        self::FIELD_LASTLOGIN => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, false),
        self::FIELD_FULLNAME => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 100, 0, false),
        self::FIELD_BIO => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 255, 0, true),
        self::FIELD_URL => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 255, 0, true),
        self::FIELD_PROFESSION => array(Db2PhpEntity::JDBC_TYPE_TINYINT, 3, 0, true),
        self::FIELD_MAILSETTINGS => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 45, 0, true),
        self::FIELD_LOGINCOUNT => array(Db2PhpEntity::JDBC_TYPE_INTEGER, 10, 0, true),
        self::FIELD_VALIDATIONCODE => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 16, 0, false),
        self::FIELD_PHOTO => array(Db2PhpEntity::JDBC_TYPE_VARCHAR, 45, 0, true));
    private static $DEFAULT_VALUES = array(
        self::FIELD_ID => null,
        self::FIELD_EMAIL => '',
        self::FIELD_PASSWORD => '',
        self::FIELD_LASTLOGIN => 0,
        self::FIELD_FULLNAME => '',
        self::FIELD_BIO => null,
        self::FIELD_URL => null,
        self::FIELD_PROFESSION => null,
        self::FIELD_MAILSETTINGS => null,
        self::FIELD_LOGINCOUNT => 0,
        self::FIELD_VALIDATIONCODE => '',
        self::FIELD_PHOTO => null);
    private $id;
    private $email;
    private $password;
    private $lastLogin;
    private $fullname;
    private $bio;
    private $url;
    private $profession;
    private $mailSettings;
    private $loginCount;
    private $validationCode;
    private $photo;

    /**
     * set value for id 
     *
     * type:INT UNSIGNED,size:10,default:null,primary,unique,autoincrement
     *
     * @param mixed $id
     * @return User
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
     * set value for email 
     *
     * type:VARCHAR,size:255,default:null
     *
     * @param mixed $email
     * @return User
     */
    public function &setEmail($email) {
        $this->notifyChanged(self::FIELD_EMAIL, $this->email, $email);
        $this->email = $email;
        return $this;
    }

    /**
     * get value for email 
     *
     * type:VARCHAR,size:255,default:null
     *
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * set value for password 
     *
     * type:VARCHAR,size:18,default:null
     *
     * @param mixed $password
     * @return User
     */
    public function &setPassword($password) {
        $this->notifyChanged(self::FIELD_PASSWORD, $this->password, $password);
        $this->password = $password;
        return $this;
    }

    /**
     * get value for password 
     *
     * type:VARCHAR,size:18,default:null
     *
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * set value for lastLogin 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @param mixed $lastLogin
     * @return User
     */
    public function &setLastLogin($lastLogin) {
        $this->notifyChanged(self::FIELD_LASTLOGIN, $this->lastLogin, $lastLogin);
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * get value for lastLogin 
     *
     * type:INT UNSIGNED,size:10,default:null
     *
     * @return mixed
     */
    public function getLastLogin() {
        return $this->lastLogin;
    }

    /**
     * set value for fullname 
     *
     * type:VARCHAR,size:100,default:null
     *
     * @param mixed $fullname
     * @return User
     */
    public function &setFullname($fullname) {
        $this->notifyChanged(self::FIELD_FULLNAME, $this->fullname, $fullname);
        $this->fullname = $fullname;
        return $this;
    }

    /**
     * get value for fullname 
     *
     * type:VARCHAR,size:100,default:null
     *
     * @return mixed
     */
    public function getFullname() {
        return $this->fullname;
    }

    /**
     * set value for bio 
     *
     * type:VARCHAR,size:255,default:null,nullable
     *
     * @param mixed $bio
     * @return User
     */
    public function &setBio($bio) {
        $this->notifyChanged(self::FIELD_BIO, $this->bio, $bio);
        $this->bio = $bio;
        return $this;
    }

    /**
     * get value for bio 
     *
     * type:VARCHAR,size:255,default:null,nullable
     *
     * @return mixed
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * set value for url 
     *
     * type:VARCHAR,size:255,default:null,nullable
     *
     * @param mixed $url
     * @return User
     */
    public function &setUrl($url) {
        $this->notifyChanged(self::FIELD_URL, $this->url, $url);
        $this->url = $url;
        return $this;
    }

    /**
     * get value for url 
     *
     * type:VARCHAR,size:255,default:null,nullable
     *
     * @return mixed
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * set value for profession 
     *
     * type:TINYINT UNSIGNED,size:3,default:null,nullable
     *
     * @param mixed $profession
     * @return User
     */
    public function &setProfession($profession) {
        $this->notifyChanged(self::FIELD_PROFESSION, $this->profession, $profession);
        $this->profession = $profession;
        return $this;
    }

    /**
     * get value for profession 
     *
     * type:TINYINT UNSIGNED,size:3,default:null,nullable
     *
     * @return mixed
     */
    public function getProfession() {
        return $this->profession;
    }

    /**
     * set value for mailSettings 
     *
     * type:VARCHAR,size:45,default:null,nullable
     *
     * @param mixed $mailSettings
     * @return User
     */
    public function &setMailSettings($mailSettings) {
        $this->notifyChanged(self::FIELD_MAILSETTINGS, $this->mailSettings, $mailSettings);
        $this->mailSettings = $mailSettings;
        return $this;
    }

    /**
     * get value for mailSettings 
     *
     * type:VARCHAR,size:45,default:null,nullable
     *
     * @return mixed
     */
    public function getMailSettings() {
        return $this->mailSettings;
    }

    /**
     * set value for loginCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @param mixed $loginCount
     * @return User
     */
    public function &setLoginCount($loginCount) {
        $this->notifyChanged(self::FIELD_LOGINCOUNT, $this->loginCount, $loginCount);
        $this->loginCount = $loginCount;
        return $this;
    }

    /**
     * get value for loginCount 
     *
     * type:INT UNSIGNED,size:10,default:0,nullable
     *
     * @return mixed
     */
    public function getLoginCount() {
        return $this->loginCount;
    }

    /**
     * set value for validationCode 
     *
     * type:VARCHAR,size:16,default:null
     *
     * @param mixed $validationCode
     * @return User
     */
    public function &setValidationCode($validationCode) {
        $this->notifyChanged(self::FIELD_VALIDATIONCODE, $this->validationCode, $validationCode);
        $this->validationCode = $validationCode;
        return $this;
    }

    /**
     * get value for validationCode 
     *
     * type:VARCHAR,size:16,default:null
     *
     * @return mixed
     */
    public function getValidationCode() {
        return $this->validationCode;
    }

    /**
     * set value for photo 
     *
     * type:VARCHAR,size:45,default:null,nullable
     *
     * @param mixed $photo
     * @return User
     */
    public function &setPhoto($photo) {
        $this->notifyChanged(self::FIELD_PHOTO, $this->photo, $photo);
        $this->photo = $photo;
        return $this;
    }

    /**
     * get value for photo 
     *
     * type:VARCHAR,size:45,default:null,nullable
     *
     * @return mixed
     */
    public function getPhoto() {
        return $this->photo;
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
            self::FIELD_EMAIL => $this->getEmail(),
            self::FIELD_PASSWORD => $this->getPassword(),
            self::FIELD_LASTLOGIN => $this->getLastLogin(),
            self::FIELD_FULLNAME => $this->getFullname(),
            self::FIELD_BIO => $this->getBio(),
            self::FIELD_URL => $this->getUrl(),
            self::FIELD_PROFESSION => $this->getProfession(),
            self::FIELD_MAILSETTINGS => $this->getMailSettings(),
            self::FIELD_LOGINCOUNT => $this->getLoginCount(),
            self::FIELD_VALIDATIONCODE => $this->getValidationCode(),
            self::FIELD_PHOTO => $this->getPhoto());
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
     * Match by attributes of passed example instance and return matched rows as an array of User instances
     *
     * @param PDO $db a PDO Database instance
     * @param User $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return User[]
     */
    public static function findByExample(PDO $db, User $example, $and = true, $sort = null) {
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
     * Will return matched rows as an array of User instances.
     *
     * @param PDO $db a PDO Database instance
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @return User[]
     */
    public static function findByFilter(PDO $db, $filter, $and = true, $sort = null) {
        if (!($filter instanceof DFCInterface)) {
            $filter = new DFCAggregate($filter, $and);
        }
        $sql = 'SELECT * FROM user'
                . self::buildSqlWhere($filter, $and, false, true)
                . self::buildSqlOrderBy($sort);

        $stmt = self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }

    /**
     * Will execute the passed statement and return the result as an array of User instances
     *
     * @param PDOStatement $stmt
     * @return User[]
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
     * returns the result as an array of User instances without executing the passed statement
     *
     * @param PDOStatement $stmt
     * @return User[]
     */
    public static function fromExecutedStatement(PDOStatement $stmt) {
        $resultInstances = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $o = new User();
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
     * Execute select query and return matched rows as an array of User instances.
     *
     * The query should of course be on the table for this entity class and return all fields.
     *
     * @param PDO $db a PDO Database instance
     * @param string $sql
     * @return User[]
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
        $sql = 'DELETE FROM user'
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
        $this->setEmail($result['email']);
        $this->setPassword($result['password']);
        $this->setLastLogin($result['lastLogin']);
        $this->setFullname($result['fullname']);
        $this->setBio($result['bio']);
        $this->setUrl($result['url']);
        $this->setProfession($result['profession']);
        $this->setMailSettings($result['mailSettings']);
        $this->setLoginCount($result['loginCount']);
        $this->setValidationCode($result['validationCode']);
        $this->setPhoto($result['photo']);
    }

    /**
     * Get element instance by it's primary key(s).
     * Will return null if no row was matched.
     *
     * @param PDO $db
     * @return User
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
        $o = new User();
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
        $stmt->bindValue(2, $this->getEmail());
        $stmt->bindValue(3, $this->getPassword());
        $stmt->bindValue(4, $this->getLastLogin());
        $stmt->bindValue(5, $this->getFullname());
        $stmt->bindValue(6, $this->getBio());
        $stmt->bindValue(7, $this->getUrl());
        $stmt->bindValue(8, $this->getProfession());
        $stmt->bindValue(9, $this->getMailSettings());
        $stmt->bindValue(10, $this->getLoginCount());
        $stmt->bindValue(11, $this->getValidationCode());
        $stmt->bindValue(12, $this->getPhoto());
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
            $stmt->bindValue(1, $this->getEmail());
            $stmt->bindValue(2, $this->getPassword());
            $stmt->bindValue(3, $this->getLastLogin());
            $stmt->bindValue(4, $this->getFullname());
            $stmt->bindValue(5, $this->getBio());
            $stmt->bindValue(6, $this->getUrl());
            $stmt->bindValue(7, $this->getProfession());
            $stmt->bindValue(8, $this->getMailSettings());
            $stmt->bindValue(9, $this->getLoginCount());
            $stmt->bindValue(10, $this->getValidationCode());
            $stmt->bindValue(11, $this->getPhoto());
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
        $stmt->bindValue(13, $this->getId());
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
        return self::hashToDomDocument($this->toHash(), 'User');
    }

    /**
     * get single User instance from a DOMElement
     *
     * @param DOMElement $node
     * @return User
     */
    public static function fromDOMElement(DOMElement $node) {
        $o = new User();
        $o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
        $o->notifyPristine();
        return $o;
    }

    /**
     * get all instances of User from the passed DOMDocument
     *
     * @param DOMDocument $doc
     * @return User[]
     */
    public static function fromDOMDocument(DOMDocument $doc) {
        $instances = array();
        foreach ($doc->getElementsByTagName('User') as $node) {
            $instances[] = self::fromDOMElement($node);
        }
        return $instances;
    }

}

?>